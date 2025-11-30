<div class="mt-6 container mx-auto px-2 md:px-4">
    <x-slot name="header">
        <span class="capitalize">{{ $post->title }}</span>
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="flex items-center">
            <a href="{{ route('posts') }}">{{ __('Posts') }}</a>
            @svg('heroicon-s-arrow-small-right','fill-current w-4 h-4 mx-3 rtl:rotate-180')
        </li>
        <li class="flex items-center">
            {{ $post->title }}
        </li>
    </x-slot>

    <div class="bg-white rounded-[2rem] shadow-md overflow-hidden">
        @if($post->image() !== null)
            <img alt="{{ $post->title }}" src="{{ $post->image() }}" class="w-full h-full rounded-t-[2rem] object-cover"/>
        @endif

        <div class="px-6 md:px-10 py-6">
            <div class="flex items-center justify-between mb-4">
                <span class="font-light text-gray-600">{{ optional($post->published_at)->diffForHumans() ?? '' }}</span>
                <div>
                    @unless ($post->tags->isEmpty())
                        @each($themePath.'.partial.category', $post->tags->where('type','category'), 'category')
                    @endunless
                </div>
            </div>

            <div class="flex flex-col items-start justify-start gap-4">
                <div>
                    <a href="#" class="text-2xl font-bold text-gray-700 hover:underline">
                        {{ $post->title ?? '' }}
                    </a>
                    <p class="mt-2 text-gray-600">
                        {{ $post->description ?? '' }}
                    </p>
                    <div>
                        @unless ($post->tags->isEmpty())
                            @foreach($post->tags->where('type','tag') as $tag)
                                @include($themePath.'.partial.tag')
                            @endforeach
                        @endunless
                    </div>
                </div>
{{--                <a href="#" class="flex items-center gap-2">--}}
{{--                    <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl($post->author) }}" alt="avatar" class="object-cover w-10 h-10 rounded-full sm:block">--}}
{{--                    <h1 class="font-bold text-gray-700 hover:underline">{{ $post->author->name ?? '' }}</h1>--}}
{{--                </a>--}}
            </div>

            <div class="mt-6 lg:mt-12 prose max-w-none">
                {!! $post->getContent() !!}
            </div>
        </div>
    </div>

    @if($related->isNotEmpty())
        <div class="py-6 flex flex-col mt-4 gap-4">
            <h1 class="text-xl font-bold text-gray-700 md:text-2xl">{{ __('Related Posts') }}</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($related as $post)
                    @include($themePath.'.partial.related')
                @endforeach
            </div>
        </div>
    @endif
</div>
