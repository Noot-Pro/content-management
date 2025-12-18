<?php

namespace NootPro\ContentManagement\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use NootPro\ContentManagement\Filament\Resources\TagResource\Pages\ListTags;
use NootPro\ContentManagement\Filament\Resources\TagResource\Pages\CreateTag;
use NootPro\ContentManagement\Filament\Resources\TagResource\Pages\EditTag;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use NootPro\ContentManagement\ContentManagementPlugin;
use NootPro\ContentManagement\Filament\Resources\TagResource\Pages;
use NootPro\ContentManagement\Models\Tag;
use NootPro\ContentManagement\Rules\UniqueTranslationRule;

class TagResource extends BaseResource
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-tag';

    protected static ?int $navigationSort = 5;

    public static function getModel(): string
    {
        return ContentManagementPlugin::get()->getModel('Tag');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label(__('Tag.Name'))
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, $state) {
                                $set('slug', Str::slug($state));
                            }),
                        TextInput::make('slug')
                            ->rules(function ($record) {
                                return [new UniqueTranslationRule(Tag::class, $record)];
                            })
                            ->required()
                            ->maxLength(255),
                        Select::make('type')
                            ->columnSpan(2)
                            ->native(false)
                            ->options(ContentManagementPlugin::get()->getTagTypes()),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                return $query->where('type', array_keys(ContentManagementPlugin::get()->getTagTypes()));
            })
            ->columns([
                TextColumn::make('name')->toggleable()->searchable()->sortable(),
                TextColumn::make('type')->toggleable()->searchable()->sortable(),
                TextColumn::make('slug')->toggleable()->searchable()->sortable(),
                TextColumn::make('items_count')
                    ->toggleable()
                    ->getStateUsing(
                        fn (Tag $record): int => method_exists($record, $record->type)
                            ? $record->{$record->type}()->count()
                            : 0
                    ),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options(ContentManagementPlugin::get()->getTagTypes())
                    ->label(__('type')),
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
        return __('Tag');
    }

    public static function getPluralLabel(): string
    {
        return __('Tags');
    }

    public static function getNavigationLabel(): string
    {
        return __('Tags');
    }
}
