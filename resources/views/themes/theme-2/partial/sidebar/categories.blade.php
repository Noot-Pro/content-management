@unless($tags->isEmpty())
    <div class="my-4 bg-white shadow-md p-4 rounded-[2rem] ltr:rounded-br-none rtl:rounded-bl-none">
        <h4 class="mb-4 text-xl font-bold text-gray-700">{{ __('noot-pro-content-management::site.categories') }}</h4>
        <ul class="space-y-2">
            @foreach($tags as $tag)
                <li class="py-2 border-b border-gray-100 last:border-b-0">
                    <a href="{{ route('tags',['category',$tag->slug]) }}" class="flex items-center justify-between text-gray-600 hover:text-[var(--primary-color)] transition-colors">
                        <span>{{ $tag->name }}</span>
                        <span class="text-gray-500 text-sm">{{ $tag->posts_published_count }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endunless
