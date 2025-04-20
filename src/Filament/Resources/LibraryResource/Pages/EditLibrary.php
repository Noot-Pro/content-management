<?php

namespace LaraZeus\Sky\Filament\Resources\LibraryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use LaraZeus\Sky\Filament\Resources\LibraryResource;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\EditRecord\Concerns\Translatable;

class EditLibrary extends EditRecord
{
    use Translatable;

    protected static string $resource = LibraryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            LocaleSwitcher::make(),
        ];
    }
}
