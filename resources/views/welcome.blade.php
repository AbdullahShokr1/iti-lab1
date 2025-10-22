
<x-app>
    <x-slot name="title">الرئيسية - متجرنا</x-slot>
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-r from-primary to-blue-500 dark:from-blue-800 dark:to-blue-600 text-white">
        <div class="container mx-auto px-4 md:px-6 lg:px-8 py-24 flex flex-col md:flex-row items-center gap-10">
            <div class="flex-1 text-center md:text-right space-y-4">
                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-black">مرحبا بك في متجرنا</h1>
                <p class="text-lg opacity-90 text-black">تسوق منتجات عالية الجودة بأفضل الأسعار — استمتع بتجربة شراء سلسة وسريعة.</p>
                <div class="mt-6 flex justify-center md:justify-start gap-3">
                    <a href="{{ route('products.index') }}" class="px-6 py-3 rounded-lg bg-white text-primary font-semibold hover:bg-slate-100 transition">تسوق الآن</a>
                    <a href="#" class="px-6 py-3 rounded-lg border border-white text-white hover:bg-white hover:text-primary transition">العروض</a>
                </div>
            </div>
            <div class="flex-1 flex justify-center">
                <img src="/images/hero-product.png" alt="منتجات مميزة" class="max-h-96 object-contain animate-fade-in-up" />
            </div>
        </div>
    </section>

    <!-- Example Featured Section -->
    <section class="py-16 bg-slate-50 dark:bg-slate-900">
        <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-6">منتجات مختارة</h2>
            <p class="max-w-2xl mx-auto text-slate-600 dark:text-slate-400 mb-10">اكتشف تشكيلتنا المميزة من المنتجات المختارة بعناية لتناسب جميع الأذواق.</p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl shadow hover:shadow-lg transition">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-40 object-contain mb-3" />
                        <h3 class="font-semibold text-slate-800 dark:text-slate-100">{{ $product->name }}</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ $product->category }}</p>
                        <div class="text-right">
                            <a href="{{ route('products.show', $product) }}" class="text-blue-600 text-sm">View</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500">لا توجد منتجات حاليه!</div>
                @endforelse
            </div>
        </div>
    </section>
</x-app>
