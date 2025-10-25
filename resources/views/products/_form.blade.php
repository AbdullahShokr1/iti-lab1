@php
  $isEdit = isset($product);
@endphp

<form method="POST"
      action="{{ $isEdit ? route('products.update', $product) : route('products.store') }}"
      enctype="multipart/form-data"
      dir="rtl"
      class="max-w-3xl mx-auto bg-white dark:bg-gray-900 shadow-md rounded-2xl p-8 space-y-6 transition duration-300">
  @csrf
  @if($isEdit)
    @method('PUT')
  @endif

  <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4 text-center">
    {{ $isEdit ? 'تعديل المنتج' : 'إضافة منتج جديد' }}
  </h2>

  {{-- الاسم --}}
  <div>
    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">اسم المنتج</label>
    <input name="name"
           value="{{ old('name', $product->name ?? '') }}"
           required
           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white" />
    @error('name')
      <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
  </div>

  {{-- الوصف --}}
  <div>
    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">الوصف</label>
    <textarea name="description"
              rows="4"
              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description')
      <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
  </div>

  {{-- السعر / الفئة / الكمية --}}
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
    <div>
      <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">السعر</label>
      <input name="price"
             value="{{ old('price', $product->price ?? '') }}"
             required
             class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white" />
      @error('price')
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">الفئة</label>
        <select name="category_id"
                required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
        <option value="">اختر الفئة</option>
        @foreach($categories as $c)
            <option value="{{ $c->id }}" @selected(old('category_id', $product->category_id ?? '') == $c->id)>
            {{ $c->name }}
            </option>
        @endforeach
        </select>
        @error('category_id')
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
      <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">الكمية بالمخزون</label>
      <input type="number"
             name="stock_quantity"
             value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}"
             class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white" />
      @error('stock_quantity')
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
      @enderror
    </div>
  </div>

  {{-- صورة المنتج --}}
  <div>
    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">صورة المنتج</label>
    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
      <div class="w-40 h-40 bg-gray-100 dark:bg-gray-800 rounded-xl overflow-hidden flex items-center justify-center shadow-inner" id="image-preview">
        @if(isset($product) && $product->image_url)
          <img src="{{ $product->image_url }}" id="existing-image" class="object-cover w-full h-full" />
        @else
          <span class="text-gray-400 text-sm">لا توجد صورة</span>
        @endif
      </div>

      <div class="flex-1">
        <input type="file"
               name="image"
               id="image"
               accept="image/*"
               class="block w-full text-sm text-gray-700 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition" />
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">الأنواع المسموح بها: jpg, jpeg, png, gif — الحد الأقصى: 2MB</p>
        @error('image')
          <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
      </div>
    </div>
  </div>

  {{-- حالة التفعيل --}}
  <div class="flex items-center">
    <label class="inline-flex items-center cursor-pointer">
      <input type="checkbox"
             name="is_active"
             value="1"
             @if(old('is_active', $product->is_active ?? true)) checked @endif
             class="mr-2 accent-blue-600 w-4 h-4 rounded">
      <span class="text-sm text-gray-700 dark:text-gray-300">نشط</span>
    </label>
  </div>



  {{-- زر الحفظ --}}
  <div class="pt-4 text-center">
    <button type="submit"
            class="px-8 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
      {{ $isEdit ? 'تحديث المنتج' : 'إضافة المنتج' }}
    </button>
  </div>
</form>

<script>
  document.getElementById('image')?.addEventListener('change', function(e){
    const preview = document.getElementById('image-preview');
    const file = e.target.files[0];
    if(!file) return;
    const reader = new FileReader();
    reader.onload = e => {
      preview.innerHTML = `<img src="${e.target.result}" class="object-cover w-full h-full rounded-lg" />`;
    };
    reader.readAsDataURL(file);
  });
</script>
