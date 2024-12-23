<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="h-screen p-3">
        <div class="flex h-full">
            @include('components.admin.navigation')
            <main class="w-full overflow-y-scroll ml-3 bg-dark-100 border border-white/10 rounded-lg p-3">
                {{ $slot }}
            </main>
        </div>
    </div>
    @livewireScripts
</body>

</html>
