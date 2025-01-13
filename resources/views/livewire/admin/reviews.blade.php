<section class="w-full h-full" x-data="{ open: false }">
    <div class="w-full mb-3 flex justify-end">
        <button @click="open = true" class="py-2 px-4 bg-rust font-semibold text-white cursor-pointer">+
            Add a review</button>
        <div class="fixed top-0 left-0 w-full h-full bg-dark/80 backdrop-blur-sm" x-show="open" x-cloak x-transition>
            <div class="w-full h-full flex items-center justify-center" @click.self="open = false">
                <div class="max-w-xl bg-dark-100 border border-white/10 rounded-lg p-6">
                    <h1 class="mb-3 text-3xl text-white">Create new Review</h1>
                    @session('saved')
                        <x-alerts.success :message="$value" />
                    @endsession
                    <div class="grid grid-cols-2 gap-3">
                        <div class="mb-2">
                            <x-input-label :value="__('Customer Name')" />
                            <x-text-input class="block mt-1 w-full" type="text" wire:model="name" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mb-2">
                            <x-input-label :value="__('Avatar URL')" />
                            <x-text-input class="block mt-1 w-full" type="text" wire:model="avatar_url" required />
                            <x-input-error :messages="$errors->get('avatar_url')" class="mt-2" />
                        </div>
                        <div class="mb-2">
                            <x-input-label :value="__('Review URL')" />
                            <x-text-input class="block mt-1 w-full" type="text" wire:model="review_url" required />
                            <x-input-error :messages="$errors->get('review_url')" class="mt-2" />
                        </div>
                        <div class="mb-2">
                            <x-input-label :value="__('Review Date')" />
                            <x-text-input class="block mt-1 w-full" type="text" wire:model="reviewed_at" required />
                            <x-input-error :messages="$errors->get('reviewed_at')" class="mt-2" />
                        </div>
                        <div class="mb-2">
                            <x-input-label :value="__('Review Stars')" />
                            <x-text-input class="block mt-1 w-full" type="number" wire:model="stars" required />
                            <x-input-error :messages="$errors->get('stars')" class="mt-2" />
                        </div>
                        <div class="mb-2">
                            <x-input-label :value="__('Platform')" />
                            <x-select wire:model="platform" required class="w-full">
                                <option value="" selected>Select Platform</option>
                                @foreach ($platforms as $singlePlatform)
                                    <option value="{{ $singlePlatform }}" selected>{{ $singlePlatform }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error :messages="$errors->get('platform')" class="mt-2" />
                        </div>

                        <div class="mb-2 col-span-2">
                            <x-input-label :value="__('Content')" />
                            <x-textarea class="block mt-1 w-full" type="text" wire:model="content" required />
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <button wire:click="save" type="submit"
                            class="py-2 inline-block px-4 bg-rust font-semibold text-white cursor-pointer">
                            <div wire:target="save" wire:loading.class="hidden">
                                Create Review
                            </div>
                            <div wire:target="save" wire:loading>
                                Processing...
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (count($reviews))
        @session('success')
            <x-alerts.success :message="$value" />
        @endsession
        <table class="w-full table-fixed">
            <tr>
                <th width="80px">Avatar</th>
                <th width="230px">Name</th>
                <th width="150px">Platform</th>
                <th width="200px">Reviewed At</th>
                <th width="150px">Stars</th>
                <th width="150px">Read Review</th>
                <th class="text-end">Created At</th>
                <th width="120px" class="text-end">Action</th>
            </tr>
            @foreach ($reviews as $item)
                <tr>
                    <td>
                        @if ($item->avatar_url)
                            <img src="{{ $item->avatar_url }}" width="30px" class="rounded-full">
                        @else
                            <img src="{{ asset('assets/rust-logo.png') }}" width="30px" class="rounded-full">
                        @endif
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>
                        @if ($item->platform == 'Google')
                            <div class="flex items-center">
                                <img src="https://api.iconify.design/devicon:google.svg" width="25px"
                                    class="object-fill">
                                <strong class="ml-2">Google</strong>
                            </div>
                        @elseif($item->platform == 'TrustPilot')
                            <div class="flex items-center">
                                <img src="https://api.iconify.design/simple-icons:trustpilot.svg?color=%2331bf4d"
                                    width="30px" class="object-fill">
                                <strong class="ml-2">Trustpilot</strong>
                            </div>
                        @endif
                    </td>
                    <td>{{ $item->reviewed_at }}</td>
                    <td>
                        <div class="h-full flex items-center">
                            @for ($index = 0; $index < $item->stars; $index++)
                                <img src="https://api.iconify.design/fluent-color:star-28.svg">
                            @endfor
                        </div>
                    </td>
                    <td>
                        <a href="{{ $item->review_url }}" target="_blank" class="py-1 px-3 rounded-md bg-rust">Visit</a>
                    </td>
                    <td class="text-end">{{ $item->created_at->format('d M,Y H:i:s') }} UTC</td>
                    <td class="text-end">
                        <div class="h-full flex items-center justify-end p-1">
                            <button wire:confirm="are you sure?" wire:click='delete("{{ $item->id }}")'
                                class="flex items-center rounded-md border border-red-600 bg-red-600/10 px-2">
                                <img
                                    src="https://api.iconify.design/material-symbols:delete-forever-sharp.svg?color=%23db3c14">
                                <span class="ml-1">Delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        @if ($reviews->hasPages())
            <div class="mt-3 bg-dark-100 rounded-lg p-3">
                {{ $reviews->links() }}
            </div>
        @endif
    @else
        <p class="mt-4 text-center text-white">No reviews exist in the system!</p>
    @endif
</section>
