<div class="mt-8 lg:mt-12 container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl pb-16">
    <x-slot name="header">
        <span class="capitalize">{{ $post->title }}</span>
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="flex items-center">
            <a href="{{ route('posts') }}" class="text-gray-500 hover:text-[#E86F44] transition-colors">{{ __('noot-pro-content-management::site.posts') }}</a>
            @svg('heroicon-s-arrow-small-right','fill-current text-gray-400 w-4 h-4 mx-3 rtl:rotate-180')
        </li>
        <li class="flex items-center text-gray-800 font-medium line-clamp-1">
            {{ $post->title }}
        </li>
    </x-slot>

    <article class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 mb-16 transition-shadow hover:shadow-md">
        @if($post->image() !== null)
            <div class="relative w-full h-[400px] lg:h-[500px] overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-black/10 z-10 transition-opacity duration-500 group-hover:via-black/50"></div>
                <img alt="{{ $post->title }}" src="{{ $post->image() }}" class="absolute inset-0 w-full h-full object-cover z-0 transform hover:scale-105 transition-transform duration-700 ease-out"/>
                
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

        <div class="p-8 lg:p-12 @if($post->image() !== null) pt-10 @endif relative">
            <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-[#E86F44]/20 via-transparent to-transparent"></div>
            <div class="flex flex-col md:flex-row justify-between gap-8 pb-10 mb-10 border-b border-gray-100 relative z-10">
                @if($post->description)
                    <div class="flex-1 md:ltr:pl-6 md:rtl:pr-6 md:border-l-[3px] md:rtl:border-r-[3px] rtl:border-l-0 border-[#E86F44]">
                        <p class="text-gray-500 text-xl md:text-2xl leading-relaxed font-light italic text-balance">
                            {{ $post->description }}
                        </p>
                    </div>
                @endif
            </div>

            <div class="prose prose-lg md:prose-xl max-w-none relative z-10
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
                    <span class="text-sm font-bold uppercase tracking-widest text-gray-400">{{ __('noot-pro-content-management::site.tags') }}:</span>
                    <div class="flex flex-wrap gap-2">
                        @foreach($post->tags->where('type','tag') as $tag)
                            @include($themePath.'.partial.tag')
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </article>

    @if($related->isNotEmpty())
        <div class="mt-20 mb-12">
            <div class="flex items-center justify-between mb-10">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 flex items-center gap-4">
                    <span class="w-8 h-1.5 bg-[#E86F44] rounded-full inline-block"></span>
                    {{ __('noot-pro-content-management::site.related_posts') }}
                </h2>
                <a href="{{ route('posts') }}" class="hidden sm:inline-flex items-center text-[#E86F44] hover:text-[#EEAB43] font-bold transition-colors group">
                    {{ __('noot-pro-content-management::site.view_all') }}
                    <span class="ltr:ml-2 rtl:mr-2 transform transition-transform duration-300 group-hover:ltr:translate-x-1 group-hover:rtl:-translate-x-1">
                        @svg('heroicon-m-arrow-right', 'w-5 h-5 rtl:rotate-180')
                    </span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($related as $post)
                    @include($themePath.'.partial.related', ['post' => $post])
                @endforeach
            </div>
        </div>
    @endif
</div>
