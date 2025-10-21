@extends('layouts.app')
@section('title','Products')
@section('content')
<div class="mb-6 flex flex-col sm:flex-row gap-3 justify-between items-center">
  <form method="GET" action="{{ route('products.index') }}" class="flex gap-2 w-full sm:w-auto">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search products..." class="w-full sm:w-64 px-3 py-2 rounded border" />
    <select name="category" class="px-3 py-2 rounded border">
      <option value="">All categories</option>
      @foreach($categories as $c)
        <option value="{{ $c }}" @if(request('category')==$c) selected @endif>{{ $c }}</option>
      @endforeach
    </select>
    <button class="px-3 py-2 bg-blue-600 text-white rounded">Search</button>
  </form>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
  @forelse($products as $product)
    <div class="bg-white rounded shadow overflow-hidden">
      <div class="h-48 bg-gray-50 flex items-center justify-center overflow-hidden">
        @if($product->image_url)
          <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="object-cover w-full h-full" loading="lazy">
        @else
          <div class="text-sm text-gray-400">No image</div>
        @endif
      </div>
      <div class="p-4">
        <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
        <p class="text-sm text-gray-500">{{ Str::limit($product->description, 80) }}</p>
        <div class="mt-3 flex items-center justify-between">
          <div>
            <span class="text-lg font-bold">${{ number_format($product->price,2) }}</span>
            <div class="text-xs text-gray-500">{{ $product->category }}</div>
          </div>
          <div class="text-right">
            <a href="{{ route('products.show', $product) }}" class="text-blue-600 text-sm">View</a>
          </div>
        </div>
      </div>
    </div>
  @empty
    <div class="col-span-full text-center text-gray-500">No products found.</div>
  @endforelse
</div>

<div class="mt-6">
  {{ $products->links() }}
</div>
@endsection
