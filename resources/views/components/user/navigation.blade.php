<nav class="w-full px-4">
    <div class="bg-dark-100/90 rounded-full p-2 border border-white/20 backdrop-blur max-w-7xl m-auto">
        <div class="flex items-center justify-between">
            @if (auth()->user()->google_avatar)
                <a href="{{ route('home') }}"><img src="{{ auth()->user()->google_avatar }}" class="rounded-full"
                        width="40"></a>
            @else
                <a href="{{ route('home') }}"><img src="{{ asset('assets/rust-dedicated-hosting-logo.png') }}"
                        width="40"></a>
            @endif

            <ul class="flex items-center text-white links">
                <a href="{{ route('dashboard') }}" class="mx-6 text-lg">Dashboard</a>
                <a href="{{ route('billings') }}" class="mx-6 text-lg">Billing</a>
                <div class="relative ml-6" x-data="{ open: false }">
                    <button class="flex items-center" x-on:click="open = !open">
                        <span class="font hover:text-rust transition-all text-lg">Support</span>
                        <img src="https://api.iconify.design/material-symbols-light:arrow-drop-down.svg?color=%23ffffff"
                            alt="Arrow Down" width="30" :class="open ? 'rotate-180' : ''">
                    </button>

                    <div x-show="open" x-cloak x-transition
                        class="absolute top-7 right-0 w-[150px] bg-dark border border-white/10 flex flex-col rounded-lg p-3 z-40">
                        <a href="mailto:{{ config('app.mail_address') }}" target="_blank"
                            title="RustDedicated Hosting Discord"
                            class="hover:text-rust transition-all py-2 border-b border-white/10 flex items-center">
                            <img src="https://api.iconify.design/twemoji:incoming-envelope.svg" width="22"
                                alt="RustDedicated Hosting Discord">
                            <strong class="ml-3">Email</strong>
                        </a>
                        <a href="{{ config('app.discord_link') }}" target="_blank" title="RustDedicated Hosting Discord"
                            class="hover:text-rust transition-all py-2 border-b border-white/10 flex items-center">
                            <img src="https://api.iconify.design/logos:discord-icon.svg"
                                alt="RustDedicated Hosting Discord">
                            <strong class="ml-3">Discord</strong>
                        </a>
                        <a href="{{ config('app.yourube_url') }}" target="_blank" title="RustDedicated Hosting YouTube"
                            class="hover:text-rust transition-all py-2 flex items-center">
                            <img src="https://api.iconify.design/logos:youtube-icon.svg"
                                alt="RustDedicated Hosting YouTube">
                            <strong class="ml-3">YouTube</strong>
                        </a>
                    </div>
                </div>
            </ul>

            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="text-black bg-white py-2 px-5 font-bold rounded-full">Logout</button>
            </form>
        </div>
    </div>
</nav>
