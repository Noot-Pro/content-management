<?php

namespace NootPro\ContentManagement\Filament\Resources;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use NootPro\ContentManagement\Filament\Resources\TagResource\Pages;
use NootPro\ContentManagement\Models\Tag;
use NootPro\ContentManagement\Rules\UniqueTranslationRule;
use NootPro\ContentManagement\ContentManagementPlugin;

class TagResource extends BaseResource
{
    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?int $navigationSort = 5;

    public static function getModel(): string
    {
        return ContentManagementPlugin::get()->getModel('Tag');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                            ->options(ContentManagementPlugin::get()->getTagTypes()),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
            ->actions([
                ActionGroup::make([
                    EditAction::make('edit'),
                    DeleteAction::make('delete'),
                ]),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTags::route('/'),
            'create' => Pages\CreateTag::route('/create'),
            'edit' => Pages\EditTag::route('/{record}/edit'),
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
