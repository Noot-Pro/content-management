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
            background: url("../../images/site/arrow-down.svg") no-repeat center;
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
        }

        .bord {
            border: solid 1px red;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 @if(app()->isLocal()) debug-screens @endif">

<header class="mx-auto pt-5 pb-5 border-b border-b-[E8E8E8]">
    <div class="px-4 flex justify-between items-center h-16">
        <a href="{{ url('/') }}">
            <img class="w-32" src="{{ asset('vendor/noot-pro/content-management/images/theme-2/logo-v2.png') }}" alt="">
        </a>
        <div class="xl:hidden">
            <button class="relative group mobile-menu">
                <div class="relative flex overflow-hidden items-center justify-center rounded-full w-[50px] h-[50px] transform transition-all bg-[var(--primary-color)] ring-0 ring-gray-300 hover:ring-8 group-focus:ring-4 ring-opacity-30 duration-200 shadow-md">
                    <div class="flex flex-col justify-between w-[20px] h-[20px] transform transition-all duration-300 origin-center overflow-hidden">
                        <div class="bg-white h-[2px] w-7 transform transition-all duration-300 origin-left group-focus:translate-y-6 delay-100"></div>
                        <div class="bg-white h-[2px] w-7 rounded transform transition-all duration-300 group-focus:translate-y-6 delay-75"></div>
                        <div class="bg-white h-[2px] w-7 transform transition-all duration-300 origin-left group-focus:translate-y-6"></div>

                        <div class="absolute items-center justify-between transform transition-all duration-500 top-2.5 -translate-x-10 group-focus:translate-x-0 flex w-0 group-focus:w-12">
                            <div class="absolute bg-white h-[2px] w-5 transform transition-all duration-500 rotate-0 delay-300 group-focus:rotate-45"></div>
                            <div class="absolute bg-white h-[2px] w-5 transform transition-all duration-500 -rotate-0 delay-300 group-focus:-rotate-45"></div>
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
                        <li class="mb-6"><a href="mailto:{{ config('noot.site.email') }}" class="text-white hover:text-[var(--primary-color)] transition ease-in-out">{{ config('noot.site.email') }}</a></li>
                        <li class="mb-6"><a href="tel:{{ config('noot.site.phone') }}" class="text-white hover:text-[var(--primary-color)] transition ease-in-out">{{ config('noot.site.phone') }}</a></li>
                    </ul>
                    <div>
                        <ul class="flex items-center">
                            <li class="me-4 relative transition ease-in-out hover:-translate-y-1">
                                <a target="_blank" href="https://x.com/bued_hr">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.053 4.988L12.684 13.012H11.187L5.566 4.988H7.053ZM18 3V15C18 16.657 16.657 18 15 18H3C1.343 18 0 16.657 0 15V3C0 1.343 1.343 0 3 0H15C16.657 0 18 1.343 18 3ZM14.538 14L10.352 8.01L13.774 4H12.463L9.759 7.16L7.552 4H3.702L7.643 9.633L3.906 14H5.239L8.24 10.484L10.698 14H14.538Z" fill="white"/>
                                    </svg>
                                </a>
                            </li>
                            <li class="me-4 relative transition ease-in-out hover:-translate-y-1">
                                <a target="_blank" href="https://www.tiktok.com/@bued.ai?_r=1&_t=ZS-91TJlartuml">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 0C1.35503 0 0 1.35503 0 3V15C0 16.645 1.35503 18 3 18H15C16.645 18 18 16.645 18 15V3C18 1.35503 16.645 0 15 0H3ZM9 4H11C11 5.005 12.471 6 13 6V8C12.395 8 11.668 7.73416 11 7.28516V11C11 12.654 9.654 14 8 14C6.346 14 5 12.654 5 11C5 9.346 6.346 8 8 8V10C7.448 10 7 10.449 7 11C7 11.551 7.448 12 8 12C8.552 12 9 11.551 9 11V4Z" fill="white"/>
                                    </svg>
                                </a>
                            </li>
                            <li class="me-4 relative transition ease-in-out hover:-translate-y-1">
                                <a target="_blank" href="https://www.linkedin.com/company/nootco">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16 0H2C0.895 0 0 0.895 0 2V16C0 17.105 0.895 18 2 18H16C17.105 18 18 17.105 18 16V2C18 0.895 17.105 0 16 0ZM6 14H3.477V7H6V14ZM4.694 5.717C3.923 5.717 3.408 5.203 3.408 4.517C3.408 3.831 3.922 3.317 4.779 3.317C5.55 3.317 6.065 3.831 6.065 4.517C6.065 5.203 5.551 5.717 4.694 5.717ZM15 14H12.558V10.174C12.558 9.116 11.907 8.872 11.663 8.872C11.419 8.872 10.605 9.035 10.605 10.174C10.605 10.337 10.605 14 10.605 14H8.082V7H10.605V7.977C10.93 7.407 11.581 7 12.802 7C14.023 7 15 7.977 15 10.174V14Z" fill="white"/>
                                    </svg>
                                </a>
                            </li>
                            <li class="me-4 relative transition ease-in-out hover:-translate-y-1">
                                <a target="_blank" href="https://www.instagram.com/bued.hr/">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 0C2.239 0 0 2.239 0 5V13C0 15.761 2.239 18 5 18H13C15.761 18 18 15.761 18 13V5C18 2.239 15.761 0 13 0H5ZM15 2C15.552 2 16 2.448 16 3C16 3.552 15.552 4 15 4C14.448 4 14 3.552 14 3C14 2.448 14.448 2 15 2ZM9 4C11.761 4 14 6.239 14 9C14 11.761 11.761 14 9 14C6.239 14 4 11.761 4 9C4 6.239 6.239 4 9 4ZM9 6C8.20435 6 7.44129 6.31607 6.87868 6.87868C6.31607 7.44129 6 8.20435 6 9C6 9.79565 6.31607 10.5587 6.87868 11.1213C7.44129 11.6839 8.20435 12 9 12C9.79565 12 10.5587 11.6839 11.1213 11.1213C11.6839 10.5587 12 9.79565 12 9C12 8.20435 11.6839 7.44129 11.1213 6.87868C10.5587 6.31607 9.79565 6 9 6Z" fill="white"/>
                                    </svg>
                                </a>
                            </li>
                            <li class="me-4 relative transition ease-in-out hover:-translate-y-1">
                                <a target="_blank" href="https://www.snapchat.com/add/bued.ai?share_id=LT6hM6sFCME&locale=ar-SA">
                                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19" width="19" height="19">
                                        <title>icons8-snapchat (1)-svg</title>
                                        <defs>
                                            <linearGradient id="g1" x2="1" gradientUnits="userSpaceOnUse" gradientTransform="matrix(3.551,20.14,-20.14,3.551,7.725,-0.57)">
                                                <stop offset="0" stop-color="#ffffff"/>
                                                <stop offset="1" stop-color="#ffffff"/>
                                            </linearGradient>
                                        </defs>
                                        <style>
                                            .s0 { fill: url(#g1) }
                                            .s1 { opacity: .1;fill: #000000 }
                                            .s2 { opacity: .1;fill: none;stroke: #1d1d1b;stroke-miterlimit:10;stroke-width: 1;stroke-dasharray: NaN }
                                            .s3 { opacity: .1;fill: none;stroke: #000000;stroke-miterlimit:10;stroke-width: .5;stroke-dasharray: NaN }
                                            .s4 { fill: #000000 }
                                        </style>
                                        <g>
                                            <g>
                                                <path class="s0" d="m14.7 18.9h-10.4c-2.3 0-4.2-1.9-4.2-4.2v-10.4c0-2.3 1.9-4.2 4.2-4.2h10.4c2.3 0 4.2 1.9 4.2 4.2v10.4c0 2.3-1.9 4.2-4.2 4.2z"/>
                                                <path class="s1" d="m4.6 7.7q-0.1 0-0.3 0-0.2 0.1-0.3 0.4c0 0.2 0 0.5 0.2 0.6l2 1.2-0.1 0.2c0 0.1-0.9 2.3-2.5 3.2q-0.1 0.1-0.1 0.1 0 0.1 0.1 0.2c0.3 0.3 0.7 0.5 1.4 0.6h0.2v0.3c0 0.3 0.1 0.6 0.2 0.6 0.5 0 1.4 0 2.4 0.5 0.5 0.3 1.3 0.4 1.7 0.4 0.4 0 1.2-0.1 1.7-0.4 1-0.5 1.9-0.5 2.4-0.5 0.1 0 0.2-0.3 0.2-0.6v-0.3h0.2c0.7-0.1 1.1-0.3 1.4-0.6q0.1-0.1 0.1-0.2 0 0-0.1-0.1c-1.6-0.9-2.5-3.1-2.5-3.2l-0.1-0.2 2-1.2c0.2-0.1 0.2-0.4 0.2-0.6q-0.1-0.3-0.3-0.4-0.2-0.1-0.5 0l-1.3 0.6v-1.9c0-1.9-1.5-3.4-3.4-3.4-1.9 0-3.4 1.5-3.4 3.4v1.9l-1.3-0.6q-0.1 0-0.2 0z"/>
                                                <path fill-rule="evenodd" class="s2" d="m9.5 16.3c0.5 0 1.2-0.2 1.8-0.5 0.9-0.4 1.9-0.4 2.3-0.4 0.5 0 0.5-0.9 0.5-0.9 0.7-0.2 1.1-0.4 1.5-0.7 0.3-0.2 0.2-0.6-0.1-0.7-1.5-0.9-2.3-3.1-2.3-3.1l1.7-1.1c0.3-0.2 0.4-0.6 0.3-0.9-0.1-0.5-0.6-0.7-1.1-0.5l-0.9 0.4v-1.5c0-2-1.7-3.7-3.7-3.7-2 0-3.7 1.7-3.7 3.7v1.5l-0.9-0.4c-0.5-0.2-1 0-1.1 0.5-0.1 0.3 0 0.7 0.3 0.9l1.7 1.1c0 0-0.8 2.2-2.3 3.1-0.3 0.1-0.4 0.5-0.1 0.7 0.4 0.3 0.8 0.5 1.5 0.7 0 0 0 0.9 0.5 0.9 0.4 0 1.4 0 2.3 0.4 0.6 0.3 1.3 0.5 1.8 0.5z"/>
                                                <path fill-rule="evenodd" class="s3" d="m9.5 16.3c0.5 0 1.2-0.2 1.8-0.5 0.9-0.4 1.9-0.4 2.3-0.4 0.5 0 0.5-0.9 0.5-0.9 0.7-0.2 1.1-0.4 1.5-0.7 0.3-0.2 0.2-0.6-0.1-0.7-1.5-0.9-2.3-3.1-2.3-3.1l1.7-1.1c0.3-0.2 0.4-0.6 0.3-0.9-0.1-0.5-0.6-0.7-1.1-0.5l-0.9 0.4v-1.5c0-2-1.7-3.7-3.7-3.7-2 0-3.7 1.7-3.7 3.7v1.5l-0.9-0.4c-0.5-0.2-1 0-1.1 0.5-0.1 0.3 0 0.7 0.3 0.9l1.7 1.1c0 0-0.8 2.2-2.3 3.1-0.3 0.1-0.4 0.5-0.1 0.7 0.4 0.3 0.8 0.5 1.5 0.7 0 0 0 0.9 0.5 0.9 0.4 0 1.4 0 2.3 0.4 0.6 0.3 1.3 0.5 1.8 0.5z"/>
                                                <path class="s4" d="m9.5 16.3c0.5 0 1.2-0.2 1.8-0.5 0.9-0.4 1.9-0.4 2.3-0.4 0.5 0 0.5-0.9 0.5-0.9 0.7-0.2 1.1-0.4 1.5-0.7 0.3-0.2 0.2-0.6-0.1-0.7-1.5-0.9-2.3-3.1-2.3-3.1l1.7-1.1c0.3-0.2 0.4-0.6 0.3-0.9-0.1-0.5-0.6-0.7-1.1-0.5l-0.9 0.4v-1.5c0-2-1.7-3.7-3.7-3.7-2 0-3.7 1.7-3.7 3.7v1.5l-0.9-0.4c-0.5-0.2-1 0-1.1 0.5-0.1 0.3 0 0.7 0.3 0.9l1.7 1.1c0 0-0.8 2.2-2.3 3.1-0.3 0.1-0.4 0.5-0.1 0.7 0.4 0.3 0.8 0.5 1.5 0.7 0 0 0 0.9 0.5 0.9 0.4 0 1.4 0 2.3 0.4 0.6 0.3 1.3 0.5 1.8 0.5z"/>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </li>
                            <li class="relative transition ease-in-out hover:-translate-y-1">
                                <a target="_blank" href="https://www.facebook.com/profile.php?id=61583944401519">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 0C4.477 0 0 4.477 0 10C0 15.013 3.693 19.153 8.505 19.876V12.65H6.031V10.021H8.505V8.272C8.505 5.376 9.916 4.105 12.323 4.105C13.476 4.105 14.085 4.19 14.374 4.229V6.523H12.732C11.71 6.523 11.353 7.492 11.353 8.584V10.021H14.348L13.942 12.65H11.354V19.897C16.235 19.236 20 15.062 20 10C20 4.477 15.523 0 10 0Z" fill="white"/>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-8">
                        <ul class="flex items-center">
                            @if(app()->getLocale() === 'ar')
                                <li class="relative transition ease-in-out hover:-translate-y-1">
                                    <a target="_blank" href="https://play.google.com/store/apps/details?id=com.noot.app" >
                                        <img src="{{ asset('images/site/googlePlay-ar.svg') }}" width="120px" alt="">
                                    </a>
                                </li>
                                <li class="relative transition ease-in-out hover:-translate-y-1 mx-1">
                                    <a target="_blank" href="https://apps.apple.com/gb/app/noot-%D9%86%D9%88%D8%AA/id6740081271?platform=iphone">
                                        <img src="{{ asset('images/site/appStore-ar.svg') }}" width="110px" alt="">
                                    </a>
                                </li>
                            @else
                                <li class="relative transition ease-in-out hover:-translate-y-1">
                                    <a target="_blank" href="https://play.google.com/store/apps/details?id=com.noot.app">
                                        <img src="{{ asset('images/site/googlePlay-en.svg') }}" width="120px" alt="">
                                    </a>
                                </li>
                                <li class="relative transition ease-in-out hover:-translate-y-1 mx-1">
                                    <a target="_blank" href="https://apps.apple.com/gb/app/noot-%D9%86%D9%88%D8%AA/id6740081271?platform=iphone" >
                                        <img src="{{ asset('images/site/appStore-en.svg') }}" width="110px" alt="">
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
