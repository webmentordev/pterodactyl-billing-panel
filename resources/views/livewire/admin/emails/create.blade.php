<div class="h-full flex w-full">
    <div class="max-w-3xl p-8 w-full h-full bg-dark rounded-lg border border-white/10">

        <h1 class="text-5xl mb-4 text-white text-center">Write an email</h1>
        @session('success')
            <x-alerts.success :message="$value" />
        @endsession
        <div class="mb-4">
            <x-input-label :value="__('Subject')" />
            <x-text-input class="block mt-1 w-full bg-dark-100" type="text" wire:model="subject" required />
            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label :value="__('Email Address')" />
            <x-text-input class="block mt-1 w-full bg-dark-100" type="email" wire:model="email" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label :value="__('Body (Markdown)')" />
            <x-textarea class="block mt-1 w-full bg-dark-100 min-h-[300px]" wire:model.live="body" rows="8"
                required />
            <x-input-error :messages="$errors->get('body')" class="mt-2" />
        </div>

        <button wire:click="sendIt" type="submit" wire:confirm="are you sure?"
            class="py-2 inline-block px-4 bg-rust font-semibold text-white cursor-pointer">Send It</button>
    </div>

    <div class="max-w-lg p-8 w-full h-full bg-dark rounded-lg border border-white/10 ml-4">
        <h3 class="text-5xl mb-4 text-white text-center">Live Preview</h3>
        <div class="preview p-3 bg-dark-100 rounded-md min-h-[53%]">
            {{ Illuminate\Mail\Markdown::parse($body) }}
        </div>
    </div>
</div>
