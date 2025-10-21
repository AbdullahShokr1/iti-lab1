<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Product</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-6">

    <a href="/products" class="text-blue-600 hover:underline mb-6 inline-block">&larr; Back to Products</a>

    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Create Product</h1>
        <form method="POST" action="" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium">Name</label>
                <input type="text" name="name" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block font-medium">Category</label>
                <input type="text" name="category" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block font-medium">Price</label>
                <input type="number" step="0.01" name="price" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block font-medium">Image Filename</label>
                <input type="text" name="image" placeholder="e.g. product.jpg" class="w-full border rounded p-2">
            </div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Submit</button>
        </form>
    </div>

</body>
</html>
