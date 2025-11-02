<section class="w-full h-full">
    <div class="max-w-7xl m-auto w-full p-4 mt-6">
        @session('failed')
            <x-alerts.failed class="text-white" :message="$value" />
        @endsession
        @session('success')
            <x-alerts.success :message="$value" />
        @endsession
        <div class="mb-4" wire:loading wire:target="delete">
            <x-alerts.loading message="Deleting..." />
        </div>
        @can('has-upload-space')
            <form wire:submit="save" method="POST" class="flex flex-col mb-4">
            <div class="w-full" x-data="{ uploading: false, progress: 0 }"
                x-on:livewire-upload-start="uploading = true"
                x-on:livewire-upload-finish="uploading = false"
                x-on:livewire-upload-cancel="uploading = false"
                x-on:livewire-upload-error="uploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <div class="flex items-center">
                    <div class="bg-white/10 border border-gray-100/10 w-full rounded-md mr-2">
                        <input type="file" wire:model="file" required class="w-full p-2 text-white">
                    </div>
                    <div x-show="!uploading">
                        <button class="py-3 px-4 bg-rust-green font-semibold text-white rounded-md" type="submit">Upload</button>
                    </div>
                </div>
                <div x-show="uploading" 
                    x-transition
                    class="mt-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-white">Uploading...</span>
                        <span class="text-sm font-semibold text-blue-600" x-text="progress + '%'"></span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full transition-all duration-300"
                            :style="`width: ${progress}%`">
                        </div>
                    </div>
                    <button type="button" 
                            wire:click="$cancelUpload('file')"
                            class="mt-3 text-sm text-red-600 hover:text-red-800 font-medium transition-colors duration-200">
                        Cancel Upload
                    </button>
                </div>
            </div>
        </form>
        @else
             <div class="alert alert-warning text-white mb-4">
                <p>You cannot upload files because:</p>
                <ul>
                    @if(auth()->user()->uploads()->sum('size') >= 61440)
                        <li>You've reached your 60 MB upload limit</li>
                    @endif
                    @if(auth()->user()->orders()->where('status', 'paid')->count() === 0)
                        <li>You need an active paid server to upload files</li>
                    @endif
                </ul>
            </div>
        @endcan

        <div class="bg-dark-100 border border-white/10 rounded-lg p-4 mb-4 grid grid-cols-1 gap-3">
            @if (count($uploads))
                @foreach ($uploads as $item)
                    <div class="flex items-center justify-between 660px:flex-col 660px:items-start @if (!$loop->last) pb-4 border-b border-white/20 @endif"
                        x-data="{ copied: false }">
                        <div class="flex flex-col">
                            <strong class="text-white text-lg mb-1">{{ Str::limit(Str::afterLast($item->name, '/'), 50, '...') }}</strong>
                            <span class="text-sm text-gray-300"><strong class="text-rust">Uploaded at:</strong> {{ $item->created_at->diffForHumans() }}, {{ $item->created_at->format('d m, Y H:i A') }} UTC</span>
                        </div>
                        <div class="flex items-center justify-end 660px:mt-1 660px:w-full">
                            <button 
                                @click="
                                    navigator.clipboard.writeText('{{ config('app.url') }}/storage/{{ $item->name }}');
                                    copied = true;
                                    setTimeout(() => copied = false, 2000);
                                "
                                class="py-1 px-4 bg-rust rounded-md font-semibold transition-colors"
                                x-text="copied ? 'Copied!' : 'Copy Link'">
                            </button>
                            @can('manage-upload', $item)
                                <button wire:click='delete("{{ $item->id }}")' class="p-2 rounded-full bg-red-700/20 ml-3">
                                    <img src="https://api.iconify.design/material-symbols:delete-outline-sharp.svg?color=%23ea2a2a" title="Delete this file">
                                </button>
                            @endcan
                        </div>
                    </div>
                @endforeach
            @else
                <span class="text-lg text-white">No uploads exist!</span>
            @endif
        </div>
        
        <div class="bg-dark-100 border border-white/10 rounded-lg p-4">
            <h3 class="text-white mb-2 text-3xl inline-block">File upload rules:</h3>
            <ul class="text-gray-200">
                <li class="mb-1"><strong class="text-rust">> </strong> File uploading is based on total size, not on the number of files you upload.</li>
                <li class="mb-1"><strong class="text-rust">> </strong> You must have at least one active server to use the file upload service.</li>
                <li class="mb-1"><strong class="text-rust">> </strong> All users with an active server will receive 60 MB of storage space, which can be used for one or multiple files.</li>
                <li class="mb-1"><strong class="text-rust">> </strong> Users without an active server purchase are not allowed to upload files. We have limited storage, so this rule is necessary.</li>
                <li class="mb-1"><strong class="text-rust">> </strong> Free trial servers are also not eligible for file uploads.</li>
                <li class="mb-1"><strong class="text-rust">> </strong> You can upload any type of file, such as server header backgrounds, kit images, custom map files, etc.</li>
                <li class="mb-1"><strong class="text-rust">> </strong> You can only upload one file per request, and the maximum file size allowed is 60 MB.</li>
                <li class="mb-1"><strong class="text-rust">> </strong> If a user is banned for any reason, all their files will be deleted.</li>
                <li class="mb-1"><strong class="text-rust">> </strong> If all your servers expire, your files will be deleted. However, if at least one server remains active, your files will stay safe.</li>
                <li class="mb-1"><strong class="text-rust">> </strong> If your server is in a Suspended state, your files will not be deleted.</li>
            </ul>
        </div>
    </div>
</section>
