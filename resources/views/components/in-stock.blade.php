<div class="z-50 bg-rust-green/70 backdrop-blur-sm bottom-0 left-0 fixed p-2 w-full" x-data="{open: false}"
    x-show="open" x-cloak x-transition x-init="setTimeout(() => {
        $refs.ouch.volume = 0.60;
        open = true;
        $refs.ouch.play();
    }, 2000);">
    <div class="flex justify-between items-center">
        <h3 class="text-2xl text-white">🔥 Rust Server are back in stock. Get your server Today 🔥</h3>
        <button class="border-white/40 border py-2 px-6 bg-white rounded-md font-semibold"
            @click="open=false">Close</button>
        <audio x-ref="ouch">
            <source src="{{ asset("assets/bubble-pop-06-351337.mp3") }}" type="audio/mpeg" />
        </audio>
    </div>
</div>