<section class="w-full h-full">
    <div class="w-full mb-3 flex justify-end">
        <a href="{{ route('admin.server.create') }}" class="py-2 px-4 bg-rust font-semibold text-white cursor-pointer">+
            Add new Server</a>
    </div>

    @if (count($servers))
        <table class="w-full">
            <tr>
                <th>Node</th>
                <th>IP</th>
                <th>Location</th>
                <th>Core</th>
                <th>RAM</th>
                <th>Storage</th>
                <th class="text-end">Orders</th>
                <th class="text-end">Created At</th>
                <th class="text-end">Action</th>
            </tr>
            @foreach ($servers as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->ip }}</td>
                    <td>{{ $item->location }}</td>
                    <td>{{ $item->cores }} vCores</td>
                    <td>{{ $item->ram }}GB ({{ $item->ram_type }})</td>
                    <td>{{ $item->storage }}GB ({{ $item->storage_type }})</td>
                    <td class="text-end">{{ count($item->orders) }}</td>
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
            <div class="mt-3">
                {{ $servers->links }}
            </div>
        @endif
    @else
        <p class="mt-4 text-center text-white">No servers exist in the system!</p>
    @endif
</section>
