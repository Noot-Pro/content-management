<div class="mt-8 container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl lg:py-8 lg:mb-12">
    <div class="flex items-center mb-12">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 flex items-center gap-4">
            <span class="w-10 h-1.5 bg-[var(--primary-color)] rounded-full inline-block"></span>
            {{ $category->name ?? __('noot-pro-content-management::site.category') }}
        </h1>
    </div>

    @unless($posts->isEmpty())
        <div class="mb-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @foreach($posts as $post)
                @include($themePath.'.partial.sticky')
            @endforeach
        </div>
        <div class="mt-12 pagination custom-pagination w-full flex justify-center">
            {{ $posts->links() }}
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-20 px-4 text-center bg-gray-50/50 rounded-[2.5rem] border border-gray-100 border-dashed">
            <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mb-6 shadow-sm border border-gray-100">
                @svg('heroicon-o-document-text', 'w-10 h-10 text-gray-400')
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ __('noot-pro-content-management::site.no_posts_found') }}</h2>
            <p class="text-gray-500 max-w-md mx-auto">{{ __('noot-pro-content-management::site.no_posts_available') }}</p>
        </div>
    @endunless
</div>
