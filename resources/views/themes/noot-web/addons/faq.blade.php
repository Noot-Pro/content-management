<div>
    @if(!$faqs->isEmpty())
        <x-slot name="header">
            <h1 class="text-2xl font-bold text-gray-900">{{ __('FAQs') }}</h1>
        </x-slot>

        <x-slot name="breadcrumbs">
            <li class="flex items-center">
                {{ __('FAQs') }}
            </li>
        </x-slot>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-extrabold tracking-tight sm:text-4xl text-gray-900 flex justify-center items-center gap-4">
                        <span class="w-10 h-1.5 bg-[#E86F44] rounded-full inline-block"></span>
                        {{ __('frequently asked questions') }}
                    </h2>
                </div>
                
                <div class="space-y-4">
                    @foreach($faqs as $faq)
                        <div x-data="{ open: false }" class="bg-white border hover:border-gray-200 border-gray-100 rounded-3xl shadow-sm transition-all duration-300 overflow-hidden group">
                            <button @click="open = !open" type="button" class="flex flex-row items-center justify-between w-full px-6 py-5 md:py-6 text-lg font-bold text-left text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#E86F44] focus:ring-inset focus:border-transparent transition-colors bg-white">
                                <span class="group-hover:text-[#E86F44] transition-colors pr-6">{{ $faq->question }}</span>
                                <span class="bg-gray-50 group-hover:bg-[#E86F44]/10 rounded-full p-2 flex-shrink-0 transition-colors">
                                    <svg class="w-5 h-5 text-gray-500 group-hover:text-[#E86F44] transform transition-transform duration-300" :class="{'rotate-180': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </button>
                            <div x-show="open" 
                                 x-collapse
                                 x-cloak
                                 style="display: none;"
                                 class="px-6 pb-6 text-gray-600 prose prose-orange max-w-none text-base border-t border-gray-50 mt-2 pt-6">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
