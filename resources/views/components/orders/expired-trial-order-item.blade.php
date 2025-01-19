@props(['order'])
<div
    class="mb-3 bg-dark-100 rounded-xl border border-rust p-4 text-white border-r-8 border-r-rust flex justify-between items-center">
    <div class="flex items-center">
        <div class="mr-3">
            <img src="{{ asset('assets/rust-logo.png') }}" width="45" class="rounded-full">
        </div>
        <div>
            <p class="text-sm mb-1"><strong class="text-rust">Trial OrderID#</strong> {{ $order->id }}</p>
            <p class="text-sm text-gray-200">This free Rust server trial has ended. Each account is allowed only one free
                Rust server trial.</p>
        </div>
    </div>
    <div>
        <div class="flex flex-col text-end">
            <span class="font-bold text-lg text-rust py-2 px-4 rounded-lg bg-rust/10 border border-rust">Trial
                Ended</span>
        </div>
    </div>
</div>
