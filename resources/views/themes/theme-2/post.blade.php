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

    @push('styles')
        <style>
            .prose a {
                color: #000000;
                font-weight: bold;
                text-decoration: underline;
            }
            .prose a:hover {
                opacity: 0.8;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const proseLinks = document.querySelectorAll('.prose a');
                proseLinks.forEach(function(link) {
                    let href = link.getAttribute('href');
                    if (href && !href.startsWith('#') && !href.startsWith('javascript:')) {
                        // Set target to open in new tab
                        link.setAttribute('target', '_blank');
                        link.setAttribute('rel', 'noopener noreferrer');
                        
                        // If it's already an absolute URL (http:// or https://), leave it as is
                        if (href.startsWith('http://') || href.startsWith('https://')) {
                            // Already correct
                        }
                        // If it starts with /, it's root-relative, leave it as is
                        else if (href.startsWith('/')) {
                            // Already correct
                        }
                        // If it looks like an external domain (contains . but no / at start)
                        else if (href.includes('.') && !href.startsWith('.')) {
                            // Add https:// if no protocol
                            if (!href.startsWith('http://') && !href.startsWith('https://')) {
                                link.setAttribute('href', 'https://' + href);
                            }
                        }
                        // For relative URLs, ensure they navigate correctly
                        link.addEventListener('click', function(e) {
                            href = link.getAttribute('href');
                            // If it's an external URL or absolute path, navigate normally
                            if (href.startsWith('http://') || href.startsWith('https://') || href.startsWith('/')) {
                                // Let browser handle it normally (opens in new tab due to target="_blank")
                                return true;
                            }
                            // For relative URLs, prevent default and navigate
                            else if (!href.startsWith('#')) {
                                e.preventDefault();
                                window.open(href, '_blank', 'noopener,noreferrer');
                            }
                        });
                    }
                });
            });
        </script>
    @endpush

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
