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
use NootPro\ContentManagement\Middleware\SetLocale;

Route::domain(config('noot-pro-content-management.domain'))
    ->middleware(array_merge(config('noot-pro-content-management.middleware'), [SetLocale::class]))
    ->prefix(config('noot-pro-content-management.prefix'))
    ->group(function () {

        Route::get('language/{locale}', function (string $locale) {
            $availableLocales = config('noot-pro-content-management.locales', []);
            if (array_key_exists($locale, $availableLocales)) {
                session()->put('locale', $locale);
                app()->setLocale($locale);
            }
            return redirect()->back();
        })->name('language.switch');

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

        Route::get('/', Posts::class)->name('blogs');
        Route::get(config('noot-pro-content-management.uri.post') . '/{slug}', Post::class)->name('post');
        Route::get(config('noot-pro-content-management.uri.page') . '/{slug}', Page::class)->name('page');
        Route::get('{type}/{slug}', Tags::class)->name('tags');
    });
