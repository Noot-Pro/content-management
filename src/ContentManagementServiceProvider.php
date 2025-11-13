<?php

namespace NootPro\ContentManagement;

use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use NootPro\ContentManagement\Console\InstallCommand;
use NootPro\ContentManagement\Console\MigrateCommand;
use NootPro\ContentManagement\Console\PublishCommand;
use NootPro\ContentManagement\Console\ZeusEditorCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ContentManagementServiceProvider extends PackageServiceProvider
{
    public static string $name = 'noot-pro-content-management';

    public static string $vendorName = 'noo-pro';

    public static string $packageName = 'content-management';

    public function packageBooted(): void
    {
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        $this->setThemePath();

        $this->bootFilamentNavigation();
    }

    public function boot(): void
    {
        parent::boot();

        $this->publishes([
            __DIR__ . '/../resources/images' => public_path('vendor/noot-pro/content-management/images'),
        ], 'noot-pro-content-management-images');
    }

    public function setThemePath(): void
    {
        $viewPath = 'noot-pro-content-management::themes.' . config('noot-pro-content-management.theme');

        //        $folder = resource_path('views/vendor/noot-pro-content-management/themes/' . config('noot-pro-content-management.theme') . '/' . $path);

        //        if (! is_dir($folder)) {
        //            // check artemis folder
        //            $folder = base_path('vendor/lara-zeus/artemis/resources/views/themes/' . config('zeus.theme') . '/' . $path);
        //            if (! is_dir($folder)) {
        //                $viewPath = 'zeus::themes.zeus.' . $path;
        //            }
        //        }

        View::share('themePath', $viewPath);

        App::singleton('themePath', function () use ($viewPath) {
            return $viewPath;
        });
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasMigrations($this->getMigrations())
            ->hasTranslations()
            ->hasConfigFile()
            ->hasCommands($this->getCommands())
            ->hasViews('noot-pro-content-management')
            ->hasAssets();

        if (! config('noot-pro-content-management.headless')) {
            $package->hasRoute('web');
        }
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            MigrateCommand::class,
            PublishCommand::class,
            InstallCommand::class,
            ZeusEditorCommand::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            'create_posts_table',
            'create_faqs_table',
            'modify_posts_columns',
            'create_library_table',
            'create_navigations_table',
        ];
    }

    private function bootFilamentNavigation(): void
    {
        Filament::serving(function () {
            if (! defined('__PHPSTAN_RUNNING__') &&
                ! app('filament')->hasPlugin('noot-pro-content-management')
            ) {
                return;
            }

            ContentManagementPlugin::get()
                ->itemType(
                    __('Post link'),
                    [
                        Select::make('post_id')
                            ->label(__('Select Post'))
                            ->searchable()
                            ->options(function () {
                                return ContentManagementPlugin::get()->getModel('Post')::published()->pluck('title', 'id');
                            }),
                    ],
                    'post_link'
                )
                ->itemType(
                    __('Page link'),
                    [
                        Select::make('page_id')
                            ->label(__('Select Page'))
                            ->searchable()
                            ->options(function () {
                                return ContentManagementPlugin::get()->getModel('Post')::query()
                                    ->page()
                                    ->whereDate('published_at', '<=', now())
                                    ->pluck('title', 'id');
                            }),
                    ],
                    'page_link'
                )
                ->itemType(
                    __('Library link'),
                    [
                        Select::make('library_id')
                            ->label(__('Select Library'))
                            ->searchable()
                            ->options(function () {
                                return ContentManagementPlugin::get()->getModel('Tag')::getWithType('library')->pluck('name', 'id');
                            }),
                    ],
                    'library_link'
                );
        });
    }

    protected function getAssetPackageName(): ?string
    {
        return 'noot-pro/content-management';
    }

    protected function getAssets(): array
    {
        return [
            //            Css::make(static::$name . '-styles', __DIR__ . '/../resources/dist/content-management.css'),
            //            Js::make(static::$name . '-scripts', __DIR__ . '/../resources/dist/content-management.js'),
        ];
    }
}
