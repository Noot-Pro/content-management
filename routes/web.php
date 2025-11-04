<?php

use Illuminate\Support\Facades\Route;
use NootPro\ContentManagement\Livewire\Faq;
use NootPro\ContentManagement\Livewire\Library;
use NootPro\ContentManagement\Livewire\LibraryItem;
use NootPro\ContentManagement\Livewire\LibraryTag;
use NootPro\ContentManagement\Livewire\Page;
use NootPro\ContentManagement\Livewire\Post;
use NootPro\ContentManagement\Livewire\Posts;
use NootPro\ContentManagement\Livewire\Tags;

Route::domain(config('noot-pro-content-management.domain'))
    ->middleware(config('noot-pro-content-management.middleware'))
    ->prefix(config('noot-pro-content-management.prefix'))
    ->group(function () {

        if (in_array('faq', config('noot-pro-content-management.uri'))) {
            Route::get(config('noot-pro-content-management.uri.faq'), Faq::class)
                ->name('faq');
        }

        if (in_array('library', config('noot-pro-content-management.uri'))) {
            Route::prefix(config('noot-pro-content-management.uri.library'))
                ->group(function () {
                    Route::get('/', Library::class)->name('library');
                    Route::get('/tag/{slug}', LibraryTag::class)->name('library.tag');
                    Route::get('/{slug}', LibraryItem::class)->name('library.item');
                });
        }

        /*Route::post('passwordConfirmation/{slug}', function ($slug) {
            // convert to LW todo
            $post = ContentManagementPlugin::get()->getModel('Post')::query()
                ->where('slug', $slug)
                ->where('password', request('password'))
                ->first();

            if ($post !== null) {
                request()->session()->put($slug.'-'.request('password'), request('password'));

                return redirect()->route($post->post_type, ['slug' => $post->slug]);
            }

            return redirect()->back()->with('status', __('sorry, the password incorrect!'));
        })
            ->name('passwordConfirmation');*/

        Route::get('/', Posts::class)->name('blogs');
        Route::get(config('noot-pro-content-management.uri.post') . '/{slug}', Post::class)->name('post');
        Route::get(config('noot-pro-content-management.uri.page') . '/{slug}', Page::class)->name('page');
        Route::get('{type}/{slug}', Tags::class)->name('tags');
    });
