<nav class="fixed top-3 w-full z-50">
    <div class="bg-dark-100/90 rounded-lg p-2 border border-white/20 backdrop-blur max-w-7xl m-auto">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}"><img src="{{ asset('assets/logo.png') }}" alt="" width="50"></a>
            <ul class="flex items-center text-white links">
                <a href="{{ route('home') }}" class="mx-6">Home</a>
                <a href="{{ route('package') }}" class="mx-6">Package</a>
                <a href="{{ config('app.ptero_domain') }}" class="mx-6">GamePanel</a>
                <a href="{{ route('dashboard') }}" class="mx-6">Client</a>
                <a href="https://discord.gg/5XFteSutRK" target="_blank" class="mx-6">Discord</a>
                @auth
                    @if (Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="mx-6">Dashboard</a>
                    @endif
                @endauth
            </ul>

            @auth
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="text-white bg-rust py-2 px-5 font-semibold rounded-lg">Logout</button>
                </form>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="text-white bg-rust rounded-2xl py-2 px-5 font-semibold">Login</a>
            @endguest
        </div>
    </div>
</nav>
