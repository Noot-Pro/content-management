<?php

namespace NootPro\ContentManagement\Filament\Resources;

use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use NootPro\ContentManagement\ContentManagementPlugin;

class BaseResource extends Resource
{
    use Translatable;

    public static function getNavigationGroup(): ?string
    {
        return ContentManagementPlugin::get()->getNavigationGroupLabel();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return ContentManagementPlugin::get()->isResourceVisible(static::class);
    }

    public static function getNavigationBadge(): ?string
    {
        if (! ContentManagementPlugin::getNavigationBadgesVisibility(static::class)) {
            return null;
        }

        return (string) static::getModel()::query()->count();
    }
}
