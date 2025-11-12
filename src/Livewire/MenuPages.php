<?php

namespace NootPro\ContentManagement\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use NootPro\ContentManagement\Models\Post;

class MenuPages extends Component
{
    public string $type = 'header';

    public object | string | null $pages;

    public function mount(int $parent_id, object | string $type): void
    {
        $pages = Cache::get('pages_' . $parent_id);
        if (! $pages && $parent_id) {
            $pages = Post::where('parent_id', $parent_id)->limit(6)->get();
            Cache::forever('pages_' . $parent_id, $pages);
        }
        $this->pages = $pages;
    }

    public function render(): Factory | View | Application
    {
        $pages = $this->pages;

        return view('noot-pro-content-management::themes.theme-2.livewire.' . $this->type . '-menu-pages', compact('pages'));
    }
}
