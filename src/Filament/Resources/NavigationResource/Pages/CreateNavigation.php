<?php

namespace NootPro\ContentManagement\Filament\Resources\NavigationResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use NootPro\ContentManagement\Filament\Resources\NavigationResource;

class CreateNavigation extends CreateRecord
{
    use NavigationResource\Pages\Concerns\HandlesNavigationBuilder;

    protected static string $resource = NavigationResource::class;
}
