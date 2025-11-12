<div class="grid grid-cols-12 gap-x-4">
    @foreach($pages as $page)
        <div class="mb-8 lg:col-span-6" >
            <div class="mb-1"><a href="{{ url('page/'.$page->slug) }}" class="text-[#1C1C1C] hover:text-[var(--primary-color)] transition ease-in-out">{{ $page->title }}</a></div>
            @php
                $content = preg_replace('/<figure\b[^>]*>.*?<\/figure>/is', '', $page->content);
            @endphp
            <div class="text-sm text-[#969696]">{{ str()->limit(strip_tags($content),70,'...') }}</div>
        </div>
    @endforeach
</div>
