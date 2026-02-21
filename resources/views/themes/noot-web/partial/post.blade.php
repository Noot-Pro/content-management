<article class="mb-6 bg-white shadow-md p-6 rounded-lg ltr:rounded-tr-4xl ltr:rounded-bl-4xl rtl:rounded-tl-4xl rtl:rounded-br-4xl">
    @unless ($post->tags->where('type','category')->isEmpty())
        <div class="flex items-start justify-between mb-4">
            <span class="font-light text-sm text-gray-600">{{ optional($post->published_at)->diffForHumans() ?? '' }}</span>
            <div>
                @foreach($post->tags->where('type','category') as $category)
                    <a href="{{ route('tags',[$category->type,$category->slug]) }}" class="inline-block px-4 py-2 bg-orange-500 text-white text-sm font-medium rounded-lg hover:bg-orange-600 transition-colors">
                        {{ $category->name ?? '' }}
                    </a>
                @endforeach
            </div>
        </div>
    @else
        <div class="mb-3">
            <span class="font-light text-sm text-gray-600">{{ optional($post->published_at)->diffForHumans() ?? '' }}</span>
        </div>
    @endunless
    <div class="mb-4">
        <a href="{{ route('post',$post->slug) }}" class="text-xl md:text-2xl font-bold text-gray-800 hover:text-(--primary-color) transition-colors">
            {!! $post->title !!}
        </a>
    </div>
    @if($post->description !== null)
        <p class="mb-4 text-gray-600 leading-relaxed">
            {!! $post->description !!}
        </p>
    @endif
    <div class="mt-4">
        <a href="{{ route('post',$post->slug) }}" class="text-(--primary-color) hover:underline font-medium">{{ __('noot-pro-content-management::site.read_more') }}</a>
    </div>
</article>
