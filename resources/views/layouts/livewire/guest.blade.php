<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/rust-dedicated-favicon.png') }}" type="image/x-icon">

    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}

    @production
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-4JHNXFWX2E"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'G-4JHNXFWX2E');
        </script>
    @endproduction

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased" x-data="{ open: true }">
    <a href="https://github.com/webmentordev/pterodactyl-billing-panel/" target="_blank" rel="nofollow"
        class="fixed bottom-3 right-3 z-50">
        <img src="https://api.iconify.design/skill-icons:github-dark.svg" alt="RustDedicated Hosting Code"
            width="50"></a>
    <x-navigation />
    <main>
        {{ $slot }}
    </main>
    <x-footer />
    @livewireScripts
</body>

</html>