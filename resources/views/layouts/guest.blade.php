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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"
        integrity="sha512-q583ppKrCRc7N5O0n2nzUiJ+suUv7Et1JGels4bXOaMFQcamPk9HjdUknZuuFjBNs7tsMuadge5k9RzdmO+1GQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <x-navigation />
    <div class="min-h-screen relative flex flex-col justify-center items-center pt-6 bg-cover bg-center"
        style="background-image: url({{ asset('assets/background/rustdedicated-hosting-login-image.webp') }})">
        <div class="absolute w-full h-full top-0 left-0 bg-dark/30 backdrop-blur-sm"></div>
        <div class="relative z-20 flex flex-col items-center max-w-lg w-full px-2">
            <div class="w-full mt-6 px-6 py-4 shadow-md overflow-hidden rounded-lg bg-dark-100">
                {{ $slot }}
            </div>
        </div>
    </div>
    <x-footer />
</body>

</html>
