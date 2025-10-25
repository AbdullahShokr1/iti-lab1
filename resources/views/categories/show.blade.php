<x-app>
    <div class="max-w-5xl mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-8 mb-8">
            <div class="flex flex-col sm:flex-row gap-6">
                <img src="{{ $category->image ? asset('storage/'.$category->image) : asset('images/category-fallback.png') }}"
                     alt="{{ $category->name }}"
                     class="w-full sm:w-60 h-60 object-cover rounded-lg">

                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-2">{{ $category->name }}</h1>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $category->description }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Products count:
                        <span class="font-medium">{{ $category->products()->count() }}</span>
                    </p>

                    <a href="{{ route('categories.edit', $category) }}"
                       class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-lg transition">
                        ✏️ Edit Category
                    </a>
                </div>
            </div>
        </div>

        <div>
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Products</h2>

            @if($products->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4 flex flex-col">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-1">{{ $product->name }}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ Str::limit($product->description, 80) }}</p>
                            <a href="{{ route('products.show', $product) }}"
                               class="mt-auto inline-block text-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm transition">
                                View Product
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            @else
                <p class="text-gray-600 dark:text-gray-300">No products in this category.</p>
            @endif
        </div>
    </div>
</x-app>
