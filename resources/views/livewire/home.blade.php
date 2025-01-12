<section>
    <div class="min-h-[800px] h-[800px] bg-cover bg-center relative"
        style="background-image: url({{ asset('assets/background/header_1.jpg') }})">
        <div class="absolute top-0 left-0 bg-dark/30 backdrop-blur-sm w-full h-full"></div>
        <div class="relative flex items-center justify-center h-full w-full z-10">
            <div class="text-center">
                <h1 class="text-8xl text-gray-300">High Performance <strong class="text-rust">Dedicated</strong> <br> Rust
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
                <strong class=" text-5xl text-center mb-4 m-auto">Rust <span class="text-rust">Servers</span>
                    For
                    Everyone</strong>
            </div>
            <p class="text-center">Dedicated Server Resources - Simple RCON Panel - File Manager</p>
            <div class="grid grid-cols-3 gap-6 mt-8">
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
                    Oxide / Carbon / Vanilla
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
                    24 / 7 Discord Support
                </x-home-info-item>

                <x-home-info-item image="https://api.iconify.design/fluent:arrow-join-20-regular.svg?color=%23ffffff"
                    text="Unlimited player slots Rust Server">
                    Unlimited Player Slots
                </x-home-info-item>

                <x-home-info-item image="https://api.iconify.design/hugeicons:file-01.svg?color=%23ffffff"
                    text="60GB NVME Storage Rust server">
                    60GB Storage FTP Access
                </x-home-info-item>
            </div>
        </div>
    </div>


    <div class="bg-dark-100 border-y border-white/10 pb-12">
        <div class="flex items-center justify-center py-12" id="packages">
            <div class="max-w-5xl w-full p-3 text-white">
                <div class="w-full flex items-center justify-center">
                    <strong class=" text-5xl text-center mb-4 m-auto" title="Global Rust Server Hosting Locations">Our
                        <span class="text-rust">Global Server</span>
                        Locations</strong>
                </div>
                <p class="text-center">Strategically positioned to serve half of the world's player base</p>
            </div>
        </div>

        <div class="flex items-center justify-center py-12 bg-center bg-contain bg-no-repeat min-h-[800px]"
            style="background-image: url({{ asset('assets/rust-dedicated-server-locations.png') }})">
        </div>
    </div>


    @if (count($reviews))
        <div class="flex items-center justify-center py-[80px] text-white">
            <div class="max-w-7xl w-full p-3">
                <div class="w-full flex items-center justify-center">
                    <strong class=" text-5xl text-center mb-4 m-auto">Our Customer <span
                            class="text-rust">Reviews</span></strong>
                </div>
                <p class="text-center">What Our Valued Customers Say About Our Services</p>
                <div class="grid grid-cols-3 gap-6 mt-8">
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
