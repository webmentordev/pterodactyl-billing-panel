<nav class="w-full bg-white rounded-lg p-3 border border-gray-200 mb-3">
    <div class="flex items-center justify-between">
        @if (auth()->user()->google_avatar)
            <a href="{{ route('home') }}"><img src="{{ auth()->user()->google_avatar }}" class="rounded-full"
                    width="40"></a>
        @else
            <a href="{{ route('home') }}"><img src="{{ asset('assets/logo.png') }}" alt="" width="40"></a>
        @endif

        <ul class="flex items-center">
            <a href="#" class="mx-6">Dashboard</a>
            <a href="#" class="mx-6">Servers</a>
            <a href="#" class="mx-6">Billing</a>
        </ul>

        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="text-white bg-black rounded-sm py-2 px-5 font-semibold">Logout</button>
        </form>
    </div>
</nav>
