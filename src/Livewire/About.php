<?php

namespace NootPro\ContentManagement\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class About extends Component
{
    public function render(): View
    {
        seo()
            ->site(config('zeus.site_title', 'Laravel'))
            ->title(__('About Us') . ' - ' . config('zeus.site_title', 'Laravel'))
            ->description(__('About Us') . ' - ' . config('zeus.site_description', '') . ' ' . config('zeus.site_title', 'Laravel'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus.site_color') . '" />')
            ->withUrl()
            ->twitter();

        return view(app('themePath') . '.about')
            ->layout(config('noot-pro-content-management.layout'));
    }
}

