<?php

namespace NootPro\ContentManagement\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use NootPro\ContentManagement\Models\Tag;

class LibraryTag extends Component
{
    public ?Tag $tag;

    public function mount(string $slug): void
    {
        $this->tag = config('noot-pro-content-management.models.Tag')::findBySlug($slug, 'library');

        abort_if($this->tag === null, 404);
    }

    public function render(): View
    {
        seo()
            ->site(config('zeus.site_title', 'Laravel'))
            ->title($this->tag->name . ' - ' . __('Library') . ' - ' . config('zeus.site_title', 'Laravel'))
            ->description($this->tag->description . ' - ' . config('zeus.site_description') . ' ' . config('zeus.site_title'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus.site_color') . '" />')
            ->withUrl()
            ->twitter();

        return view(app('themePath') .'.addons.library-tag')
            ->with('libraryTag', $this->tag)
            ->layout(config('noot-pro-content-management.layout'));
    }
}
