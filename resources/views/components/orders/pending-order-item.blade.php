@props(['order'])
<div
    class="mb-3 bg-dark-100 rounded-xl border border-yellow-300 p-4 text-white border-r-8 border-r-yellow-300 flex justify-between items-center">
    <div class="flex items-center">
        <div class="mr-3">
            <img src="{{ asset('assets/rust-logo.png') }}" width="45" class="rounded-full">
        </div>
        <div>
            <p class="text-sm mb-1"><strong class="text-rust">OrderID#</strong> - {{ $order->id }}
            </p>
            <p class="text-sm flex items-center text-gray-200">Your payment is pending. Please complete the transaction
                to <br> proceed with server creation.
            </p>
        </div>
    </div>
    <div>
        <div class="flex flex-col">
            <div class="flex items-center mb-2">
                <p class="mr-2 text-sm text-gray-300">
                    <strong class="text-rust">EXPIRE AT </strong> -
                    {{ $order->created_at->addHours(3)->format('d M, Y H:i:s A') }}
                </p>
            </div>
            <button wire:click='pay("{{ $order->id }}")'
                class="bg-yellow-300 text-black py-2 px-3 rounded-lg font-bold transition-all hover:bg-rust hover:text-white">
                <div wire:target="pay" wire:loading.class="hidden">
                    Pay Now
                </div>
                <div wire:target="pay" wire:loading>
                    Processing...
                </div>
            </button>
        </div>
    </div>
</div>
