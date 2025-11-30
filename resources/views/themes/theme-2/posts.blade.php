<div>
    @unless($stickies->isEmpty())
        <section class="mt-10 grid @if($stickies->count() > 1) grid-cols-3 @endif gap-4">
            @foreach($stickies as $post)
                @include($themePath.'.partial.sticky')
            @endforeach
        </section>
    @endunless

    <main class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-6 lg:gap-8">
            <section class="w-full lg:w-2/3">
                @if(request()->filled('search'))
                    <div class="mb-6 py-4">
                        {{ __('Showing Search result of') }}: <span class="highlight">{{ request('search') }}</span>
                        <a title="{{ __('clear') }}" href="{{ route('posts') }}" class="ml-2 text-[var(--primary-color)] hover:underline">
                            @svg('heroicon-o-backspace','w-4 h-4 inline-flex align-middle')
                        </a>
                    </div>
                @endif

                @unless ($posts->isEmpty())
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">{{ __('Posts') }}</h1>
                    <div>
                        @each($themePath.'.partial.post', $posts, 'post')
                    </div>
                @else
                    @include($themePath.'.partial.empty')
                @endunless
            </section>
            <aside class="w-full lg:w-1/3">
                @include($themePath.'.partial.sidebar')
            </aside>
        </div>
    </main>
</div>
