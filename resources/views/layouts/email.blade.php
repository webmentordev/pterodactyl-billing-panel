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

    <!-- Scripts -->
    @vite(['resources/css/email.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased ">
    <div class="min-h-screen py-12 flex flex-col sm:justify-center items-center bg-dark px-3">
        <div
            class="w-full mb-5 max-w-lg mt-6 px-8 py-4 overflow-hidden sm:rounded-lg bg-dark-100 border border-white/10">
            <div class="w-full flex items-center justify-center">
                <a href="/">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="140px">
                </a>
            </div>
            @yield('content')
        </div>
        <p class="mt-3 text-gray-400 text-sm text-center">Copyrights &copy; {{ date('Y') }} {{ config('app.name') }}
            <br> All
            rights reserved!
        </p>
    </div>
</body>

</html>
