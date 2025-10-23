<?php

namespace LaraZeus\Sky\Filament\Resources;

use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use LaraZeus\Sky\Filament\Resources\TagResource\Pages\CreateTag;
use LaraZeus\Sky\Filament\Resources\TagResource\Pages\EditTag;
use LaraZeus\Sky\Filament\Resources\TagResource\Pages\ListTags;
use LaraZeus\Sky\Models\Tag;
use LaraZeus\Sky\Rules\UniqueTranslationRule;
use LaraZeus\Sky\SkyPlugin;

class TagResource extends SkyResource
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-tag';

    protected static ?int $navigationSort = 5;

    public static function getModel(): string
    {
        return SkyPlugin::get()->getModel('Tag');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->columns()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label(__('zeus-sky::cms.tags.name'))
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, $state) {
                                $set('slug', Str::slug($state));
                            }),
                        TextInput::make('slug')
                            ->label(__('zeus-sky::cms.tags.slug'))
                            ->rules(function ($record) {
                                return [new UniqueTranslationRule(Tag::class, $record)];
                            })
                            ->required()
                            ->maxLength(255),
                        Select::make('type')
                            ->label(__('zeus-sky::cms.tags.type'))
                            ->columnSpan(2)
                            ->options(SkyPlugin::get()->getTagTypes()),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('zeus-sky::cms.tags.name'))
                    ->toggleable()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->label(__('zeus-sky::cms.tags.type'))
                    ->toggleable()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->label(__('zeus-sky::cms.tags.slug'))
                    ->toggleable()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('items_count')
                    ->label(__('zeus-sky::cms.tags.items_count'))
                    ->toggleable()
                    ->getStateUsing(
                        fn(Tag $record): int => method_exists($record, $record->type)
                            ? $record->{$record->type}()->count()
                            : 0
                    ),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options(SkyPlugin::get()->getTagTypes())
                    ->label(__('zeus-sky::cms.tags.type')),
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make('edit'),
                    DeleteAction::make('delete'),
                ]),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTags::route('/'),
            'create' => CreateTag::route('/create'),
            'edit' => EditTag::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): string
    {
        return __('zeus-sky::cms.tags.label');
    }

    public static function getPluralLabel(): string
    {
        return __('zeus-sky::cms.tags.plural_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('zeus-sky::cms.tags.navigation_label');
    }
}
