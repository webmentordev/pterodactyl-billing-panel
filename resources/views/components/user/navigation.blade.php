<nav class="w-full">
    <div class="bg-dark-100/90 rounded-full p-2 border border-white/20 backdrop-blur max-w-7xl m-auto">
        <div class="flex items-center justify-between">
            @if (auth()->user()->google_avatar)
                <a href="{{ route('home') }}"><img src="{{ auth()->user()->google_avatar }}" class="rounded-full"
                        width="40"></a>
            @else
                <a href="{{ route('home') }}"><img src="{{ asset('assets/logo.png') }}" width="40"></a>
            @endif

            <ul class="flex items-center text-white font-semibold">
                <a href="{{ route('dashboard') }}" class="mx-6">Dashboard</a>
                <a href="{{ route('billings') }}" class="mx-6">Billing</a>
            </ul>

            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="text-black bg-white py-2 px-5 font-bold rounded-full">Logout</button>
            </form>
        </div>
    </div>
</nav>
