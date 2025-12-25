<?php

namespace NootPro\ContentManagement\Filament\Resources;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use LaraZeus\Helen\Actions\ShortUrlAction;
use LaraZeus\Helen\HelenServiceProvider;
use NootPro\ContentManagement\ContentManagementPlugin;
use NootPro\ContentManagement\Filament\Resources\LibraryResource\Pages\CreateLibrary;
use NootPro\ContentManagement\Filament\Resources\LibraryResource\Pages\EditLibrary;
use NootPro\ContentManagement\Filament\Resources\LibraryResource\Pages\ListLibrary;
use NootPro\ContentManagement\Models\Library;

class LibraryResource extends BaseResource
{
    protected static ?string $slug = 'library';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-folder';

    protected static ?int $navigationSort = 4;

    public static function getModel(): string
    {
        return ContentManagementPlugin::get()->getModel('Library');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make(__('Library File'))
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label(__('Library Title'))
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, $state, $context) {
                                if ($context === 'edit') {
                                    return;
                                }

                                $set('slug', Str::slug($state));
                            }),

                        TextInput::make('slug')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->maxLength(255)
                            ->label(__('Library Slug')),

                        Textarea::make('description')
                            ->maxLength(255)
                            ->label(__('Library Description'))
                            ->columnSpan(2),

                        SpatieTagsInput::make('category')
                            ->type('library')
                            ->label(__('Library Categories')),

                        Select::make('type')
                            ->label(__('Library Type'))
                            ->visible(ContentManagementPlugin::get()->getLibraryTypes() !== null)
                            ->options(ContentManagementPlugin::get()->getLibraryTypes())
                            ->native(false),
                    ]),

                Section::make(__('Library File'))
                    ->collapsible()
                    ->compact()
                    ->schema([
                        ToggleButtons::make('upload_or_url')
                            ->dehydrated(false)
                            ->hiddenLabel()
                            ->live()
                            ->afterStateHydrated(function (Set $set, Get $get) {
                                $setVal = ($get('file_path') === null) ? 'upload' : 'url';
                                $set('upload_or_url', $setVal);
                            })
                            ->grouped()
                            ->options([
                                'upload' => __('upload'),
                                'url' => __('url'),
                            ])
                            ->default('upload'),
                        SpatieMediaLibraryFileUpload::make('file_path_upload')
                            ->disk(ContentManagementPlugin::get()->getUploadDisk())
                            ->directory(ContentManagementPlugin::get()->getUploadDirectory())
                            ->collection('library')
                            ->multiple()
                            ->reorderable()
                            ->visible(fn (Get $get) => $get('upload_or_url') === 'upload')
                            ->label(__('Library file upload')),

                        TextInput::make('file_path')
                            ->label(__('file url'))
                            ->visible(fn (Get $get) => $get('upload_or_url') === 'url')
                            ->url(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label(__('Library Title'))->searchable()->sortable()->toggleable(),
                TextColumn::make('slug')->label(__('Library Slug'))->searchable()->sortable()->toggleable(),

                TextColumn::make('type')
                    ->label(__('Library Type'))
                    ->searchable()
                    ->sortable()
                    ->visible(ContentManagementPlugin::get()->getLibraryTypes() !== null)
                    ->formatStateUsing(function (string $state): string {
                        $libraryTypes = ContentManagementPlugin::get()->getLibraryTypes();

                        return $libraryTypes[$state] ?? str($state)->title();
                    })
                    ->color('')
                    ->color(fn (string $state) => match ($state) {
                        'IMAGE' => 'primary',
                        'FILE' => 'success',
                        'VIDEO' => 'warning',
                        default => '',
                    })
                    ->icon(fn (string $state) => match ($state) {
                        'IMAGE' => 'heroicon-o-photo',
                        'FILE' => 'heroicon-o-document',
                        'VIDEO' => 'heroicon-o-film',
                        default => 'heroicon-o-document-magnifying-glass',
                    })
                    ->toggleable(),

                SpatieTagsColumn::make('tags')
                    ->label(__('Library Tags'))
                    ->toggleable()
                    ->type('library'),
            ])
            ->recordActions(static::getActions())
            ->filters([
                SelectFilter::make('type')
                    ->visible()
                    ->options(ContentManagementPlugin::get()->getLibraryTypes())
                    ->visible(ContentManagementPlugin::get()->getLibraryTypes() !== null)
                    ->label(__('type')),
                SelectFilter::make('tags')
                    ->multiple()
                    ->relationship('tags', 'name')
                    ->label(__('Tags')),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLibrary::route('/'),
            'create' => CreateLibrary::route('/create'),
            'edit' => EditLibrary::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): string
    {
        return __('Library');
    }

    public static function getPluralLabel(): string
    {
        return __('Libraries');
    }

    public static function getNavigationLabel(): string
    {
        return __('Libraries');
    }

    public static function getActions(): array
    {
        $action = [
            EditAction::make('edit')
                ->label(__('Edit')),
            Action::make('Open')
                ->color('warning')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->label(__('Open'))
                ->visible(! config('noot-pro-content-management.headless'))
                ->url(fn (Library $record): string => route(ContentManagementPlugin::get()->getRouteNamePrefix() . 'library.item', ['slug' => $record->slug]))
                ->openUrlInNewTab(),
            DeleteAction::make('delete')
                ->label(__('Delete')),
        ];

        if (
            class_exists(HelenServiceProvider::class)
            && ! config('noot-pro-content-management.headless')
        ) {
            // @phpstan-ignore-next-line
            $action[] = ShortUrlAction::make('get-link')
                ->distUrl(fn (Library $record): string => route(ContentManagementPlugin::get()->getRouteNamePrefix() . 'library.item', ['slug' => $record->slug]));
        }

        return [ActionGroup::make($action)];
    }
}
