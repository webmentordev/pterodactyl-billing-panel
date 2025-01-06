@props(['order'])
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
                <img src="https://api.iconify.design/uil:processor.svg?color=%23cd412b" width="18" class="mr-2">
                @if ($order->usage)
                    {{ $order->usage->server->processor }}
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
                        {{ $order->usage->server->ip }}:{{ $order->usage->server_port }}
                    @else
                        -
                    @endif
                </p>
            </div>
            <div class="flex items-center">
                <img src="https://api.iconify.design/mdi:ethernet.svg?color=%235d7239" width="20">
                <p class="ml-2 text-sm text-gray-300">
                    @if ($order->usage)
                        {{ $order->usage->query_port }} / {{ $order->usage->app_port }} /
                        {{ $order->usage->rcon_port }}
                    @else
                        -
                    @endif
                </p>
            </div>
        </div>
    </div>
    <div>
        <div class="flex flex-col">
            <div class="flex items-center mb-2">
                <p class="mr-2 text-sm text-gray-300">
                    @if ($order->expire_at)
                        {{ $order->expire_at->format('d M, Y H:i:s A') }}
                    @endif
                </p>
                <img src="https://api.iconify.design/tabler:calendar-due.svg?color=%23cd412b" width="20">
            </div>
            <button wire:click='renew("{{ $order->id }}")'
                class="bg-rust-green py-2 px-3 rounded-lg font-semibold transition-all hover:bg-rust">
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
