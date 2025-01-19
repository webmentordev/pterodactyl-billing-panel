<section class="w-full">
    <div class="min-h-[800px] h-[800px] bg-cover bg-center relative bg-fixed"
        style="background-image: url({{ asset('assets/background/rust-server-free-trial-hosting.webp') }})">
        <div class="absolute top-0 left-0 bgGradient w-full h-full"></div>
        <div class="relative flex items-center justify-center h-full w-full z-10">
            <div class="text-center">
                <h1 class="text-8xl text-gray-200 550px:text-5xl">Request Free Rust Server
                    <br>
                    <strong class="text-rust">Trial</strong>
                </h1>
                <p class="text-white text-lg mb-4">Feature launches in less than
                    {{ \Carbon\Carbon::parse('1 February, 2025')->diffForHumans() }}
                </p>
            </div>
        </div>
    </div>
</section>
