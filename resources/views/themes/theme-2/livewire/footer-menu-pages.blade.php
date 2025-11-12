<ul>
    @foreach($pages as $page)
        <li class="mb-6"><a href="{{ url('page/'.$page->slug) }}" class="text-white hover:text-[#E86F44] transition ease-in-out">{{ $page->title }}</a></li>
    @endforeach
</ul>
