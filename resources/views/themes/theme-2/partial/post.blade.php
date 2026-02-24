<article class="group relative flex flex-col md:flex-row bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300">
    @if($post->image() !== null)
        <a href="{{ route('post',$post->slug) }}" class="relative block w-full md:w-1/3 shrink-0 overflow-hidden aspect-[16/10] md:aspect-auto">
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300 z-10 pointer-events-none"></div>
            <img alt="{{ $post->title }}" src="{{ $post->image() }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 z-0"/>
        </a>
    @endif

    <div class="p-5 md:p-6 lg:p-8 flex flex-col justify-between w-full relative">
        <div>
            <div class="flex items-center justify-between mb-3 lg:mb-4">
                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-gray-500">
                    @svg('heroicon-o-clock', 'w-4 h-4 text-gray-400')
                    {{ optional($post->published_at)->diffForHumans() ?? '' }}
                </span>
                <div class="flex flex-wrap gap-2">
                    @unless ($post->tags->where('type','category')->isEmpty())
                        @each($themePath.'.partial.category', $post->tags->where('type','category'), 'category')
                    @endunless
                </div>
            </div>

            <a href="{{ route('post',$post->slug) }}" class="block inline-block">
                <h3 class="text-xl md:text-2xl font-bold text-gray-900 leading-tight group-hover:text-[#E86F44] transition-colors duration-300 line-clamp-2">
                    {!! $post->title !!}
                </h3>
            </a>
            @if($post->description !== null)
                <p class="mt-3 text-gray-600 line-clamp-2 md:line-clamp-3 text-sm leading-relaxed">
                    {!! $post->description !!}
                </p>
            @endif
        </div>

        <div class="flex items-center justify-end mt-5 md:mt-6 pt-5 md:pt-6 border-t border-gray-100">
            <a href="{{ route('post',$post->slug) }}" class="inline-flex items-center text-sm font-semibold text-[#E86F44] hover:text-[#EEAB43] transition-colors duration-300">
                {{ __('noot-pro-content-management::site.read_more') }}
                <span class="ltr:ml-1.5 rtl:mr-1.5 transform transition-transform duration-300 group-hover:ltr:translate-x-1 group-hover:rtl:-translate-x-1">
                    @svg('heroicon-m-arrow-right', 'w-4 h-4 rtl:-scale-x-100')
                </span>
            </a>
        </div>
    </div>
</article>
