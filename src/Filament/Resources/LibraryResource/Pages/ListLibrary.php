<?php

namespace NootPro\ContentManagement\Filament\Resources\LibraryResource\Pages;

use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;
use NootPro\ContentManagement\ContentManagementPlugin;
use NootPro\ContentManagement\Filament\Resources\LibraryResource;

class ListLibrary extends ListRecords
{
    use Translatable;

    protected static string $resource = LibraryResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('Open')
                ->color('warning')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->label(__('Open'))
                ->visible(! config('noot-pro-content-management.headless'))
                ->url(fn (): string => route(ContentManagementPlugin::get()->getRouteNamePrefix() . 'library'))
                ->openUrlInNewTab(),
            LocaleSwitcher::make(),
        ];
    }
}
