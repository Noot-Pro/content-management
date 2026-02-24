<div class="mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/50 p-6">
        <label for="search" class="block mb-5 text-lg font-bold text-gray-900 dark:text-white flex items-center gap-3">
            <span class="w-1.5 h-6 bg-[#E86F44] rounded-full inline-block"></span>
            {{ __('site.search') }}
        </label>
        <form method="GET" class="relative">
            <input class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-[#E86F44] focus:border-[#E86F44] transition-colors text-sm" type="text" name="search" id="search" placeholder="{{ __('site.search') }}..." value="{{ request()->get('search') }}">
            <button type="submit" class="absolute ltr:right-3 rtl:left-3 top-2.5 p-1 text-gray-400 hover:text-[#E86F44] transition-colors">
                @svg('heroicon-o-magnifying-glass', 'w-5 h-5')
            </button>
        </form>
    </div>
</div>
