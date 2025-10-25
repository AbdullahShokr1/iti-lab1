<x-app>
    <div class="max-w-3xl mx-auto mt-10 bg-white dark:bg-gray-800 shadow-md rounded-2xl p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                انشاء تصنيف
            </h1>

            <a href="{{ route('categories.index') }}"
               class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors duration-200">
                ← العودة
            </a>
        </div>

        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data"
              class="space-y-6">
            @include('categories._form')

            <div class="flex justify-end">
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-sm transition duration-200">
                    انشاء
                </button>
            </div>
        </form>
    </div>
</x-app>
