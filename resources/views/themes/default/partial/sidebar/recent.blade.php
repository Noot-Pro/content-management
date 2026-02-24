@unless($recent->isEmpty())
    <div class="mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/50 p-6">
            <h4 class="mb-5 text-lg font-bold text-gray-900 dark:text-white flex items-center gap-3">
                <span class="w-1.5 h-6 bg-[#E86F44] rounded-full inline-block"></span>
                {{ __('Recent Post') }}
            </h4>
            <div class="flex flex-col gap-4">
                @foreach($recent as $post)
                    <a href="{{ route('post',$post->slug) }}" class="group flex items-center gap-4 p-2 -mx-2 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        @if($post->image() !== null)
                            <img alt="{{ $post->title }}" src="{{ $post->image() }}" class="h-16 w-16 shrink-0 rounded-lg object-cover shadow-sm group-hover:opacity-90 transition-opacity border border-gray-100 dark:border-gray-700"/>
                        @endif
                        <div class="flex-1">
                            <h5 class="font-semibold text-sm text-gray-800 dark:text-gray-200 group-hover:text-[#E86F44] transition-colors line-clamp-2 leading-snug">{{ $post->title ?? '' }}</h5>
                            <span class="text-xs text-gray-500 dark:text-gray-400 mt-1.5 block flex items-center gap-1">
                                @svg('heroicon-o-clock', 'w-3.5 h-3.5')
                                {{ optional($post->published_at)->diffForHumans() ?? '' }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endunless
