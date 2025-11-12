<div>
    <section class="bg-white">
        <div class="container px-4 pt-24 pb-24">
            <h2 class="mb-2 text-4xl tracking-tight font-extrabold text-center text-gray-900">{{ __('noot-pro-content-management::site.contact_us') }}</h2>
            <p class="mb-2 lg:mb-2 font-light text-center text-gray-500 sm:text-sm">{{ __('noot-pro-content-management::site.contact_us_text') }}</p>
            <p class="mb-2 lg:mb-2 font-light text-center text-gray-500 sm:text-sm mx-2">{{ __('noot-pro-content-management::site.contact_us_whatsapp') }}
                <a target="_blank" class="inline-block align-middle border-2 rounded-xl border-[#E8E8E8] hover:bg-[#E8E8E8] transition ease-in-out" href="https://wa.me/{{ config('noot.site.phone_with_code') }}">
                    <img src="{{ asset('images/site/social-media/whatsapp.svg') }}" alt="">
                </a>
            </p>
            @if(Session::has('message'))
                <p>{{ Session::get('message') }}</p>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
            @endif
            <div class="py-4 px-4 mx-auto max-w-screen-md">
                <form action="" method="post" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">{{ __('noot-pro-content-management::site.name') }}</label>
                            <input type="text" name="name" id="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="{{ __('noot-pro-content-management::site.name') }}" required>
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">{{ __('noot-pro-content-management::site.email') }}</label>
                            <input type="email" name="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="example:name@gmail.com" required>
                        </div>
                    </div>
                    <div>
                        <label for="subject" class="block mb-2 text-sm font-medium text-gray-900">{{ __('noot-pro-content-management::site.subject') }}</label>
                        <input type="text" name="subject" id="subject" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500" placeholder="{{ __('noot-pro-content-management::site.subject') }}" required>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900">{{ __('noot-pro-content-management::site.message') }}</label>
                        <textarea id="message" name="message" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500" placeholder="{{ __('noot-pro-content-management::site.message') }}"></textarea>
                    </div>
                    <button type="submit" class="px-6 py-3.5 border-2 rounded-xl border-[var(--primary-color)] bg-[var(--primary-color)] hover:bg-[var(--secondary-color)] hover:border-[var(--secondary-color)] text-white transition ease-in-out">{{ __('noot-pro-content-management::site.send') }}</button>
                </form>
            </div>
        </div>
    </section>
</div>

