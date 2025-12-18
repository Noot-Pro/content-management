<?php

namespace NootPro\ContentManagement\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\View;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use NootPro\ContentManagement\Filament\Resources\NavigationResource\Pages\ListNavigations;
use NootPro\ContentManagement\Filament\Resources\NavigationResource\Pages\CreateNavigation;
use NootPro\ContentManagement\Filament\Resources\NavigationResource\Pages\EditNavigation;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use NootPro\ContentManagement\ContentManagementPlugin;
use NootPro\ContentManagement\Models\Navigation;

class NavigationResource extends BaseResource
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-queue-list';

    protected static ?int $navigationSort = 99;

    protected static bool $showTimestamps = true;

    public static function disableTimestamps(bool $condition = true): void
    {
        static::$showTimestamps = ! $condition;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('')->schema([
                    TextInput::make('name')
                        ->label(__('noot-pro-content-management::filament-navigation.attributes.name'))
                        ->reactive()
                        ->debounce()
                        ->afterStateUpdated(function (?string $state, Set $set) {
                            if (! $state) {
                                return;
                            }

                            $set('handle', Str::slug($state));
                        })
                        ->required(),
                    ViewField::make('items')
                        ->label(__('noot-pro-content-management::filament-navigation.attributes.items'))
                        ->default([])
                        ->view('zeus::filament.navigation-builder'),
                ])
                    ->columnSpan([
                        12,
                        'lg' => 8,
                    ]),
                Section::make()
                    ->hiddenLabel()
                    ->schema([
                        TextInput::make('handle')
                            ->label(__('noot-pro-content-management::filament-navigation.attributes.handle'))
                            ->required()
                            ->unique(ignoreRecord: true),
                        View::make('zeus::filament.card-divider')
                            ->visible(static::$showTimestamps),
                        Placeholder::make('created_at')
                            ->label(__('noot-pro-content-management::filament-navigation.attributes.created_at'))
                            ->visible(static::$showTimestamps)
                            ->content(fn (?Navigation $record) => $record ? $record->created_at->translatedFormat(Table::$defaultDateTimeDisplayFormat) : new HtmlString('&mdash;')),
                        Placeholder::make('updated_at')
                            ->label(__('noot-pro-content-management::filament-navigation.attributes.updated_at'))
                            ->visible(static::$showTimestamps)
                            ->content(fn (?Navigation $record) => $record ? $record->updated_at->translatedFormat(Table::$defaultDateTimeDisplayFormat) : new HtmlString('&mdash;')),
                    ])
                    ->columnSpan([
                        12,
                        'lg' => 4,
                    ]),
            ])
            ->columns(12);
    }

    public static function getLabel(): string
    {
        return __('Navigation');
    }

    public static function getPluralLabel(): string
    {
        return __('Navigations');
    }

    public static function getNavigationLabel(): string
    {
        return __('Navigations');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('noot-pro-content-management::filament-navigation.attributes.name'))
                    ->searchable(),
                TextColumn::make('handle')
                    ->label(__('noot-pro-content-management::filament-navigation.attributes.handle'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('noot-pro-content-management::filament-navigation.attributes.created_at'))
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label(__('noot-pro-content-management::filament-navigation.attributes.updated_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make()
                    ->icon(null),
                DeleteAction::make()
                    ->icon(null),
            ])
            ->filters([

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNavigations::route('/'),
            'create' => CreateNavigation::route('/create'),
            'edit' => EditNavigation::route('/{record}'),
        ];
    }

    public static function getModel(): string
    {
        return ContentManagementPlugin::get()->getModel('Navigation');
    }
}
