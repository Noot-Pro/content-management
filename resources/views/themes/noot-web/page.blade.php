<div class="mt-8 lg:mt-12 container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl pb-20">
    <x-slot name="header">
        <span class="capitalize">{{ $post->title }}</span>
    </x-slot>

    <x-slot name="breadcrumbs">
        @if($post->parent !== null)
            <li class="flex items-center">
                <a href="{{ route('page',[$post->parent->slug]) }}" class="text-gray-500 hover:text-[#E86F44] transition-colors capitalize text-sm font-medium" aria-current="page">{{ $post->parent->title }}</a>
                @svg('heroicon-s-arrow-small-right','fill-current text-gray-300 w-4 h-4 mx-3 rtl:rotate-180')
            </li>
        @endif
        <li class="flex items-center text-gray-800 font-semibold text-sm line-clamp-1">
            {{ $post->title }}
        </li>
    </x-slot>

    <article class="bg-white rounded-[2rem] overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100/80 mb-16 transition-all duration-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)]">
        @if($post->image('pages') !== null)
            <div class="relative w-full h-[350px] sm:h-[450px] lg:h-[500px] overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/95 via-gray-900/40 to-black/10 z-10 transition-opacity duration-500 group-hover:via-gray-900/50"></div>
                <img alt="{{ $post->title }}" src="{{ $post->image('pages') }}" class="absolute inset-0 w-full h-full object-cover z-0 transform hover:scale-105 transition-transform duration-700 ease-out"/>
                
                <div class="absolute bottom-0 left-0 right-0 p-8 sm:p-10 lg:p-14 z-20 transform transition-transform duration-500 translate-y-2 group-hover:translate-y-0">
                    <div class="flex flex-wrap items-center gap-3 mb-5">
                        @unless ($post->tags->where('type','category')->isEmpty())
                            @each($themePath.'.partial.category', $post->tags->where('type','category'), 'category')
                        @endunless
                        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/20 backdrop-blur-md text-white/95 text-xs font-bold uppercase tracking-widest border border-white/20 hover:bg-white/30 transition-colors">
                            @svg('heroicon-o-calendar', 'w-4 h-4')
                            {{ optional($post->published_at)->isoFormat('LL') ?? '' }}
                        </span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight tracking-tight drop-shadow-md">
                        {{ $post->title ?? '' }}
                    </h1>
                </div>
            </div>
        @else
            <div class="px-8 sm:px-10 lg:px-14 pb-0 pt-14 lg:pt-16 relative overflow-hidden bg-gray-50/30">
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-72 h-72 bg-[#E86F44] rounded-full mix-blend-multiply filter blur-[80px] opacity-10"></div>
                <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-72 h-72 bg-[#EEAB43] rounded-full mix-blend-multiply filter blur-[80px] opacity-10"></div>
                
                <div class="flex flex-wrap items-center gap-3 mb-6 relative z-10">
                    @unless ($post->tags->where('type','category')->isEmpty())
                        @each($themePath.'.partial.category', $post->tags->where('type','category'), 'category')
                    @endunless
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white text-gray-500 text-xs font-bold uppercase tracking-widest border border-gray-200/60 shadow-sm hover:shadow transition-shadow">
                        @svg('heroicon-o-calendar', 'w-4 h-4 text-[#E86F44]')
                        {{ optional($post->published_at)->isoFormat('LL') ?? '' }}
                    </span>
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-[1.1] tracking-tight relative z-10 text-balance">
                    {{ $post->title ?? '' }}
                </h1>
                
                <div class="flex items-center gap-2 mt-8 mb-4 relative z-10">
                    <div class="w-12 h-1.5 bg-[#E86F44] rounded-full"></div>
                    <div class="w-2 h-1.5 bg-[#EEAB43] rounded-full"></div>
                </div>
            </div>
        @endif

        <div class="p-8 sm:p-10 lg:p-14 relative bg-white">
            <div class="absolute inset-0 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:24px_24px] opacity-30 z-0"></div>
            
            @if($post->description)
                <div class="pb-10 mb-10 border-b border-gray-100 relative z-10">
                    <p class="text-gray-500 text-xl md:text-2xl leading-relaxed font-light text-balance rtl:border-r-4 ltr:border-l-4 rtl:pr-6 ltr:pl-6 border-[#E86F44] bg-gradient-to-l from-gray-50/50 to-transparent p-4 rounded-xl rounded-r-none rtl:rounded-l-none rtl:rounded-r-xl">
                        {{ $post->description }}
                    </p>
                </div>
            @endif

            <div class="prose prose-lg max-w-none relative z-10
                        prose-headings:font-extrabold prose-headings:text-gray-900 prose-headings:tracking-tight prose-headings:mb-6 prose-headings:mt-10
                        prose-p:text-gray-600 prose-p:leading-loose prose-p:mb-6 prose-p:text-[1.1rem]
                        prose-a:text-[#E86F44] prose-a:font-semibold hover:prose-a:text-[#EEAB43] prose-a:decoration-[#E86F44]/30 hover:prose-a:decoration-[#EEAB43] transition-colors
                        prose-img:rounded-3xl prose-img:shadow-xl prose-img:border prose-img:border-gray-100/50 prose-img:my-10
                        prose-strong:text-gray-900 prose-strong:font-bold
                        prose-blockquote:border-l-4 prose-blockquote:border-[#E86F44] prose-blockquote:bg-gray-50/80 prose-blockquote:px-8 prose-blockquote:py-6 prose-blockquote:rounded-3xl prose-blockquote:rounded-tl-none rtl:prose-blockquote:rounded-tr-none rtl:prose-blockquote:rounded-tl-3xl prose-blockquote:italic prose-blockquote:text-gray-700 prose-blockquote:my-8 prose-blockquote:shadow-sm
                        prose-ul:list-disc prose-ol:list-decimal rtl:prose-ul:pr-8 rtl:prose-ol:pr-8 ltr:prose-ul:pl-8 ltr:prose-ol:pl-8 prose-li:text-gray-600 prose-li:marker:text-[#E86F44] prose-li:mb-3 leading-loose text-[1.1rem]">
                {!! $post->getContent() !!}
            </div>

            @if($post->tags->where('type','tag')->isNotEmpty())
                <div class="mt-16 pt-8 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center gap-6 relative z-10">
                    <span class="text-xs font-bold uppercase tracking-widest text-gray-400 bg-gray-50 px-3 py-1 rounded-full">{{ __('noot-pro-content-management::site.tags') }}</span>
                    <div class="flex flex-wrap gap-2">
                        @foreach($post->tags->where('type','tag') as $tag)
                            @include($themePath.'.partial.tag')
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </article>
</div>
