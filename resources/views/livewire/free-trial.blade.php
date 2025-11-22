<section class="w-full">
    <div class="min-h-[800px] h-[800px] bg-cover bg-center relative bg-fixed"
        style="background-image: url({{ asset('assets/background/rust-server-free-trial-hosting.webp') }})">
        <div class="absolute top-0 left-0 bgGradient w-full h-full"></div>
        <div class="relative flex items-center justify-center h-full w-full z-10">
            <div class="text-center">
                <h1 class="text-8xl text-gray-200 550px:text-5xl">Request Free Rust
                    <br>
                    <strong class="text-rust text-6xl">Server Trial</strong>
                </h1>
                <p class="text-white text-lg mb-4">Get your free trial of a Rust server for 24 hours. Submit request now.
                </p>
                <form wire:submit="requestTrial" method="post">
                    <div class="flex flex-col max-w-lg w-full" wire:ignore>
                        <div class="flex items-center m-auto w-full mb-3">
                            @session('success')
                                <x-alerts.success :message="$value" />
                            @endsession
                            <div class="flex flex-col mr-3 w-full">
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    :value="old('email')" required placeholder="Email Address" autocomplete="off" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <button class="py-2 px-3 bg-rust font-bold rounded-md text-white" type="submit">Submit</button>
                        </div>
                        <x-turnstile wire:model="trustileResponse" data-action="newsletter" data-theme="light" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-center py-[80px]">
        <div class="max-w-7xl w-full p-3 text-white 920px:max-w-3xl">
            <div class="w-full flex items-center justify-center">
                <h2 class="text-5xl text-center mb-4 m-auto 510px:text-4xl">What you get with a <span
                        class="text-rust font">FREE TRIAL
                    </span>
                    RUST SERVER</h2>
            </div>
            <p class="text-center">We offer the same server specifications as our paid Rust servers</p>
            <div class="grid grid-cols-1 gap-6 mt-8 920px:grid-cols-1">
                <div class="w-full py-2">
                    <p class="leading-7 mb-4">Our free Rust trial server includes everything we offer in our paid Rust
                        servers. Important Note: All free trial server requests must be approved by me, Ahmer (Founder),
                        to ensure there is sufficient capacity available on the server before approval. Trial servers
                        are created on the same machines as the paid Rust servers and are available for 24 hours. Trial
                        servers feature an Intel or Ryzen processor @ 4.70GHz, 15GB of 2666MHz DDR4 RAM, 60GB of M.2
                        NVMe storage, MySQL database support, and backup capacity, along with more features.</p>
                    <p class="leading-7">When a request is submitted, it is reviewed. If the request is accepted, you
                        will receive an email containing your Billing Panel and Game Panel login details, provided you
                        do not already have an account associated with that email. The trial server time begins
                        immediately after the request is accepted. If your request is rejected, it will be due to
                        insufficient space for a trial server. We
                        recommend trying again in 1–2 days, once other clients’ trial servers have expired.</p>
                </div>
                <img src="{{ asset('assets/fast-rust-server-loading.png') }}" alt="User Friendly Game Panel"
                    class="rounded-md">
            </div>
        </div>
    </div>
</section>
