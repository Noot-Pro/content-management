<!doctype html>
<html class="scroll-smooth" dir="{{ (app()->getLocale() === 'ar') ? 'rtl' : 'ltr' }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <meta name="google-site-verification" content="HT67x1ITfme_YzTtBSyU8Xcs0IY3lAFQQhEK4R2kcZQ" />
    <!-- Seo Tags -->
    <x-seo::meta/>
    @if(request()->is('/'))
        <link rel="canonical" href="{{ url()->current() }}" />
    @endif
    <!-- Seo Tags -->

    @livewireStyles
    @filamentStyles
    @stack('styles')

    @if(request()->is('/'))
        @vite(['resources/css/landing/landing.css'])
    @else
        @vite(['resources/css/site/site.css'])
    @endif

    @if(request()->is('/'))
        <!-- Snap Pixel Code -->
        <script type='text/javascript'>
            (function(e,t,n){if(e.snaptr)return;var a=e.snaptr=function()
            {a.handleRequest?a.handleRequest.apply(a,arguments):a.queue.push(arguments)};
                a.queue=[];var s='script';r=t.createElement(s);r.async=!0;
                r.src=n;var u=t.getElementsByTagName(s)[0];
                u.parentNode.insertBefore(r,u);})(window,document,
                'https://sc-static.net/scevent.min.js');

            snaptr('init', 'dc0236cb-6ab7-44a2-b892-488794b2b257', {
                'user_email': '{{ config('noot.site.email') }}',
                'user_phone_number': '{{ config('noot.site.phone_with_code') }}'
            });

            snaptr('track', 'PAGE_VIEW');

        </script>
        <!-- End Snap Pixel Code -->
    @endif

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-TLVDL5Z9');</script>
    <!-- End Google Tag Manager -->
    <!-- Twitter conversion tracking base code -->
    <script>
        !function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
        },s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='https://static.ads-twitter.com/uwt.js',
            a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
        twq('config','pqmrb');
    </script>
    <!-- End Twitter conversion tracking base code -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TLVDL5Z9"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
@include('noot-pro-content-management::site.partials.header')

<div class="container mx-auto">
    {{ $slot }}
</div>

@include('noot-pro-content-management::site.partials.footer')

<div class="responsive-menu overflow-y-auto pt-28 pb-12 hidden">
    <div class="fixed top-11 left-4 close-responsive">
        <button class="relative mobile-menu">
            <div class="relative flex overflow-hidden items-center justify-center rounded-full w-[50px] h-[50px] transform transition-all bg-[#E86F44] ring-gray-300 hover:ring-8 ring-4 ring-opacity-30 duration-200 shadow-md">
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

    <div class="logo flex justify-center">
        <img src="{{ asset('images/site/logo.svg') }}" alt="">
    </div>
    <ul class="flex flex-col gap-2 max-w-[280px] mx-auto my-12">
        <li>
            <details>
                <summary class="flex items-center justify-between gap-2 p-2 font-medium marker:content-none hover:cursor-pointer">
                    <span class="flex gap-2">
                        <a href="{{ url('/') }}">{{ __('noot-pro-content-management::site.home') }}</a>
                    </span>
                </summary>
            </details>
        </li>
        <li>
            <details class="group">
                <summary class="flex items-center justify-between gap-2 p-2 font-medium marker:content-none hover:cursor-pointer">
                    <span class="flex gap-2">
                        <span class="group-open:text-[#E86F44]">{{ __('noot-pro-content-management::site.products') }}</span>
                    </span>
                    <svg class="w-5 h-5 rotate-180 text-gray-500 transition group-open:rotate-90" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                    </svg>
                </summary>
                <article class="px-4 pb-4">
                    @livewire('menu-pages', ['parent_id' => 60,'type' => 'mobile'])
                </article>
            </details>
        </li>
        <li>
            <details>
                <summary class="flex items-center justify-between gap-2 p-2 font-medium marker:content-none hover:cursor-pointer">
                    <span class="flex gap-2">
                        <a href="{{ url('/#plans') }}">{{ __('noot-pro-content-management::site.plans') }}</a>
                    </span>
                </summary>
            </details>
        </li>
        <li>
            <details class="group">
                <summary class="flex items-center justify-between gap-2 p-2 font-medium marker:content-none hover:cursor-pointer">
                <span class="flex gap-2">
                    <span class="group-open:text-[#E86F44]">{{ __('noot-pro-content-management::site.contents') }}</span>
                </span>
                    <svg class="w-5 h-5 rotate-180 text-gray-500 transition group-open:rotate-90" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                    </svg>
                </summary>
                <article class="px-4 pb-4">
                    @livewire('menu-pages', ['parent_id' => 61,'type' => 'mobile'])
                </article>
            </details>
        </li>
        <li>
            <details>
                <summary class="flex items-center justify-between gap-2 p-2 font-medium marker:content-none hover:cursor-pointer">
                    <span class="flex gap-2">
                        <a href="{{ url('blog') }}">{{ __('noot-pro-content-management::site.blog') }}</a>
                    </span>
                </summary>
            </details>
        </li>
        <li>
            <details>
                <summary class="flex items-center justify-between gap-2 p-2 font-medium marker:content-none hover:cursor-pointer">
                    <span class="flex gap-2">
                        @if(app()->getLocale() == 'ar')
                            <a href="{{ url('lang/en') }}">English</a>
                        @else
                            <a href="{{ url('lang/ar') }}">العربية</a>
                        @endif
                    </span>
                </summary>
            </details>
        </li>
    </ul>
    <div class="actions max-w-[280px] mx-auto">
        <ul class="flex justify-between gap-x-4">
            <li><a href="#" class="px-4 py-2.5 text-sm border-2 rounded-xl border-[#E8E8E8] hover:bg-[#E8E8E8] transition ease-in-out">تسجيل الدخول</a></li>
            <li><a href="#" class="px-4 py-2.5 text-sm border-2 rounded-xl border-[#E86F44] bg-[#E86F44] hover:bg-(--secondary-color) hover:border-(--secondary-color) text-white transition ease-in-out">تواصل معنا الآن</a></li>
        </ul>
    </div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="{{ asset('js/site/scripts.js') }}"></script>

@livewireScripts
@filamentScripts
@livewire('notifications')
@stack('scripts')
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-13H8FHHK01"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-13H8FHHK01');
</script>
</body>
</html>
