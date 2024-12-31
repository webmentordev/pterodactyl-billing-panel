<nav class="fixed top-3 w-full z-50">
    <div class="bg-dark-100/90 rounded-full p-2 border border-white/20 backdrop-blur max-w-7xl m-auto">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center"><img
                    src="{{ asset('assets/rust-dedicated-hosting-logo.png') }}" alt="" width="40">
                <strong class="text-white text-2xl ml-3">RustDedicated</strong>
            </a>
            <ul class="flex items-center text-white links">
                <a href="{{ route('home') }}" class="mx-6 hover:text-rust transition-all">Home</a>
                <a href="{{ route('package') }}" class="mx-6 hover:text-rust transition-all">Package</a>
                <a href="{{ config('app.ptero_domain') }}"
                    class="mx-6 text-lg hover:text-rust transition-all">GamePanel</a>
                <a href="{{ route('dashboard') }}" class="mx-6 hover:text-rust transition-all">Client</a>
                <a href="https://discord.gg/5XFteSutRK" target="_blank"
                    class="mx-6 hover:text-rust transition-all">Discord</a>
                <a href="https://youtube.com/@rustdedicatedhosting" target="_blank"
                    class="mx-6 hover:text-rust transition-all">YouTube</a>
                @auth
                    @if (Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}"
                            class="mx-6 text-lg hover:text-rust transition-all">Dashboard</a>
                    @endif
                @endauth
            </ul>
            @auth
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button
                        class="text-white bg-rust py-2 px-5 font-semibold rounded-full hover:bg-rust-green transition-all">Logout</button>
                </form>
            @endauth
            @guest
                <ul class="flex items-center mr-5 links">
                    <a href="{{ route('login') }}" class="text-white pr-4 border-r border-white/10">Login</a>
                    <a href="{{ route('register') }}" class="text-white pl-4">Register</a>
                </ul>
            @endguest
        </div>
    </div>
</nav>
