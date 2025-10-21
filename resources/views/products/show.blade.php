<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $product['name'] }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-6">

    <a href="/products" class="text-blue-600 hover:underline mb-6 inline-block">&larr; Back to Products</a>

    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <img src="{{ asset('images/' . $product['image']) }}" 
             onerror="this.src='https://picsum.photos/200/300'" 
             class="w-full h-64 object-cover rounded mb-4">
        <h1 class="text-3xl font-bold mb-2">{{ $product['name'] }}</h1>
        <p class="text-gray-600 mb-2">Category: {{ $product['category'] }}</p>
        <p class="text-blue-600 text-2xl font-semibold mb-4">${{ number_format($product['price'], 2) }}</p>
    </div>

</body>
</html>
