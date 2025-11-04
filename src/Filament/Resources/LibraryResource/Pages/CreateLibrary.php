<?php

namespace NootPro\ContentManagement\Filament\Resources\LibraryResource\Pages;

use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\CreateRecord;
use NootPro\ContentManagement\Filament\Resources\LibraryResource;

class CreateLibrary extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = LibraryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
