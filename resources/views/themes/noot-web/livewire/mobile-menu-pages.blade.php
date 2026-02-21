<ul class="flex flex-col gap-1 pr-2">
    @foreach($pages as $page)
        <li class="mb-2"><a href="{{ url('page/'.$page->slug) }}">{{ $page->title }}</a></li>
    @endforeach
</ul>
