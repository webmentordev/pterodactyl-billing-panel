<foter class="w-full">
    <div class="w-full bg-dark-100 border-t border-white/10 px-4 p-12">
        <div class="grid grid-cols-3 gap-6 max-w-7xl w-full m-auto">
            <div class="flex flex-col">
                <img src="{{ asset('assets/nav-logo.png') }}" alt="Rust Game Dedicated Hosting Under 20$"
                    title="Rust Game Dedicated Hosting Under 20$" width="340px" class="mb-4">
                <div class="mt-3 text-white">
                    <p class="mb-3">Welcome to the Official Website Of RustDedicated Hosting!</p>
                    <p class="mb-3">RustDedicated is your trusted provider for Rust game hosting, delivering
                        high-performance
                        solutions
                        backed by cutting-edge hardware.</p>
                    <p>
                        Thank you for visiting! We look forward to helping you create the ultimate Rust gaming
                        experience.
                    </p>
                    <ul class="flex items-center mt-3">
                        <a href="https://discord.gg/5XFteSutRK" class="mr-5" target="_blank"
                            title="RustDedicated Hosting Discord">
                            <img src="https://api.iconify.design/logos:discord-icon.svg"
                                alt="RustDedicated Hosting Discord" width="25px">
                        </a>
                        <a href="https://youtube.com/@rustdedicatedhosting" class="mr-5" target="_blank"
                            title="RustDedicated Hosting YouTube">
                            <img src="https://api.iconify.design/logos:youtube-icon.svg"
                                alt="RustDedicated Hosting YouTube" width="25px">
                        </a>
                        <a href="mailto:support@rustdedicated.com" class="mr-3" target="_blank"
                            title="RustDedicated Hosting Support Email">
                            <img src="https://api.iconify.design/twemoji:incoming-envelope.svg"
                                alt="RustDedicated Hosting Support Email" width="25px">
                        </a>
                    </ul>
                </div>
            </div>
            <div class="flex flex-col items-end">
                <h2 class="mb-4 text-4xl text-white">Navigation</h2>
                <ul class="flex flex-col text-gray-200 text-end">
                    <a href="{{ route('home') }}" class="hover:text-rust transition-all text-md mb-2">Home</a>
                    <a href="{{ route('login') }}" class="hover:text-rust transition-all text-md mb-2">Login</a>
                    <a href="{{ route('package') }}" class="hover:text-rust transition-all text-md mb-2">Package</a>
                    <a href="{{ route('register') }}" class="hover:text-rust transition-all text-md mb-2">Register</a>
                    <a href="{{ route('dashboard') }}" class="hover:text-rust transition-all text-md mb-2">Client
                        Area</a>
                    <a href="{{ config('app.ptero_domain') }}" class="hover:text-rust transition-all text-md mb-2">Game
                        Panel</a>
                    <a href="#" class="hover:text-rust transition-all text-md">Free Trial Server</a>
                </ul>
            </div>

            <div class="flex flex-col items-end">
                <h2 class="mb-4 text-4xl text-white">Other Links</h2>
                <ul class="flex flex-col text-gray-200 text-end">
                    <a href="#" class="hover:text-rust transition-all text-md mb-2">Terms Of Service</a>
                    <a href="#" class="hover:text-rust transition-all text-md mb-2">Privacy Policy</a>
                    <a href="#" class="hover:text-rust transition-all text-md mb-2">Refund Policy</a>
                </ul>
            </div>
        </div>
    </div class="w-full">
    <div class="text-center bg-dark border-t border-white/10 text-white py-7">
        <p>Copyright &copy; {{ date('Y') }} {{ config('app.name') }} | All rights Reserved <br> Created & Operated
            by <a href="https://fiverr.com/mahmer97" class="font-semibold underline text-rust" target="_blank">Ahmer</a>
        </p>
    </div>
</foter>
