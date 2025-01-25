<foter class="w-full">
    <div class="w-full bg-dark-100 border-t border-white/10 px-4 p-12">
        <div class="grid grid-cols-3 gap-6 max-w-7xl w-full m-auto 890px:grid-cols-2 510px:grid-cols-1">
            <div class="flex flex-col">
                <img src="{{ asset('assets/rust-dedicated-logo.png') }}" alt="Rust Game Dedicated Hosting Under 20$"
                    title="Rust Game Dedicated Hosting Under 20$" width="340px" class="mb-4">
                <div class="mt-3 text-white">
                    <p class="mb-3">Welcome to the Official Website Of RustDedicated Hosting!</p>
                    <p class="mb-3">RustDedicated is your trusted provider for Rust game hosting, delivering
                        high-performance
                        solutions
                        backed by cutting-edge hardware.</p>
                    <p class="mb-1">
                        Thank you for visiting! We look forward to helping you create the ultimate Rust gaming
                        experience.
                    </p>
                    <i>We are in no way affiliated with <a href="https://rust.facepunch.com/"
                            class="underline text-rust" rel="nofollow" target="_blank">Facepunch</a></i>
                    <ul class="flex items-center mt-3">
                        <li class="mr-5"><a href="{{ config('app.discord_link') }}" target="_blank"
                                title="RustDedicated Hosting Discord">
                                <img src="https://api.iconify.design/logos:discord-icon.svg"
                                    alt="RustDedicated Hosting Discord" width="25px">
                            </a></li>
                        <li class="mr-5"><a href="{{ config('app.yourube_url') }}" target="_blank"
                                title="RustDedicated Hosting YouTube">
                                <img src="https://api.iconify.design/logos:youtube-icon.svg"
                                    alt="RustDedicated Hosting YouTube" width="25px">
                            </a></li>
                        <li class="mr-5"><a href="{{ config('app.facebook_link') }}" target="_blank"
                                title="RustDedicated Hosting Facebook">
                                <img src="https://api.iconify.design/logos:facebook.svg"
                                    alt="RustDedicated Hosting Facebook" width="24px">
                            </a></li>
                        <li class="mr-5"><a href="{{ config('app.twitter_link') }}" target="_blank"
                                title="RustDedicated Hosting Twitter">
                                <img src="https://api.iconify.design/logos:twitter.svg"
                                    alt="RustDedicated Hosting Twitter" width="25px">
                            </a></li>
                        <li class="mr-3"><a href="mailto:support@rustdedicated.com" target="_blank"
                                title="RustDedicated Hosting Support Email">
                                <img src="https://api.iconify.design/twemoji:incoming-envelope.svg"
                                    alt="RustDedicated Hosting Support Email" width="25px">
                            </a></li>
                    </ul>
                </div>
            </div>
            <nav class="flex flex-col items-end 510px:items-start">
                <h2 class="mb-4 text-4xl text-white">Navigation</h2>
                <ul class="flex flex-col text-gray-200 text-end 510px:text-start">
                    <li class="mb-2 text-md"><a href="{{ route('home') }}"
                            class="hover:text-rust transition-all">Home</a></li>
                    <li class="mb-2 text-md"><a href="{{ route('login') }}"
                            class="hover:text-rust transition-all">Login</a>
                    </li>
                    <li class="mb-2 text-md"><a href="{{ route('register') }}"
                            class="hover:text-rust transition-all text-md mb-2">Register</a></li>
                    <li class="mb-2 text-md"><a href="{{ route('package') }}"
                            class="hover:text-rust transition-all">Package</a>
                    </li>
                    <li class="mb-2 text-md"><a href="{{ route('about') }}" class="hover:text-rust transition-all">About
                            Us</a>
                    </li>
                    <li class="mb-2 text-md"><a href="{{ route('dashboard') }}"
                            class="hover:text-rust transition-all">Client
                            Area</a></li>
                    <li class="mb-2 text-md"><a href="{{ config('app.ptero_url') }}"
                            class="hover:text-rust transition-all">Game
                            Panel</a></li>
                    <li class="mb-2 text-md"><a href="{{ route('free.trial') }}"
                            class="hover:text-rust transition-all">Free Trial
                            Server</a></li>
                </ul>
            </nav>

            <nav class="flex flex-col items-end 890px:items-start">
                <h2 class="mb-4 text-4xl text-white">Other Links</h2>
                <ul class="flex flex-col text-gray-200 text-end 890px:text-start">
                    <li class="mb-2 text-md"><a href="{{ route('terms') }}"
                            class="hover:text-rust transition-all">Terms Of
                            Service</a></li>
                    <li class="mb-2 text-md"><a href="{{ route('privacy') }}"
                            class="hover:text-rust transition-all">Privacy
                            Policy</a></li>
                    <li class="mb-2 text-md"><a href="{{ route('refund') }}"
                            class="hover:text-rust transition-all">Refund
                            Policy</a></li>

                    <li class="mb-2 text-md"><a href="#" class="hover:text-rust transition-all">Rust Guide</a>
                    </li>
                    <li class="mb-2 text-md"><a href="{{ config('app.trustpilot_link') }}" target="_blank"
                            rel="nofollow" class="hover:text-rust transition-all">TrustPilot</a></li>
                    <li class="mb-2 text-md"><a href="{{ route('sitemap') }}" target="_blank" rel="nofollow"
                            class="hover:text-rust transition-all">Sitemap</a></li>
                </ul>
            </nav>
        </div>
    </div class="w-full">
    <div class="text-center bg-dark border-t border-white/10 text-white py-7">
        <p>Copyright &copy; {{ date('Y') }} {{ config('app.name') }} | All rights Reserved <br> Created & Operated
            by <a href="https://fiverr.com/mahmer97" class="font-semibold underline text-rust"
                target="_blank">Ahmer</a>
        </p>
    </div>
</foter>
