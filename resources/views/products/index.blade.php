<x-app>
    <div dir="rtl" class="font-[Tajawal] text-gray-800 dark:text-gray-100">

        {{-- ✅ Container عام --}}
        <div class="container mx-auto px-4 py-8">

            {{-- 🔍 شريط البحث والفلاتر --}}
            <div class="mb-8 bg-white dark:bg-gray-900 shadow-md rounded-2xl p-5 flex flex-col sm:flex-row gap-3 justify-between items-center">
                <form method="GET" action="{{ route('products.index') }}" class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <input type="text" name="q" value="{{ request('q') }}"
                        placeholder="ابحث عن منتج..."
                        class="w-full sm:w-72 px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700
                               bg-gray-50 dark:bg-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                               text-sm transition" />

                    <select name="category"
                        class="px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700
                               bg-gray-50 dark:bg-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                               text-sm transition">
                        <option value="">كل الفئات</option>
                        @foreach($categories as $c)
                            <option value="{{ $c }}" @if(request('category')==$c) selected @endif>{{ $c }}</option>
                        @endforeach
                    </select>

                    <button type="submit"
                        class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition flex items-center gap-1">
                         <span>بحث</span>
                    </button>
                </form>
                <a href="{{ route('products.create') }}"
                    class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition flex items-center gap-1">
                     <span>اضافة منتج</span>
                </a>
            </div>


            {{-- 🛒 شبكة المنتجات --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-md hover:shadow-2xl transition transform hover:-translate-y-1 duration-300 overflow-hidden group">

                        {{-- صورة المنتج --}}
                        <div class="relative h-56 bg-gray-100 dark:bg-gray-800 flex items-center justify-center overflow-hidden">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                    class="object-cover w-full h-full transform group-hover:scale-105 transition duration-500 ease-in-out"
                                    loading="lazy">
                            @else
                                <div class="text-sm text-gray-400">لا توجد صورة</div>
                            @endif
                            @if(!$product->is_active)
                                <span class="absolute top-2 right-2 bg-red-600 text-white text-xs px-2 py-1 rounded-full shadow">
                                    غير نشط
                                </span>
                            @endif
                        </div>

                        {{-- تفاصيل المنتج --}}
                        <div class="p-4 space-y-2">
                            <h3 class="font-bold text-lg line-clamp-1 text-gray-900 dark:text-white">
                                {{ $product->name }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                                {{ Str::limit($product->description, 80) }}
                            </p>

                            <div class="mt-3 flex items-center justify-between">
                                <div>
                                    <span class="text-xl font-bold text-blue-600 dark:text-yellow-400">
                                        ${{ number_format($product->price, 2) }}
                                    </span>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $product->category }}
                                    </div>
                                </div>

                                <a href="{{ route('products.show', $product) }}"
                                   class="text-blue-600 dark:text-yellow-400 hover:underline text-sm font-semibold transition">
                                    عرض التفاصيل →
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 dark:text-gray-400 py-16 text-lg">
                        لا توجد منتجات مطابقة لبحثك 🔎
                    </div>
                @endforelse
            </div>

            {{-- 📄 ترقيم الصفحات (Pagination) --}}
            @if($products->hasPages())
                <div class="mt-10 flex justify-center">
                    <div class="flex items-center gap-2 bg-white dark:bg-gray-900 shadow-md rounded-xl px-4 py-3">
                        {{-- روابط الصفحات --}}
                        {{ $products->onEachSide(1)->links('pagination::tailwind') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app>
