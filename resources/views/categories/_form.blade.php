@csrf

<div class="space-y-5">
    {{-- Name --}}
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
            الاسم
        </label>
        <input type="text" name="name" id="name" value="{{ old('name', $category->name ?? '') }}"
               class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500">
        @error('name')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Image --}}
    <div>
        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
            الصورة
        </label>
        <input type="file" name="image" id="image"
               class="w-full text-gray-700 dark:text-gray-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-200 dark:hover:file:bg-blue-800">
        @error('image')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
