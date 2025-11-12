<article class="mt-6 bg-gray-50">
    <div class="px-6 pb-6 mx-auto rounded">
        <aside class="mt-2">
            <a href="{{ route('post',$post->slug) }}" class="text-xl md:text-3xl font-bold text-gray-700 hover:underline">
                {!! $post->title !!}
            </a>
            @if($post->description !== null)
                <p class="mt-2 text-gray-600">
                    {!! $post->description !!}
                </p>
            @endif
        </aside>
        <div class="flex items-center justify-between">
            <span class="font-light text-sm text-gray-600 mt-2">{{ optional($post->published_at)->diffForHumans() ?? '' }}</span>
            <div>
                @unless ($post->tags->isEmpty())
                    @each($themePath.'.partial.category', $post->tags->where('type','category'), 'category')
                @endunless
            </div>
        </div>
        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('post',$post->slug) }}" class="text-[var(--primary-color)] hover:underline">{{ __("Read more") }}</a>
{{--            <div>--}}
{{--                <a class="flex items-center gap-2">--}}
{{--                    <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl($post->author) }}" alt="avatar" class="hidden object-cover w-8 h-8 rounded-full sm:block">--}}
{{--                    <p class="text-gray-700 hover:underline">{{ $post->author->name ?? '' }}</p>--}}
{{--                </a>--}}
{{--            </div>--}}
        </div>
    </div>
</article>
