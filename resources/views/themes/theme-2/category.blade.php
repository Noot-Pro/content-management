<div class="mt-8 container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl lg:py-8 lg:mb-12">
    <div class="flex items-center mb-12">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white flex items-center gap-4">
            <span class="w-10 h-1.5 bg-[#E86F44] rounded-full inline-block"></span>
            {{ $category->name ?? __('Category') }}
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
        <div class="flex flex-col items-center justify-center py-20 px-4 text-center bg-gray-50/50 dark:bg-gray-800/20 rounded-[2.5rem] border border-gray-100 dark:border-gray-700/50 border-dashed">
            <div class="w-24 h-24 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center mb-6 shadow-sm border border-gray-100 dark:border-gray-700/50">
                @svg('heroicon-o-document-text', 'w-10 h-10 text-gray-400')
            </div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ __('No posts found') }}</h2>
            <p class="text-gray-500 dark:text-gray-400 max-w-md mx-auto">{{ __('There are currently no posts available in this category. Please check back later.') }}</p>
        </div>
    @endunless
</div>
