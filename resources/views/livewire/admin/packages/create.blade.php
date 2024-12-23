<div class="h-full w-full flex items-center justify-center">
    <div class="max-w-xl p-8 w-full">
        @session('success')
            <x-alerts.success :message="$value" />
        @endsession
        <div wire:loading wire_target="createNewPackage">
            <x-alerts.loading message="Loading..." />
        </div>
        <h1 class="text-5xl mb-4 text-white text-center">Create new Package</h1>

        <div class="grid grid-cols-2 gap-3">
            <div class="mb-2">
                <x-input-label :value="__('Package Name')" />
                <x-text-input class="block mt-1 w-full" type="text" wire:model="name" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="mb-2">
                <x-input-label :value="__('Players')" />
                <x-text-input class="block mt-1 w-full" type="number" wire:model="players" required />
                <x-input-error :messages="$errors->get('players')" class="mt-2" />
            </div>
            <div class="mb-2">
                <x-input-label :value="__('Storage (GB)')" />
                <x-text-input class="block mt-1 w-full" type="number" wire:model="storage" required />
                <x-input-error :messages="$errors->get('storage')" class="mt-2" />
            </div>
            <div class="mb-2">
                <x-input-label :value="__('Price')" />
                <x-text-input class="block mt-1 w-full" type="number" step="0.01" wire:model="price" required />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>
            <div class="mb-2">
                <x-input-label :value="__('Storage Type')" />
                <x-select wire:model="storage_type" required class="w-full">
                    <option value="" selected>Select Storage type</option>
                    <option value="HDD">HDD</option>
                    <option value="SSD">SSD</option>
                    <option value="NVME">NVME</option>
                </x-select>
                <x-input-error :messages="$errors->get('storage_type')" class="mt-2" />
            </div>
            <div class="mb-2">
                <x-input-label :value="__('RAM Type')" />
                <x-select wire:model="ram_type" required class="w-full">
                    <option value="" selected>Select RAM type</option>
                    <option value="DDR3">DDR3</option>
                    <option value="DDR4">DDR4</option>
                    <option value="DDR5">DDR5</option>
                </x-select>
                <x-input-error :messages="$errors->get('ram_type')" class="mt-2" />
            </div>
            <div class="mb-2">
                <x-input-label :value="__('Cores')" />
                <x-text-input class="block mt-1 w-full" type="number" wire:model="cores" required />
                <x-input-error :messages="$errors->get('cores')" class="mt-2" />
            </div>
            <div class="mb-2">
                <x-input-label :value="__('RAM (GB)')" />
                <x-text-input class="block mt-1 w-full" type="number" wire:model="ram" required />
                <x-input-error :messages="$errors->get('ram')" class="mt-2" />
            </div>
        </div>
        <div class="mt-4 mb-3 w-full">
            <x-input-label :value="__('Image (Transparent, png only)')" />
            <x-text-input wire:model="image" type="file" accept="image/*" required class="w-full rounded-none p-2" />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>

        <div class="mt-4 mb-3 w-full">
            <x-input-label :value="__('Body (markdown)')" />
            <x-textarea wire:model="body" required />
            <x-input-error :messages="$errors->get('body')" class="mt-2" />
        </div>

        <span wire:click="createNewPackage" type="submit"
            class="py-2 inline-block px-4 bg-rust font-semibold text-white cursor-pointer">Create
            package</span>
    </div>
</div>
