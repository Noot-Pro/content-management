<div class="mt-8 container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
    @unless($stickies->isEmpty())
        <section class="mb-12 grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
            @foreach($stickies as $post)
                @include($themePath.'.partial.sticky')
            @endforeach
        </section>
    @endunless

    <main class="flex flex-col lg:flex-row justify-between gap-8 py-4 md:py-8 lg:mt-8">
        <section class="w-full lg:w-3/4">
            @if(request()->filled('search'))
                <div class="py-4 mb-8 font-semibold text-gray-700 bg-white rounded-2xl px-6 border border-gray-100 shadow-sm flex items-center justify-between">
                    <div>
                        {{ __('noot-pro-content-management::site.showing_search_result_of') }}: <span class="highlight text-[#E86F44]">{{ request('search') }}</span>
                    </div>
                    <a title="{{ __('noot-pro-content-management::site.clear') }}" href="{{ route('posts') }}" class="inline-flex items-center justify-center p-1.5 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors">
                        @svg('heroicon-o-x-mark','text-gray-500 w-5 h-5')
                    </a>
                </div>
            @endif

            @unless ($posts->isEmpty())
                <div class="flex items-center mb-8">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 flex items-center gap-3">
                        <span class="w-8 h-1 bg-[#E86F44] rounded-full inline-block"></span>
                        {{ __('noot-pro-content-management::site.posts') }}
                    </h1>
                </div>
                
                <div class="space-y-8">
                    @each($themePath.'.partial.post', $posts, 'post')
                </div>
                
                <div class="mt-12 pagination custom-pagination w-full flex justify-center">
                    {{ $posts->links() }}
                </div>
            @else
                @include($themePath.'.partial.empty')
            @endunless
        </section>
        
        <aside class="w-full lg:w-1/4">
            <div class="sticky top-8 space-y-8">
                @include($themePath.'.partial.sidebar')
            </div>
        </aside>
    </main>
</div>
