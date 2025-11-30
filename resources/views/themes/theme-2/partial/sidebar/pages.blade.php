@unless($pages->isEmpty())
    <div class="my-4 bg-white shadow-md p-4 rounded-[2rem] ltr:rounded-br-none rtl:rounded-bl-none">
        <h4 class="mb-4 text-xl font-bold text-gray-700">{{ __('Pages') }}</h4>
        <ul class="space-y-2">
            @foreach($pages as $post)
                <li>
                    <a href="{{ route('page',$post->slug) }}" class="text-gray-600 hover:text-[var(--primary-color)] transition-colors">
                        {!! $post->title !!}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endunless
