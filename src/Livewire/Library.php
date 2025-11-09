<?php

namespace NootPro\ContentManagement\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class Library extends Component
{
    public function render(): View
    {
        seo()
            ->site(config('zeus.site_title', 'Laravel'))
            ->title(__('libraries') . ' - ' . config('zeus.site_title'))
            ->description(__('Libraries') . ' - ' . config('zeus.site_description') . ' ' . config('zeus.site_title'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus.site_color') . '" />')
            ->withUrl()
            ->twitter();

        return view('noot-pro-content-management::themes.default.addons.library')
            ->with('libraries', config('noot-pro-content-management.models.Library')::get())
            ->with('categories', config('noot-pro-content-management.models.Tag')::getWithType('library'))
            ->layout(config('noot-pro-content-management.layout'));
    }
}
