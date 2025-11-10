<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ __('filament-panels::layout.direction') ?? 'ltr' }}" class="antialiased filament js-focus-visible">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="application-name" content="{{ config('app.name', 'Laravel') }}">

    <!-- Seo Tags -->
    <x-seo::meta/>
    <!-- Seo Tags -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @livewireStyles
{{--    @filamentStyles--}}
{{--    @stack('styles')--}}

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * {font-family: 'Noto Kufi Arabic', sans-serif;}
        [x-cloak] {display: none !important;}
    </style>

    <script>
        (function() {
            'use strict';
            const theme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (theme === 'dark' || (!theme && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else if (theme === 'light') {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
</head>
<body class="font-sans antialiased text-gray-900 dark:text-gray-100 dark:bg-gray-900 @if(app()->isLocal()) debug-screens @endif">

@php
    $availableLocales = config('noot-pro-content-management.locales', []);
    $currentLocale = session('locale', app()->getLocale());
@endphp

<header x-data="{ open: false, languageOpen: false }" class="bg-white dark:bg-black px-4">
    <div class="container mx-auto">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a class="italic flex gap-2 group" href="{{ url('/') }}">
                        <img class="w-16" src="https://noot.co/images/site/logo.svg" alt="{{ config('zeus.site_title', config('app.name', 'Laravel')) }}">
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex sm:items-center">
                    {{--Navigation Links--}}
                </div>

            </div>
            <div class="hidden sm:flex sm:items-center sm:ml-6 gap-2">
                <div class="relative" x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open" type="button" class="p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500 transition-colors flex items-center gap-1" aria-label="Select language">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                        </svg>
                        <span class="text-sm font-medium uppercase">{{ $currentLocale }}</span>
                        <svg class="h-4 w-4 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" :class="{ 'rotate-180': open }">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-cloak class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 dark:ring-gray-700 z-50">
                        <div class="py-1" role="menu">
                            @foreach($availableLocales as $localeCode => $localeData)
                                <a href="{{ route('language.switch', $localeCode) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 {{ $currentLocale === $localeCode ? 'bg-gray-100 dark:bg-gray-700 font-semibold' : '' }}" role="menuitem">
                                    <div class="flex items-center justify-between">
                                        <span>{{ $localeData['native'] ?? $localeData['name'] ?? strtoupper($localeCode) }}</span>
                                        @if($currentLocale === $localeCode)
                                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <button data-theme-toggle type="button" class="p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500 transition-colors" aria-label="Toggle dark mode">
                    <svg data-theme-icon="moon" class="h-5 w-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg data-theme-icon="sun" class="h-5 w-5 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>
                {{--Account menu and other icons--}}
            </div>
        </div>
    </div>
</header>

<div class="bg-gray-100 dark:bg-gray-800">
    <div class="container mx-auto py-2 px-3">
            <div class="flex justify-between items-center">
                <div class="w-full">
                    @if(isset($breadcrumbs))
                        <nav class="text-gray-400 font-bold my-1" aria-label="Breadcrumb">
                            <ol class="list-none p-0 inline-flex">
                                {{ $breadcrumbs }}
                            </ol>
                        </nav>
                    @endif
                    @if(isset($header))
                        <div class="italic font-semibold text-xl text-gray-600 dark:text-gray-100">
                            {{ $header }}
                        </div>
                    @endif
                </div>
                <span class="bolt-loading animate-pulse"></span>
            </div>
        </div>
</div>

<div class="container mx-auto my-6">
    {{ $slot }}
</div>

<footer class="bg-gray-100 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            {{-- About Company --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">{{ __('About Company') }}</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">{{ __('About Us') }}</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">{{ __('Privacy Policy') }}</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">{{ __('Terms and Conditions') }}</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">{{ __('FAQ') }}</a></li>
                </ul>
            </div>

            {{-- Solutions --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">{{ __('Our Solutions') }}</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">{{ __('Financial Accounting') }}</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">{{ __('Point of Sale (POS)') }}</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">{{ __('Inventory Management') }}</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">{{ __('Noot Integration with WhatsApp') }}</a></li>
                </ul>
            </div>

            {{-- Content --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">{{ __('Content') }}</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">{{ __('Help Center') }}</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">{{ __('Developers') }}</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">{{ __('Integration') }}</a></li>
                    <li><a href="{{ route('posts') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">{{ __('News') }}</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">{{ __('Contact Us') }}</h3>
                <ul class="space-y-2">
                    <li class="text-gray-600 dark:text-gray-400">{{ __('Email') }}: <a href="mailto:info@noot.co" class="hover:text-gray-900 dark:hover:text-gray-100 transition-colors">info@noot.co</a></li>
                    <li class="text-gray-600 dark:text-gray-400">{{ __('Phone') }}: <a href="tel:+966555028398" class="hover:text-gray-900 dark:hover:text-gray-100 transition-colors">+966 55 502 8398</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-200 dark:border-gray-700 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 md:mb-0">
                    {{ __('All rights reserved') }} © {{ date('Y') }} {{ config('zeus.site_title', config('app.name', 'Laravel')) }}
                </p>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    © {{ date('Y') }} {{ config('zeus.site_title', config('app.name', 'Laravel')) }} Inc.
                </p>
            </div>
        </div>
    </div>
</footer>

@livewireScripts
@stack('scripts')

<script>
    (function() {
        'use strict';

        const ThemeManager = {
            getTheme() {
                return localStorage.getItem('theme');
            },

            setTheme(theme) {
                localStorage.setItem('theme', theme);
                this.applyTheme();
            },

            applyTheme() {
                const theme = this.getTheme();
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                if (theme === 'dark' || (!theme && prefersDark)) {
                    document.documentElement.classList.add('dark');
                } else if (theme === 'light') {
                    document.documentElement.classList.remove('dark');
                }
            },

            toggleTheme() {
                const isDark = document.documentElement.classList.contains('dark');
                this.setTheme(isDark ? 'light' : 'dark');
            },

            setupToggleButton() {
                const toggleButton = document.querySelector('[data-theme-toggle]');
                if (toggleButton) {
                    toggleButton.addEventListener('click', (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        this.toggleTheme();
                    });
                } else {
                    console.warn('Theme toggle button not found');
                }
            },

            watchSystemPreference() {
                const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
                if (mediaQuery.addEventListener) {
                    mediaQuery.addEventListener('change', (e) => {
                        if (!this.getTheme()) {
                            if (e.matches) {
                                document.documentElement.classList.add('dark');
                            } else {
                                document.documentElement.classList.remove('dark');
                            }
                        }
                    });
                }
            },

            init() {
                this.setupToggleButton();
                this.watchSystemPreference();
            }
        };

        function initializeTheme() {
            ThemeManager.init();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initializeTheme);
        } else {
            setTimeout(initializeTheme, 0);
        }

        window.ThemeManager = ThemeManager;
    })();
</script>

</body>
</html>
