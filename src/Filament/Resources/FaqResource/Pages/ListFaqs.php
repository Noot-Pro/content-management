<?php

namespace NootPro\ContentManagement\Filament\Resources\FaqResource\Pages;

use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use NootPro\ContentManagement\ContentManagementPlugin;
use NootPro\ContentManagement\Filament\Resources\FaqResource;

class ListFaqs extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = FaqResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
//            Action::make('Open')
//                ->color('warning')
//                ->icon('heroicon-o-arrow-top-right-on-square')
//                ->label(__('Open'))
//                ->visible(! config('noot-pro-content-management.headless'))
//                ->url(fn (): string => route(ContentManagementPlugin::get()->getRouteNamePrefix() . 'faq'))
//                ->openUrlInNewTab(),
            LocaleSwitcher::make(),
        ];
    }
}
