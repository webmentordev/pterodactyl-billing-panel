@props(['order'])
<div
    class="mb-3 bg-dark-100 rounded-xl border border-white/20 p-4 text-white border-r-8 border-r-green-500 flex justify-between items-center">
    <div class="flex items-center">
        <div class="mr-3">
            <img src="{{ asset('assets/rust-logo.png') }}" width="45" class="rounded-full">
        </div>
        <div>
            <p class="text-sm mb-1"><strong class="text-rust">OrderID#</strong></p>
            <p class="text-sm mb-1">{{ $order->id }}</p>
        </div>
    </div>
    <div>
        <div class="flex flex-col text-end">
            <h3 class="text-l">Status</h3>
            <p class="font-bold text-lg text-rust">Canceled </p>
        </div>
    </div>
</div>
