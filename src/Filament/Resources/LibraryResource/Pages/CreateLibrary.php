<?php

namespace LaraZeus\Sky\Filament\Resources\LibraryResource\Pages;

use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use Filament\Resources\Pages\CreateRecord;
use LaraZeus\Sky\Filament\Resources\LibraryResource;
use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateLibrary extends CreateRecord
{
    use Translatable;

    protected static string $resource = LibraryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
