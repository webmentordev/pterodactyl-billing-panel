@extends('layouts.email')
@section('content')
    <section class="text-white email">
        <div class="flex items-center justify-center">
            <h1 class="text-white mb-2 text-3xl items-center 360px:text-2xl inline-block mt-3 text-center">🤟 Servers are
                back
                in-stock 🤟
            </h1>
        </div>
        <p class="mb-3">We’re excited to announce that Rust servers are back in stock and ready for you to start your next
            adventure! </p>

        <p class="mb-2 text-lg font-semibold">Why choose our Rust servers?</p>
        <ul class="mb-5 list-disc ml-4">
            <li>Optimal performance for smooth gameplay.</li>
            <li>Get started with minimal to no effort.</li>
            <li>Flexible plans that grow with your needs.</li>
            <li>Click below to order now and join the action!</li>
        </ul>

        <div class="w-full flex items-center justify-center mb-3">
            <a href="{{ route('package') }}" target="_blank"
                class="bg-rust-green w-full font-bold py-2 text-center rounded-md">Order
                Now</a>
        </div>

        <p class="mb-4">If you have any questions or need assistance, feel free to reply to this email. We're always here
            to help!</p>

        <p class="mb-1">See you on the battlefield!</p>
        <p class="mb-1">Best regards,</p>
        <strong class="mt-7 text-rust underline"><a href="{{ route('home') }}">{{ config('app.name') }}</a></strong>
        <address>{{ config('app.mail_address') }}</address>
    </section>
@endsection
