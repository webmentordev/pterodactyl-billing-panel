<section class="w-full h-full">
    <div class="w-full py-12 bg-cover bg-center relative bg-fixed"
        style="background-image: url({{ asset('assets/background/rust-dedicated-client-header.webp') }})">
        <div class="bgGradient-2 backdrop-blur-sm absolute top-0 left-0 w-full h-full"></div>
        <div class="mt-12 max-w-7xl m-auto flex relative z-10 px-2 920px:max-w-2xl 920px:flex-col">
            <div class="flex flex-col text-white border border-white/20 bg-dark-100 rounded-2xl w-full p-8 530px:p-4">
                <h1 class="text-5xl mb-3 w-full border-b border-white/10 pb-3 530px:text-3xl" title="Budget High Specs Rust
                    Hosting In Germany">Budget High Specs Rust
                    Hosting Uner 30$
                </h1>
                <ul class="">
                    <li class="mb-2">● Game Panel For Management</li>
                    <li class="mb-2">● Integrated Rust Console (RCON)</li>
                    <li class="mb-2">● Intel® or AMD Ryzen Processor with up to 4.70 GHz</li>
                    <li class="mb-2">● 2 Threads Performance (Dedicated)</li>
                    <li class="mb-2">● 15GB DDR4 RAM (Physical)</li>
                    <li class="mb-2">● 5GB RAM (Virtual)</li>
                    <li class="mb-2">● 60GB M.2 NVMe SSD</li>
                    <li class="mb-2">● 1Gbit/s Uplink</li>
                    <li class="mb-2">● DDoS Protection</li>
                    <li class="mb-2">● 2 Server Backups (System Backups)</li>
                    <li class="mb-2">● 1 MySQL Database (May be store Player Stats)</li>
                    <li class="mb-2">● Unlimited Players Slot (150 Recommended)</li>
                    <li class="mb-2">● Up to 4500 Map Size (4250 Max Recommended)</li>
                    <li class="mb-2">● Full FTP Access</li>
                    <li class="mb-2">● Sub User Management</li>
                    <li class="mb-2">● Carbon & Oxide Support</li>
                    <li class="mb-2">● Modded & Vanilla / Community Server</li>
                    <li class="mb-2">● Future Server Upgrade Support</li>
                    <li class="mb-2">● Quick <a href="{{ config('app.discord_link') }}"
                            class="text-rust font-semibold underline">Discord</a>
                        support</li>
                </ul>
                <p class="bg-dark rounded-lg py-3 px-4 border border-white/10">By placing an order with us, you agree to
                    the
                    <a href="{{ route('terms') }}" class="underline text-rust">Terms Of Service</a> and the <a
                        href="{{ route('privacy') }}" class="underline text-rust">Privacy Policy</a>
                </p>
            </div>
            <div x-data="{ open: false }"
                class="flex flex-col text-white border border-white/20 bg-dark-100 h-fit rounded-2xl max-w-[400px] 920px:max-w-2xl w-full ml-4 p-6 920px:ml-0 920px:mt-3">
                <h2 class="text-2xl text-center bg-dark w-full py-2 px-4 mb-4">Order Summery</h2>

                <p class="mb-3 pb-3 border-b border-white/10">Rust - High Quality Metal</p>
                <ul class="list-disc ml-5">
                    <li>Rust Server</li>
                    <li>Intel or Ryzen CPU @ 4.70 GHz</li>
                    <li>2 CPU Threads (200%)</li>
                    <li>15GB DDR4 RAM</li>
                    <li>5GB RAM (Virtual)</li>
                    <li>60GB M.2 NVMe SSD</li>
                    <li>Unlimited Players Slot</li>
                    <li>4500 Map Size Support</li>
                    <li>Rust+ App Support</li>
                    <li>Full FTP Access</li>
                    <li>2 Backups</li>
                    <li>1 MySQL Database</li>
                    <li>Location: Germany</li>
                    <li>Renewal Period: 31 Days</li>
                </ul>
                <div class="mb-3 pb-3 border-b border-white/10"></div>
                <p class="mb-3 pb-3 border-b border-white/10">Free Server Migration (Contact Support)</p>
                <p class="flex justify-between items-center"><span>Setup Fees:</span> <span>$0.00 USD</span></p>
                <p class="flex justify-between items-center mb-3 pb-3 border-b border-white/10"><span>Monthly:</span>
                    <span>${{ number_format($price) }} USD</span>
                </p>
                <p class="flex justify-between items-center"><span>Server Ready In:</span> <span>~10 Minutes</span></p>
                @if (!$outOfStock)
                    <button type="button" wire:click="buyNow" onclick="trackBuyNow()"
                        class="py-3 bg-rust-green text-white font-semibold my-2 rounded-sm">
                        <div wire:target="buyNow" wire:loading.class="hidden">
                            Pay Now
                            ${{ number_format($price) }}
                        </div>
                        <div wire:target="buyNow" wire:loading>
                            Processing...
                        </div>
                    </button>
                @else
                    <div class="w-full relative" x-data="{ pop: false }">
                        <button class="py-3 bg-rust-green text-white font-semibold my-2 rounded-sm w-full"
                            x-on:click="pop = true" onclick="trackBuyNow()">
                            Pay Now
                            ${{ number_format($price) }}
                        </button>
                        <div x-show="pop" x-cloak x-transition x-on:click.self="pop = false"
                            class="fixed top-0 left-0 w-full h-full z-30 bg-dark/70 backdrop-blur-md flex items-center justify-center px-2">
                            <div class="bg-dark-100 p-5 rounded-lg border border-white/10 max-w-lg w-full">
                                <p class="text-white font-bold text-2xl mb-6">We are currently <strong class="text-rust">Out
                                        Of Stock</strong></p>
                                <p class="text-gray-200 mb-3">We regret to inform you that we are currently out of stock
                                    of
                                    servers. The Owner is actively working to replenish the inventory as quickly as
                                    possible
                                    to meet the growing demand.</p>
                                <p class="text-gray-200 mb-3">Please provide your email address to receive a
                                    notification
                                    when servers are back in stock. It typically takes 2-3 hours for servers to become
                                    available again.</p>

                                @session('success')
                                    <x-alerts.success :message="$value" />
                                @endsession

                                <x-text-input class="block mt-1 w-full" type="email" wire:model="email"
                                    :value="old('email')" required placeholder="Email address" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                <button type="submit" wire:click="request"
                                    class="py-2 px-6 rounded-sm bg-rust-green mt-3 inline-block font-bold">Request</button>
                                <p
                                    class="p-4 py-2 rounded-lg italic text-white bg-rust-green/10 border border-rust-green mt-3">
                                    Once the servers are back in stock, you will receive an email notification.
                                    Afterward,
                                    your email address will be deleted from our system to enhance privacy and protect
                                    against accidental email spams.</p>
                                <div class="flex justify-end items-center">
                                    <button @click="pop = false"
                                        class="py-2 px-4 bg-rust text-white font-semibold mt-3 inline-block">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="flex items-center justify-between">
                    <p class="text-start">(excl. Sales Tax)</p>
                    <p class="text-end">Total Due Today</p>
                </div>
                <button class="text-center underline text-rust font-semibold" x-on:click="open = true">No Automatic
                    Renewal?</button>
                <div x-show="open" x-cloak x-transition x-on:click.self="open = false"
                    class="fixed top-0 left-0 w-full h-full z-30 bg-dark/70 backdrop-blur-md flex items-center justify-center px-2">
                    <div class="bg-dark-100 p-5 rounded-lg border border-white/10 max-w-lg w-full">
                        <p class="text-white font-bold text-2xl mb-6">Why don’t we support automatic package renewal or
                            subscriptions?</p>
                        <p class="text-gray-200 mb-3">In our 3+ years of development experience, we’ve found that many
                            customers either forget about their server or fail to cancel on time. This often leads to a
                            poor
                            experience when they request a refund for an accidental renewal, which we are frequently
                            unable
                            to process due to the refund period being exceeded. These situations can result in negative
                            experiences and unfavorable reviews.</p>
                        <p class="text-gray-200">We always email you 3 days before your package or server expires,
                            giving
                            you enough time to renew your server.</p>
                        <div class="flex justify-end items-center">
                            <button @click="open = false"
                                class="py-2 px-4 bg-rust text-white font-semibold mt-3 inline-block">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-center py-[80px]">
        <div class="max-w-7xl w-full p-3 text-white 870px:max-w-2xl 470px:max-w-[300px]">
            <div class="grid grid-cols-4 gap-6 mt-8 870px:grid-cols-2 470px:grid-cols-1">
                <div
                    class="flex flex-col items-center bg-dark-100 py-6 px-4 rounded-lg border border-white/10 hover:scale-110 transition-all">
                    <div class="flex items-center justify-center p-3 mb-4 border border-rust rounded-lg">
                        <img src="https://api.iconify.design/uil:processor.svg?color=%23ffffff" alt="Dedicated Server"
                            title="Dedicated Server" width="60">
                    </div>
                    <strong class="text-center text-3xl leading-[40px] text-">Simple <br> <span
                            class="text-rust">Console</span></strong>
                </div>

                <div
                    class="flex flex-col items-center bg-dark-100 py-8 px-4 rounded-lg border border-white/10 hover:scale-110 transition-all">
                    <div class="flex items-center justify-center p-3 mb-4 border border-rust rounded-lg">
                        <img src="https://api.iconify.design/carbon:document-configuration.svg?color=%23ffffff"
                            alt="Dedicated Server" title="Dedicated Server" width="60">
                    </div>
                    <strong class="text-center text-3xl leading-[40px] text-">Simple File <br> <span
                            class="text-rust">Explorer</span></strong>
                </div>

                <div
                    class="flex flex-col items-center bg-dark-100 py-8 px-4 rounded-lg border border-white/10 hover:scale-110 transition-all">
                    <div class="flex items-center justify-center p-3 mb-4 border border-rust rounded-lg">
                        <img src="https://api.iconify.design/mdi:database-plus.svg?color=%23ffffff"
                            alt="Dedicated Server" title="Dedicated Server" width="60">
                    </div>
                    <strong class="text-center text-3xl leading-[40px] text-">MySQL <br> <span
                            class="text-rust">Database</span></strong>
                </div>

                <div
                    class="flex flex-col items-center bg-dark-100 py-8 px-4 rounded-lg border border-white/10 hover:scale-110 transition-all">
                    <div class="flex items-center justify-center p-3 mb-4 border border-rust rounded-lg">
                        <img src="https://api.iconify.design/ic:outline-alarm-on.svg?color=%23ffffff"
                            alt="Dedicated Server" title="Dedicated Server" width="60">
                    </div>
                    <strong class="text-center text-3xl leading-[40px] text-">99.99% <br> <span
                            class="text-rust">Uptime</span></strong>
                </div>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-center py-[80px]">
        <div class="max-w-7xl w-full p-3 text-white 920px:max-w-3xl">
            <div class="w-full flex items-center justify-center">
                <h2 class="text-5xl text-center mb-4 m-auto 510px:text-4xl">Rust Server <span
                        class="text-rust font">Configurations
                    </span>
                    We Offer</h2>
            </div>
            <p class="text-center">Explore our range of high-performance server setups tailored to meet diverse gaming
                and hosting needs</p>
            <div class="grid grid-cols-2 gap-6 mt-8 920px:grid-cols-1">
                <div class="w-full py-2">
                    <h3 class="text-3xl mb-4">User Friendly Game Panel</h3>
                    <p class="leading-7 mb-4">We use Pterodactyl panel for our Rust servers. Once you sign up for the
                        first time and place an order, we automatically create your account on the panel and email you
                        the login details. Simply log in, and you will easily be able to navigate through the panel. You
                        will find all the information you need to operate your Rust server.</p>
                    <p class="leading-7">You will see your server status and resource usage, including RAM, CPU usage,
                        uptime, etc. To
                        change your server configurations, such as the server name, description, switching to Oxide,
                        Vanilla, or Carbon, or checking ports, everything is conveniently available in the Startup tab
                        of the panel. You can also add your friends or Rust server developers directly from the panel.
                    </p>
                </div>
                <img src="{{ asset('assets/fast-rust-server-loading.png') }}" alt="User Friendly Game Panel"
                    class="rounded-md">
            </div>


            <div class="grid grid-cols-2 gap-6 mt-8 920px:grid-cols-1">
                <div class="p-4 rounded-lg border border-white/10 bg-dark-100">
                    <h3 class="mb-3 text-lg">Why 2 Dedicated Threads for a Rust Server?</h3>
                    <p>Rust game servers run on a single thread. To handle additional tasks, we have assigned a second
                        thread to reduce the load on the primary thread. <br> Intel processors with Hyper-Threading
                        technology will activate under load, effectively utilizing the power of a single core.</p>
                </div>

                <div class="p-4 rounded-lg border border-white/10 bg-dark-100">
                    <h3 class="mb-3 text-lg">Why do we assign 15GB DDR4 Physical RAM for a Rust Server?</h3>
                    <p>Our goal is to provide a Rust server that can handle large maps, ranging from 2000 to 6000 in
                        size. Rust needs at least 8GB to 12GB of RAM. Servers with monthly wipes may experience crashes
                        if there isn't enough RAM. Allocating 15GB of RAM ensures stability during the entire wipe
                        cycle.
                    </p>
                </div>

                <div class="p-4 rounded-lg border border-white/10 bg-dark-100">
                    <h3 class="mb-3 text-lg">Why Do We Assign a 60GB M.2 NVMe SSD for Rust Servers?</h3>
                    <p>We use a 60GB M.2 NVMe SSD to give Rust servers the best performance. NVMe SSDs are fast and
                        have low delay, making them great for loading your Rust server, including map data, player
                        actions, and server logs. This setup ensures smooth and reliable gameplay</p>
                </div>

                <div class="p-4 rounded-lg border border-white/10 bg-dark-100">
                    <h3 class="mb-3 text-lg">Rust server with unlimited player slots</h3>
                    <p>All Rust servers are built to support unlimited player slots for large servers. We will never
                        limit the number of players on your server, but we recommend limiting it to 150 players. If it's
                        fewer, that's perfectly fine. We recommend reducing the number of entities using plugins and
                        disabling AI, such as sharks and animals, etc.</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        function trackBuyNow() {
            gtag('event', 'buy_now_click', {
                'event_category': 'Purchases',
                'event_label': 'Buy Now Button',
                'value': 25
            });
        }
    </script>
    @if (!$outOfStock)
        <x-in-stock />
    @endif
</section>