<?php

namespace NootPro\ContentManagement\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use NootPro\ContentManagement\Filament\Resources\PageResource\Pages\ListPage;
use NootPro\ContentManagement\Filament\Resources\PageResource\Pages\CreatePage;
use NootPro\ContentManagement\Filament\Resources\PageResource\Pages\EditPage;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use LaraZeus\Helen\HelenServiceProvider;
use LaraZeus\Helen\Actions\ShortUrlAction;
use Filament\Actions\ActionGroup;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use NootPro\ContentManagement\ContentManagementPlugin;
use NootPro\ContentManagement\Filament\Resources\PageResource\Pages;
use NootPro\ContentManagement\Models\Post;

class PageResource extends BaseResource
{
    protected static ?string $slug = 'pages';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document';

    protected static ?int $navigationSort = 2;

    public static function getModel(): string
    {
        return ContentManagementPlugin::get()->getModel('Post');
    }

    /**
     * @return Builder<Post>
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('post_tabs')->schema([
                Tab::make(__('Title & Content'))->schema([
                    TextInput::make('title')
                        ->label(__('Page Title'))
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Set $set, $state) {
                            $set('slug', Str::slug($state));
                        }),
                    config('noot-pro-content-management.editor')::component(),
                ]),
                Tab::make(__('SEO'))->schema([
                    Hidden::make('user_id')
                        ->required()
                        ->default(auth()->user()->id),

                    Hidden::make('post_type')
                        ->default('page')
                        ->required(),

                    Textarea::make('description')
                        ->maxLength(255)
                        ->label(__('Description'))
                        ->hint(__('Write an excerpt for your page')),

                    TextInput::make('slug')
                        ->unique(ignoreRecord: true)
                        ->required()
                        ->maxLength(255)
                        ->label(__('Page Slug')),

                    Select::make('parent_id')
                        ->options(ContentManagementPlugin::get()->getModel('Post')::where('post_type', 'page')->pluck(
                            'title',
                            'id'
                        ))
                        ->searchable()
                        ->label(__('Parent Page')),

                    TextInput::make('ordering')
                        ->integer()
                        ->label(__('Page Order'))
                        ->default(1),
                ]),
                Tab::make(__('Visibility'))->schema([
                    Select::make('status')
                        ->label(__('status'))
                        ->default('publish')
                        ->required()
                        ->live()
                        ->native(false)
                        ->options(ContentManagementPlugin::get()->getModel('PostStatus')::pluck('label', 'name')),

                    TextInput::make('password')
                        ->label(__('Password'))
                        ->visible(fn (Get $get): bool => $get('status') === 'private'),

                    DateTimePicker::make('published_at')
                        ->label(__('published at'))
                        ->required()
                        ->default(now()),
                ]),
                Tab::make(__('Image'))->schema([
                    Placeholder::make(__('Featured Image')),
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
                        ->collection('pages')
                        ->disk(ContentManagementPlugin::get()->getUploadDisk())
                        ->directory(ContentManagementPlugin::get()->getUploadDirectory())
                        ->visible(fn (Get $get) => $get('featured_image_type') === 'upload')
                        ->label(''),
                    TextInput::make('featured_image')
                        ->label(__('featured image url'))
                        ->visible(fn (Get $get) => $get('featured_image_type') === 'url')
                        ->url(),
                ]),
            ])->columnSpan(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('title')
                    ->label(__('Title'))
                    ->sortable(['title'])
                    ->searchable(['title'])
                    ->toggleable(),

                TextColumn::make('status')
                    ->label(__('Status'))
                    ->sortable(['status'])
                    ->searchable(['status'])
                    ->toggleable()
//                    ->view('zeus::filament.columns.status-desc')
                    ->tooltip(fn (Post $record): string => $record->published_at->format('Y/m/d | H:i A')),

                TextColumn::make('parent.title'),
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
                    ->options(ContentManagementPlugin::get()->getModel('PostStatus')::pluck('label', 'name')),
                Filter::make('password')
                    ->label(__('Password Protected'))
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('password')),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPage::route('/'),
            'create' => CreatePage::route('/create'),
            'edit' => EditPage::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): string
    {
        return __('Page');
    }

    public static function getPluralLabel(): string
    {
        return __('Pages');
    }

    public static function getNavigationLabel(): string
    {
        return __('Pages');
    }

    public static function getNavigationBadge(): ?string
    {
        if (! ContentManagementPlugin::getNavigationBadgesVisibility(static::class)) {
            return null;
        }

        return (string) ContentManagementPlugin::get()->getModel('Post')::page()->count();
    }

    public static function getActions(): array
    {
        $action = [
            EditAction::make('edit')->label(__('Edit')),
            Action::make('Open')
                ->color('warning')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->label(__('Open'))
                ->visible(! config('noot-pro-content-management.headless'))
                ->url(fn (Post $record): string => route(ContentManagementPlugin::get()->getRouteNamePrefix() . 'page', ['slug' => $record]))
                ->openUrlInNewTab(),
            DeleteAction::make('delete'),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];

        if (
            class_exists(HelenServiceProvider::class)
            && ! config('noot-pro-content-management.headless')
        ) {
            // @phpstan-ignore-next-line
            $action[] = ShortUrlAction::make('get-link')
                ->distUrl(fn (Post $record): string => route(ContentManagementPlugin::get()->getRouteNamePrefix() . 'page', ['slug' => $record]));
        }

        return [ActionGroup::make($action)];
    }
}
