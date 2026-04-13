<article class="group relative flex flex-col bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
    @if($post->image() !== null)
        <a href="{{ route('post',$post->slug) }}" class="relative block w-full overflow-hidden aspect-[16/9]">
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500 z-10 pointer-events-none"></div>
            <img alt="{{ $post->title }}" src="{{ $post->image() }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110 z-0"/>
        </a>
    @endif

    <div class="p-6 md:p-8 flex flex-col justify-between flex-grow relative bg-white z-20">
        <div>
            <div class="flex items-center justify-between mb-4">
                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    @svg('heroicon-o-clock', 'w-4 h-4')
                    {{ optional($post->published_at)->diffForHumans() ?? '' }}
                </span>
                <div class="flex flex-wrap gap-2">
                    @unless ($post->tags->where('type','category')->isEmpty())
                        @each($themePath.'.partial.category', $post->tags->where('type','category'), 'category')
                    @endunless
                </div>
            </div>

            <a href="{{ route('post',$post->slug) }}" class="block">
                <h3 class="text-xl md:text-2xl font-extrabold text-gray-900 leading-tight group-hover:text-[var(--primary-color)] transition-colors duration-300 line-clamp-2">
                    {!! $post->title !!}
                </h3>
            </a>
            @if($post->description !== null)
                <p class="mt-4 text-gray-500 line-clamp-3 text-sm md:text-base leading-relaxed">
                    {!! $post->description !!}
                </p>
            @endif
        </div>

        <div class="flex items-center justify-between mt-6 md:mt-8 pt-6 border-t border-gray-50">
            <a href="{{ route('post',$post->slug) }}" class="inline-flex items-center text-sm font-bold text-[var(--primary-color)] hover:opacity-80 transition-colors duration-300">
                {{ __('noot-pro-content-management::site.read_more') }}
                <span class="ltr:ml-2 rtl:mr-2 transform transition-transform duration-300 group-hover:ltr:translate-x-1 group-hover:rtl:-translate-x-1">
                    @svg('heroicon-m-arrow-right', 'w-4 h-4 rtl:-scale-x-100')
                </span>
            </a>
        </div>
    </div>
</article>
