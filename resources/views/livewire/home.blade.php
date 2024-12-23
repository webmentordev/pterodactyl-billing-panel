<section class="flex items-center justify-center">
    <div class="max-w-4xl w-full p-3 grid grid-cols-3 gap-6">
        @foreach ($packages as $package)
            <div class="rounded-lg border border-gray-200 p-8 flex flex-col justify-between">
                <div class="w-full">
                    <img src="{{ asset('/storage/' . $package->image) }}" width="80px" class="m-auto mb-5">
                    <h3 class="text-center text-2xl mt-3 mb-3 pb-4 border-b border-gray-200">{{ $package->name }}</h3>
                    <p class="uppercase mb-4 font-semibold text-indigo-600 text-center">{{ $package->players }} Players
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
                    <div class="markdown mb-4">
                        {!! Str::of($package->body)->markdown() !!}
                    </div>
                </div>
                <button wire:click='purchase("{{ $package->name }}")'
                    class="w-full bg-black rounded-lg text-white font-semibold py-3">Pay
                    {{ $package->price }}</button>
            </div>
        @endforeach
    </div>
</section>
