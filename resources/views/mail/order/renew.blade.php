@extends('layouts.email')
@section('content')
    <section class="text-white email">
        <div class="flex items-center justify-center">
            <h1 class="text-white mb-2 text-3xl items-center 360px:text-2xl inline-block mt-3 text-center">Order has been
                renewed
            </h1>
        </div>
        <p class="mb-3">We’re pleased to inform you that your Rust server has been successfully renewed, and the expiration
            date has been extended.
        </p>

        <code class="mt-5 mb-4 bg-rust w-full p-3 inline-block text-center font-bold">ORDERID# {{ $order->id }}</code>

        <div class="border border-white/10 rounded-md mb-5">
            <div class="flex justify-between p-3">
                <span class="text-sm">Next Expire Date</span>
                <span class="text-sm">{{ $order->expire_at->format('D d M, Y h:i:s A') }} UTC</span>
            </div>
        </div>

        <p class="mb-4">If you have any questions or need assistance, feel free to reply to this email. We're always here
            to help!</p>

        <p class="mb-1">See you on the battlefield!</p>
        <p class="mb-1">Best regards,</p>
        <strong class="mt-7 text-rust underline"><a href="{{ route('home') }}">{{ config('app.name') }}</a></strong>
        <address>{{ config('app.mail_address') }}</address>
    </section>
@endsection
