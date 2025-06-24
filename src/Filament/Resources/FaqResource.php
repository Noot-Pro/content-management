<?php

namespace LaraZeus\Sky\Filament\Resources;

use BackedEnum;
use Exception;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use LaraZeus\Helen\Actions\ShortUrlAction;
use LaraZeus\Helen\HelenServiceProvider;
use LaraZeus\Sky\Filament\Resources\FaqResource\Pages\CreateFaq;
use LaraZeus\Sky\Filament\Resources\FaqResource\Pages\EditFaq;
use LaraZeus\Sky\Filament\Resources\FaqResource\Pages\ListFaqs;
use LaraZeus\Sky\SkyPlugin;

class FaqResource extends SkyResource
{
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-folder-open';

    protected static ?int $navigationSort = 3;

    public static function getModel(): string
    {
        return SkyPlugin::get()->getModel('Faq');
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

    /**
     * @throws Exception
     */
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->columns()
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

        if (
            class_exists(HelenServiceProvider::class)
            && ! config('zeus-sky.headless')
        ) {
            // @phpstan-ignore-next-line
            $action[] = ShortUrlAction::make('get-link')
                ->distUrl(fn (): string => route(SkyPlugin::get()->getRouteNamePrefix() . 'faq'));
        }

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
