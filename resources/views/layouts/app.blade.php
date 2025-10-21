<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title', 'Products')</title>
  @vite(['resources/css/app.css','resources/js/app.js']) {{-- assuming Vite --}}
</head>
<body class="bg-gray-100 text-gray-900">
  <div class="min-h-screen">
    <nav class="bg-white border-b">
      <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ route('products.index') }}" class="font-bold text-xl">Products Lab</a>
        <a href="{{ route('products.create') }}" class="px-3 py-1 bg-blue-600 text-white rounded">Add Product</a>
      </div>
    </nav>
    <main class="max-w-7xl mx-auto p-4">
      @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-800 rounded">
          {{ session('success') }}
        </div>
      @endif

      @yield('content')
    </main>
  </div>
</body>
</html>
