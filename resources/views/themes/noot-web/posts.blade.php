<div class="mt-8 container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl pb-16">
    @unless($stickies->isEmpty())
        <div class="mb-16">
            <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-3 mb-8">
                <span class="w-2 h-2 bg-[#E86F44] rounded-full inline-block"></span>
                {{ __('Featured Posts') }}
            </h2>
            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($stickies as $post)
                    @include($themePath.'.partial.sticky')
                @endforeach
            </section>
        </div>
    @endunless

    <main class="flex flex-col lg:flex-row justify-between gap-12">
        <section class="w-full lg:w-3/4">
            @if(request()->filled('search'))
                <div class="py-5 mb-10 font-medium text-gray-700 bg-white rounded-2xl px-6 border border-gray-100 shadow-sm flex items-center justify-between transition-shadow hover:shadow-md">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <span>{{ __('noot-pro-content-management::site.showing_search_result_of') }} <span class="font-bold text-[#E86F44] break-all">"{{ request('search') }}"</span></span>
                    </div>
                    <a title="{{ __('noot-pro-content-management::site.clear') }}" href="{{ route('posts') }}" class="inline-flex items-center justify-center p-2 rounded-full bg-gray-50 hover:bg-red-50 hover:text-red-500 text-gray-500 transition-colors focus:ring-2 focus:ring-gray-200">
                        @svg('heroicon-o-x-mark','w-5 h-5')
                    </a>
                </div>
            @endif

            @unless ($posts->isEmpty())
                <div class="flex items-center mb-10">
                    <h1 class="text-3xl font-extrabold text-gray-900 flex items-center gap-4">
                        <span class="w-10 h-1.5 bg-[#E86F44] rounded-full inline-block"></span>
                        {{ __('noot-pro-content-management::site.posts') }}
                    </h1>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @each($themePath.'.partial.post', $posts, 'post')
                </div>
                
                <div class="mt-16 bg-white border border-gray-100 rounded-2xl p-4 shadow-sm custom-pagination w-full flex justify-center">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="bg-white border border-gray-100 rounded-2xl p-10 shadow-sm flex flex-col items-center justify-center text-center">
                    <svg class="w-16 h-16 text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    @include($themePath.'.partial.empty')
                </div>
            @endunless
        </section>
        
        <aside class="w-full lg:w-1/4">
            <div class="sticky top-8 space-y-8 bg-gray-50/50 p-6 rounded-3xl border border-gray-100/50 hidden lg:block">
                @include($themePath.'.partial.sidebar')
            </div>
            
            <!-- Mobile sidebar version -->
            <div class="lg:hidden space-y-8 mt-12 bg-gray-50/50 p-6 rounded-3xl border border-gray-100/50">
                @include($themePath.'.partial.sidebar')
            </div>
        </aside>
    </main>
</div>
