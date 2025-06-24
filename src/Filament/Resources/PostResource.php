<?php

namespace LaraZeus\Sky\Filament\Resources;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use LaraZeus\Helen\Actions\ShortUrlAction;
use LaraZeus\Helen\HelenServiceProvider;
use LaraZeus\Sky\Filament\Resources\PostResource\Pages\CreatePost;
use LaraZeus\Sky\Filament\Resources\PostResource\Pages\EditPost;
use LaraZeus\Sky\Filament\Resources\PostResource\Pages\ListPosts;
use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\SkyPlugin;

// @mixin Builder<PostScope>
class PostResource extends SkyResource
{
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 1;

    public static function getModel(): string
    {
        return SkyPlugin::get()->getModel('Post');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('post_tabs')
                    ->schema([
                        Tab::make(__('Title & Content'))
                            ->schema([
                                TextInput::make('title')
                                    ->label(__('Post Title'))
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Set $set, $state, $context) {
                                        if ($context === 'edit') {
                                            return;
                                        }

                                        $set('slug', Str::slug($state));
                                    }),
                                config('zeus-sky.editor')::component()
                                    ->label(__('Post Content')),
                            ]),

                        Tab::make(__('SEO'))
                            ->schema([
                                Hidden::make('user_id')
                                    ->default(auth()->user()?->id ?? 0)
                                    ->required(),

                                Hidden::make('post_type')
                                    ->default('post')
                                    ->required(),

                                Textarea::make('description')
                                    ->maxLength(255)
                                    ->label(__('Description'))
                                    ->hint(__('Write an excerpt for your post')),

                                TextInput::make('slug')
                                    ->unique()
                                    ->required()
                                    ->maxLength(255)
                                    ->label(__('Post Slug')),
                            ]),

                        Tab::make(__('Tags'))
                            ->schema([
                                SpatieTagsInput::make('tags')
                                    ->type('tag')
                                    ->label(__('Tags')),

                                SpatieTagsInput::make('category')
                                    ->type('category')
                                    ->label(__('Categories')),
                            ]),

                        Tab::make(__('Visibility'))
                            ->schema([
                                Select::make('status')
                                    ->label(__('status'))
                                    ->default('publish')
                                    ->required()
                                    ->live()
                                    ->options(SkyPlugin::get()->getModel('PostStatus')),

                                TextInput::make('password')
                                    ->label(__('Password'))
                                    ->visible(fn (Get $get): bool => $get('status')->value === 'private'),

                                DateTimePicker::make('published_at')
                                    ->label(__('published at'))
                                    ->required()
                                    ->native(false)
                                    ->default(now()),

                                DateTimePicker::make('sticky_until')
                                    ->native(false)
                                    ->label(__('Sticky Until')),
                            ]),

                        Tab::make(__('Image'))
                            ->schema([
                                ToggleButtons::make('featured_image_type')
                                    ->dehydrated(false)
                                    ->hiddenLabel()
                                    ->live()
                                    ->afterStateHydrated(function (Set $set, Get $get) {
                                        $setVal = ($get('featured_image') === null) ? 'upload' : 'url';
                                        $set('featured_image_type', $setVal);
                                    })
                                    ->grouped()
                                    ->options([
                                        'upload' => __('upload'),
                                        'url' => __('url'),
                                    ])
                                    ->default('upload'),
                                SpatieMediaLibraryFileUpload::make('featured_image_upload')
                                    ->collection('posts')
                                    ->disk(SkyPlugin::get()->getUploadDisk())
                                    ->directory(SkyPlugin::get()->getUploadDirectory())
                                    ->visible(fn (Get $get) => $get('featured_image_type') === 'upload')
                                    ->label(''),

                                TextInput::make('featured_image')
                                    ->label(__('featured image url'))
                                    ->visible(fn (Get $get) => $get('featured_image_type') === 'url')
                                    ->url(),
                            ]),
                    ])
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ViewColumn::make('title_card')
                    ->label(__('Title'))
                    ->sortable(['title'])
                    ->searchable(['title'])
                    ->toggleable()
                    ->view('zeus::filament.columns.post-title'),

                TextColumn::make('status')
                    ->label(__('Status'))
                    ->sortable(['status'])
                    ->searchable(['status'])
                    ->toggleable()
                    ->tooltip(fn (Post $record): string => $record->published_at->format('Y/m/d | H:i A'))
                    ->description(fn ($record) => optional($record->published_at)->diffForHumans()),

                SpatieTagsColumn::make('tags')
                    ->label(__('Post Tags'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->type('tag'),

                SpatieTagsColumn::make('category')
                    ->label(__('Post Category'))
                    ->toggleable()
                    ->type('category'),
            ])
            ->defaultSort('id', 'desc')
            ->recordActions(static::getActions())
            ->toolbarActions([
                DeleteBulkAction::make(),
                ForceDeleteBulkAction::make(),
                RestoreBulkAction::make(),
            ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('status')
                    ->multiple()
                    ->label(__('Status'))
                    ->options(SkyPlugin::get()->getModel('PostStatus')),

                Filter::make('password')
                    ->label(__('Password Protected'))
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('password')),

                Filter::make('sticky')
                    ->label(__('Still Sticky'))
                    // @phpstan-ignore-next-line
                    ->query(fn (Builder $query): Builder => $query->sticky()),

                Filter::make('not_sticky')
                    ->label(__('Not Sticky'))
                    ->query(
                        fn (Builder $query): Builder => $query
                            ->whereDate('sticky_until', '<=', now())
                            ->orWhereNull('sticky_until')
                    ),

                Filter::make('sticky_only')
                    ->label(__('Sticky Only'))
                    ->query(
                        fn (Builder $query): Builder => $query
                            ->where('post_type', 'post')
                            ->whereNotNull('sticky_until')
                    ),

                SelectFilter::make('tags')
                    ->multiple()
                    ->relationship('tags', 'name')
                    ->label(__('Tags')),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): string
    {
        return __('Post');
    }

    public static function getPluralLabel(): string
    {
        return __('Posts');
    }

    public static function getNavigationLabel(): string
    {
        return __('Posts');
    }

    public static function getNavigationBadge(): ?string
    {
        if (! SkyPlugin::getNavigationBadgesVisibility(static::class)) {
            return null;
        }

        return (string) SkyPlugin::get()->getModel('Post')::posts()->count();
    }

    public static function getActions(): array
    {
        $action = [
            EditAction::make('edit')->label(__('Edit')),
            Action::make('Open')
                ->color('warning')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->label(__('Open'))
                ->visible(! config('zeus-sky.headless'))
                ->url(fn (Post $record): string => route(
                    SkyPlugin::get()->getRouteNamePrefix() . 'post',
                    ['slug' => $record]
                ))
                ->openUrlInNewTab(),
            DeleteAction::make('delete'),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];

        if (
            class_exists(HelenServiceProvider::class)
            && ! config('zeus-sky.headless')
        ) {
            // @phpstan-ignore-next-line
            $action[] = ShortUrlAction::make('get-link')
                ->distUrl(fn (Post $record): string => route(
                    SkyPlugin::get()->getRouteNamePrefix() . 'post',
                    ['slug' => $record]
                ));
        }

        return [ActionGroup::make($action)];
    }
}
