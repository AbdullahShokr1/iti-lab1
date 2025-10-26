<x-app>
    <div class="max-w-7xl mx-auto px-4 py-8">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">الاقسام</h1>

            <div class="flex gap-3">
                <a href="{{ route('categories.create') }}"
                class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow transition duration-200">
                    انشاء تصنيف جديد
                </a>
                <x-button
                    type="danger"
                    :href="route('categories.trashed')"
                    :text="' سلة المحذوفات (' . $trashedCount . ')'"
                />
            </div>
        </div>

        {{-- Search Form --}}
        <form method="GET" action="{{ route('categories.index') }}" class="flex flex-col sm:flex-row gap-3 mb-6">
            <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="البحث عن التصنيفات..."
                   class="w-full sm:w-1/3 px-4 py-2 border rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
            <div class="flex gap-2">
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    بحث
                </button>
                <a href="{{ route('categories.index') }}"
                   class="px-4 py-2 bg-gray-200 dark:bg-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    تنظيف
                </a>
            </div>
        </form>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-6 p-3 rounded-lg bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                {{ session('success') }}
            </div>
        @endif

        {{-- Categories Grid --}}
        @if($categories->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($categories as $category)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-lg transition p-5 flex flex-col items-center text-center">
                        {{-- Small Circular Image --}}
                        <div class="w-24 h-24 mb-4">
                            <img src="{{ $category->image ? asset('storage/'.$category->image) : asset('images/category-fallback.png') }}"
                                 alt="{{ $category->name }}"
                                 class="w-24 h-24 object-cover rounded-full border-4 border-gray-200 dark:border-gray-700 shadow-sm">
                        </div>

                        {{-- Category Info --}}
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-1">
                            {{ $category->name }}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                            {{ Str::limit($category->description, 100) }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">
                            Products: {{ $category->products_count }}
                        </p>

                        {{-- Action Buttons --}}
                        <div class="flex gap-2 mt-auto">
                            <a href="{{ route('categories.show', $category) }}"
                               class="px-3 py-1.5 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                                عرض
                            </a>
                            <a href="{{ route('categories.edit', $category) }}"
                               class="px-3 py-1.5 text-sm bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition">
                                تعديل
                            </a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                  onsubmit="return confirm('هل تريد حقا حذف هذا التصنيف ؟');">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1.5 text-sm bg-red-600 hover:bg-red-700 text-white rounded-lg transition">
                                    حدف
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600 dark:text-gray-300 mt-6">لا يوجد تصنيفات</p>
        @endif

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $categories->links() }}
        </div>
    </div>
</x-app>
