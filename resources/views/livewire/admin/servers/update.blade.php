<div class="h-full w-full flex items-center justify-center">
    <div class="max-w-xl p-8 w-full">
        @session('success')
            <x-alerts.success :message="$value" />
        @endsession
        <div wire:loading wire_target="updateServer">
            <x-alerts.loading message="Loading..." />
        </div>
        <h1 class="text-5xl mb-4 text-white text-center">Update Server</h1>

        <div class="grid grid-cols-2 gap-3">
            <div class="mb-2">
                <x-input-label :value="__('Server Name')" />
                <x-text-input class="block mt-1 w-full" type="text" wire:model="name" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="mb-2">
                <x-input-label :value="__('Server Domain')" />
                <x-text-input class="block mt-1 w-full" type="text" wire:model="domain" required />
                <x-input-error :messages="$errors->get('domain')" class="mt-2" />
            </div>
            <div class="mb-2">
                <x-input-label :value="__('IP Address')" />
                <x-text-input class="block mt-1 w-full" type="text" wire:model="ip" required />
                <x-input-error :messages="$errors->get('ip')" class="mt-2" />
            </div>
            <div class="mb-2">
                <x-input-label :value="__('Storage')" />
                <x-text-input class="block mt-1 w-full" type="number" wire:model="storage" required />
                <x-input-error :messages="$errors->get('storage')" class="mt-2" />
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
                <x-input-label :value="__('Location')" />
                <x-select wire:model="location" required class="w-full">
                    <option value="" selected>Select Server Location</option>
                    <option value="Germany">Germany</option>
                    <option value="United States">United States</option>
                    <option value="Norway">Norway</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Australia">Australia</option>
                    <option value="United Kingdom">United Kingdom</option>
                </x-select>
                <x-input-error :messages="$errors->get('ram_type')" class="mt-2" />
            </div>
            <div class="mb-2">
                <x-input-label :value="__('Cores')" />
                <x-text-input class="block mt-1 w-full" type="number" wire:model="cores" required />
                <x-input-error :messages="$errors->get('cores')" class="mt-2" />
            </div>
            <div class="mb-2">
                <x-input-label :value="__('Threads')" />
                <x-text-input class="block mt-1 w-full" type="number" wire:model="threads" required />
                <x-input-error :messages="$errors->get('threads')" class="mt-2" />
            </div>
            <div class="mb-2">
                <x-input-label :value="__('Swap (GB)')" />
                <x-text-input class="block mt-1 w-full" type="number" wire:model="swap" required />
                <x-input-error :messages="$errors->get('swap')" class="mt-2" />
            </div>
            <div class="mb-2">
                <x-input-label :value="__('RAM (GB)')" />
                <x-text-input class="block mt-1 w-full" type="number" wire:model="ram" required />
                <x-input-error :messages="$errors->get('ram')" class="mt-2" />
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
        </div>

        <span wire:click="updateServer" type="submit"
            class="py-2 inline-block px-4 bg-rust font-semibold text-white cursor-pointer">Update
            Server</span>
    </div>
</div>
