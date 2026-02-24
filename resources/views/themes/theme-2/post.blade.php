<div class="mt-8 lg:mt-12 container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">
    <x-slot name="header">
        <span class="capitalize">{{ $post->title }}</span>
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="flex items-center">
            <a href="{{ route('posts') }}" class="text-gray-500 hover:text-primary-600 transition-colors">{{ __('noot-pro-content-management::site.posts') }}</a>
            @svg('heroicon-s-arrow-small-right','fill-current text-gray-400 w-4 h-4 mx-3 rtl:rotate-180')
        </li>
        <li class="flex items-center text-gray-800 font-medium line-clamp-1">
            {{ $post->title }}
        </li>
    </x-slot>

    <article class="bg-white rounded-[2.5rem] overflow-hidden shadow-xl shadow-gray-200/40 border border-gray-100 mb-12 lg:mb-20">
        @if($post->image() !== null)
            <div class="relative w-full h-[400px] lg:h-[500px] overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent z-10 transition-opacity duration-300"></div>
                <img alt="{{ $post->title }}" src="{{ $post->image() }}" class="absolute inset-0 w-full h-full object-cover z-0 hover:scale-105 transition-transform duration-700"/>
                
                <div class="absolute bottom-0 left-0 right-0 p-8 lg:p-12 z-20">
                    <div class="flex flex-wrap items-center gap-3 mb-4">
                        @unless ($post->tags->where('type','category')->isEmpty())
                            @each($themePath.'.partial.category', $post->tags->where('type','category'), 'category')
                        @endunless
                        <span class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-white/20 backdrop-blur-md text-white text-sm font-medium border border-white/10">
                            @svg('heroicon-o-clock', 'w-4 h-4')
                            {{ optional($post->published_at)->diffForHumans() ?? '' }}
                        </span>
                    </div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight">
                        {{ $post->title ?? '' }}
                    </h1>
                </div>
            </div>
        @else
            <div class="p-8 lg:p-12 pb-0 pt-10">
                <div class="flex flex-wrap items-center gap-3 mb-6">
                    @unless ($post->tags->where('type','category')->isEmpty())
                        @each($themePath.'.partial.category', $post->tags->where('type','category'), 'category')
                    @endunless
                    <span class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-gray-50 text-gray-600 text-sm font-medium border border-gray-100">
                        @svg('heroicon-o-clock', 'w-4 h-4')
                        {{ optional($post->published_at)->diffForHumans() ?? '' }}
                    </span>
                </div>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
                    {{ $post->title ?? '' }}
                </h1>
            </div>
        @endif

        <div class="p-8 lg:p-12 @if($post->image() !== null) pt-8 lg:pt-10 @endif">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-8 border-b border-gray-100 mb-8 lg:mb-10">
                @if($post->description)
                    <div class="flex-1 md:ltr:ml-8 md:rtl:mr-8 md:ltr:pl-8 md:rtl:pr-8 md:border-l rtl:border-r md:rtl:border-l-0 border-gray-100">
                        <p class="text-gray-600 text-base md:text-lg italic leading-relaxed font-light">
                            "{{ $post->description }}"
                        </p>
                    </div>
                @endif
            </div>

            <div class="prose prose-lg max-w-none 
                        prose-headings:font-bold prose-headings:text-gray-900 
                        prose-p:text-gray-600 prose-p:leading-relaxed
                        prose-a:text-primary-600 hover:prose-a:text-primary-500
                        prose-img:rounded-3xl prose-img:shadow-lg
                        prose-strong:text-gray-900
                        prose-blockquote:border-l-4 prose-blockquote:border-[#E86F44] prose-blockquote:bg-gray-50 prose-blockquote:px-6 prose-blockquote:py-4 prose-blockquote:rounded-r-2xl prose-blockquote:italic
                        prose-ul:list-disc prose-ul:pl-6 prose-li:text-gray-600">
                {!! $post->getContent() !!}
            </div>

            @if($post->tags->where('type','tag')->isNotEmpty())
                <div class="mt-12 pt-8 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center gap-4">
                    <span class="text-sm font-semibold uppercase tracking-wider text-gray-500">{{ __('noot-pro-content-management::site.tags') }}:</span>
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
        <div class="mb-12">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 flex items-center gap-3">
                    <span class="w-8 h-1 bg-[#E86F44] rounded-full inline-block"></span>
                    {{ __('noot-pro-content-management::site.related_posts') }}
                </h2>
                <a href="{{ route('posts') }}" class="hidden sm:inline-flex items-center text-[#E86F44] hover:text-[#EEAB43] font-semibold transition-colors group">
                    {{ __('noot-pro-content-management::site.view_all') }}
                    <span class="ltr:ml-2 rtl:mr-2 transform transition-transform group-hover:ltr:translate-x-1 group-hover:rtl:-translate-x-1">
                        @svg('heroicon-m-arrow-right', 'w-5 h-5 rtl:rotate-180')
                    </span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 lg:gap-8">
                @foreach($related as $post)
                    @include($themePath.'.partial.related')
                @endforeach
            </div>
        </div>
    @endif
</div>
