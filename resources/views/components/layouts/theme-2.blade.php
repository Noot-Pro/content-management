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
            <img class="w-20" src="{{ asset('vendor/noot-pro/content-management/images/theme-2/logo.png') }}" alt="">
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
                        @livewire(\NootPro\ContentManagement\Livewire\MenuPages::class, ['parent_id' => 60,'type' => 'header'])
                    </div>
                </li>
                <li class="links__item">
                    <a href="{{ url('/#plans') }}">{{ __('noot-pro-content-management::site.plans') }}</a>
                </li>
                <li class="links__item links__item--has-dropdown">
                    <a href="#">{{ __('noot-pro-content-management::site.contents') }}</a>
                    <div class="links__dropdown">
                        @livewire(\NootPro\ContentManagement\Livewire\MenuPages::class, ['parent_id' => 61,'type' => 'header'])
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
                <li><a href="{{ url('/contact') }}" class="px-4 py-2.5 text-sm border-2 rounded-xl border-[var(--primary-color)] bg-[var(--primary-color)] hover:bg-[#EEAB43] hover:border-[#EEAB43] text-white transition ease-in-out">{{ __('noot-pro-content-management::site.contact_us') }}</a></li>
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
                                <img class="w-32" src="{{ asset('vendor/noot-pro/content-management/images/theme-2/logo.png') }}" alt="">
                            </a>
                        </div>
                        <div class="mb-4 text-white">{{ __('noot-pro-content-management::site.footer_text') }}.</div>
                        <div>
                            <a href="{{ url(filament()->getRegistrationUrl()) }}" class="inline-block px-6 py-3.5 border-2 rounded-xl border-[var(--primary-color)] bg-[var(--primary-color)] hover:bg-[#EEAB43] hover:border-[#EEAB43] text-white transition ease-in-out">{{ __('noot-pro-content-management::site.start_free_test') }}</a>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-6 xl:col-span-2 col-span-full mb-12 xl:mb-0">
                    <div class="mb-6 text-[#969696]">{{ __('noot-pro-content-management::site.about_company') }}</div>
                    <ul>
                        <li class="mb-6"><a href="{{ url('page/about-as') }}" class="text-white hover:text-[var(--primary-color)] transition ease-in-out">{{ __('noot-pro-content-management::site.about_us') }}</a></li>
                        <li class="mb-6"><a href="{{ url('page/privacy') }}" class="text-white hover:text-[var(--primary-color)] transition ease-in-out">{{ __('noot-pro-content-management::site.privacy') }}</a></li>
                        <li class="mb-6"><a href="{{ url('page/term') }}" class="text-white hover:text-[var(--primary-color)] transition ease-in-out">{{ __('noot-pro-content-management::site.term') }}</a></li>
                        <li class="mb-6"><a href="{{ url('faq') }}" class="text-white hover:text-[var(--primary-color)] transition ease-in-out">{{ __('noot-pro-content-management::site.faq') }}</a></li>
                    </ul>
                </div>
                <div class="lg:col-span-6 xl:col-span-2 col-span-full mb-12 xl:mb-0">
                    <div class="mb-6 text-[#969696]">{{ __('noot-pro-content-management::site.our_solutions') }}</div>
                    @livewire(\NootPro\ContentManagement\Livewire\MenuPages::class, ['parent_id' => 60,'type' => 'footer'])
                </div>
                <div class="lg:col-span-6 xl:col-span-2 col-span-full mb-12 xl:mb-0">
                    <div class="mb-6 text-[#969696]">{{ __('noot-pro-content-management::site.contents') }}</div>
                    @livewire(\NootPro\ContentManagement\Livewire\MenuPages::class, ['parent_id' => 61,'type' => 'footer'])
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
                                <a target="_blank" href="https://x.com/erpnootsa">
                                    <img src="{{ asset('images/site/social-media/x.svg') }}" alt="">
                                </a>
                            </li>
                            <li class="me-4 relative transition ease-in-out hover:-translate-y-1">
                                <a target="_blank" href="https://www.tiktok.com/@erpnootsa?is_from_webapp=1&sender_device=pc">
                                    <img src="{{ asset('images/site/social-media/tiktok.svg') }}" alt="">
                                </a>
                            </li>
                            <li class="me-4 relative transition ease-in-out hover:-translate-y-1">
                                <a target="_blank" href="https://www.linkedin.com/company/nootco">
                                    <img src="{{ asset('images/site/social-media/linkedin.svg') }}" alt="">
                                </a>
                            </li>
                            <li class="me-4 relative transition ease-in-out hover:-translate-y-1">
                                <a target="_blank" href="https://www.instagram.com/erpnootsa/?hl=ar">
                                    <img src="{{ asset('images/site/social-media/instagram.svg') }}" alt="">
                                </a>
                            </li>
                            <li class="me-4 relative transition ease-in-out hover:-translate-y-1">
                                <a target="_blank" href="https://story.snapchat.com/u/erpnootsa?share_id=EQe7lcbQRFO20N57ygzSvw&locale=ar_SA@calendar=gregorian">
                                    <img src="{{ asset('images/site/social-media/snapchat.svg') }}" alt="">
                                </a>
                            </li>
                            <li class="relative transition ease-in-out hover:-translate-y-1">
                                <a target="_blank" href="https://www.facebook.com/erpnootsa/?locale=ar_AR">
                                    <img src="{{ asset('images/site/social-media/facebook.svg') }}" alt="">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-8">
                        <ul class="flex items-center">
                            @if(app()->getLocale() == 'ar')
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
