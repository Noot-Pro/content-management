<?php

namespace NootPro\ContentManagement\Filament\Resources\LibraryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use NootPro\ContentManagement\Filament\Resources\LibraryResource;

class EditLibrary extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = LibraryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
