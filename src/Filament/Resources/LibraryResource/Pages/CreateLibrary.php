<?php

namespace NootPro\ContentManagement\Filament\Resources\LibraryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;
use NootPro\ContentManagement\Filament\Resources\LibraryResource;

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
