<nav class="w-full bg-dark-100 rounded-lg p-3 border h-full border-white/10 mb-3 flex flex-col max-w-[220px]">
    <div class="flex justify-center">
        @if (auth()->user()->google_avatar)
            <a href="{{ route('home') }}"><img src="{{ auth()->user()->google_avatar }}" class="rounded-full"
                    width="70"></a>
        @else
            <a href="{{ route('home') }}"><img src="{{ asset('assets/rust-dedicated-hosting-logo.png') }}" alt=""
                    width="70"></a>
        @endif
    </div>

    <ul class="flex flex-col my-8 h-full text-white font-bold">
        <a href="{{ route('admin.dashboard') }}" class="py-3 w-full pl-5 flex items-center rounded-sm"
            wire:current="bg-dark"><img
                src="https://api.iconify.design/material-symbols:dashboard-customize-rounded.svg?color=%23FFFFFF"
                width="20px" class="mr-3"><span>Dashboard</span></a>
        <a href="{{ route('admin.users') }}" class="py-3 w-full pl-5 flex items-center rounded-sm"
            wire:current="bg-dark"><img
                src="https://api.iconify.design/material-symbols:account-circle.svg?color=%23FFFFFF" width="20px"
                class="mr-3"><span>Users</span></a>
        <a href="{{ route('admin.servers') }}" class="py-3 w-full pl-5 flex items-center rounded-sm"
            wire:current="bg-dark"><img src="https://api.iconify.design/solar:server-outline.svg?color=%23FFFFFF"
                width="20px" class="mr-3"><span>Servers</span></a>
        <a href="{{ route('admin.orders') }}" class="py-3 w-full pl-5 flex items-center rounded-sm"
            wire:current="bg-dark"><img src="https://api.iconify.design/carbon:delivery-parcel.svg?color=%23ffffff"
                width="20px" class="mr-3"><span>Orders</span></a>
        <a href="{{ route('admin.billing') }}" class="py-3 w-full pl-5 flex items-center rounded-sm"
            wire:current="bg-dark"><img src="https://api.iconify.design/solar:bill-list-outline.svg?color=%23FFFFFF"
                width="20px" class="mr-3"><span>Billings</span></a>
        <a href="{{ route('admin.refunds') }}" class="py-3 w-full pl-5 flex items-center rounded-sm"
            wire:current="bg-dark"><img src="https://api.iconify.design/heroicons:receipt-refund.svg?color=%23ffffff"
                width="20px" class="mr-3"><span>Refunds</span></a>
        <a href="{{ route('admin.reminders') }}" class="py-3 w-full pl-5 flex items-center rounded-sm"
            wire:current="bg-dark"><img
                src="https://api.iconify.design/material-symbols:brightness-alert-outline-rounded.svg?color=%23ffffff"
                width="20px" class="mr-3"><span>Reminders</span></a>
        <a href="{{ route('dashboard') }}" class="py-3 w-full pl-5 flex items-center rounded-sm"
            wire:current="bg-dark"><img src="https://api.iconify.design/ic:baseline-manage-accounts.svg?color=%23ffffff"
                width="20px" class="mr-3"><span>Client Area</span></a>

    </ul>

    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button class="text-white bg-rust rounded-sm py-2 px-5 w-full font-semibold">Logout</button>
    </form>
</nav>
