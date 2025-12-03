<section class="w-full h-full">
    <div class="w-full mb-3 flex justify-between">
        <button wire:click="sendReminder" class="py-2 px-4 bg-rust font-semibold text-white cursor-pointer">
            <div wire:target="sendReminder" wire:loading.class="hidden">
                Send Reminder
            </div>
            <div wire:target="sendReminder" wire:loading>
                Processing...
            </div>
        </button>
        <a href="{{ route('admin.server.create') }}" class="py-2 px-4 bg-rust font-semibold text-white cursor-pointer">+
            Add new Server</a>
    </div>

    @if (count($servers))
        @session('success')
            <x-alerts.success :message="$value" />
        @endsession
        <table class="w-full table-fixed">
            <tr>
                <th width="90px">NodeID</th>
                <th width="150px">Name</th>
                <th width="250px">Processor</th>
                <th width="210px">Domain</th>
                <th width="130px">IP</th>
                <th width="130px">Location</th>
                <th width="130px">Specs</th>
                <th class="text-end" width="120px">Active</th>
                <th class="text-end" width="120px">Orders</th>
                <th class="text-end" width="120px">Trials</th>
                <th class="text-end" width="120px">Usages</th>
                <th class="text-end">Added At</th>
                <th class="text-end" width="120px">Action</th>
            </tr>
            @foreach ($servers as $item)
                <tr>
                    <td>{{ $item->node_id }}</td>
                    <td>{{ $item->name }}</td>
                    <td style="width: 500px">{{ $item->processor }}</td>
                    <td>{{ $item->domain }}</td>
                    <td>{{ $item->ip }}</td>
                    <td>{{ $item->location }}</td>
                    <td class="relative" x-data="{ pop: false }">
                        <button class="text-rust-green underline font-semibold" @click="pop = !pop">View</button>
                        <div x-show="pop" x-cloak x-transition
                            class="z-10 top-12 right-0 bg-dark-100 absolute w-[250px] p-2 rounded-2xl border border-white/10">
                            <ul class="specs p-3">
                                <li><strong>Cores</strong><span>{{ $item->cores }}</span></li>
                                <li><strong>Threads</strong><span>{{ $item->threads }}</span></li>
                                <li><strong>Threads Limit</strong><span>{{ $item->threads_limit }}</span></li>
                                <li><strong>Storage</strong><span>{{ $item->storage }}GB
                                        ({{ $item->storage_type }})
                                    </span></li>
                                <li><strong>RAM</strong><span>{{ $item->ram }}GB
                                        ({{ $item->ram_type }})</span></li>
                                <li><strong>Swap</strong><span>{{ $item->swap }}GB</span></li>
                            </ul>
                        </div>
                    </td>
                    <td class="text-end">
                        @if ($item->is_active)
                            <button wire:click='activeStatus("{{ $item->id }}")'
                                class="py-1 px-3 rounded-lg text-white bg-rust-green">Active</button>
                        @else
                            <button wire:click='activeStatus("{{ $item->id }}")'
                                class="py-1 px-3 rounded-lg text-white bg-rust">InActive</button>
                        @endif

                    </td>
                    <td class="text-end">{{ $item->orders_count }}</td>
                    <td class="text-end">{{ $item->trails_count }}</td>
                    <td class="text-end">{{ count($item->usage) }}/{{ $item->threads_limit / 2 }}</td>
                    <td class="text-end">{{ $item->created_at->format('d M,Y H:i:s') }} UTC</td>
                    <td class="flex items-center justify-end">
                        <div class="flex items-center h-fit mt-1">
                            <a href="{{ route('admin.server.update', $item->id) }}" class="mr-1">
                                <img src="https://api.iconify.design/solar:pen-new-square-outline.svg?color=%233998fe"
                                    width="18">
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        @if ($servers->hasPages())
            <div class="mt-3 bg-dark-100 rounded-lg p-3">
                {{ $servers->links() }}
            </div>
        @endif
    @else
        <p class="mt-4 text-center text-white">No servers exist in the system!</p>
    @endif
</section>
