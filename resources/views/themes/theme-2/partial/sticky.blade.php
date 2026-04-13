<article class="group relative flex flex-col bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-1 @if($loop->first) md:col-span-2 @endif border border-gray-100/50">
    <a href="{{ route('post',$post->slug) }}" class="block w-full relative h-[24rem] md:h-[28rem] lg:h-[32rem] overflow-hidden">
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-500 z-10 pointer-events-none"></div>

        @if($post->image() !== null)
            <img alt="{{ $post->title }}" src="{{ $post->image() }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110 z-0"/>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-[var(--primary-color)]/20 to-[var(--primary-color)]/10 z-0"></div>
        @endif

        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/95 via-gray-900/40 to-transparent z-[5]"></div>

        <div class="absolute bottom-0 left-0 right-0 p-8 md:p-10 lg:p-12 z-20 transform transition-transform duration-500 translate-y-2 group-hover:translate-y-0">
            <div class="flex items-center gap-2 mb-4">
                <span class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-white/90 bg-white/20 backdrop-blur-md px-4 py-2 rounded-full border border-white/20">
                    @svg('heroicon-o-calendar', 'w-4 h-4 ltr:mr-2 rtl:ml-2')
                    {{ optional($post->published_at)->diffForHumans() ?? '' }}
                </span>
            </div>
            <h3 class="@if($loop->first) text-4xl lg:text-5xl @else text-3xl lg:text-4xl @endif font-extrabold text-white leading-tight group-hover:text-amber-200 transition-colors duration-300 line-clamp-2 md:line-clamp-3 drop-shadow-sm">
                {{ $post->title ?? '' }}
            </h3>
        </div>
    </a>
</article>
