<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Products</h1>
        <a href="/products/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create Product</a>
    </div>

    <input id="search" type="text" placeholder="Search products..." class="w-full p-2 mb-6 border rounded" />

    <div id="products" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="product-card bg-white shadow hover:shadow-lg rounded overflow-hidden" data-name="{{ strtolower($product['name']) }}">
                <img src="{{ asset('images/' . $product['image']) }}" 
                     onerror="this.src='https://picsum.photos/200/300'" 
                     class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="font-semibold text-lg">{{ $product['name'] }}</h2>
                    <p class="text-gray-600">{{ $product['category'] }}</p>
                    <p class="text-blue-600 font-bold mt-2">${{ number_format($product['price'], 2) }}</p>
                    <a href="/products/{{ $product['id'] }}" class="mt-3 inline-block text-sm text-blue-500 hover:underline">View details</a>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        const searchInput = document.getElementById('search');
        searchInput.addEventListener('input', () => {
            const query = searchInput.value.toLowerCase();
            document.querySelectorAll('.product-card').forEach(card => {
                card.style.display = card.dataset.name.includes(query) ? '' : 'none';
            });
        });
    </script>

</body>
</html>
