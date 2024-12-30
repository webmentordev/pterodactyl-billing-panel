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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen relative flex flex-col justify-center items-center pt-6 bg-cover bg-center"
        style="background-image: url({{ asset('assets/background/header_2.jpg') }})">
        <div class="absolute w-full h-full top-0 left-0 bg-dark/30 backdrop-blur-sm"></div>
        <div class="relative z-20 flex flex-col items-center max-w-lg w-full">
            <div>
                <a href="/">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="140px">
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg bg-dark-100">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
