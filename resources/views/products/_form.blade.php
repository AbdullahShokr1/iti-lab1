@php
  $isEdit = isset($product);
@endphp

<form method="POST" action="{{ $isEdit ? route('products.update', $product) : route('products.store') }}" enctype="multipart/form-data" class="space-y-4">
  @csrf
  @if($isEdit)
    @method('PUT')
  @endif

  <div>
    <label class="block text-sm font-medium">Name</label>
    <input name="name" value="{{ old('name', $product->name ?? '') }}" required class="w-full px-3 py-2 rounded border" />
    @error('name') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
  </div>

  <div>
    <label class="block text-sm font-medium">Description</label>
    <textarea name="description" class="w-full px-3 py-2 rounded border" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
    <div>
      <label class="block text-sm">Price</label>
      <input name="price" value="{{ old('price', $product->price ?? '') }}" required class="w-full px-3 py-2 rounded border" />
      @error('price') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
    </div>

    <div>
      <label class="block text-sm">Category</label>
      <select name="category" class="w-full px-3 py-2 rounded border">
        @foreach($categories as $c)
          <option value="{{ $c }}" @if(old('category', $product->category ?? '')==$c) selected @endif>{{ $c }}</option>
        @endforeach
      </select>
      @error('category') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
    </div>

    <div>
      <label class="block text-sm">Stock qty</label>
      <input name="stock_quantity" type="number" value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}" class="w-full px-3 py-2 rounded border" />
      @error('stock_quantity') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
    </div>
  </div>

  <div>
    <label class="block text-sm">Image</label>

    <div class="flex items-center gap-4">
      <div class="w-40 h-40 bg-gray-100 rounded overflow-hidden flex items-center justify-center" id="image-preview">
        @if(old('image') && !$isEdit)
          <!-- nothing -->
        @elseif(isset($product) && $product->image_url)
          <img src="{{ $product->image_url }}" id="existing-image" class="object-contain w-full h-full" />
        @else
          <div class="text-gray-400">No Image</div>
        @endif
      </div>

      <div class="flex-1">
        <input type="file" name="image" id="image" accept="image/*" class="block" />
        <p class="text-xs text-gray-500 mt-1">Allowed: jpg, jpeg, png, gif. Max: 2MB</p>
        @error('image') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
      </div>
    </div>
  </div>

  <div class="flex items-center gap-3">
    <label class="inline-flex items-center">
      <input type="checkbox" name="is_active" value="1" @if(old('is_active', $product->is_active ?? true)) checked @endif class="mr-2">
      Active
    </label>
  </div>

  <div>
    <button class="px-4 py-2 bg-blue-600 text-white rounded">
      {{ $isEdit ? 'Update Product' : 'Create Product' }}
    </button>
  </div>
</form>

<script>
  document.getElementById('image')?.addEventListener('change', function(e){
    const preview = document.getElementById('image-preview');
    const file = e.target.files[0];
    if(!file) return;
    const reader = new FileReader();
    reader.onload = function(ev){
      preview.innerHTML = '<img src="'+ev.target.result+'" class="object-contain w-full h-full" />';
    }
    reader.readAsDataURL(file);
  });
</script>
