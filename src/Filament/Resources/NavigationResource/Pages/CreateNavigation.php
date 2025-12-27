<?php

namespace NootPro\ContentManagement\Filament\Resources\NavigationResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use NootPro\ContentManagement\Filament\Resources\NavigationResource;
use NootPro\ContentManagement\Filament\Resources\NavigationResource\Pages\Concerns\HandlesNavigationBuilder;

class CreateNavigation extends CreateRecord
{
    use HandlesNavigationBuilder;

    protected static string $resource = NavigationResource::class;
}
