<section class="w-full py-12 bg-cover bg-center relative"
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
                <li class="mb-2">● Dedicated CPU Threads (No Sharing)</li>
                <li class="mb-2">● 15GB DDR4 RAM (Physical)</li>
                <li class="mb-2">● 5GB RAM (Virtual)</li>
                <li class="mb-2">● 50GB NVME SSD</li>
                <li class="mb-2">● 8 Minutes Rust Server Startup Time</li>
                <li class="mb-2">● 2Gbps Uplink</li>
                <li class="mb-2">● DDoS Protection up to 2Tb/s</li>
                <li class="mb-2">● 3 Server Backups</li>
                <li class="mb-2">● Unlimited Players Slot (150 Recommended)</li>
                <li class="mb-2">● Up to 20 Server Ticks (10 Recommended)</li>
                <li class="mb-2">● Up to 5000 Map Size (4250 Recommended)</li>
                <li class="mb-2">● Full FTP Access</li>
                <li class="mb-2">● Sub User Management</li>
                <li class="mb-2">● Carbon & Oxide Support</li>
                <li class="mb-2">● Modded & Community Server</li>
                <li class="mb-2">● Future Server Upgrade Support</li>
                <li class="mb-2">● Quick <a href="https://discord.gg/5XFteSutRK"
                        class="text-rust font-semibold underline">Discord</a>
                    support</li>
            </ul>
        </div>
        <div x-data="{ open: false }"
            class="flex flex-col text-white border border-white/20 bg-dark-100 h-fit rounded-2xl max-w-[400px] w-full ml-4 p-6">
            <h2 class="text-2xl text-center bg-dark w-full py-2 px-4 mb-4">Order Summery</h2>

            <p class="mb-3 pb-3 border-b border-white/10">Rust - Assault Rifle</p>
            <ul class="list-disc ml-5">
                <li>Rust Server</li>
                <li>2 vCores (Core™ i7-7700 @ 4.20GHz)</li>
                <li>15GB DDR4 RAM</li>
                <li>5GB RAM (Virtual)</li>
                <li>50GB M.2 NVME SSD</li>
                <li>Unlimited Players Slot</li>
                <li>5000 Map Size Support</li>
                <li>Rust+ App Support</li>
                <li>Full FTP Access</li>
                <li>Location: Germany</li>
            </ul>
            <div class="mb-3 pb-3 border-b border-white/10"></div>
            <p class="mb-3 pb-3 border-b border-white/10">Free Server Migration (Contact Support)</p>
            <p class="flex justify-between items-center"><span>Setup Fees:</span> <span>$0.00 USD</span></p>
            <p class="flex justify-between items-center mb-3 pb-3 border-b border-white/10"><span>Monthly:</span>
                <span>${{ number_format($price) }} USD</span>
            </p>
            <p class="flex justify-between items-center"><span>Server Ready In:</span> <span>~10 Minutes</span></p>
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
