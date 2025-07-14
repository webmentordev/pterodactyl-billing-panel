<div class="z-50  backdrop-blur-sm bottom-4 left-0 fixed px-2 w-full" x-data="{open: false}" x-show="open" x-cloak
    x-transition x-init="setTimeout(() => {
        $refs.ouch.volume = 0.60;
        open = true;
        $refs.ouch.play();
    }, 2000);">
    <div
        class="flex relative justify-between items-center max-w-7xl m-auto bg-rust-green/70 p-2 660px:py-4 rounded-lg 660px:flex-col 660px:justify-center">
        <h3 class="text-2xl text-white 660px:text-center">🔥 Rust Servers are back in stock. Get your server
            Today 🔥</h3>
        <button class="border-white/40 border py-2 px-6 bg-white rounded-md font-semibold 660px:hidden"
            @click="open=false">Close</button>
        <button
            class="hidden absolute -top-4 right-0 bg-white rounded-full h-[30px] w-[30px] 660px:flex items-center justify-center"
            @click="open=false">X</button>
        <audio x-ref="ouch">
            <source src="{{ asset("assets/bubble-pop-06-351337.mp3") }}" type="audio/mpeg" />
        </audio>
    </div>
</div>