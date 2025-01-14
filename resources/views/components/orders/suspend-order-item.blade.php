@props(['order', 'refund', 'days'])
<div
    class="mb-3 bg-dark-100 rounded-xl border border-blue-500 p-4 text-white border-r-8 border-r-blue-500 flex justify-between items-center">
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
        <div class="flex flex-col" x-data="{ open: false }">
            <span class="text-lg mb-1"><strong class="text-rust">Status:</strong> Suspended</span>
            <button wire:click='renew("{{ $order->id }}")'
                class="bg-blue-500 py-2 px-3 rounded-lg font-semibold transition-all hover:bg-rust">
                <div wire:target="renew" wire:loading.class="hidden">
                    Renew
                </div>
                <div wire:target="renew" wire:loading>
                    Processing...
                </div>
            </button>
        </div>
    </div>
</div>
