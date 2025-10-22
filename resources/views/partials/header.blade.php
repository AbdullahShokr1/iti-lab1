<header class="bg-white dark:bg-slate-900 border-b dark:border-slate-800">
<div class="container mx-auto px-4 md:px-6 lg:px-8">
<div class="flex items-center justify-between h-20">
<!-- Left: Logo + Categories (RTL: appears on right) -->
<div class="flex items-center gap-4">
<!-- Mobile menu button -->
<button id="mobileMenuBtn" aria-label="فتح القائمة" class="md:hidden p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
</button>


<!-- Logo -->
<a href="{{ url('/') }}" class="flex items-center gap-3">
<span class="sr-only">متجرنا</span>
<img src="/images/logo-light.svg" alt="متجرنا" class="h-10 dark:hidden" />
<img src="/images/logo-dark.svg" alt="متجرنا" class="h-10 hidden dark:block" />
</a>


<!-- Categories (desktop) -->
<nav class="hidden md:flex items-center gap-2 rtl:flex-row-reverse" aria-label="التصنيفات">
<a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">أجهزة</a>
<a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">ملابس</a>
<a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">أكسسوارات</a>
<a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">عروض</a>
</nav>
</div>


<!-- Center: Search (takes available width) -->
<div class="flex-1 mx-4">
<form action="#" method="GET" class="relative">
<input name="q" type="search" placeholder="ابحث عن منتج، فئة، أو ماركة" value="{{ request('q') }}" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 py-3 pl-4 pr-12 text-sm bg-white dark:bg-slate-800 text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-primary" />
<button type="submit" class="absolute inset-y-0 left-0 md:left-auto md:right-0 flex items-center justify-center px-4">
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"></path></svg>
</button>
</form>
</div>


<!-- Right: Utilities (cart, account, dark mode) -->
<div class="flex items-center gap-3">
<!-- Wishlist (optional) -->
<a href="#" class="hidden sm:inline-flex items-center gap-2 text-sm px-3 py-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-800">
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.364 4.318 12.682a4.5 4.5 0 010-6.364z"></path></svg>
<span class="text-sm">المفضلة</span>
</a>


<!-- Cart -->
<button id="cartBtn" class="relative p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 7h14l-2-7M10 21a1 1 0 11-2 0 1 1 0 012 0zm8 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
<span id="cartCount" class="absolute -top-1 -right-1 inline-flex items-center justify-center px-2 py-0.5 text-xs font-semibold rounded-full bg-primary text-white">0</span>
</button>


<!-- Account / Auth -->
@guest
<a href="{{ route('login') }}" class="hidden sm:inline-flex items-center px-3 py-2 rounded-md text-sm hover:bg-slate-100 dark:hover:bg-slate-800">تسجيل دخول</a>
@else
<div class="relative">
<button id="userMenuBtn" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-800">
<img src="{{ Auth::user()->avatar ?? '/images/avatar-placeholder.png' }}" alt="avatar" class="w-8 h-8 rounded-full object-cover" />
<span class="text-sm">{{ Auth::user()->name }}</span>
</button>
<!-- dropdown (implement with Alpine/JS) -->
</div>
@endguest
</header>
