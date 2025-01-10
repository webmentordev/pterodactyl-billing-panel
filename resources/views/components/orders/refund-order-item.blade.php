@props(['order'])
<div
    class="mb-3 bg-dark-100 rounded-xl border border-rust p-4 text-white border-r-8 border-r-rust flex justify-between items-center">
    <div class="flex items-center">
        <div class="mr-3">
            <img src="{{ asset('assets/rust-logo.png') }}" width="45" class="rounded-full">
        </div>
        <div>
            <p class="text-sm mb-1"><strong class="text-rust">OrderID#</strong> {{ $order->id }}</p>
            <p class="text-sm text-gray-200">This order has been refunded. Refunds usuall take up to 10 days to
                appear on your statement. Contact support <br> if you encounter any issues. Read <a
                    href="{{ route('refund') }}" class="text-rust underline" target="_blank">our refund
                    policy</a>.</p>
        </div>
    </div>
    <div>
        <div class="flex flex-col text-end">
            <p>${{ $order->price }} - <span class="font-bold text-lg text-rust-green">Paid</span></p>
            <p>${{ $order->refund->amount }} - <span class="font-bold text-lg text-indigo-500">Refunded</span>
            </p>
        </div>
    </div>
</div>
