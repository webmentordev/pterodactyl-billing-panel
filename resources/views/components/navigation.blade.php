<nav class="fixed top-3 w-full z-50 px-4">
    <div class="bg-dark-100/90 rounded-full p-2 border border-white/20 backdrop-blur max-w-7xl m-auto">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center"><img
                    src="{{ asset('assets/rust-dedicated-hosting-logo.png') }}" alt="" width="40">
                <strong class="text-white text-2xl ml-3">RustDedicated</strong>
            </a>
            <ul class="flex items-center text-white links">
                <a href="{{ route('home') }}" class="mx-6 hover:text-rust transition-all text-lg">Home</a>
                <a href="{{ route('package') }}" class="mx-6 hover:text-rust transition-all text-lg">Package</a>
                <a href="{{ route('free.trial') }}" class="mx-6 hover:text-rust transition-all text-lg">Trial</a>
                <div class="relative ml-6" x-data="{ open: false }">
                    <button class="flex items-center" x-on:click="open = !open">
                        <span class="font hover:text-rust transition-all text-lg">Panel</span>
                        <img src="https://api.iconify.design/material-symbols-light:arrow-drop-down.svg?color=%23ffffff"
                            alt="Arrow Down" width="30" :class="open ? 'rotate-180' : ''">
                    </button>
                    <div x-show="open" x-cloak x-transition
                        class="absolute top-7 right-0 w-[150px] bg-dark border border-white/10 flex flex-col rounded-lg p-3">
                        <a href="{{ config('app.ptero_url') }}" target="_blank" title="RustDedicated Hosting Game Panel"
                            class="hover:text-rust transition-all py-2 border-b border-white/10 flex items-center">
                            <strong class="ml-2">Game Panel</strong>
                        </a>
                        <a href="{{ route('dashboard') }}" title="RustDedicated Hosting Client Area"
                            class="hover:text-rust transition-all py-2 flex items-center">
                            <strong class="ml-2">Client Area</strong>
                        </a>
                    </div>
                </div>
                <div class="relative ml-6" x-data="{ open: false }">
                    <button class="flex items-center" x-on:click="open = !open">
                        <span class="font hover:text-rust transition-all text-lg">Socials</span>
                        <img src="https://api.iconify.design/material-symbols-light:arrow-drop-down.svg?color=%23ffffff"
                            alt="Arrow Down" width="30" :class="open ? 'rotate-180' : ''">
                    </button>

                    <div x-show="open" x-cloak x-transition
                        class="absolute top-7 right-0 w-[150px] bg-dark border border-white/10 flex flex-col rounded-lg p-3">
                        <a href="{{ config('app.discord_link') }}" target="_blank" title="RustDedicated Hosting Discord"
                            class="hover:text-rust transition-all py-2 border-b border-white/10 flex items-center">
                            <img src="https://api.iconify.design/logos:discord-icon.svg"
                                alt="RustDedicated Hosting Discord">
                            <strong class="ml-2">Discord</strong>
                        </a>
                        <a href="{{ config('app.yourube_url') }}" target="_blank" title="RustDedicated Hosting YouTube"
                            class="hover:text-rust transition-all py-2 flex items-center border-b border-white/10">
                            <img src="https://api.iconify.design/logos:youtube-icon.svg"
                                alt="RustDedicated Hosting YouTube" width="20">
                            <strong class="ml-2">YouTube</strong>
                        </a>
                        <a href="{{ config('app.facebook_link') }}" target="_blank"
                            title="RustDedicated Hosting Facebook"
                            class="hover:text-rust transition-all py-2 flex items-center border-b border-white/10">
                            <img src="https://api.iconify.design/logos:facebook.svg"
                                alt="RustDedicated Hosting Facebook" width="20">
                            <strong class="ml-2">Facebook</strong>
                        </a>
                        <a href="{{ config('app.twitter_link') }}" target="_blank"
                            title="RustDedicated Hosting Twitter"
                            class="hover:text-rust transition-all py-2 flex items-center">
                            <img src="https://api.iconify.design/logos:twitter.svg" alt="RustDedicated Hosting Twitter">
                            <strong class="ml-2">Twitter</strong>
                        </a>
                    </div>
                </div>
                <a href="{{ route('about') }}" class="mx-6 hover:text-rust transition-all text-lg">About</a>
                @auth
                    @if (Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}"
                            class="mx-6 hover:text-rust transition-all text-lg">Dashboard</a>
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
                    <a href="{{ route('login') }}" class="text-white pr-4 border-r border-white/10 text-lg">Login</a>
                    <a href="{{ route('register') }}" class="text-white pl-4 text-lg">Register</a>
                </ul>
            @endguest
        </div>
    </div>
</nav>
