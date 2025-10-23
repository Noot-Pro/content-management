<?php

namespace LaraZeus\Sky\Filament\Resources;

use BackedEnum;
use Exception;
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
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use LaraZeus\Helen\Actions\ShortUrlAction;
use LaraZeus\Helen\HelenServiceProvider;
use LaraZeus\Sky\Filament\Resources\LibraryResource\Pages\CreateLibrary;
use LaraZeus\Sky\Filament\Resources\LibraryResource\Pages\EditLibrary;
use LaraZeus\Sky\Filament\Resources\LibraryResource\Pages\ListLibrary;
use LaraZeus\Sky\Models\Library;
use LaraZeus\Sky\SkyPlugin;

class LibraryResource extends SkyResource
{
    protected static ?string $slug = 'library';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-folder';

    protected static ?int $navigationSort = 4;

    public static function getModel(): string
    {
        return SkyPlugin::get()->getModel('Library');
    }

    /**
     * @throws Exception
     */
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('zeus-sky::cms.library.library_file'))
                    ->columnSpanFull()
                    ->columns()
                    ->schema([
                        TextInput::make('title')
                            ->label(__('zeus-sky::cms.library.library_title'))
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
                            ->unique()
                            ->required()
                            ->maxLength(255)
                            ->label(__('zeus-sky::cms.library.library_slug')),

                        Textarea::make('description')
                            ->maxLength(255)
                            ->label(__('zeus-sky::cms.library.library_description'))
                            ->columnSpan(2),

                        SpatieTagsInput::make('category')
                            ->type('library')
                            ->label(__('zeus-sky::cms.library.library_categories')),

                        Select::make('type')
                            ->label(__('zeus-sky::cms.library.library_type'))
                            ->visible(SkyPlugin::get()->getLibraryTypes() !== null)
                            ->options(SkyPlugin::get()->getLibraryTypes()),
                    ]),

                Section::make(__('zeus-sky::cms.library.library_file'))
                    ->columnSpanFull()
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
                                'upload' => __('zeus-sky::cms.library.upload'),
                                'url' => __('zeus-sky::cms.library.url'),
                            ])
                            ->default('upload'),
                        SpatieMediaLibraryFileUpload::make('file_path_upload')
                            ->disk(SkyPlugin::get()->getUploadDisk())
                            ->directory(SkyPlugin::get()->getUploadDirectory())
                            ->collection('library')
                            ->multiple()
                            ->reorderable()
                            ->visible(fn (Get $get) => $get('upload_or_url') === 'upload')
                            ->label(''),

                        TextInput::make('file_path')
                            ->label(__('zeus-sky::cms.library.file_url'))
                            ->visible(fn (Get $get) => $get('upload_or_url') === 'url')
                            ->url(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('zeus-sky::cms.library.library_title'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('slug')
                    ->label(__('zeus-sky::cms.library.library_slug'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('type')
                    ->label(__('zeus-sky::cms.library.library_type'))
                    ->searchable()
                    ->sortable()
                    ->visible(SkyPlugin::get()->getLibraryTypes() !== null)
                    ->formatStateUsing(fn (string $state): string => str($state)->title())
                    ->color('')
                    ->color(fn (string $state) => match ($state) {
                        'IMAGE' => 'primary',
                        'FILE' => 'success',
                        'VIDEO' => 'warning',
                        default => '',
                    })
                    ->icon(fn (string $state) => match ($state) {
                        'IMAGE' => Heroicon::Photo,
                        'FILE' => Heroicon::Document,
                        'VIDEO' => Heroicon::Film,
                        default => Heroicon::DocumentMagnifyingGlass,
                    })
                    ->toggleable(),

                SpatieTagsColumn::make('tags')
                    ->label(__('zeus-sky::cms.library.library_tags'))
                    ->toggleable()
                    ->type('library'),
            ])
            ->recordActions(static::getActions())
            ->filters([
                SelectFilter::make('type')
                    ->visible()
                    ->options(SkyPlugin::get()->getLibraryTypes())
                    ->visible(SkyPlugin::get()->getLibraryTypes() !== null)
                    ->label(__('zeus-sky::cms.library.library_type')),
                SelectFilter::make('tags')
                    ->multiple()
                    ->relationship('tags', 'name')
                    ->label(__('zeus-sky::cms.library.library_tags')),
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
        return __('zeus-sky::cms.library.label');
    }

    public static function getPluralLabel(): string
    {
        return __('zeus-sky::cms.library.plural_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('zeus-sky::cms.library.navigation_label');
    }

    public static function getActions(): array
    {
        $action = [
            EditAction::make('edit'),
            Action::make('Open')
                ->color('warning')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->label(__('zeus-sky::cms.open_action'))
                ->visible(! config('zeus-sky.headless'))
                ->url(fn (Library $record): string => route(SkyPlugin::get()->getRouteNamePrefix() . 'library.item', ['slug' => $record->slug]))
                ->openUrlInNewTab(),
            DeleteAction::make('delete'),
        ];

        if (
            class_exists(HelenServiceProvider::class)
            && ! config('zeus-sky.headless')
        ) {
            // @phpstan-ignore-next-line
            $action[] = ShortUrlAction::make('get-link')
                ->distUrl(fn (Library $record): string => route(SkyPlugin::get()->getRouteNamePrefix() . 'library.item', ['slug' => $record->slug]));
        }

        return [ActionGroup::make($action)];
    }
}
