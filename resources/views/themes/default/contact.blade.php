<div>
    {{-- Hero Section --}}
    <section class="relative w-full h-[400px] md:h-[500px] bg-cover bg-center bg-gray-900" style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1920&q=80');">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <div class="relative container mx-auto h-full flex items-center justify-center px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">تواصل معنا</h1>
                <p class="text-xl md:text-2xl max-w-3xl mx-auto">نحن هنا لمساعدتك. تواصل معنا في أي وقت</p>
            </div>
        </div>
    </section>

    {{-- Contact Section --}}
    <section class="py-16 md:py-24 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
                {{-- Contact Form --}}
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-gray-100 mb-6">أرسل لنا رسالة</h2>
                    <p class="text-gray-600 dark:text-gray-300 mb-8">املأ النموذج أدناه وسنتواصل معك في أقرب وقت ممكن</p>
                    
                    @if(session()->has('message'))
                        <div class="mb-6 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 rounded-lg">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="submit" class="space-y-6">
                        {{-- Name --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الاسم <span class="text-red-500">*</span></label>
                            <input 
                                type="text" 
                                id="name" 
                                wire:model="name"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:text-gray-100 transition-colors"
                                placeholder="أدخل اسمك الكامل"
                            >
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">البريد الإلكتروني <span class="text-red-500">*</span></label>
                            <input 
                                type="email" 
                                id="email" 
                                wire:model="email"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:text-gray-100 transition-colors"
                                placeholder="example@email.com"
                            >
                            @error('email')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">رقم الهاتف</label>
                            <input 
                                type="tel" 
                                id="phone" 
                                wire:model="phone"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:text-gray-100 transition-colors"
                                placeholder="+966 5X XXX XXXX"
                            >
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Subject --}}
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الموضوع <span class="text-red-500">*</span></label>
                            <input 
                                type="text" 
                                id="subject" 
                                wire:model="subject"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:text-gray-100 transition-colors"
                                placeholder="موضوع رسالتك"
                            >
                            @error('subject')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Message --}}
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الرسالة <span class="text-red-500">*</span></label>
                            <textarea 
                                id="message" 
                                wire:model="message"
                                rows="6"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:text-gray-100 transition-colors resize-none"
                                placeholder="اكتب رسالتك هنا..."
                            ></textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div>
                            <button 
                                type="submit" 
                                class="w-full px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                            >
                                <span wire:loading.remove wire:target="submit">إرسال الرسالة</span>
                                <span wire:loading wire:target="submit">جاري الإرسال...</span>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Contact Information --}}
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-gray-100 mb-6">معلومات التواصل</h2>
                    <p class="text-gray-600 dark:text-gray-300 mb-8">يمكنك التواصل معنا عبر القنوات التالية</p>

                    <div class="space-y-6">
                        {{-- Email --}}
                        <div class="flex items-start gap-4 p-6 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-1">البريد الإلكتروني</h3>
                                <a href="mailto:info@noot.co" class="text-blue-600 dark:text-blue-400 hover:underline">info@noot.co</a>
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="flex items-start gap-4 p-6 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-1">رقم الهاتف</h3>
                                <a href="tel:+966555028398" class="text-blue-600 dark:text-blue-400 hover:underline">+966 55 502 8398</a>
                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="flex items-start gap-4 p-6 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-1">العنوان</h3>
                                <p class="text-gray-600 dark:text-gray-300">المملكة العربية السعودية</p>
                            </div>
                        </div>

                        {{-- Working Hours --}}
                        <div class="flex items-start gap-4 p-6 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-1">ساعات العمل</h3>
                                <p class="text-gray-600 dark:text-gray-300">الأحد - الخميس: 9:00 ص - 5:00 م</p>
                                <p class="text-gray-600 dark:text-gray-300">الجمعة - السبت: مغلق</p>
                            </div>
                        </div>
                    </div>

                    {{-- Social Media --}}
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">تابعنا على</h3>
                        <div class="flex gap-4">
                            <a href="#" class="w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-blue-400 hover:bg-blue-500 text-white rounded-lg flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-blue-700 hover:bg-blue-800 text-white rounded-lg flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Map Section --}}
    <section class="py-0 bg-gray-50 dark:bg-gray-800">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="w-full h-[400px] md:h-[500px] rounded-lg overflow-hidden shadow-lg">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3624.198652094313!2d46.67527731500078!3d24.71325398409033!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f03299457c85f%3A0x1c3c99263ada9aa6!2sRiyadh%2C%20Saudi%20Arabia!5e0!3m2!1sen!2sus!4v1234567890123!5m2!1sen!2sus" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        class="w-full h-full"
                    ></iframe>
                </div>
            </div>
        </div>
    </section>
</div>

