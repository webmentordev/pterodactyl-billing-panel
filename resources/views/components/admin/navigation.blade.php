<nav class="w-full bg-dark-100 rounded-lg p-3 border h-full border-white/10 mb-3 flex flex-col max-w-[220px] px-4">
    <div class="flex justify-center">
        @if (auth()->user()->google_avatar)
            <a href="{{ route('home') }}"><img src="{{ auth()->user()->google_avatar }}" class="rounded-full"
                    width="70"></a>
        @else
            <a href="{{ route('home') }}"><img src="{{ asset('assets/rust-dedicated-favicon.png') }}" alt=""
                    width="70"></a>
        @endif
    </div>

    <ul class="flex flex-col my-8 h-full text-white font-bold">
        <a href="{{ route('admin.dashboard') }}" class="py-3 w-full pl-5 flex items-center rounded-sm"
            wire:current="bg-dark"><iconify-icon icon="material-symbols:dashboard-customize-rounded" width="20px"
                class="mr-3 text-white"></iconify-icon><span>Dashboard</span></a>
        <a href="{{ route('admin.users') }}" class="py-3 w-full pl-5 flex items-center rounded-sm"
            wire:current="bg-dark"><iconify-icon icon="material-symbols:account-circle" width="20px"
                class="mr-3 text-white"></iconify-icon><span>Users</span></a>
        <a href="{{ route('admin.servers') }}" class="py-3 w-full pl-5 flex items-center rounded-sm"
            wire:current="bg-dark"><iconify-icon icon="solar:server-outline" width="20px"
                class="mr-3 text-white"></iconify-icon><span>Servers</span></a>
        <a href="{{ route('admin.orders') }}" class="py-3 w-full pl-5 flex items-center rounded-sm"
            wire:current="bg-dark"><iconify-icon icon="carbon:delivery-parcel" width="20px"
                class="mr-3 text-white"></iconify-icon><span>Orders</span></a>
        <a href="{{ route('admin.billing') }}" class="py-3 w-full pl-5 flex items-center rounded-sm"
            wire:current="bg-dark"><iconify-icon icon="solar:bill-list-outline" width="20px"
                class="mr-3 text-white"></iconify-icon><span>Billings</span></a>
        <a href="{{ route('admin.refunds') }}" class="py-3 w-full pl-5 flex items-center rounded-sm"
            wire:current="bg-dark"><iconify-icon icon="heroicons:receipt-refund" width="20px"
                class="mr-3 text-white"></iconify-icon><span>Refunds</span></a>
        <a href="{{ route('admin.reviews') }}" class="py-3 w-full pl-5 flex items-center rounded-sm"
            wire:current="bg-dark"><iconify-icon icon="material-symbols:reviews-outline-sharp" width="20px"
                class="mr-3 text-white"></iconify-icon><span>Reviews</span></a>
        <a href="{{ route('admin.reminders') }}" class="py-3 w-full pl-5 flex items-center rounded-sm"
            wire:current="bg-dark"><iconify-icon icon="material-symbols:brightness-alert-outline-rounded" width="20px"
                class="mr-3 text-white"></iconify-icon><span>Reminders</span></a>
        <a href="{{ route('admin.trails') }}" class="py-3 w-full pl-5 flex items-center rounded-sm"
            wire:current="bg-dark"><iconify-icon icon="carbon:global-loan-and-trial" width="20px"
                class="mr-3 text-white"></iconify-icon><span>Trials</span></a>
        <a href="{{ route('dashboard') }}" class="py-3 w-full pl-5 flex items-center rounded-sm"
            wire:current="bg-dark"><iconify-icon icon="ic:baseline-manage-accounts" width="20px"
                class="mr-3 text-white"></iconify-icon><span>Client Area</span></a>
        <a href="{{ route('admin.emails') }}" class="py-3 w-full pl-5 flex items-center rounded-sm"
            wire:current="bg-dark"><iconify-icon icon="tabler:mail-opened" width="20px"
                class="mr-3 text-white"></iconify-icon><span>Custom Emails</span></a>

    </ul>

    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button class="text-white bg-rust rounded-sm py-2 px-5 w-full font-semibold">Logout</button>
    </form>
</nav>
