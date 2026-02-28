<div class="mt-8 lg:mt-12 container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl pb-16">
    <x-slot name="header">
        <span class="capitalize">{{ $post->title }}</span>
    </x-slot>

    <x-slot name="breadcrumbs">
        @if($post->parent !== null)
            <li class="flex items-center">
                <a href="{{ route('page',[$post->parent->slug]) }}" class="text-gray-500 hover:text-[#E86F44] transition-colors capitalize" aria-current="page">{{ $post->parent->title }}</a>
                @svg('heroicon-s-arrow-small-right','fill-current text-gray-400 w-4 h-4 mx-3 rtl:rotate-180')
            </li>
        @endif
        <li class="flex items-center text-gray-800 font-medium line-clamp-1">
            {{ $post->title }}
        </li>
    </x-slot>

    <article class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 mb-16 transition-shadow hover:shadow-md">
        @if($post->image('pages') !== null)
            <div class="relative w-full h-[400px] lg:h-[500px] overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-black/10 z-10 transition-opacity duration-500 group-hover:via-black/50"></div>
                <img alt="{{ $post->title }}" src="{{ $post->image('pages') }}" class="absolute inset-0 w-full h-full object-cover z-0 transform hover:scale-105 transition-transform duration-700 ease-out"/>
                
                <div class="absolute bottom-0 left-0 right-0 p-8 lg:p-12 z-20 transform transition-transform duration-500 translate-y-2 group-hover:translate-y-0">
                    <div class="flex flex-wrap items-center gap-3 mb-6">
                        @unless ($post->tags->where('type','category')->isEmpty())
                            @each($themePath.'.partial.category', $post->tags->where('type','category'), 'category')
                        @endunless
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-black/30 backdrop-blur-md text-white/90 text-sm font-medium border border-white/20 hover:bg-black/40 transition-colors">
                            @svg('heroicon-o-calendar', 'w-4 h-4')
                            {{ optional($post->published_at)->isoFormat('LL') ?? '' }}
                        </span>
                    </div>
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight tracking-tight drop-shadow-sm">
                        {{ $post->title ?? '' }}
                    </h1>
                </div>
            </div>
        @else
            <div class="p-8 lg:p-12 pb-0 pt-12 relative overflow-hidden">
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-[#E86F44] rounded-full mix-blend-multiply filter blur-3xl opacity-5"></div>
                <div class="flex flex-wrap items-center gap-3 mb-8 relative z-10">
                    @unless ($post->tags->where('type','category')->isEmpty())
                        @each($themePath.'.partial.category', $post->tags->where('type','category'), 'category')
                    @endunless
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gray-50 text-gray-500 text-sm font-medium border border-gray-100 hover:bg-gray-100 transition-colors">
                        @svg('heroicon-o-calendar', 'w-4 h-4')
                        {{ optional($post->published_at)->isoFormat('LL') ?? '' }}
                    </span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight tracking-tight relative z-10">
                    {{ $post->title ?? '' }}
                </h1>
            </div>
        @endif

        <div class="p-8 lg:p-12 @if($post->image('pages') !== null) pt-10 @endif relative">
            <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-[#E86F44]/20 via-transparent to-transparent"></div>
            
            @if($post->description)
                <div class="flex flex-col md:flex-row justify-between gap-8 pb-10 mb-10 border-b border-gray-100 relative z-10">
                    <div class="flex-1 md:ltr:pl-6 md:rtl:pr-6 md:border-l-[3px] md:rtl:border-r-[3px] rtl:border-l-0 border-[#E86F44]">
                        <p class="text-gray-500 text-xl md:text-2xl leading-relaxed font-light italic text-balance">
                            {{ $post->description }}
                        </p>
                    </div>
                </div>
            @endif

            <div class="prose prose-lg md:prose-xl max-w-none relative z-10
                        prose-headings:font-extrabold prose-headings:text-gray-900 prose-headings:tracking-tight
                        prose-p:text-gray-600 prose-p:leading-loose
                        prose-a:text-[#E86F44] prose-a:font-semibold hover:prose-a:text-[#EEAB43] prose-a:decoration-[#E86F44]/30 hover:prose-a:decoration-[#EEAB43] transition-colors
                        prose-img:rounded-2xl prose-img:shadow-md prose-img:border prose-img:border-gray-100
                        prose-strong:text-gray-900 prose-strong:font-bold
                        prose-blockquote:border-l-4 prose-blockquote:border-[#E86F44] prose-blockquote:bg-[#E86F44]/5 prose-blockquote:px-8 prose-blockquote:py-6 prose-blockquote:rounded-r-2xl prose-blockquote:italic prose-blockquote:text-gray-700
                        prose-ul:list-disc prose-ul:pl-6 prose-li:text-gray-600 prose-li:marker:text-[#E86F44]">
                {!! $post->getContent() !!}
            </div>

            @if($post->tags->where('type','tag')->isNotEmpty())
                <div class="mt-16 pt-8 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center gap-6 relative z-10">
                    <span class="text-sm font-bold uppercase tracking-widest text-gray-400">{{ __('noot-pro-content-management::site.tags') }}:</span>
                    <div class="flex flex-wrap gap-2">
                        @foreach($post->tags->where('type','tag') as $tag)
                            @include($themePath.'.partial.tag')
                        @endforeach
                    </div>
                </div>
            @endif
            
            {{-- Children Pages can be restored here if needed in the future --}}
        </div>
    </article>
</div>
