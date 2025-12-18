<?php

namespace NootPro\ContentManagement\Livewire;

use NootPro\ContentManagement\Models\Post;
use Illuminate\View\View;
use Livewire\Component;

class Page extends Component
{
    public Post $page;

    public function mount(string $slug): void
    {
        $this->page = config('noot-pro-content-management.models.Post')::query()
            ->page()
            ->where('slug', $slug)
            ->whereDate('published_at', '<=', now())
            ->firstOrFail();
    }

    public function render(): View
    {
        $this->setSeo();

        if ($this->page->status !== 'publish' && ! $this->page->require_password) {
            abort_if(! auth()->check(), 404);
            abort_if($this->page->user_id !== auth()->user()->id, 401);
        }

        if ($this->page->require_password && ! session()->has($this->page->slug . '-' . $this->page->password)) {
            return view(app('themePath') . '.partial.password-form')
                ->with('post', $this->page)
                ->layout(config('noot-pro-content-management.layout'));
        }

        return view(app('themePath') . '.page')
            ->with([
                'post' => $this->page,
                'children' => config('noot-pro-content-management.models.Post')::with('parent')->where('parent_id', $this->page->id)->get(),
            ])
            ->layout(config('noot-pro-content-management.layout'));
    }

    public function setSeo(): void
    {
        seo()
            ->site(config('zeus.site_title', 'Laravel'))
            ->title($this->page->title . ' - ' . config('zeus.site_title'))
            ->description(($this->page->description ?? '') . ' ' . config('zeus.site_description', 'Laravel') . ' ' . config('zeus.site_title'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus.site_color') . '" />')
            ->withUrl()
            ->twitter();

        if (! $this->page->getMedia('posts')->isEmpty()) {
            seo()->image($this->page->getFirstMediaUrl('pages'));
        }
    }
}
