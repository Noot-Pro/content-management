<?php

namespace NootPro\ContentManagement\Filament\Resources\NavigationResource\Pages;

use Filament\Resources\Pages\EditRecord;
use NootPro\ContentManagement\Filament\Resources\NavigationResource;
use NootPro\ContentManagement\Filament\Resources\NavigationResource\Pages\Concerns\HandlesNavigationBuilder;

class EditNavigation extends EditRecord
{
    use HandlesNavigationBuilder;

    protected static string $resource = NavigationResource::class;
}
