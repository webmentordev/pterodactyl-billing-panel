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
                    seamless, <br> low-latency gameplay</p>
                <a href="{{ route('package') }}"
                    class="inline-block text-white bg-rust p-3 rounded-sm font-semibold px-4 hover:bg-rust-green transition-all"
                    title="Buy Under 20$ Dedicated Rust Server">Get 20$ Server</a>
            </div>
        </div>
    </div>
    <div class="flex items-center justify-center py-12" id="packages">
        <div class="max-w-4xl w-full p-3 grid grid-cols-3 gap-6">
            {{-- @foreach ($packages as $package)
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
            @endforeach --}}
        </div>
    </div>
</section>
