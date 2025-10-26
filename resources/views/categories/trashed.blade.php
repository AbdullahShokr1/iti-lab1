<x-app>
    <div class="py-8 max-w-6xl mx-auto sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">🗑️ الأقسام المحذوفة</h2>

        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if ($trashedCategories->count())
            <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
                <table class="w-full text-sm text-gray-700 dark:text-gray-200">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="py-3 px-4 text-left">#</th>
                            <th class="py-3 px-4 text-left">الاسم</th>
                            <th class="py-3 px-4 text-left">تاريخ الحذف</th>
                            <th class="py-3 px-4 text-center">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trashedCategories as $category)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <td class="py-3 px-4">{{ $category->id }}</td>
                                <td class="py-3 px-4">{{ $category->name }}</td>
                                <td class="py-3 px-4">{{ $category->deleted_at->format('Y-m-d H:i') }}</td>
                                <td class="py-3 px-4 text-center flex justify-center gap-2">
                                    <form method="POST" action="{{ route('categories.restore', $category->id) }}">
                                        @csrf
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-1 px-3 rounded">
                                            استرجاع
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('categories.forceDelete', $category->id) }}" onsubmit="return confirm('هل أنت متأكد من الحذف النهائي؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded">
                                            حذف نهائي
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $trashedCategories->links() }}
            </div>
        @else
            <p class="text-gray-600 dark:text-gray-300">لا توجد أقسام محذوفة.</p>
        @endif
    </div>
</x-app>
