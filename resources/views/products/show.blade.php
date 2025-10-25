<x-app>
    <div dir="rtl" class="font-[Tajawal] text-gray-800 dark:text-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg p-8">
                <div class="flex flex-col md:flex-row gap-10">

                    {{-- صورة المنتج --}}
                    <div class="md:w-1/3 bg-gray-100 dark:bg-gray-800 p-6 flex items-center justify-center rounded-xl">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                 class="max-h-[28rem] w-full object-contain rounded-xl">
                        @else
                            <div class="text-gray-400">لا توجد صورة</div>
                        @endif
                    </div>

                    {{-- تفاصيل المنتج --}}
                    <div class="flex-1 space-y-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                                {{ $product->name }}
                            </h1>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                {{ $product->description }}
                            </p>
                        </div>

                        {{-- تفاصيل السعر والمعلومات --}}
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-5 space-y-3">
                            <div class="flex items-center">
                                <span class="font-semibold">السعر:</span>
                                <span class="text-2xl font-bold text-blue-600 dark:text-yellow-400">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                            </div>

                            <div class="flex items-center">
                                <span class="font-semibold">الفئة:</span>
                                <span>{{ $product->category->name ?? 'بدون تصنيف' }}</span>
                            </div>

                            <div class="flex items-center">
                                <span class="font-semibold">المخزون:</span>
                                <span>{{ $product->stock_quantity }}</span>
                            </div>

                            <div class="flex items-center">
                                <span class="font-semibold">الحالة:</span>
                                @if($product->is_active)
                                    <span class="text-green-600 dark:text-green-400 font-semibold">نشط</span>
                                @else
                                    <span class="text-red-600 dark:text-red-400 font-semibold">غير نشط</span>
                                @endif
                            </div>
                        </div>

                        {{-- الأزرار --}}
                        <div class="flex flex-wrap gap-4 pt-6">
                            <a href="{{ route('products.edit', $product) }}"
                               class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg
                                      bg-yellow-500 hover:bg-yellow-600 text-white font-medium transition">
                                ✏️ تعديل المنتج
                            </a>

                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                  onsubmit="return confirm('هل أنت متأكد من حذف هذا المنتج؟')">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg
                                           bg-red-600 hover:bg-red-700 text-white font-medium transition">
                                    🗑️ حذف
                                </button>
                            </form>

                            <a href="{{ route('products.index') }}"
                               class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg
                                      bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600
                                      text-gray-800 dark:text-gray-100 font-medium transition">
                                ← رجوع للمنتجات
                            </a>
                        </div>
                    </div>
                </div>

                {{-- 💬 قسم التعليقات --}}
                <div class="mt-10 border-t border-gray-200 dark:border-gray-700 pt-8">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">التعليقات</h2>

                    {{-- عرض التعليقات الحالية --}}
                    @if($product->comments->count())
                        <div class="space-y-4 mb-8">
                            @foreach($product->comments as $comment)
                                <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-semibold text-blue-600 dark:text-yellow-400">
                                            {{ $comment->author_name }}
                                        </span>
                                        <span class="text-sm text-gray-500">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="text-gray-700 dark:text-gray-200">{{ $comment->content }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400 mb-6">لا توجد تعليقات بعد.</p>
                    @endif

                    {{-- نموذج إضافة تعليق إن كان المستخدم مسجلاً --}}
                    @auth
                        <form action="{{ route('comments.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <textarea name="content" rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg
                                             focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white"
                                      placeholder="أضف تعليقك هنا..." required></textarea>

                            <button type="submit"
                                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                                💬 إرسال التعليق
                            </button>
                        </form>
                    @else
                        <p class="text-gray-600 dark:text-gray-300">
                            <a href="{{ route('login') }}" class="text-blue-600 dark:text-yellow-400 hover:underline">
                                سجل الدخول
                            </a>
                            لإضافة تعليق.
                        </p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app>
