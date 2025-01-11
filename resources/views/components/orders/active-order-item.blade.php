@props(['order', 'refund', 'days'])
<div
    class="mb-3 bg-dark-100 rounded-xl border border-white/20 p-4 text-white border-r-8 border-r-green-500 flex justify-between items-center">
    <div class="flex items-center">
        <div class="mr-3">
            <img src="{{ asset('assets/rust-logo.png') }}" width="45" class="rounded-full">
        </div>
        <div>
            <p class="text-sm mb-1"><strong class="text-rust">OrderID#</strong> - {{ $order->id }}
            </p>
            <p class="text-sm flex items-center text-gray-200">
                <img src="https://api.iconify.design/uil:processor.svg?color=%23cd412b" width="20" class="mr-2">
                @if ($order->usage)
                    <code class="border-r border-white/10 pr-3">{{ $order->usage->server->processor }}</code>
                    <img src="https://api.iconify.design/fluent-emoji:thread.svg" width="18" class="mx-2"
                        title="CPU Threads Number">
                    <span title="CPU Threads Number">{{ $order->usage->cpu_pin_1 }} &
                        {{ $order->usage->cpu_pin_2 }}</span>
                @else
                    -
                @endif
            </p>
        </div>
    </div>
    <div>
        <div class="flex flex-col pr-4 border-r border-white/10">
            <div class="flex items-center mb-1">
                <img src="https://api.iconify.design/iconoir:ip-address-tag.svg?color=%23cd412b" width="20">
                <p class="ml-2 text-sm text-gray-300">
                    @if ($order->usage)
                        <code>{{ $order->usage->server->ip }}:{{ $order->usage->server_port }}</code>
                    @else
                        -
                    @endif
                </p>
            </div>
            <div class="flex items-center">
                <img src="https://api.iconify.design/mdi:ethernet.svg?color=%235d7239" width="20">
                <p class="ml-2 text-sm text-gray-300">
                    @if ($order->usage)
                        <code>{{ $order->usage->query_port }} / {{ $order->usage->app_port }} /
                            {{ $order->usage->rcon_port }}</code>
                    @else
                        -
                    @endif
                </p>
            </div>
        </div>
    </div>
    <div>
        @if (!$order->refund)
            <div class="flex flex-col" x-data="{ open: false }">
                <div class="flex items-center justify-end mb-2">
                    <p class="mr-2 text-sm text-gray-300">
                        @if ($order->expire_at)
                            {{ $order->expire_at->format('d M, Y H:i:s A') }}
                        @endif
                    </p>
                    <img src="https://api.iconify.design/tabler:calendar-due.svg?color=%23cd412b" width="20">
                </div>
                @php
                    $refundDate = \Carbon\Carbon::parse($order->refund_at);
                    $expireDate = \Carbon\Carbon::parse($order->expire_at)->subDays(7);
                @endphp
                @if (!$refundDate->isPast())
                    <button @click="open = true"
                        class="bg-rust py-2 px-3 rounded-lg font-semibold transition-all hover:bg-rust {{ !now()->greaterThan($expireDate) ? 'col-span-2' : '' }}">
                        Request Refund
                    </button>
                    <div x-show="open" x-cloak x-transition x-on:click.self="open = false"
                        class="fixed top-0 left-0 w-full h-full z-30 bg-dark/70 backdrop-blur-md flex items-center justify-center">
                        <div class="bg-dark-100 p-5 rounded-lg border border-white/10 max-w-lg w-full flex-col">
                            @session('refund')
                                <x-alerts.success :message="$value" />
                            @endsession
                            <p class="text-white font-bold text-2xl mb-6">Are you sure you want to request a refund?
                            </p>
                            <p class="text-gray-200 mb-3">If you confirm the initiation of the refund, the server
                                associated with this order will be deleted along with its backups, database,
                                plugins,
                                configurations, and any files you have stored using FTP.</p>
                            <p class="text-gray-200 mb-3">As part of our refund policy, <strong
                                    class="text-rust">{{ $refund }}%</strong> of the paid amount is eligible
                                for
                                a
                                refund within <strong class="text-rust">{{ $days * 24 }} Hours</strong> of the
                                purchase
                                or order
                                renewal, to prevent refund abuse. Please read <a href="{{ route('refund') }}"
                                    class="text-rust underline">Our Refund Policy</a> for more details. </p>
                            <button @click="open = true" wire:click='refund("{{ $order->id }}")'
                                class="bg-rust-green py-2 px-3 rounded-lg font-semibold transition-all hover:bg-rust">
                                <div wire:target="refund" wire:loading.class="hidden">
                                    Confirm: I want to request a refund
                                </div>
                                <div wire:target="refund" wire:loading>
                                    Processing...
                                </div>
                            </button>
                            <p class="mt-3 border border-rust bg-rust/10 text-white p-3 rounded-lg">Refunds usually
                                take
                                up
                                to 10 business
                                days to appear on your
                                statement.</p>
                        </div>
                    </div>
                @else
                    <button wire:click='renew("{{ $order->id }}")'
                        class="bg-rust-green py-2 px-3 rounded-lg font-semibold transition-all hover:bg-rust">
                        <div wire:target="renew" wire:loading.class="hidden">
                            Renew
                        </div>
                        <div wire:target="renew" wire:loading>
                            Processing...
                        </div>
                    </button>
                @endif
            </div>
        @endif

        @if ($order->refund)
            <div class="flex flex-col" x-data="{ open: false }">
                <div class="flex items-center justify-end mb-2">
                    <p class="mr-2 text-sm text-gray-300">
                        @if ($order->expire_at)
                            {{ $order->expire_at->format('d M, Y H:i:s A') }}
                        @endif
                    </p>
                    <img src="https://api.iconify.design/tabler:calendar-due.svg?color=%23cd412b" width="20">
                </div>
                @php
                    $refundDate = \Carbon\Carbon::parse($order->refund_at);
                    $expireDate = \Carbon\Carbon::parse($order->expire_at)->subDays(7);
                @endphp
                <button @click="open = true"
                    class="bg-indigo-600 py-2 px-3 rounded-lg font-semibold transition-all hover:bg-dark {{ !now()->greaterThan($expireDate) ? 'col-span-2' : '' }}">
                    Cancel Refund Request
                </button>
                <div x-show="open" x-cloak x-transition x-on:click.self="open = false"
                    class="fixed top-0 left-0 w-full h-full z-30 bg-dark/70 backdrop-blur-md flex items-center justify-center">
                    <div class="bg-dark-100 p-5 rounded-lg border border-white/10 max-w-lg w-full flex-col">
                        <p class="text-white font-bold text-2xl mb-6">Are you sure you want to cancel your refund
                            request?
                        </p>
                        <p class="text-gray-200 mb-3">Your service has not been canceled yet. You can cancel the
                            refund
                            request at any time before it is accepted by the owner.</p>
                        <p class="text-gray-200 mb-3">For more information, please read <a href="{{ route('refund') }}"
                                class="text-rust underline mb-2">Our Refund
                                Policy</a></p>
                        <button @click="open = true" wire:click='cancel("{{ $order->id }}")'
                            class="bg-rust-green inline-block mt-1 py-2 px-3 rounded-lg font-semibold transition-all hover:bg-rust w-full">
                            <div wire:target="cancel" wire:loading.class="hidden">
                                Confirm: I want to cancel refund request
                            </div>
                            <div wire:target="cancel" wire:loading>
                                Processing...
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
