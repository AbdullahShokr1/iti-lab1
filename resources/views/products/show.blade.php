@extends('layouts.app')
@section('title',$product->name)
@section('content')
<div class="bg-white rounded shadow p-6">
  <div class="flex flex-col md:flex-row gap-6">
    <div class="md:w-1/3 bg-gray-50 p-4 flex items-center justify-center">
      @if($product->image_url)
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="max-h-96 object-contain">
      @else
        <div class="text-gray-400">No image</div>
      @endif
    </div>
    <div class="md:flex-1">
      <h1 class="text-2xl font-bold">{{ $product->name }}</h1>
      <p class="mt-3 text-gray-700">{{ $product->description }}</p>
      <div class="mt-4">
        <span class="text-2xl font-bold">${{ number_format($product->price,2) }}</span>
        <div class="text-sm text-gray-500">Category: {{ $product->category }}</div>
        <div class="text-sm text-gray-500">Stock: {{ $product->stock_quantity }}</div>
        <div class="text-sm mt-2">
          Status:
          @if($product->is_active)
            <span class="text-green-600 font-semibold">Active</span>
          @else
            <span class="text-red-600 font-semibold">Inactive</span>
          @endif
        </div>
      </div>

      <div class="mt-6 flex gap-2">
        <a href="{{ route('products.edit', $product) }}" class="px-3 py-2 bg-yellow-500 text-white rounded">Edit</a>

        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product?')">
          @csrf
          @method('DELETE')
          <button class="px-3 py-2 bg-red-600 text-white rounded">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
