<div>
    <section class="w-full bg-no-repeat bg-bottom">
        <div class="container px-4 py-20 pb-2">
            <div class="text-center">
                <span class="text-sm py-1.5 px-3 border rounded-lg inline-block mb-4">{{ __('noot-pro-content-management::site.noot_title') }}</span>
                <div class="text-[32px] xl:text-[64px] font-bold mb-6">{{ __('noot-pro-content-management::site.home_head_1') }} <span class="block text-[#E86F44]">{{ __('noot-pro-content-management::site.home_head_2') }}</span></div>
                <div class="mx-auto max-w-[663px] text-xl text-[#8C9399] font-light mb-8">{{ __('noot-pro-content-management::site.home_text') }}</div>
                <div class="flex justify-center gap-x-4">
                    <a href="{{ url(filament()->getRegistrationUrl()) }}" class="px-6 py-3.5 border-2 rounded-xl border-[#E86F44] bg-[#E86F44] hover:bg-[#EEAB43] hover:border-[#EEAB43] text-white transition ease-in-out">{{ __('noot-pro-content-management::site.start_free_test') }}</a>
                    <a href="#plans" class="px-6 py-3.5 border-2 rounded-xl border-[#E8E8E8] hover:bg-[#E8E8E8] transition ease-in-out">{{ __('noot-pro-content-management::site.plans_and_prices') }}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full">
        <div class="container px-4 text-center">
            <div class="w-full text-center">
                @if(app()->getLocale() == 'ar')
                    <img src="{{ url('/vendor/noot-pro/content-management/images/apps.png') }}" class="mx-auto md:w-[100%] lg:w-[60%]" alt="">
                @else
                    <img src="{{ asset('/vendor/noot-pro/content-management/images/apps.png') }}" class="mx-auto md:w-[100%] lg:w-[60%]" alt="">
                @endif
            </div>
        </div>
    </section>

    <section class="w-full">
        <div class="container px-4 pt-12 xl:pt-14 mb-2">
            <div class="text-[32px] xl:text-[48px] font-bold mb-10 xl:mb-20 text-center">{{ __('noot-pro-content-management::site.features_title') }} <span class="block text-[#E86F44]">{{ __('noot-pro-content-management::site.one_place') }}</span></div>
            <div class="grid grid-cols-12  gap-x-4">
                <div class="group lg:col-span-6 xl:col-span-8 col-span-full p-7 lg:p-14 mb-5 bg-[#F7F7F7] lg:h-[250px] rounded-[24px] xl:rounded-[48px] transition ease-in-out hover:bg-orange-50">
                    <div class="text-xl mb-2.5 transition ease-in-out group-hover:text-[#E86F44]">{{ __('noot-pro-content-management::site.hr_title') }}</div>
                    <div class="text-base text-[#8C9399] font-light max-w-[524px]">{{ __('noot-pro-content-management::site.hr_text') }}</div>
                </div>
                <div class="group lg:col-span-6 xl:col-span-4 col-span-full p-7 lg:p-14 mb-5 bg-[#F7F7F7] lg:h-[250px] rounded-[24px] xl:rounded-[48px] transition ease-in-out hover:bg-orange-50">
                    <div class="text-xl mb-2.5 transition ease-in-out group-hover:text-[#E86F44]">{{ __('noot-pro-content-management::site.accounting_title') }}</div>
                    <div class="text-base text-[#8C9399] font-light max-w-[524px]">{{ __('noot-pro-content-management::site.accounting_text') }}</div>
                </div>

                <div class="group lg:col-span-6 xl:col-span-4 col-span-full p-7 lg:p-14 mb-5 bg-[#F7F7F7] lg:h-[350px] rounded-[24px] xl:rounded-[48px] transition ease-in-out hover:bg-orange-50">
                    <div class="text-xl mb-2.5 transition ease-in-out group-hover:text-[#E86F44]">{{ __('noot-pro-content-management::site.crm_title') }}</div>
                    <div class="text-base text-[#8C9399] font-light max-w-[524px]">{{ __('noot-pro-content-management::site.crm_text') }}</div>
                </div>

                <div class="group lg:col-span-6 xl:col-span-8 col-span-full p-7 lg:p-14 mb-5 bg-[#F7F7F7] lg:h-[350px] rounded-[24px] xl:rounded-[48px] transition ease-in-out hover:bg-orange-50">
                    <div class="text-xl mb-2.5 transition ease-in-out group-hover:text-[#E86F44]">{{ __('noot-pro-content-management::site.pos_title') }}</div>
                    <div class="text-base text-[#8C9399] font-light max-w-[524px]">{{ __('noot-pro-content-management::site.pos_text') }}</div>
                </div>

            </div>
        </div>
    </section>

    <section class="w-full">
        <div class="container px-4">
            <div class="text-[32px] xl:text-[48px] font-bold mb-10 xl:mb-20 text-center">{{ __('noot-pro-content-management::site.why_choose') }} <span class="text-[#E86F44]">{{ __('noot-pro-content-management::site.noot') }}</span></div>
            <div class="timeline max-w-[1108px] mx-auto">
                <div class="timeline__items ps-12 xl:ps-0">
                    <span class="default-line"></span>
                    <span class="draw-line"></span>
                    <div class="timeline__item timeline__item--first mb-16 xl:mb-32 group">
                        <div class="grid xl:grid-cols-12 lg:gap-x-12 xl:gap-x-24 min-h-[250px]">
                            <div class="hidden xl:block xl:col-span-6 col-span-full overflow-hidden h-[424px]  rounded-[48px] transition ease-in-out group-hover:bg-orange-50">
                                <img class="size-full object-cover object-center" src="{{ asset('/vendor/noot-pro/content-management/images/why/6.png') }}" alt="">
                            </div>
                            <div class="xl:col-start-7 xl:col-span-6 col-span-full">
                                <div class="py-1.5 px-3 mb-2.5 inline-block text-sm border rounded-xl border-[#E86F44] text-[#E86F44]">{{ __('noot-pro-content-management::site.solution_badge') }}</div>
                                <div class="text-xl mb-2.5">{{ __('noot-pro-content-management::site.solution_title') }}</div>
                                <div class="text-xl text-[#8C9399] font-light transition ease-in-out group-hover:text-[#E86F44]">{{ __('noot-pro-content-management::site.solution_text') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="timeline__item mb-16 xl:mb-32 group">
                        <div class="grid xl:grid-cols-12 lg:gap-x-12 xl:gap-x-24 items-center min-h-[250px] xl:min-h-[424px]">
                            <div class="lg:col-span-6 col-span-full xl:text-left">
                                <div class="py-1.5 px-3 mb-2.5 inline-block text-sm border rounded-xl border-[#E86F44] text-[#E86F44]">{{ __('noot-pro-content-management::site.easy_use_badge') }}</div>
                                <div class="text-xl mb-2.5">{{ __('noot-pro-content-management::site.easy_use_title') }}</div>
                                <div class="text-xl text-[#8C9399] font-light transition ease-in-out group-hover:text-[#E86F44]">{{ __('noot-pro-content-management::site.easy_use_text') }}</div>
                            </div>
                            <div class="hidden xl:block xl:col-start-7 xl:col-span-6 col-span-full overflow-hidden h-[424px] rounded-[48px] transition ease-in-out group-hover:bg-orange-50">
                                <img class="size-full object-cover object-center" src="{{ asset('/vendor/noot-pro/content-management/images/why/1.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="timeline__item mb-16 xl:mb-32 group">
                        <div class="grid xl:grid-cols-12 lg:gap-x-12 xl:gap-x-24 items-center min-h-[250px] xl:min-h-[424px]">
                            <div class="hidden xl:block xl:col-span-6 col-span-full overflow-hidden h-[424px]  rounded-[48px] transition ease-in-out group-hover:bg-orange-50">
                                <img class="size-full object-cover object-center" src="{{ asset('/vendor/noot-pro/content-management/images/why/2.png') }}" alt="">
                            </div>
                            <div class="xl:col-start-7 lg:col-span-6 col-span-full">
                                <div class="py-1.5 px-3 mb-2.5 inline-block text-sm border rounded-xl border-[#E86F44] text-[#E86F44]">{{ __('noot-pro-content-management::site.support_badge') }}</div>
                                <div class="text-xl mb-2.5">{{ __('noot-pro-content-management::site.support_title') }}</div>
                                <div class="text-xl text-[#8C9399] font-light transition ease-in-out group-hover:text-[#E86F44]">{{ __('noot-pro-content-management::site.support_text') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="timeline__item mb-16 xl:mb-32 group">
                        <div class="grid xl:grid-cols-12 lg:gap-x-12 xl:gap-x-24 items-center min-h-[250px] xl:min-h-[424px]">
                            <div class="lg:col-span-6 col-span-full xl:text-left">
                                <div class="py-1.5 px-3 mb-2.5 inline-block text-sm border rounded-xl border-[#E86F44] text-[#E86F44]">{{ __('noot-pro-content-management::site.integration_badge') }}</div>
                                <div class="text-xl mb-2.5">{{ __('noot-pro-content-management::site.integration_title') }}</div>
                                <div class="text-xl text-[#8C9399] font-light transition ease-in-out group-hover:text-[#E86F44]">{{ __('noot-pro-content-management::site.integration_text') }}</div>
                            </div>
                            <div class="hidden xl:block xl:col-start-7 xl:col-span-6 col-span-full overflow-hidden h-[424px] rounded-[48px] transition ease-in-out group-hover:bg-orange-50">
                                <img class="size-full object-cover object-center" src="{{ asset('/vendor/noot-pro/content-management/images/why/3.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="timeline__item mb-16 xl:mb-32 group">
                        <div class="grid xl:grid-cols-12 lg:gap-x-12 xl:gap-x-24 items-center min-h-[250px] xl:min-h-[424px]">
                            <div class="hidden xl:block xl:col-span-6 col-span-full overflow-hidden h-[424px] rounded-[48px] transition ease-in-out group-hover:bg-orange-50">
                                <img class="size-full object-cover object-center" src="{{ asset('/vendor/noot-pro/content-management/images/why/4.png') }}" alt="">
                            </div>
                            <div class="xl:col-start-7 lg:col-span-6 col-span-full">
                                <div class="py-1.5 px-3 mb-2.5 inline-block text-sm border rounded-xl border-[#E86F44] text-[#E86F44]">{{ __('noot-pro-content-management::site.analysis_badge') }}</div>
                                <div class="text-xl mb-2.5">{{ __('noot-pro-content-management::site.analysis_title') }}</div>
                                <div class="text-xl text-[#8C9399] font-light transition ease-in-out group-hover:text-[#E86F44]">{{ __('noot-pro-content-management::site.analysis_text') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="timeline__item mb-16 xl:mb-32 group">
                        <div class="grid xl:grid-cols-12 lg:gap-x-12 xl:gap-x-24 items-center min-h-[250px] xl:min-h-[424px]">
                            <div class="lg:col-span-6 col-span-full xl:text-left">
                                <div class="py-1.5 px-3 mb-2.5 inline-block text-sm border rounded-xl border-[#E86F44] text-[#E86F44]">{{ __('noot-pro-content-management::site.security_badge') }}</div>
                                <div class="text-xl mb-2.5">{{ __('noot-pro-content-management::site.security_title') }}</div>
                                <div class="text-xl text-[#8C9399] font-light transition ease-in-out group-hover:text-[#E86F44]">{{ __('noot-pro-content-management::site.security_text') }}</div>
                            </div>
                            <div class="hidden xl:block xl:col-start-7 xl:col-span-6 lg:col-span-6 col-span-full overflow-hidden h-[424px] rounded-[48px] transition ease-in-out group-hover:bg-orange-50">
                                <img class="size-full object-cover object-center" src="{{ asset('/vendor/noot-pro/content-management/images/why/5.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full">
        <div class="container px-4 pt-32 xl:pt-48">
            <div class="grid xl:grid-cols-12 gap-x-24 w-full min-h-[100%]">
                <div class="lg:col-span-6 col-span-full mb-16 xl:mb-0">
                    <div class="text-[32px] xl:text-[48px] font-bold mb-10 xl:mb-20 text-center xl:text-right">{{ __('noot-pro-content-management::site.explore_solutions') }} <span class="text-[#E86F44]">{{ __('noot-pro-content-management::site.noot_provided') }}</span></div>
                    <div class="faqs-list">
                        <div class="faqs-list__item cursor-pointer p-7 rounded-[24px] xl:rounded-[32px] transition ease-in-out">
                            <div class="faq-title text-xl flex items-center justify-between flex-row-reverse"><i></i>{{ __('noot-pro-content-management::site.solution_1_title') }}</div>
                            <div class="faq-content mt-4 text-base text-[#8C9399] font-light" style="display: none;">{{ __('noot-pro-content-management::site.solution_1_text') }}</div>
                        </div>
                        <div class="faqs-list__item cursor-pointer p-7 rounded-[24px] xl:rounded-[32px] transition ease-in-out">
                            <div class="faq-title text-xl flex items-center justify-between flex-row-reverse"><i></i>{{ __('noot-pro-content-management::site.solution_2_title') }}</div>
                            <div class="faq-content mt-4 text-base text-[#8C9399] font-light" style="display: none;">{{ __('noot-pro-content-management::site.solution_2_text') }}</div>
                        </div>
                        <div class="faqs-list__item cursor-pointer p-7 rounded-[24px] xl:rounded-[32px] transition ease-in-out">
                            <div class="faq-title text-xl flex items-center justify-between flex-row-reverse"><i></i>{{ __('noot-pro-content-management::site.solution_4_title') }}</div>
                            <div class="faq-content mt-4 text-base text-[#8C9399] font-light" style="display: none;">{{ __('noot-pro-content-management::site.solution_4_text') }}</div>
                        </div>
                        <div class="faqs-list__item cursor-pointer p-7 rounded-[24px] xl:rounded-[32px] transition ease-in-out">
                            <div class="faq-title text-xl flex items-center justify-between flex-row-reverse"><i></i>{{ __('noot-pro-content-management::site.solution_5_title') }}</div>
                            <div class="faq-content mt-4 text-base text-[#8C9399] font-light" style="display: none;">{{ __('noot-pro-content-management::site.solution_5_text') }}</div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-6 col-span-full h-[600px] overflow-hidden bg-[#F7F7F7] rounded-[24px] xl:rounded-[48px] transition ease-in-out group-hover:bg-orange-50">
                    <img class="size-full object-cover object-center" src="{{ asset('/vendor/noot-pro/content-management/images/solution.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="w-full">
        <div class="container px-4 pt-32 xl:pt-48">
            <div class="text-[32px] xl:text-[48px] font-bold mb-10 xl:mb-20 text-center">{{ __('noot-pro-content-management::site.partners_said') }} <span class="text-[#E86F44]">{{ __('noot-pro-content-management::site.partners') }}</span></div>
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="p-14 bg-[#F7F7F7] rounded-[24px] xl:rounded-[48px] w-full min-h-[400px] flex flex-col justify-between">
                            <div class="text-xl text-[#8C9399] font-light">{{ __('noot-pro-content-management::site.said_1_text') }}</div>
                            <div class="flex items-center">
                                <div class="w-[52px] h-[52px] overflow-hidden rounded-full bg-[#E8E8E8]">
                                    <img class="size-full object-cover object-center" src="{{ asset('/vendor/noot-pro/content-management/images/said/1.jpg') }}" alt="">
                                </div>
                                <div class="ms-4">
                                    <div class="text-base mb-1">{{ __('noot-pro-content-management::site.client_1_name') }}</div>
                                    <div class="text-[#8C9399] font-light">12 {{ __('noot-pro-content-management::site.may') }} 2025</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="p-14 bg-[#F7F7F7] rounded-[24px] xl:rounded-[48px] w-full min-h-[400px] flex flex-col justify-between">
                            <div class="text-xl text-[#8C9399] font-light">{{ __('noot-pro-content-management::site.said_2_text') }}</div>
                            <div class="flex items-center">
                                <div class="w-[52px] h-[52px] overflow-hidden rounded-full bg-[#E8E8E8]">
                                    <img class="size-full object-cover object-center" src="{{ asset('/vendor/noot-pro/content-management/images/said/2.jpg') }}" alt="">
                                </div>
                                <div class="ms-4">
                                    <div class="text-base mb-1">{{ __('noot-pro-content-management::site.client_2_name') }}</div>
                                    <div class="text-[#8C9399] font-light">17 {{ __('noot-pro-content-management::site.march') }} 2025</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="p-14 bg-[#F7F7F7] rounded-[24px] xl:rounded-[48px] w-full min-h-[400px] flex flex-col justify-between">
                            <div class="text-xl text-[#8C9399] font-light">{{ __('noot-pro-content-management::site.said_3_text') }}</div>
                            <div class="flex items-center">
                                <div class="w-[52px] h-[52px] overflow-hidden rounded-full bg-[#E8E8E8]">
                                    <img class="size-full object-cover object-center" src="{{ asset('/vendor/noot-pro/content-management/images/said/3.png') }}" alt="">
                                </div>
                                <div class="ms-4">
                                    <div class="text-base mb-1">{{ __('noot-pro-content-management::site.client_3_name') }}</div>
                                    <div class="text-[#8C9399] font-light">24 {{ __('noot-pro-content-management::site.april') }} 2025</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(app()->getLocale() == 'ar')
        @php
            $bg_align = 'bg-right';
        @endphp
    @else
        @php
            $bg_align = 'bg-left';
        @endphp
    @endif

    <section class="w-full" id="plans">
        <div class="container px-4 py-32 xl:py-48">
            <div class="text-[32px] xl:text-[48px] font-bold mb-10 xl:mb-20 text-center">{{ __('noot-pro-content-management::site.various_packages') }} <span class="text-[#E86F44]">{{ __('noot-pro-content-management::site.for_all_categories') }}</span></div>
            <div class="grid grid-cols-12 gap-0 lg:gap-x-8 2xl:gap-x-20 items-stretch">
                <div class="xl:col-span-4 mb-6 xl:mb-0 col-span-full p-7 xl:p-14 bg-[#F7F7F7] rounded-[24px] xl:rounded-[48px] flex flex-col justify-between hover:shadow-2xl hover:bg-orange-50 transition ease-in-out">
                    <div class="mb-10">
                        <div class="text-2xl mb-2 flex items-center">{{ __('noot-pro-content-management::site.test_package_title') }}</div>
                        <div class="text-[#8C9399] font-light mb-[26px]">{{ __('noot-pro-content-management::site.test_package_text') }}</div>
                        <div class="mb-10 pb-10 border-b border-[#E8E8E8]">
                            <div class="flex items-end font-bold text-5xl pb-6">@if(app()->getLocale() == 'ar') 0<img src="{{ asset('images/site/Saudi_Riyal_Symbol.svg') }}" class="mb-2 mx-2" width="34px" alt=""> @else <img src="{{ asset('images/site/Saudi_Riyal_Symbol.svg') }}" class="mb-2 mx-2" width="34px" alt="">0 @endif<span class="ms-2 text-[#585757] font-light text-xl"></span>
                            </div>
                        </div>
                        <div class="text-[#969696] mb-4 text-xl">{{ __('noot-pro-content-management::site.package_details') }}:</div>
                        <ul class="text-xl font-light">
                            <li class="mb-6 ps-8 bg-circle-check-black bg-no-repeat {{ $bg_align }}">10 {{ __('noot-pro-content-management::site.employee') }}</li>
                            <li class="mb-6 ps-8 bg-circle-check-black bg-no-repeat {{ $bg_align }}">{{ __('noot-pro-content-management::site.customer_service') }}</li>

                            <li class="mb-6 ps-8 bg-circle-check-black bg-no-repeat {{ $bg_align }}">{{ __('noot-pro-content-management::site.accounting') }}</li>
                            <li class="mb-6 ps-8 bg-circle-check-black bg-no-repeat {{ $bg_align }}">{{ __('noot-pro-content-management::site.inventory_management') }}</li>
                            <li class="mb-6 ps-8 bg-circle-check-black bg-no-repeat {{ $bg_align }}">{{ __('noot-pro-content-management::site.customer_relationship_management') }}</li>
                            <li class="mb-6 ps-8 bg-circle-check-black bg-no-repeat {{ $bg_align }}">{{ __('noot-pro-content-management::site.point_of_sale_management') }} 1</li>
                        </ul>
                    </div>
                    <div>
                        <a href="{{ url(filament()->getRegistrationUrl()) }}" class="block text-center text-[#1C1C1C]  px-6 py-3.5 w-full border-2 rounded-[14px] border-[#E8E8E8] bg-[#E8E8E8] hover:bg-[#969696] hover:border-[#969696] hover:text-white transition ease-in-out">{{ __('noot-pro-content-management::site.try_it_free') }}</a>
                    </div>
                </div>
                <div class="xl:col-span-4 mb-6 xl:mb-0 col-span-full p-7 xl:p-14 bg-[#F7F7F7] rounded-[24px] xl:rounded-[48px] flex flex-col justify-between hover:shadow-2xl hover:bg-orange-50 transition ease-in-out">
                    <div class="mb-10">
                        <div class="text-2xl mb-2 flex items-center">{{ __('noot-pro-content-management::site.main_package_title') }} <span class="bg-[#FFEEE5] ms-1.5 px-3 py-1 text-[#E86F44] text-xs border rounded-[10px] border-[#FFDECC]">{{ __('noot-pro-content-management::site.main_package_badge') }}</span></div>
                        <div class="text-[#8C9399] font-light mb-[26px]">{{ __('noot-pro-content-management::site.main_package_text') }}</div>
                        <div class="mb-10 pb-10 border-b border-[#E8E8E8]">
                            <div class="flex items-end font-bold text-5xl">@if(app()->getLocale() == 'ar') 2000<img src="{{ asset('images/site/Saudi_Riyal_Symbol.svg') }}" class="mb-2 mx-2" width="34px" alt=""> @else <img src="{{ asset('images/site/Saudi_Riyal_Symbol.svg') }}" class="mb-2 mx-2" width="34px" alt="">2000 @endif<span class="plan-monthly ms-2 text-[#585757] font-light text-xl"> / {{ __('noot-pro-content-management::site.yearly') }}</span></div>
                            <span class="text-sm text-[#8C9399] font-light">{{ __('noot-pro-content-management::site.package_tax') }}</span>
                        </div>
                        <div class="text-[#969696] mb-4 text-xl">{{ __('noot-pro-content-management::site.package_details') }}:</div>
                        <ul class="text-xl font-light">
                            <li class="mb-6 ps-8 bg-circle-check-orange bg-no-repeat {{ $bg_align }}">10 {{ __('noot-pro-content-management::site.employee') }}</li>
                            <li class="mb-6 ps-8 bg-circle-check-orange bg-no-repeat {{ $bg_align }}">{{ __('noot-pro-content-management::site.sales_management') }}</li>
                            <li class="mb-6 ps-8 bg-circle-check-orange bg-no-repeat {{ $bg_align }}">{{ __('noot-pro-content-management::site.customer_service') }}</li>

                            <li class="mb-6 ps-8 bg-circle-check-orange bg-no-repeat {{ $bg_align }}">{{ __('noot-pro-content-management::site.accounting') }}</li>
                            <li class="mb-6 ps-8 bg-circle-check-orange bg-no-repeat {{ $bg_align }}">{{ __('noot-pro-content-management::site.inventory_management') }}</li>
                            <li class="mb-6 ps-8 bg-circle-check-orange bg-no-repeat {{ $bg_align }}">{{ __('noot-pro-content-management::site.customer_relationship_management') }}</li>
                            <li class="mb-6 ps-8 bg-circle-check-orange bg-no-repeat {{ $bg_align }}">{{ __('noot-pro-content-management::site.point_of_sale_management') }} 1</li>
                        </ul>
                    </div>
                    <div>
                        <a href="{{ url(filament()->getRegistrationUrl()) }}" class="block text-center px-6 py-3.5 w-full border-2 rounded-[14px] border-[#E86F44] bg-[#E86F44] hover:bg-[#EEAB43] hover:border-[#EEAB43] text-white transition ease-in-out">{{ __('noot-pro-content-management::site.get_the_package') }}</a>
                    </div>
                </div>
                <div class="xl:col-span-4 mb-6 xl:mb-0 col-span-full p-7 xl:p-14 bg-[#F7F7F7] rounded-[24px] xl:rounded-[48px] flex flex-col justify-between hover:shadow-2xl hover:bg-orange-50 transition ease-in-out">
                    <div class="mb-10">
                        <div class="text-2xl mb-2 flex items-center">{{ __('noot-pro-content-management::site.advanced_package_title') }}</div>
                        <div class="text-[#8C9399] font-light mb-[26px]">{{ __('noot-pro-content-management::site.advanced_package_text') }}</div>
                        <div class="mb-10 pb-10 border-b border-[#E8E8E8]">
                            <div class="flex items-end font-bold text-5xl">@if(app()->getLocale() == 'ar') 3588<img src="{{ asset('images/site/Saudi_Riyal_Symbol.svg') }}" class="mb-2 mx-2" width="34px" alt=""> @else <img src="{{ asset('images/site/Saudi_Riyal_Symbol.svg') }}" class="mb-2 mx-2" width="34px" alt="">3588 @endif <span class="plan-monthly ms-2 text-[#585757] font-light text-xl"> / {{ __('noot-pro-content-management::site.yearly') }}</span></div>
                            <span class="text-sm text-[#8C9399] font-light">{{ __('noot-pro-content-management::site.package_tax') }}</span>
                        </div>
                        <div class="text-[#969696] mb-4 text-xl">{{ __('noot-pro-content-management::site.package_details') }}:</div>
                        <ul class="text-xl font-light">
                            <li class="mb-6 ps-8 bg-circle-check-black bg-no-repeat {{ $bg_align }}">25 {{ __('noot-pro-content-management::site.employee') }}</li>
                            <li class="mb-6 ps-8 bg-circle-check-black bg-no-repeat {{ $bg_align }}">{{ __('noot-pro-content-management::site.all_main_features') }}</li>
                            <li class="mb-6 ps-8 bg-circle-check-black bg-no-repeat {{ $bg_align }}">{{ __('noot-pro-content-management::site.reports_and_analysis') }}</li>
                            <li class="mb-6 ps-8 bg-circle-check-black bg-no-repeat {{ $bg_align }}">{{ __('noot-pro-content-management::site.integration_with_other_tools') }}</li>

                            <li class="mb-6 ps-8 bg-circle-check-black bg-no-repeat {{ $bg_align }}">{{ __('noot-pro-content-management::site.accounting') }}</li>
                            <li class="mb-6 ps-8 bg-circle-check-black bg-no-repeat {{ $bg_align }}">{{ __('noot-pro-content-management::site.customer_relationship_management') }}</li>
                            <li class="mb-6 ps-8 bg-circle-check-black bg-no-repeat {{ $bg_align }}">{{ __('noot-pro-content-management::site.point_of_sale_management') }} 3</li>
                        </ul>
                    </div>
                    <div>
                        <a href="{{ url(filament()->getRegistrationUrl()) }}" class="block text-center text-[#1C1C1C]  px-6 py-3.5 w-full border-2 rounded-[14px] border-[#E8E8E8] bg-[#E8E8E8] hover:bg-[#969696] hover:border-[#969696] hover:text-white transition ease-in-out">{{ __('noot-pro-content-management::site.get_the_package') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @push('styles')
        @if(app()->getLocale() !== 'ar')
            <style>
                .plan-monthly{
                    font-size: 16px !important;
                }
            </style>
        @endif
    @endpush

</div>
