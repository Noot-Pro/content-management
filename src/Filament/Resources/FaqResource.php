<?php

namespace NootPro\ContentManagement\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ActionGroup;
use NootPro\ContentManagement\Filament\Resources\FaqResource\Pages\ListFaqs;
use NootPro\ContentManagement\Filament\Resources\FaqResource\Pages\CreateFaq;
use NootPro\ContentManagement\Filament\Resources\FaqResource\Pages\EditFaq;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use NootPro\ContentManagement\ContentManagementPlugin;
use NootPro\ContentManagement\Filament\Resources\FaqResource\Pages;

class FaqResource extends BaseResource
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-folder-open';

    protected static ?int $navigationSort = 3;

    public static function getModel(): string
    {
        return ContentManagementPlugin::get()->getModel('Faq');
    }

    public static function getLabel(): string
    {
        return __('FAQ');
    }

    public static function getPluralLabel(): string
    {
        return __('frequently asked questions');
    }

    public static function getNavigationLabel(): string
    {
        return __('FAQs');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('Library File'))
                    ->columns(2)
                    ->schema([
                        Textarea::make('question')
                            ->label(__('Question'))
                            ->required()
                            ->maxLength(65535)
                            ->columnSpan(2),

                        RichEditor::make('answer')
                            ->label(__('Answer'))
                            ->required()
                            ->maxLength(65535)
                            ->columnSpan(2),

                        SpatieTagsInput::make('category')
                            ->type('faq')
                            ->label(__('FAQ Categories')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question')->searchable(),

                SpatieTagsColumn::make('tags')
                    ->label(__('FAQ Categories'))
                    ->toggleable()
                    ->type('faq'),
            ])
            ->filters([
                SelectFilter::make('tags')
                    ->multiple()
                    ->relationship('tags', 'name')
                    ->label(__('Tags')),
            ])
            ->recordActions(static::getActions());
    }

    public static function getActions(): array
    {
        $action = [
            EditAction::make('edit')->label(__('Edit')),
            DeleteAction::make('delete')
                ->label(__('Delete')),
        ];

        return [ActionGroup::make($action)];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFaqs::route('/'),
            'create' => CreateFaq::route('/create'),
            'edit' => EditFaq::route('/{record}/edit'),
        ];
    }
}
