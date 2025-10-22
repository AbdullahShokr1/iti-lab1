<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'المتجر الإلكتروني' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white dark:bg-slate-950 text-slate-900 dark:text-slate-200">

    <!-- Include Header -->
    @include('partials.header')

    <!-- Main Content -->
    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <!-- Include Footer -->
    @include('partials.footer')

    @vite('resources/js/app.js')
</body>
</html>
