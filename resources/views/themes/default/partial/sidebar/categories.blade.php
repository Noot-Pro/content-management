@unless($tags->isEmpty())
    <div class="mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/50 p-6">
            <h4 class="mb-5 text-lg font-bold text-gray-900 dark:text-white flex items-center gap-3">
                <span class="w-1.5 h-6 bg-[#E86F44] rounded-full inline-block"></span>
                {{ __('site.categories') }}
            </h4>
            <ul class="flex flex-col gap-2">
                @foreach($tags as $tag)
                    <li>
                        <a href="{{ route('tags',['category',$tag->slug]) }}"
                           class="group flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors border border-transparent hover:border-gray-100 dark:hover:border-gray-600">
                            <span class="font-medium text-sm text-gray-700 dark:text-gray-300 group-hover:text-[#E86F44] transition-colors">
                                {{ $tag->name }}
                            </span>
                            <div class="flex items-center text-gray-400 dark:text-gray-500 group-hover:text-[#E86F44] transition-colors gap-2">
                                <span class="bg-gray-100 dark:bg-gray-700/50 text-gray-600 dark:text-gray-400 text-xs px-2.5 py-1 rounded-lg group-hover:bg-[#E86F44]/10 group-hover:text-[#E86F44] transition-colors font-semibold">{{ $tag->posts_published_count }}</span>
                                @svg('heroicon-m-chevron-right', 'w-4 h-4 rtl:-scale-x-100')
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endunless
