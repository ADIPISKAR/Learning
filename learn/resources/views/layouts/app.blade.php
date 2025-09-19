<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Навигация -->
    <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-gray-800">{{ config('app.name', 'Laravel') }}</a>
            <nav>
                <a href="{{ route('users.index') }}" class="text-gray-600 hover:text-gray-800 px-3">Пользователи</a>
            </nav>
        </div>
    </header>

    <!-- Основной контент -->
    <main class="flex-1 max-w-7xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- Подвал -->
    <footer class="bg-white shadow-inner mt-10">
        <div class="max-w-7xl mx-auto px-4 py-4 text-gray-500 text-sm text-center">
            &copy; {{ date('Y') }} {{ config('app.name') }}. Все права защищены.
        </div>
    </footer>

</body>
</html>
