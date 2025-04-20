<?php

namespace LaraZeus\Sky\Filament\Resources;

use Filament\Resources\Resource;
use LaraZeus\Sky\SkyPlugin;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;

class SkyResource extends Resource
{
    use Translatable;

    public static function getNavigationGroup(): ?string
    {
        return SkyPlugin::get()->getNavigationGroupLabel();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return SkyPlugin::get()->isResourceVisible(static::class);
    }

    public static function getNavigationBadge(): ?string
    {
        if (! SkyPlugin::getNavigationBadgesVisibility(static::class)) {
            return null;
        }

        return (string) static::getModel()::query()->count();
    }
}
