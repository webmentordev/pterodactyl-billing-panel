<section class="w-full py-12 bg-cover bg-center relative bg-fixed"
    style="background-image: url({{ asset('assets/background/header_3.jpg') }})">
    <div class="bg-black/50 backdrop-blur-sm absolute top-0 left-0 w-full h-full"></div>
    <div class="mt-12 max-w-7xl m-auto flex relative z-10">
        <div class="flex flex-col text-white border border-white/20 bg-dark-100 rounded-2xl w-full p-8">
            <h1 class="text-5xl mb-3 w-full border-b border-white/10 pb-3">Budget High Specs Rust Hosting In Germany</h1>
            <ul class="">
                <li class="mb-2">● Game Panel For Management</li>
                <li class="mb-2">● Integrated Rust Console (RCON)</li>
                <li class="mb-2">● Intel® Core™ i7-7700 @ 4.20GHz</li>
                <li class="mb-2">● 2 vCores CPU Performance</li>
                <li class="mb-2">● 15GB DDR4 RAM (Physical)</li>
                <li class="mb-2">● 5GB RAM (Virtual)</li>
                <li class="mb-2">● 50GB NVME SSD</li>
                <li class="mb-2">● Dedicated CPU Threads (No Sharing)</li>
                <li class="mb-2">● 5 - 10 Minutes Restart Time</li>
                <li class="mb-2">● 1Gbit/s Uplink</li>
                <li class="mb-2">● DDoS Protection</li>
                <li class="mb-2">● 2 Server Backups</li>
                <li class="mb-2">● Unlimited Players Slot (150 Recommended)</li>
                <li class="mb-2">● Up to 4250 Map Size (3750 Recommended)</li>
                <li class="mb-2">● Full FTP Access</li>
                <li class="mb-2">● Sub User Management</li>
                <li class="mb-2">● Carbon & Oxide Support</li>
                <li class="mb-2">● Modded & Vanilla / Community Server</li>
                <li class="mb-2">● Future Server Upgrade Support</li>
                <li class="mb-2">● Quick <a href="https://discord.gg/5XFteSutRK"
                        class="text-rust font-semibold underline">Discord</a>
                    support</li>
            </ul>
        </div>
        <div x-data="{ open: false }"
            class="flex flex-col text-white border border-white/20 bg-dark-100 h-fit rounded-2xl max-w-[400px] w-full ml-4 p-6">
            <h2 class="text-2xl text-center bg-dark w-full py-2 px-4 mb-4">Order Summery</h2>

            <p class="mb-3 pb-3 border-b border-white/10">Rust - High Quality Metal</p>
            <ul class="list-disc ml-5">
                <li>Rust Server</li>
                <li>2 vCores (Core™ i7-7700 @ 4.20GHz)</li>
                <li>15GB DDR4 RAM</li>
                <li>5GB RAM (Virtual)</li>
                <li>50GB M.2 NVME SSD</li>
                <li>Unlimited Players Slot</li>
                <li>4250 Map Size Support</li>
                <li>Rust+ App Support</li>
                <li>Full FTP Access</li>
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
                <button type="button" wire:click="buyNow"
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
                        x-on:click="pop = true">
                        Pay Now
                        ${{ number_format($price) }}
                    </button>
                    <div x-show="pop" x-cloak x-transition x-on:click.self="pop = false"
                        class="fixed top-0 left-0 w-full h-full z-30 bg-dark/70 backdrop-blur-md flex items-center justify-center">
                        <div class="bg-dark-100 p-5 rounded-lg border border-white/10 max-w-lg w-full">
                            <p class="text-white font-bold text-2xl mb-6">We are currently <strong class="text-rust">Out
                                    Of Stock</strong></p>
                            <p class="text-gray-200 mb-3">We regret to inform you that we are currently out of stock of
                                servers. The Owner is actively working to replenish the inventory as quickly as possible
                                to meet the growing demand.</p>
                            <p class="text-gray-200 mb-3">Please provide your email address to receive a notification
                                when servers are back in stock. It typically takes 2-3 hours for servers to become
                                available again</p>

                            @session('success')
                                <x-alerts.success :message="$value" />
                            @endsession

                            <x-text-input class="block mt-1 w-full" type="email" wire:model="email" :value="old('email')"
                                required placeholder="Email address" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            <button type="submit" wire:click="request"
                                class="py-2 px-6 rounded-sm bg-rust-green mt-3 inline-block font-bold">Request</button>
                            <p
                                class="p-4 py-2 rounded-lg italic text-white bg-rust-green/10 border border-rust-green mt-3">
                                Once servers are back in stock, you will receive an email notification, after which your
                                email address will be deleted from our system.</p>
                        </div>
                    </div>
                </div>
            @endif
            <p class="text-end">Total Due Today</p>
            <button class="text-center underline text-rust font-semibold" x-on:click="open = true">No Automatic
                Renewal?</button>
            <div x-show="open" x-cloak x-transition x-on:click.self="open = false"
                class="fixed top-0 left-0 w-full h-full z-30 bg-dark/70 backdrop-blur-md flex items-center justify-center">
                <div class="bg-dark-100 p-5 rounded-lg border border-white/10 max-w-lg w-full">
                    <p class="text-white font-bold text-2xl mb-6">Why don’t we support automatic package renewal or
                        subscriptions?</p>
                    <p class="text-gray-200 mb-3">In our 3+ years of development experience, we’ve found that many
                        customers either forget about their server or fail to cancel on time. This often leads to a poor
                        experience when they request a refund for an accidental renewal, which we are frequently unable
                        to process due to the refund period being exceeded. These situations can result in negative
                        experiences and unfavorable reviews.</p>
                    <p class="text-gray-200">We always email you 3 days before your package or server expires, giving
                        you enough time to renew your server.</p>
                </div>
            </div>
        </div>
    </div>
</section>
