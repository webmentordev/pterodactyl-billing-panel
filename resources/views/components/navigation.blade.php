<div class="w-full" x-data="{ open: false }">
    <nav class="fixed w-full z-50 px-1 top-3">
        <div class="bg-dark-100/90 p-2 pl-5 border border-white/20 backdrop-blur rounded-full max-w-7xl m-auto">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center"><img
                        src="{{ asset('assets/rust-dedicated-logo.webp') }}" width="80" alt="RustDedicated Logo">
                </a>
                <ul class="flex items-center text-white links 870px:hidden">
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
                            <a href="{{ config('app.ptero_url') }}" target="_blank"
                                title="RustDedicated Hosting Game Panel"
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
                            <a href="{{ config('app.discord_link') }}" target="_blank"
                                title="RustDedicated Hosting Discord"
                                class="hover:text-rust transition-all py-2 border-b border-white/10 flex items-center">
                                <img src="https://api.iconify.design/logos:discord-icon.svg"
                                    alt="RustDedicated Hosting Discord">
                                <strong class="ml-2">Discord</strong>
                            </a>
                            <a href="{{ config('app.yourube_url') }}" target="_blank"
                                title="RustDedicated Hosting YouTube"
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
                                <img src="https://api.iconify.design/logos:twitter.svg"
                                    alt="RustDedicated Hosting Twitter">
                                <strong class="ml-2">Twitter</strong>
                            </a>
                        </div>
                    </div>
                    <a href="{{ route('about') }}" class="mx-6 hover:text-rust transition-all text-lg">About</a>
                    @auth
                        @if (Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}"
                                class="mx-6 hover:text-rust transition-all text-lg">Dashboard</a>
                        @else
                            <a href="{{ route('dashboard') }}"
                                class="mx-6 hover:text-rust transition-all text-lg">Dashboard</a>
                        @endif
                    @endauth
                </ul>
                @auth
                    <form action="{{ route('logout') }}" method="post" class="870px:hidden">
                        @csrf
                        <button
                            class="text-white bg-rust py-2 px-5 font-semibold rounded-full hover:bg-rust-green transition-all">Logout</button>
                    </form>
                @endauth
                @guest
                    <ul class="flex items-center mr-5 links 870px:hidden">
                        <a href="{{ route('login') }}" class="text-white pr-4 border-r border-white/10 text-lg">Login</a>
                        <a href="{{ route('register') }}" class="text-white pl-4 text-lg">Register</a>
                    </ul>
                @endguest
                <div class="w-fit relative hidden 870px:block">
                    <button class="mr-2 mt-1" @click="open = true"><img
                            src="https://api.iconify.design/iconoir:align-right.svg?color=%23ffffff" alt="Burger Icon"
                            width="30"></button>
                </div>
            </div>
        </div>
    </nav>
    <div class="fixed top-0 left-0 z-50 h-full w-full right-0 flex justify-end" @click.self="open = false" x-show="open"
        x-cloak x-transition:enter="transform transition-transform duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition-transform duration-300" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full">
        <div class="h-full w-[230px] border-l bg-dark-100 border-white/20 py-4 px-6">
            <button class="w-full bg-rust-green p-2 rounded-md mb-3 font-semibold text-white"
                @click="open = false">Close</button>
            <ul class="flex flex-col text-white">
                <a href="{{ route('home') }}" class="mb-3">Home</a>
                <a href="{{ route('package') }}" class="mb-3">Package</a>
                <a href="{{ route('free.trial') }}" class="mb-3">Trial</a>
                <a href="{{ config('app.ptero_url') }}" class="mb-3">Game Panel</a>
                <a href="{{ route('dashboard') }}" class="mb-3">Client Panel</a>
                <a href="{{ route('about') }}" class="mb-3">About Us</a>
                @guest
                    <a href="{{ route('login') }}" class="mb-3">Login</a>
                    <a href="{{ route('register') }}" class="mb-3">Register</a>
                @endguest
                @auth
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="mb-3">Dashboard</a>
                    @endif
                @endauth
                <a href="{{ config('app.discord_link') }}" target="_blank" title="RustDedicated Hosting Discord"
                    class="hover:text-rust transition-all flex items-center py-2">
                    <img src="https://api.iconify.design/logos:discord-icon.svg" alt="RustDedicated Hosting Discord">
                    <strong class="ml-2">Discord</strong>
                </a>
                <a href="{{ config('app.yourube_url') }}" target="_blank" title="RustDedicated Hosting YouTube"
                    class="hover:text-rust transition-all flex items-center py-2">
                    <img src="https://api.iconify.design/logos:youtube-icon.svg" alt="RustDedicated Hosting YouTube"
                        width="20">
                    <strong class="ml-2">YouTube</strong>
                </a>
                <a href="{{ config('app.facebook_link') }}" target="_blank" title="RustDedicated Hosting Facebook"
                    class="hover:text-rust transition-all flex items-center py-2">
                    <img src="https://api.iconify.design/logos:facebook.svg" alt="RustDedicated Hosting Facebook"
                        width="20">
                    <strong class="ml-2">Facebook</strong>
                </a>
                <a href="{{ config('app.twitter_link') }}" target="_blank" title="RustDedicated Hosting Twitter"
                    class="hover:text-rust transition-all flex items-center py-2">
                    <img src="https://api.iconify.design/logos:twitter.svg" alt="RustDedicated Hosting Twitter">
                    <strong class="ml-2">Twitter</strong>
                </a>
                @auth
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button
                            class="text-white bg-rust p-2 w-full font-semibold rounded-md hover:bg-rust-green transition-all">Logout</button>
                    </form>
                @endauth
            </ul>
        </div>
    </div>
</div>