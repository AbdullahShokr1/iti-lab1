<div class="product-card bg-white shadow hover:shadow-lg rounded overflow-hidden" data-name="{{ strtolower($product['name']) }}">
    <img src="{{ asset('images/' . $product['image']) }}" 
         onerror="this.src='https://via.placeholder.com/300x200?text=No+Image'" 
         class="w-full h-48 object-cover">
    <div class="p-4">
        <h2 class="font-semibold text-lg">{{ $product['name'] }}</h2>
        <p class="text-gray-600">{{ $product['category'] }}</p>
        <p class="text-blue-600 font-bold mt-2">${{ number_format($product['price'], 2) }}</p>
        <a href="/products/{{ $product['id'] }}" class="mt-3 inline-block text-sm text-blue-500 hover:underline">View details</a>
    </div>
</div>
