<?php

namespace LaraZeus\Sky\Filament\Resources\NavigationResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use LaraZeus\Sky\Filament\Resources\NavigationResource;
use LaraZeus\Sky\Filament\Resources\NavigationResource\Pages\Concerns\HandlesNavigationBuilder;

class CreateNavigation extends CreateRecord
{
    use HandlesNavigationBuilder;

    protected static string $resource = NavigationResource::class;
}
