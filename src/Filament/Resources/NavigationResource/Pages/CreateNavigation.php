<?php

namespace NootPro\ContentManagement\Filament\Resources\NavigationResource\Pages;

use NootPro\ContentManagement\Filament\Resources\NavigationResource\Pages\Concerns\HandlesNavigationBuilder;
use Filament\Resources\Pages\CreateRecord;
use NootPro\ContentManagement\Filament\Resources\NavigationResource;

class CreateNavigation extends CreateRecord
{
    use HandlesNavigationBuilder;

    protected static string $resource = NavigationResource::class;
}
