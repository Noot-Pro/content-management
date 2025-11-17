@php
    $availableLocales = config('noot-pro-content-management.locales', []);
    $currentLocale = session('locale', app()->getLocale());
    $isRtl = in_array($currentLocale, ['ar', 'he', 'fa', 'ur']); // RTL languages
    $direction = $isRtl ? 'rtl' : 'ltr';
@endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $direction ?? __('filament-panels::layout.direction') ?? 'ltr' }}" class="antialiased filament js-focus-visible">
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
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')

    <style>
        :root {
            --primary-color: #189cd8;
            --secondary-color: #132524;
            --hover-bg-color: #ecf1f4
        }
        * {font-family: 'Noto Kufi Arabic', sans-serif;}
        [x-cloak] {display: none !important;}


        .links__item {
            position: relative;
            margin-inline-end: 16px;
        }

        .links__item > a {
            display: flex;
            align-items: center;
            padding: 12px;
            border-radius: 12px;
        }

        .links__item > a:hover {
            background: #F7F7F7;
        }

        .links__item--has-dropdown > a:after {
            content: "";
            display: block;
            margin-inline-start: 6px;
            width: 16px;
            height: 16px;
            background: url("../../vendor/noot-pro/content-management/images/theme-2/arrow-down.svg") no-repeat center;
            transition: all linear 0.1s;
        }

        .links__item--has-dropdown:hover > a {
            background: #F7F7F7;
        }

        .links__item--has-dropdown:hover > a:after {
            transform: rotate(180deg);
        }

        .links__item--has-dropdown:hover > a + .links__dropdown {
            opacity: 1;
            visibility: visible;
        }

        .links__dropdown {
            width: 608px;
            padding: 32px;
            border: 1px solid #E8E8E8;
            border-radius: 26px;
            position: absolute;
            top: 45px;
            right: 0;
            box-shadow: 0 0 32px 0 rgba(0, 0, 0, 0.08);
            background: #fff;
            opacity: 0;
            visibility: hidden;
            transition: visibility 0.1s, opacity 0.1s;
            z-index: 1;
        }

        .links__dropdown__w_auto {
            width: auto;
        }

        .timeline__items {
            position: relative;
        }

        .timeline .default-line {
            content: "";
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            background: #E8E8E8;
            height: calc(100% - 212px);
        }

        @media screen and (max-width: 1024px) {
            .timeline .default-line {
                left: auto;
                right: 24px;
                height: calc(100% - 125px);
            }
        }

        .timeline .draw-line {
            width: 2px;
            height: 0;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            background: #FF9873;
        }

        @media screen and (max-width: 1024px) {
            .timeline .draw-line {
                left: auto;
                right: 24px;
            }
        }

        .timeline__item {
            position: relative;
        }

        .timeline__item:before {
            content: "";
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #FF9873;
            box-shadow: 0 0 0 6px #fff;
            transition: all 0.2s ease-in-out;
        }

        @media screen and (max-width: 1024px) {
            .timeline__item:before {
                left: auto;
                right: -30px;
            }
        }

        .timeline__item--first:before {
            top: 0;
        }

        .responsive-menu {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            background-color: #fff;
            overflow-y: auto;
        }


        .bord {
            border: solid 1px red;
        }
    </style>
</head>
<body x-data="{ mobileMenuOpen: false }" x-effect="document.body.style.overflow = mobileMenuOpen ? 'hidden' : ''" class="font-sans antialiased text-gray-900 @if(app()->isLocal()) debug-screens @endif">

<header class="mx-auto pt-5 pb-5 border-b border-b-[E8E8E8]">
    <div class="px-4 flex justify-between items-center h-16">
        <a href="{{ url('/') }}">
            <img class="w-32" src="{{ asset('vendor/noot-pro/content-management/images/theme-2/logo-v2.png') }}" alt="">
        </a>
        <div class="xl:hidden">
            <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="relative group">
                <div class="relative flex overflow-hidden items-center justify-center rounded-full w-[50px] h-[50px] transform transition-all bg-[var(--primary-color)] ring-0 ring-gray-300 hover:ring-8 group-focus:ring-4 ring-opacity-30 duration-200 shadow-md">
                    <div class="flex flex-col justify-between w-[20px] h-[20px] transform transition-all duration-300 origin-center overflow-hidden">
                        <div class="bg-white h-[2px] w-7 transform transition-all duration-300 origin-left" :class="mobileMenuOpen ? 'translate-y-6 delay-100' : ''"></div>
                        <div class="bg-white h-[2px] w-7 rounded transform transition-all duration-300" :class="mobileMenuOpen ? 'translate-y-6 delay-75' : ''"></div>
                        <div class="bg-white h-[2px] w-7 transform transition-all duration-300 origin-left" :class="mobileMenuOpen ? 'translate-y-6' : ''"></div>

                        <div class="absolute items-center justify-between transform transition-all duration-500 top-2.5 flex" :class="mobileMenuOpen ? 'translate-x-0 w-12' : '-translate-x-10 w-0'">
                            <div class="absolute bg-white h-[2px] w-5 transform transition-all duration-500 delay-300" :class="mobileMenuOpen ? 'rotate-45' : 'rotate-0'"></div>
                            <div class="absolute bg-white h-[2px] w-5 transform transition-all duration-500 delay-300" :class="mobileMenuOpen ? '-rotate-45' : '-rotate-0'"></div>
                        </div>
                    </div>
                </div>
            </button>
        </div>
        <div class="links hidden xl:block">
            <ul class="flex justify-between">
                <li class="links__item">
                    <a href="{{ url('/') }}">{{ __('noot-pro-content-management::site.home') }}</a>
                </li>
                <li class="links__item links__item--has-dropdown">
                    <a href="#">{{ __('noot-pro-content-management::site.products') }}</a>
                    <div class="links__dropdown">
                        @livewire(\NootPro\ContentManagement\Livewire\MenuPages::class, ['parent_id' => 3,'type' => 'header'])
                    </div>
                </li>
                <li class="links__item">
                    <a href="{{ url('/#plans') }}">{{ __('noot-pro-content-management::site.plans') }}</a>
                </li>
                <li class="links__item links__item--has-dropdown">
                    <a href="#">{{ __('noot-pro-content-management::site.contents') }}</a>
                    <div class="links__dropdown">
                        @livewire(\NootPro\ContentManagement\Livewire\MenuPages::class, ['parent_id' => 15,'type' => 'header'])
                    </div>
                </li>
                <li class="links__item">
                    <a href="{{ route('posts') }}">{{ __('noot-pro-content-management::site.blog') }}</a>
                </li>
                @if(app()->getLocale() === 'ar')
                    <li class="links__item">
                        <a href="{{ route('language.switch', 'en') }}">English</a>
                    </li>
                @else
                    <li class="links__item">
                        <a href="{{ route('language.switch', 'ar') }}">العربية</a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="actions hidden xl:block">
            <ul class="flex justify-between gap-x-4">
                <li><a href="{{ url(filament()->getLoginUrl()) }}" class="px-4 py-2.5 text-sm border-2 rounded-xl border-[#E8E8E8] hover:bg-[#E8E8E8] transition ease-in-out">{{ __('noot-pro-content-management::site.login') }}</a></li>
                <li><a href="{{ url('/contact') }}" class="px-4 py-2.5 text-sm border-2 rounded-xl border-[var(--primary-color)] bg-[var(--primary-color)] hover:bg-[var(--secondary-color)] hover:border-[var(--secondary-color)] text-white transition ease-in-out">{{ __('noot-pro-content-management::site.contact_us') }}</a></li>
            </ul>
        </div>
    </div>
</header>


<div x-show="mobileMenuOpen" x-cloak @click.away="mobileMenuOpen = false" class="responsive-menu overflow-y-auto pt-28 pb-12">
    <div class="fixed top-11 left-4 z-[1001]">
        <button @click="mobileMenuOpen = false" type="button" class="relative">
            <div class="relative flex overflow-hidden items-center justify-center rounded-full w-[50px] h-[50px] transform transition-all bg-[var(--primary-color)] ring-gray-300 hover:ring-8 ring-4 ring-opacity-30 duration-200 shadow-md">
                <div class="flex flex-col justify-between w-[20px] h-[20px] transform transition-all duration-300 origin-center overflow-hidden">
                    <div class="bg-white h-[2px] w-7 transform transition-all duration-300 origin-left translate-y-6 delay-100"></div>
                    <div class="bg-white h-[2px] w-7 rounded transform transition-all duration-300 translate-y-6 delay-75"></div>
                    <div class="bg-white h-[2px] w-7 transform transition-all duration-300 origin-left translate-y-6"></div>

                    <div class="absolute items-center justify-between transform transition-all duration-500 top-2.5 translate-x-0 flex w-12">
                        <div class="absolute bg-white h-[2px] w-5 transform rotate-45"></div>
                        <div class="absolute bg-white h-[2px] w-5 transform -rotate-45"></div>
                    </div>
                </div>
            </div>
        </button>
    </div>

    <ul class="flex flex-col gap-2 max-w-[280px] mx-auto my-12">
        <li>
            <a href="{{ url('/') }}" class="flex items-center justify-between gap-2 p-2 font-medium hover:bg-[#F7F7F7] rounded-lg transition ease-in-out" @click="mobileMenuOpen = false">
                {{ __('noot-pro-content-management::site.home') }}
            </a>
        </li>
        <li>
            <details class="group">
                <summary class="flex items-center justify-between gap-2 p-2 font-medium marker:content-none hover:cursor-pointer hover:bg-[#F7F7F7] rounded-lg transition ease-in-out">
                    <span class="flex gap-2 group-open:text-[var(--primary-color)]">
                        {{ __('noot-pro-content-management::site.products') }}
                    </span>
                    <svg class="w-5 h-5 rotate-180 text-gray-500 transition group-open:rotate-90" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                    </svg>
                </summary>
                <article class="px-4 pb-4">
                    @livewire(\NootPro\ContentManagement\Livewire\MenuPages::class, ['parent_id' => 3,'type' => 'mobile'])
                </article>
            </details>
        </li>
        <li>
            <a href="{{ url('/#plans') }}" class="flex items-center justify-between gap-2 p-2 font-medium hover:bg-[#F7F7F7] rounded-lg transition ease-in-out" @click="mobileMenuOpen = false">
                {{ __('noot-pro-content-management::site.plans') }}
            </a>
        </li>
        <li>
            <details class="group">
                <summary class="flex items-center justify-between gap-2 p-2 font-medium marker:content-none hover:cursor-pointer hover:bg-[#F7F7F7] rounded-lg transition ease-in-out">
                    <span class="flex gap-2 group-open:text-[var(--primary-color)]">
                        {{ __('noot-pro-content-management::site.contents') }}
                    </span>
                    <svg class="w-5 h-5 rotate-180 text-gray-500 transition group-open:rotate-90" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                    </svg>
                </summary>
                <article class="px-4 pb-4">
                    @livewire(\NootPro\ContentManagement\Livewire\MenuPages::class, ['parent_id' => 15,'type' => 'mobile'])
                </article>
            </details>
        </li>
        <li>
            <a href="{{ route('posts') }}" class="flex items-center justify-between gap-2 p-2 font-medium hover:bg-[#F7F7F7] rounded-lg transition ease-in-out" @click="mobileMenuOpen = false">
                {{ __('noot-pro-content-management::site.blog') }}
            </a>
        </li>
        <li>
            @if(app()->getLocale() === 'ar')
                <a href="{{ route('language.switch', 'en') }}" class="flex items-center justify-between gap-2 p-2 font-medium hover:bg-[#F7F7F7] rounded-lg transition ease-in-out" @click="mobileMenuOpen = false">
                    English
                </a>
            @else
                <a href="{{ route('language.switch', 'ar') }}" class="flex items-center justify-between gap-2 p-2 font-medium hover:bg-[#F7F7F7] rounded-lg transition ease-in-out" @click="mobileMenuOpen = false">
                    العربية
                </a>
            @endif
        </li>
    </ul>
    <div class="actions max-w-[280px] mx-auto">
        <ul class="flex flex-col gap-4">
            <li><a href="{{ url(filament()->getLoginUrl()) }}" class="block text-center px-4 py-2.5 text-sm border-2 rounded-xl border-[#E8E8E8] hover:bg-[#E8E8E8] transition ease-in-out" @click="mobileMenuOpen = false">{{ __('noot-pro-content-management::site.login') }}</a></li>
            <li><a href="{{ url('/contact') }}" class="block text-center px-4 py-2.5 text-sm border-2 rounded-xl border-[var(--primary-color)] bg-[var(--primary-color)] hover:bg-[var(--secondary-color)] hover:border-[var(--secondary-color)] text-white transition ease-in-out" @click="mobileMenuOpen = false">{{ __('noot-pro-content-management::site.contact_us') }}</a></li>
        </ul>
    </div>
</div>

<div class="container mx-auto my-6">
    {{ $slot }}
</div>

<footer class="w-full">
    <div class="bg-[#0F0F0F] pt-14 pb-32">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-12 gap-x-6 items-stretch">
                <div class="lg:col-span-12 xl:col-span-4 col-span-full mb-12 xl:mb-0">
                    <div class="max-w-[300px]">
                        <div class="mb-4">
                            <a href="{{ url('/') }}">
                                <img class="w-32" src="{{ asset('vendor/noot-pro/content-management/images/theme-2/logo-white.png') }}" alt="">
                            </a>
                        </div>
                        <div class="mb-4 text-white">{{ __('noot-pro-content-management::site.footer_text') }}.</div>
                        <div>
                            <a href="{{ url(filament()->getRegistrationUrl()) }}" class="inline-block px-6 py-3.5 border-2 rounded-xl border-[var(--primary-color)] bg-[var(--primary-color)] hover:bg-[var(--secondary-color)] hover:border-[var(--secondary-color)] text-white transition ease-in-out">{{ __('noot-pro-content-management::site.start_free_test') }}</a>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-6 xl:col-span-2 col-span-full mb-12 xl:mb-0">
                    <div class="mb-6 text-[#969696]">{{ __('noot-pro-content-management::site.about_company') }}</div>
                    <ul>
                        <li class="mb-6"><a href="{{ route('page', \NootPro\ContentManagement\Models\Post::find(12)?->slug ?? "nothing") }}" class="text-white hover:text-[var(--primary-color)] transition ease-in-out">{{ __('noot-pro-content-management::site.about_us') }}</a></li>
                        <li class="mb-6"><a href="{{ route('page', \NootPro\ContentManagement\Models\Post::find(13)?->slug ?? "nothing") }}" class="text-white hover:text-[var(--primary-color)] transition ease-in-out">{{ __('noot-pro-content-management::site.privacy') }}</a></li>
                        <li class="mb-6"><a href="{{ route('page', \NootPro\ContentManagement\Models\Post::find(14)?->slug ?? "nothing") }}" class="text-white hover:text-[var(--primary-color)] transition ease-in-out">{{ __('noot-pro-content-management::site.term') }}</a></li>
                        <li class="mb-6"><a href="{{ url('faq') }}" class="text-white hover:text-[var(--primary-color)] transition ease-in-out">{{ __('noot-pro-content-management::site.faq') }}</a></li>
                    </ul>
                </div>
                <div class="lg:col-span-6 xl:col-span-2 col-span-full mb-12 xl:mb-0">
                    <div class="mb-6 text-[#969696]">{{ __('noot-pro-content-management::site.our_solutions') }}</div>
                    @livewire(\NootPro\ContentManagement\Livewire\MenuPages::class, ['parent_id' => 3,'type' => 'footer'])
                </div>
                <div class="lg:col-span-6 xl:col-span-2 col-span-full mb-12 xl:mb-0">
                    <div class="mb-6 text-[#969696]">{{ __('noot-pro-content-management::site.contents') }}</div>
                    @livewire(\NootPro\ContentManagement\Livewire\MenuPages::class, ['parent_id' => 15,'type' => 'footer'])
                </div>
                <div class="lg:col-span-12 xl:col-span-2 col-span-full">
                    <div class="mb-6 text-[#969696]">{{ __('noot-pro-content-management::site.contact_us') }}</div>
                    <ul class="mb-6">
                        <li class="mb-6"><a href="mailto:info@noot.co" class="text-white hover:text-[var(--primary-color)] transition ease-in-out">info@noot.co</a></li>
                        <li class="mb-6"><a href="tel:0575811311" class="text-white hover:text-[var(--primary-color)] transition ease-in-out">0575811311</a></li>
                    </ul>
                    <div>
                        <ul class="flex items-center">
                            <li class="me-4 relative transition ease-in-out hover:-translate-y-1">
                                <a target="_blank" href="https://x.com/bued_hr">
                                    <img src="{{ asset('vendor/noot-pro/content-management/images/theme-2/social-media/x.svg') }}" alt="">
                                </a>
                            </li>
                            <li class="me-4 relative transition ease-in-out hover:-translate-y-1">
                                <a target="_blank" href="https://www.tiktok.com/@bued.ai?_r=1&_t=ZS-91TJlartuml">
                                    <img src="{{ asset('vendor/noot-pro/content-management/images/theme-2/social-media/tiktok.svg') }}" alt="">
                                </a>
                            </li>
                            <li class="me-4 relative transition ease-in-out hover:-translate-y-1">
                                <a target="_blank" href="https://www.linkedin.com/in/%D9%86%D8%B8%D8%A7%D9%85-%D8%A8%D9%8F%D8%B9%D8%AF-%D9%84%D9%84%D9%85%D9%88%D8%A7%D8%B1%D8%AF-%D8%A7%D9%84%D8%A8%D8%B4%D8%B1%D9%8A%D8%A9-a97a84390/">
                                    <img src="{{ asset('vendor/noot-pro/content-management/images/theme-2/social-media/linkedin.svg') }}" alt="">
                                </a>
                            </li>
                            <li class="me-4 relative transition ease-in-out hover:-translate-y-1">
                                <a target="_blank" href="https://www.instagram.com/bued.hr/">
                                    <img src="{{ asset('vendor/noot-pro/content-management/images/theme-2/social-media/instagram.svg') }}" alt="">
                                </a>
                            </li>
                            <li class="me-4 relative transition ease-in-out hover:-translate-y-1">
                                <a target="_blank" href="https://www.snapchat.com/add/bued.ai?share_id=LT6hM6sFCME&locale=ar-SA">
                                    <img src="{{ asset('vendor/noot-pro/content-management/images/theme-2/social-media/snapchat.svg') }}" alt="">
                                </a>
                            </li>
                            <li class="relative transition ease-in-out hover:-translate-y-1">
                                <a target="_blank" href="https://www.facebook.com/profile.php?id=61583944401519">
                                    <img src="{{ asset('vendor/noot-pro/content-management/images/theme-2/social-media/facebook.svg') }}" alt="">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-8">
                        <ul class="flex items-center">
                            @if(app()->getLocale() === 'ar')
                                <li class="relative transition ease-in-out hover:-translate-y-1">
                                    <a target="_blank" href="https://play.google.com/store/apps/details?id=com.noot.app" >
                                        <img src="{{ asset('vendor/noot-pro/content-management/images/theme-2/googlePlay-ar.svg') }}" width="120px" alt="">
                                    </a>
                                </li>
                                <li class="relative transition ease-in-out hover:-translate-y-1 mx-1">
                                    <a target="_blank" href="https://apps.apple.com/gb/app/noot-%D9%86%D9%88%D8%AA/id6740081271?platform=iphone">
                                        <img src="{{ asset('vendor/noot-pro/content-management/images/theme-2/appStore-ar.svg') }}" width="110px" alt="">
                                    </a>
                                </li>
                            @else
                                <li class="relative transition ease-in-out hover:-translate-y-1">
                                    <a target="_blank" href="https://play.google.com/store/apps/details?id=com.noot.app">
                                        <img src="{{ asset('vendor/noot-pro/content-management/images/theme-2/googlePlay-en.svg') }}" width="120px" alt="">
                                    </a>
                                </li>
                                <li class="relative transition ease-in-out hover:-translate-y-1 mx-1">
                                    <a target="_blank" href="https://apps.apple.com/gb/app/noot-%D9%86%D9%88%D8%AA/id6740081271?platform=iphone" >
                                        <img src="{{ asset('vendor/noot-pro/content-management/images/theme-2/appStore-en.svg') }}" width="110px" alt="">
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-black py-4">
        <div class="container mx-auto px-4 flex justify-between text-sm text-[#969696]">
            <div>{{ __('noot-pro-content-management::site.copy_write') }} © {{ now()->format('Y') }}</div>
            <div style="direction: ltr;">© {{ now()->format('Y') }} Noot Inc.</div>
        </div>
    </div>
</footer>

@livewireScripts
@stack('scripts')

</body>
</html>
