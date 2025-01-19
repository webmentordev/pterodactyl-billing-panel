<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://unpkg.com/alpinejs" defer></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <x-navigation />
    <div class="min-h-screen relative flex flex-col justify-center items-center pt-6 bg-cover bg-center"
        style="background-image: url({{ asset('assets/errors-page-background.webp') }})">
        <div class="top-0 left-0 w-full h-full absolute bgGradient"></div>
        <main class="relative z-10">
            @yield('content')
        </main>
    </div>
    <x-footer />
</body>

</html>
