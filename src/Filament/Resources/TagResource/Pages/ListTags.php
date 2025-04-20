<?php

namespace LaraZeus\Sky\Filament\Resources\TagResource\Pages;

use Filament\Actions\CreateAction;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\Sky\Filament\Resources\TagResource;
use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;

class ListTags extends ListRecords
{
    use Translatable;

    protected static string $resource = TagResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
            LocaleSwitcher::make(),
        ];
    }
}
