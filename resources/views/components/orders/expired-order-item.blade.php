@props(['order'])
<div
    class="mb-3 bg-dark-100 rounded-xl border border-rust p-4 text-white border-r-8 border-r-rust flex justify-between items-center">
    <div class="flex items-center">
        <div class="mr-3">
            <img src="{{ asset('assets/rust-logo.png') }}" width="45" class="rounded-full">
        </div>
        <div>
            <p class="text-sm mb-1"><strong class="text-rust">OrderID#</strong> {{ $order->id }}</p>
            <p class="text-sm text-gray-200">This order has expired. The expiration occurred
                {{ $order->expire_at->diffForHumans() }} on {{ $order->expire_at->format('D d M, Y H:i:s A') }} UTC.</p>
        </div>
    </div>
    <div>
        <div class="flex flex-col text-end">
            <span class="font-bold text-lg text-rust py-2 px-4 rounded-lg bg-rust/10 border border-rust">Expired</span>
        </div>
    </div>
</div>
