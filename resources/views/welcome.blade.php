<x-app>
    <x-slot name="title">الرئيسية - متجرنا</x-slot>

    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 transition-colors duration-500">
        <div class="container mx-auto px-6 lg:px-12 py-24 flex flex-col-reverse md:flex-row items-center justify-between gap-10">

            <!-- النصوص -->
            <div class="flex-1 text-center md:text-right space-y-6">
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-slate-900 dark:text-white">
                    مرحباً بك في <span class="text-primary dark:text-blue-400">متجرنا</span>
                </h1>
                <p class="text-lg text-slate-700 dark:text-slate-300 max-w-xl mx-auto md:mx-0">
                    تسوق منتجات عالية الجودة بأسعار تنافسية. تجربة شراء سهلة، سريعة، وآمنة — كل ما تحتاجه في مكان واحد!
                </p>

                <div class="flex justify-center md:justify-start gap-4 pt-4">
                    <a href="{{ route('products.index') }}"
                    class="px-7 py-3 rounded-xl bg-primary text-white font-semibold shadow-md bg-gray-500 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                        تسوق الآن
                    </a>

                    <a href="#offers"
                    class="px-7 py-3 rounded-xl border-2 border-primary text-primary font-semibold bg-orange-500 hover:bg-primary hover:text-white dark:border-blue-400 dark:text-blue-400 dark:hover:bg-blue-400 dark:hover:text-slate-900 transition-all duration-300 transform hover:-translate-y-1">
                         العروض
                    </a>
                </div>
            </div>

            <!-- الصورة -->
            <div class="flex-1 flex justify-center relative">
                <div class="absolute -top-10 -left-10 w-64 h-64 bg-blue-300/20 dark:bg-blue-500/10 blur-3xl rounded-full"></div>
                <img src="/images/hero-product.png" alt="منتجات مميزة"
                    class="relative z-10 max-h-96 object-contain drop-shadow-2xl animate-fade-in-up" />
            </div>
        </div>
    </section>


    <!-- Featured Section -->
    <section class="py-16 bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
        <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-6 text-slate-800 dark:text-white">
                منتجات مختارة
            </h2>
            <p class="max-w-2xl mx-auto text-slate-600 dark:text-slate-400 mb-10">
                اكتشف تشكيلتنا المميزة من المنتجات المختارة بعناية لتناسب جميع الأذواق.
            </p>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <div class="group bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-md hover:shadow-xl transition-transform transform hover:-translate-y-1 duration-300">
                        <div class="w-full h-44 bg-slate-100 dark:bg-slate-700 rounded-xl flex items-center justify-center overflow-hidden mb-4">
                            <img src="{{ $product->image_url ?: asset('images/default-product.png') }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" />
                        </div>
                        <h3 class="font-semibold text-slate-800 dark:text-slate-100 mb-1 truncate">
                            {{ $product->name }}
                        </h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mb-3">
                            {{ $product->category->name ?? 'بدون تصنيف' }}
                        </p>
                        <div class="text-right">
                            <a href="{{ route('products.show', $product) }}"
                               class="text-blue-600 dark:text-blue-400 text-sm hover:underline">
                                عرض التفاصيل →
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 dark:text-gray-300">
                        لا توجد منتجات حالية!
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-app>
