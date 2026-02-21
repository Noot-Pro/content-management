@unless($recent->isEmpty())
    <div class="my-4 bg-white shadow-md p-4 rounded-4xl ltr:rounded-br-none rtl:rounded-bl-none">
        <h4 class="mb-4 text-xl font-bold text-gray-700">{{ __('Recent Post') }}</h4>
        <div class="space-y-3">
            @foreach($recent as $post)
                <a href="{{ route('post',$post->slug) }}" class="flex items-start space-x-3 rtl:space-x-reverse hover:text-(--primary-color) transition-colors group">
                    @if($post->image() !== null)
                        <img alt="{{ $post->title }}" src="{{ $post->image() }}" class="h-12 w-12 rounded object-cover shrink-0"/>
                    @else
                        <div class="h-12 w-12 rounded bg-gray-200 shrink-0 flex items-center justify-center">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    @endif
                    <div class="flex-1 text-sm text-gray-700 group-hover:text-(--primary-color)">{{ $post->title ?? '' }}</div>
                </a>
            @endforeach
        </div>
    </div>
@endunless
