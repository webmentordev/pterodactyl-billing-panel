<section>
    <div class="min-h-[800px] h-[800px] bg-cover bg-center relative bg-fixed"
        style="background-image: url({{ asset('assets/background/rust-dedicated-hosting-image.webp') }})">
        <div class="absolute top-0 left-0 bgGradient w-full h-full"></div>
        <div class="relative flex items-center justify-center h-full w-full z-10">
            <div class="text-center">
                <h1 class="text-8xl text-gray-200 550px:text-5xl">High Performance <strong
                        class="text-rust">Dedicated</strong> <br> Rust
                    <strong class="text-rust">Servers</strong>
                </h1>
                <p class="text-white text-lg mb-4">We utilize high-performance consumer-grade hardware to ensure
                    seamless, <br> low-latency, lag-free gameplay</p>
                <a href="{{ route('package') }}"
                    class="inline-block text-white bg-rust p-3 rounded-sm font-semibold px-4 hover:bg-rust-green transition-all"
                    title="Buy Under 25$ Dedicated Rust Server">Get {{ $price }}$ Server</a>
            </div>
        </div>
    </div>


    <div class="flex items-center justify-center py-[80px]">
        <div class="max-w-5xl w-full p-3 text-white">
            <div class="w-full flex items-center justify-center">
                <strong class=" text-5xl text-center mb-4 m-auto 510px:text-3xl">Rust <span
                        class="text-rust">Servers</span>
                    For
                    Everyone</strong>
            </div>
            <p class="text-center">Dedicated Server Resources - Simple RCON Panel - File Manager</p>
            <div class="grid grid-cols-3 gap-6 mt-8 750px:grid-cols-2 530px:grid-cols-1">
                <x-home-info-item image="https://api.iconify.design/uil:processor.svg?color=%23ffffff"
                    text="Dedicated CPU Core Rust Server">
                    Dedicated CPU Core
                </x-home-info-item>

                <x-home-info-item image="https://api.iconify.design/solar:video-frame-2-outline.svg?color=%23ffffff"
                    text="Dedicated DDR4 RAM Rust Server">
                    15GB DDR4 Memory
                </x-home-info-item>

                <x-home-info-item image="https://api.iconify.design/bi:nvme.svg?color=%23ffffff"
                    text="Fast NVME Storage Rust Server">
                    Fast M.2 NVME Storage
                </x-home-info-item>

                <x-home-info-item image="https://api.iconify.design/solar:database-outline.svg?color=%23ffffff"
                    text="Free MySQL Database Rust Server">
                    MYSQL Database
                </x-home-info-item>


                <x-home-info-item image="https://api.iconify.design/material-symbols-light:globe.svg?color=%23ffffff"
                    text="Rust Server Location">
                    EU Servers Location
                </x-home-info-item>

                <x-home-info-item image="https://api.iconify.design/carbon:accumulation-rain.svg?color=%23ffffff"
                    text="Oxide & Carbon Support Rust Server">
                    Oxide, Carbon & Vanilla
                </x-home-info-item>

                <x-home-info-item
                    image="https://api.iconify.design/fluent:people-community-32-regular.svg?color=%23ffffff"
                    text="Modded & Community Rust Server Hosting">
                    Modded, Community Server
                </x-home-info-item>

                <x-home-info-item
                    image="https://api.iconify.design/fluent:panel-left-key-16-regular.svg?color=%23ffffff"
                    text="Rust Server Panel">
                    Custom Game Panel
                </x-home-info-item>

                <x-home-info-item image="https://api.iconify.design/teenyicons:money-outline.svg?color=%23ffffff"
                    text="{{ config('app.refund_days') * 24 }} Refund Policy">
                    {{ config('app.refund_days') * 24 }} Hours Refund Policy
                </x-home-info-item>

                <x-home-info-item
                    image="https://api.iconify.design/fluent:person-support-20-regular.svg?color=%23ffffff"
                    text="Rust Server Location">
                    24 / 7 Dedicated Support
                </x-home-info-item>

                <x-home-info-item image="https://api.iconify.design/fluent:arrow-join-20-regular.svg?color=%23ffffff"
                    text="Unlimited player slots Rust Server">
                    Unlimited Player Slots
                </x-home-info-item>

                <x-home-info-item image="https://api.iconify.design/hugeicons:file-01.svg?color=%23ffffff"
                    text="60GB NVME Storage Rust server">
                    60GB Storage FTP Access
                </x-home-info-item>

                <x-home-info-item image="https://api.iconify.design/tabler:map.svg?color=%23ffffff"
                    text="Large Map Support Rust Server">
                    Large Map Support
                </x-home-info-item>

                <x-home-info-item image="https://api.iconify.design/tabler:device-mobile.svg?color=%23ffffff"
                    text="Rust+ App Support Rust server">
                    Rust+ App Support
                </x-home-info-item>

                <x-home-info-item image="https://api.iconify.design/solar:alarm-broken.svg?color=%23ffffff"
                    text="99.99% Uptime Rust server">
                    99.99% Server Uptime
                </x-home-info-item>
            </div>
        </div>
    </div>


    <div class="bg-dark-100 border-y border-white/10 pb-12">
        <div class="flex items-center justify-center py-12" id="packages">
            <div class="max-w-5xl w-full p-3 text-white">
                <div class="w-full flex items-center justify-center">
                    <strong class=" text-5xl text-center mb-4 m-auto 510px:text-3xl"
                        title="Global Rust Server Hosting Locations">Our
                        <span class="text-rust">Global Server</span>
                        Locations</strong>
                </div>
                <p class="text-center">Strategically positioned to serve half of the world's player base</p>
            </div>
        </div>

        <div class="flex items-center justify-center py-12 bg-center bg-contain bg-no-repeat min-h-[800px] 1000px:min-h-[500px] 800px:min-h-[300px] 530px:min-h-[200px]"
            style="background-image: url({{ asset('assets/rust-dedicated-server-locations.png') }})">
        </div>
    </div>


    <div class="flex items-center justify-center py-12" id="packages">
        <div class="max-w-7xl w-full p-3 text-white">
            <div class="w-full flex items-center justify-center">
                <h2 class="mb-4 m-auto">
                    <strong title="How to choose the best rust server?" class="text-5xl text-center 510px:text-3xl"
                        title="Global Rust Server Hosting Locations">How to
                        Choose
                        <span class="text-rust">The Best Rust</span>
                        Server</strong>
                </h2>
            </div>
            <p class="text-center">An important aspect of running Rust is choosing the best server to host on</p>
            <div class="mt-4 p-8 rounded-lg bg-dark-100 border border-white/10 510px:p-4">
                <p class="mb-3">Let’s explore Rust and how its servers operate.</p>
                <strong class="text-3xl mb-4">Dedicated CPU</strong>
                <p class="mt-3">Rust is a single-threaded game, which means it only requires a CPU’s single thread to
                    function.
                    All entities, such as animals, NPCs, AI (including sharks), and, most importantly, player
                    population,
                    are processed by this single thread. For this reason, a Rust server must have a processor with a
                    clock speed averaging above 4.20 GHz. A higher CPU frequency can increase the processor’s
                    temperature, so excellent cooling is essential for optimal server performance.
                </p>
                <p class="mt-1 mb-6">Assigning multiple cores or threads to a Rust server is unnecessary. While
                    generating
                    a procedural map, the server requires additional CPU power to load the map. That’s why we allocate
                    two threads per server—no more, no less. In cases where there is extra load on the primary thread,
                    the second thread handles additional tasks, effectively reducing lag and rubber banding.
                </p>

                <strong class="text-3xl mb-4">Dedicated RAM Usage</strong>
                <p class="mt-3 mb-6">Server RAM usage depends on factors such as map size, the number of entities, and
                    player population. For a 2000-size map, the minimum RAM requirement is approximately 7GB to 8GB
                    after server bootup. The maximum map size in Rust, 6000, requires at least 12GB of RAM after bootup.
                    RAM usage tends to increase over time, which can be a challenge for server owners running monthly
                    wipe servers. Therefore, it’s always recommended to opt for a server with ample RAM capacity. While
                    DDR4 RAM is sufficient, upgrading to DDR5 can further enhance server performance.
                </p>

                <strong class="text-3xl mb-4">NVME Storage</strong>
                <p class="mt-3">Having fast storage, such as M.2 Gen4 NVMe, can significantly improve server bootup
                    times. During asset warmup, Rust requires quick access to files, which directly impacts the server's
                    startup speed. On average, HDDs take 6–8 minutes to load assets, standard SSDs take 3–5 minutes,
                    while M.2 NVMe storage reduces this time dramatically to just 20–40 seconds. Investing in high-speed
                    storage is essential for optimal server performance and minimizing downtime.</p>
            </div>
        </div>
    </div>


    @if (count($reviews))
        <div class="flex items-center justify-center pb-[80px] text-white">
            <div class="max-w-7xl w-full p-3 1000px:max-w-3xl m-auto 660px:max-w-xl">
                <div class="w-full flex items-center justify-center">
                    <strong class=" text-5xl text-center mb-4 m-auto 510px:text-3xl">Our Customer <span
                            class="text-rust">Reviews</span></strong>
                </div>
                <p class="text-center">What Our Valued Customers Say About Our Services</p>
                <div class="grid grid-cols-3 gap-6 mt-8 1000px:grid-cols-2 660px:grid-cols-1">
                    @foreach ($reviews as $review)
                        <x-review-card :review="$review" :index="$loop->index" />
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- <div class="flex items-center justify-center py-12" id="packages">
        <div class="max-w-4xl w-full p-3 grid grid-cols-3 gap-6">
            @foreach ($packages as $package)
                <div class="rounded-lg bg-dark-100 border border-white/10 p-8 flex flex-col justify-between text-white">
                    <div class="w-full">
                        <img src="{{ asset('/storage/' . $package->image) }}" width="80px" class="m-auto mb-5">
                        <h3 class="text-center text-2xl mt-3 mb-3 pb-4 border-b border-white/10">{{ $package->name }}
                        </h3>
                        <p class="uppercase mb-4 font-semibold text-rust text-center">{{ $package->players }} Players
                            recommended</p>
                        <div class="flex
                            justify-between w-full mb-4">
                            <div class="w-fit text-start">
                                {{ $package->ram }} RAM
                                {{ $package->ram_type }}
                            </div>
                            <div class="w-fit text-end">
                                {{ $package->storage }}GB {{ $package->storage_type }}
                                STORAGE
                            </div>
                        </div>
                        <div class="markdown mb-4 text-sm">
                            {!! Str::of($package->body)->markdown() !!}
                        </div>
                    </div>
                    <button wire:click='purchase("{{ $package->name }}")'
                        class="w-full bg-rust rounded-lg text-white font-semibold py-3">Pay
                        {{ $package->price }}</button>
                </div>
            @endforeach
        </div>
    </div> --}}
</section>
