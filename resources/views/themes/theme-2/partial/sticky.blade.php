<article class="group relative flex flex-col bg-white rounded-[2.5rem] overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 @if($loop->first) md:col-span-2 @endif">
    <a href="{{ route('post',$post->slug) }}" class="block w-full relative h-[20rem] md:h-[24rem] lg:h-[28rem] overflow-hidden">
        <div class="absolute inset-0 bg-primary-600/0 group-hover:bg-[#E86F44]/10 transition-colors duration-300 z-10 pointer-events-none"></div>
        
        @if($post->image() !== null)
            <img alt="{{ $post->title }}" src="{{ $post->image() }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 z-0"/>
        @else
            <div class="absolute inset-0 bg-gray-100 z-0"></div>
        @endif
        
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent z-[5]"></div>
        
        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 lg:p-10 z-20">
            <div class="flex items-center gap-2 mb-3">
                <span class="inline-flex items-center text-xs font-medium text-white/90 bg-white/20 backdrop-blur-md px-3 py-1.5 rounded-xl border border-white/10">
                    @svg('heroicon-o-clock', 'w-3.5 h-3.5 mr-1.5 rtl:ml-1.5 rtl:mr-0')
                    {{ optional($post->published_at)->diffForHumans() ?? '' }}
                </span>
            </div>
            <h3 class="@if($loop->first) text-3xl lg:text-5xl @else text-2xl lg:text-3xl @endif font-bold text-white leading-tight group-hover:text-[#EEAB43] transition-colors line-clamp-2 md:line-clamp-3">
                {{ $post->title ?? '' }}
            </h3>
        </div>
    </a>
</article>
