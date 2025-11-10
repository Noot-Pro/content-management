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
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=KoHo:ital,wght@0,200;0,300;0,500;0,700;1,200;1,300;1,600;1,700&display=swap" rel="stylesheet">

{{--    @livewireStyles--}}
{{--    @filamentStyles--}}
{{--    @stack('styles')--}}

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * {font-family: 'KoHo', 'Almarai', sans-serif;}
        [x-cloak] {display: none !important;}
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 dark:text-gray-100 dark:bg-gray-900 @if(app()->isLocal()) debug-screens @endif">

<header x-data="{ open: false }" class="bg-white dark:bg-black px-4">
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
            <div class="hidden sm:flex sm:items-center sm:ml-6">
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

<header class="bg-gray-100 dark:bg-gray-800">
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
    </header>

<div class="container mx-auto my-6">
    {{ $slot }}
</div>

<footer class="bg-gray-100 dark:bg-gray-800 p-6 text-center font-light">

</footer>

{{--@livewireScripts--}}
{{--@filamentScripts--}}
{{--@livewire('notifications')--}}
@stack('scripts')

<script>
    (function() {
        'use strict';

        const ThemeManager = {
            init() {
                this.applyTheme();
                this.setupToggleButton();
                this.watchSystemPreference();
            },

            getTheme() {
                return localStorage.getItem('theme');
            },

            setTheme(theme) {
                localStorage.setItem('theme', theme);
                this.applyTheme();
            },

            isDarkMode() {
                const theme = this.getTheme();
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                return theme === 'dark' || (!theme && prefersDark);
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
                    toggleButton.addEventListener('click', () => {
                        this.toggleTheme();
                    });
                }
            },

            watchSystemPreference() {
                const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
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
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => ThemeManager.init());
        } else {
            ThemeManager.init();
        }

        window.ThemeManager = ThemeManager;
    })();
</script>

</body>
</html>
