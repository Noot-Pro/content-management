<div class="my-4 bg-gray-50 dark:bg-gray-900 p-2 rounded">
    <label for="search" class="mb-4 text-xl font-bold text-gray-700 dark:text-gray-200">{{ __('Search') }}</label>
    <div class="flex flex-col max-w-sm px-2 py-4 mx-auto">
        <form method="GET">
                <input class="w-full px-3 py-1.5 rounded" type="text" name="search" id="search" value="{{ request()->get('search') }}">
        </form>
    </div>
</div>
