<?php

namespace NootPro\ContentManagement;

use Closure;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use LaraZeus\FilamentPluginTools\Concerns\CanDisableBadges;
use LaraZeus\FilamentPluginTools\Concerns\CanHideResources;
use LaraZeus\FilamentPluginTools\Concerns\HasModels;
use LaraZeus\FilamentPluginTools\Concerns\HasNavigationGroupLabel;
use LaraZeus\FilamentPluginTools\Concerns\HasRouteNamePrefix;
use LaraZeus\FilamentPluginTools\Concerns\HasUploads;
use NootPro\ContentManagement\Filament\Resources\FaqResource;
use NootPro\ContentManagement\Filament\Resources\LibraryResource;
use NootPro\ContentManagement\Filament\Resources\NavigationResource;
use NootPro\ContentManagement\Filament\Resources\PageResource;
use NootPro\ContentManagement\Filament\Resources\PostResource;
use NootPro\ContentManagement\Filament\Resources\TagResource;

final class ContentManagementPlugin implements Plugin
{
    use CanDisableBadges;
    use CanHideResources;
    use Configuration;
    use EvaluatesClosures;
    use HasModels;
    use HasNavigationGroupLabel;
    use HasRouteNamePrefix;
    use HasUploads;

    protected Closure | string $navigationGroupLabel = 'Content Management';

    public function getId(): string
    {
        return 'noot-pro-content-management';
    }

    public function register(Panel $panel): void
    {
        if ($this->hasPostResource()) {
            $panel->resources([PostResource::class]);
        }

        if ($this->hasPageResource()) {
            $panel->resources([PageResource::class]);
        }

        if ($this->hasFaqResource()) {
            $panel->resources([FaqResource::class]);
        }

        if ($this->hasLibraryResource()) {
            $panel->resources([LibraryResource::class]);
        }

        if ($this->hasTagResource()) {
            $panel->resources([TagResource::class]);
        }

        if ($this->hasNavigationResource()) {
            $panel->resources([NavigationResource::class]);
        }
    }

    public static function make(): static
    {
        return new self;
    }

    public static function get(): static
    {
        // @phpstan-ignore-next-line
        return filament('noot-pro-content-management');
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
