@props(['review', 'index'])
<a href="{{ $review->review_url }}" title="RustDedicated Hosting Customer Review {{ $index }}" target="_blank"
    class="p-8 bg-dark-100 border border-white/10 rounded-xl text-white group flex flex-col justify-between">
    <div class="flex flex-col">
        <div class="flex justify-between items-start">
            <div class="flex mb-5">
                <div class="p-1 rounded-full border-[2px] border-rust group-hover:border-rust-green h-fit">
                    @if ($review->avatar_url)
                        <div class="h-[70px] w-[70px] bg-cover bg-center rounded-full"
                            style="background-image: url({{ $review->avatar_url }})">
                        </div>
                    @else
                        <div class="h-[70px] w-[70px] bg-cover bg-center rounded-full"
                            style="background-image: url({{ asset('assets/rust-logo.png') }})">
                        </div>
                    @endif
                </div>
                <div class="flex flex-col ml-3">
                    <div class="flex items-center mb-1">
                        @for ($index = 0; $index < $review->stars; $index++)
                            <img data-src="https://api.iconify.design/fluent-color:star-28.svg" width="23"
                                class="mr-1 lazyload" alt="Review star {{ $index }}">
                        @endfor
                    </div>
                    <span class="font-bold text-lg">{{ $review->name }}</span>
                    <p class="flex items-center"><img
                            data-src="https://api.iconify.design/si:verified-duotone.svg?color=%2318adec" width="20"
                            class="lazyload" alt="Verified Icon">
                        <span class="text-sm ml-1">Verified
                            Customer</span>
                    </p>
                </div>
            </div>
        </div>
        <p>{{ $review->content }}</p>
    </div>
    <div class="flex justify-between items-center w-full mt-4">
        @if ($review->platform == 'Google')
            <div class="flex items-center">
                <img data-src="https://api.iconify.design/devicon:google.svg" width="25px"
                    class="object-fill lazyload" alt="Google Reviews Icon">
                <strong class="ml-2">Google</strong>
            </div>
        @elseif($review->platform == 'TrustPilot')
            <div class="flex items-center">
                <img data-src="https://api.iconify.design/simple-icons:trustpilot.svg?color=%2331bf4d" width="30px"
                    alt="Trustpilot Logo" class="object-fill lazyload">
                <strong class="ml-2">Trustpilot</strong>
            </div>
        @endif
        <span
            class="hover:bg-dark font-semibold w-fit inline-block mt-2 bg-rust transition-all py-1 px-7 rounded-sm bg-">Visit</span>
    </div>
</a>
