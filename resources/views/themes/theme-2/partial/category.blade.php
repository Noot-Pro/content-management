<a href="{{ route('tags',[$category->type,$category->slug]) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded-lg bg-[var(--primary-color)] hover:opacity-90 text-white transition-colors duration-300 shadow-sm hover:shadow">
    {{ $category->name ?? '' }}
</a>
