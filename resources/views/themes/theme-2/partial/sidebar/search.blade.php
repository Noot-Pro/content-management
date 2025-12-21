<div class="my-4 bg-white rounded-lg shadow-md p-4">
    <label for="search" class="mb-3 block text-xl font-bold text-gray-700">{{ __('noot-pro-content-management::site.search') }}</label>
    <form method="GET">
        <input class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-(--primary-color) focus:border-transparent" type="text" name="search" id="search" value="{{ request()->get('search') }}" placeholder="{{ __('Search') }}">
    </form>
</div>
