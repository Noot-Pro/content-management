<a href="{{ route('tags',[$category->type,$category->slug]) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded-lg bg-[#E86F44] hover:bg-[#EEAB43] text-white transition-colors duration-300 shadow-sm hover:shadow">
    {{ $category->name ?? '' }}
</a>
