<footer class="w-full">
    <div class="bg-[#0F0F0F] pt-14 pb-32">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-12 gap-x-6 items-stretch">
                <div class="lg:col-span-12 xl:col-span-4 col-span-full mb-12 xl:mb-0">
                    <div class="max-w-[300px]">
                        <div class="mb-4">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('images/site/logo.svg') }}" alt="">
                            </a>
                        </div>
                        <div class="mb-4 text-white">{{ __('site.footer_text') }}.</div>
                        <div>
                            <a href="{{ url(filament()->getRegistrationUrl()) }}" class="inline-block px-6 py-3.5 border-2 rounded-xl border-[#E86F44] bg-[#E86F44] hover:bg-[#EEAB43] hover:border-[#EEAB43] text-white transition ease-in-out">{{ __('site.start_free_test') }}</a>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-6 xl:col-span-2 col-span-full mb-12 xl:mb-0">
                    <div class="mb-6 text-[#969696]">{{ __('site.about_company') }}</div>
                    <ul>
                        <li class="mb-6"><a href="{{ url('page/about-as') }}" class="text-white hover:text-[#E86F44] transition ease-in-out">{{ __('site.about_us') }}</a></li>
                        <li class="mb-6"><a href="{{ url('page/privacy') }}" class="text-white hover:text-[#E86F44] transition ease-in-out">{{ __('site.privacy') }}</a></li>
                        <li class="mb-6"><a href="{{ url('page/term') }}" class="text-white hover:text-[#E86F44] transition ease-in-out">{{ __('site.term') }}</a></li>
                        <li class="mb-6"><a href="{{ url('faq') }}" class="text-white hover:text-[#E86F44] transition ease-in-out">{{ __('site.faq') }}</a></li>
                    </ul>
                </div>
                <div class="lg:col-span-6 xl:col-span-2 col-span-full mb-12 xl:mb-0">
                    <div class="mb-6 text-[#969696]">{{ __('site.our_solutions') }}</div>
                    @livewire(\NootPro\ContentManagement\Livewire\MenuPages::class, ['parent_id' => 60,'type' => 'footer'])
                </div>
                <div class="lg:col-span-6 xl:col-span-2 col-span-full mb-12 xl:mb-0">
                    <div class="mb-6 text-[#969696]">{{ __('site.contents') }}</div>
                    @livewire(\NootPro\ContentManagement\Livewire\MenuPages::class, ['parent_id' => 61,'type' => 'footer'])
                </div>
                <div class="lg:col-span-12 xl:col-span-2 col-span-full">
                    <div class="mb-6 text-[#969696]">{{ __('site.contact_us') }}</div>
                    <ul class="mb-6">
                        <li class="mb-6"><a href="mailto:{{ config('noot.site.email') }}" class="text-white hover:text-[#E86F44] transition ease-in-out">{{ config('noot.site.email') }}</a></li>
                        <li class="mb-6"><a href="tel:{{ config('noot.site.phone') }}" class="text-white hover:text-[#E86F44] transition ease-in-out">{{ config('noot.site.phone') }}</a></li>
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
            <div>{{ __('site.copy_write') }} © {{ now()->format('Y') }}</div>
            <div style="direction: ltr;">© {{ now()->format('Y') }} Noot Inc.</div>
        </div>
    </div>
</footer>
