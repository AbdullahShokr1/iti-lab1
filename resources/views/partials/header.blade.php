<header class="bg-white dark:bg-slate-900 border-b dark:border-slate-800 font-[Tajawal]">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20 gap-3">

            <!-- 🔹 القسم الأيمن (الشعار والقائمة) -->
            <div class="flex items-center gap-4">
                <!-- زر القائمة للجوال -->
                <button id="mobileMenuBtn" aria-label="فتح القائمة"
                    class="md:hidden p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- الشعار -->
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <img src="/images/logo-light.svg" alt="Logo" class="h-10 dark:hidden">
                    <img src="/images/logo-dark.svg" alt="Logo" class="h-10 hidden dark:block">
                </a>

                <!-- روابط الأقسام (سطح المكتب) -->
                <nav class="hidden md:flex items-center gap-2 rtl:flex-row-reverse">
                    <a href="{{ route('products.index') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">المنتجات</a>
                    <a href="{{ route('categories.index') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">الأقسام</a>
                </nav>
            </div>

            <!-- 🔹 مربع البحث -->
            <div class="flex-1 mx-3">
                <form action="{{ route('products.index') }}" method="GET" class="relative">
                    <input type="search" name="q" value="{{ request('q') }}"
                        placeholder="ابحث عن منتج، فئة، أو ماركة..."
                        class="w-full rounded-lg border border-slate-200 dark:border-slate-700 py-2.5 pl-4 pr-10 text-sm bg-white dark:bg-slate-800 text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-primary">
                    <button type="submit"
                        class="absolute inset-y-0 left-2 flex items-center justify-center text-slate-500 dark:text-slate-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                    </button>
                </form>
            </div>

            <!-- 🔹 أدوات المستخدم -->
            <div class="flex items-center gap-2">

                <!-- زر الوضع الليلي -->
                <button id="darkToggle" aria-label="تبديل الوضع"
                    class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                    <svg id="sunIcon" class="w-6 h-6 hidden text-yellow-400" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v1m0 16v1m8.485-8.485l-.707.707M4.222 4.222l.707.707M21 12h1M2 12H1m16.97 7.03l-.707-.707M4.222 19.778l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>
                    <svg id="moonIcon" class="w-6 h-6 text-slate-700 dark:text-slate-200" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z" />
                    </svg>
                </button>

                <!-- عربة التسوق -->
                <button id="cartBtn"
                    class="relative p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-2 7h14l-2-7M10 21a1 1 0 11-2 0m10 0a1 1 0 11-2 0" />
                    </svg>
                    <span
                        class="absolute -top-1 -right-1 inline-flex items-center justify-center px-1.5 text-xs font-semibold rounded-full bg-primary text-white">0</span>
                </button>

                <!-- تسجيل الدخول / المستخدم -->
                @guest
                    <a href="{{ route('login') }}"
                        class="hidden sm:inline-flex items-center px-3 py-2 rounded-md text-sm hover:bg-slate-100 dark:hover:bg-slate-800">
                        تسجيل دخول
                    </a>
                @else
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.away="open = false"
                            class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none">
                            <img src="{{ Auth::user()->profile_picture_url ?? '/images/avatar-placeholder.png' }}"
                                alt="avatar" class="w-8 h-8 rounded-full object-cover">
                            <span class="text-sm">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 mt-[2px]" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition
                            class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg shadow-lg overflow-hidden z-50">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-slate-100 dark:hover:bg-slate-700">
                                الملف الشخصي
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-slate-100 dark:hover:bg-slate-700">
                                    تسجيل الخروج
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</header>

<!-- ✅ سكربت الوضع الليلي -->
<script>
    (function () {
        const html = document.documentElement;
        const toggle = document.getElementById('darkToggle');
        const moon = document.getElementById('moonIcon');
        const sun = document.getElementById('sunIcon');

        function setDark(isDark) {
            if (isDark) {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                if (moon && sun) {
                    moon.classList.add('hidden');
                    sun.classList.remove('hidden');
                }
            } else {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                if (moon && sun) {
                    moon.classList.remove('hidden');
                    sun.classList.add('hidden');
                }
            }
        }

        // التهيئة
        const stored = localStorage.getItem('theme');
        if (stored) {
            setDark(stored === 'dark');
        } else {
            setDark(window.matchMedia('(prefers-color-scheme: dark)').matches);
        }

        if (toggle) {
            toggle.addEventListener('click', () => setDark(!html.classList.contains('dark')));
        }
    })();
</script>
