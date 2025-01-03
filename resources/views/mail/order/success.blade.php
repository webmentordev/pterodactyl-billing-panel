@extends('layouts.email')
@section('content')
    <section class="text-white email text-sm">
        <h1 class="text-white mb-2 text-3xl items-center 360px:text-2xl inline-block mt-3">🎉Purchasing Your Rust Game
            Hosting🎉
        </h1>
        <p class="mb-2">Dear <strong class="text-rust">{{ $order->user->name }}</strong>,</p>
        <p class="mb-2">We’re thrilled to see you take the next step in your gaming journey! With your new Rust game
            hosting, you're all
            set for an incredible multiplayer experience. </p>
        <p>Get ready to build, survive, and thrive in the world of Rust with
            a fast, reliable, and customizable server. We wish you endless hours of fun and unforgettable moments with your
            friends and fellow players. Happy gaming!</p>
        <code class="mt-5 mb-4 bg-rust w-full p-3 inline-block text-center font-bold">ORDERID# {{ $order->id }}</code>

        @if ($password)
            <div class="border border-white/10 rounded-md mb-5">
                <div class="flex justify-between p-3">
                    <span>Game Panel</span>
                    <span><a href="{{ config('app.ptero_domain') }}" class="underline text-rust" target="_blank">Access
                            Here</a></span>
                </div>
                <div class="flex justify-between p-3 border-y border-white/10">
                    <span>Email</span>
                    <span>{{ $order->user->email }}</span>
                </div>
                <div class="flex justify-between p-3">
                    <span>Password</span>
                    <span>{{ $password }}</span>
                </div>
            </div>
        @endif

        <p class="mb-1">We’re here to support you along the way, so if you need any assistance or have questions, feel
            free
            to reach out.
            Here’s to many exciting adventures in Rust!</p>
        <p class="mb-1">Happy gaming and welcome to the community!</p>
        <p class="mb-1">Best regards,</p>
        <strong class="mt-7 text-rust">{{ config('app.name') }}</strong>
    </section>
@endsection
