<section class="w-full h-full">
    <div class="w-full mb-3 flex justify-end">
        <a href="{{ route('admin.server.create') }}" class="py-2 px-4 bg-rust font-semibold text-white cursor-pointer">+
            Add new Server</a>
    </div>

    @if (count($servers))
        <table class="w-full table-fixed">
            <tr>
                <th width="90px">NodeID</th>
                <th width="90px">Name</th>
                <th width="200px">Processor</th>
                <th width="210px">Domain</th>
                <th>IP</th>
                <th>Location</th>
                <th width="60px">Cores</th>
                <th width="80px">Threads</th>
                <th>RAM</th>
                <th>Storage</th>
                <th width="80px">Swap</th>
                <th class="text-end" width="80px">Orders</th>
                <th class="text-end">Added At</th>
                <th class="text-end">Action</th>
            </tr>
            @foreach ($servers as $item)
                <tr>
                    <td>{{ $item->node_id }}</td>
                    <td>{{ $item->name }}</td>
                    <td style="width: 500px">{{ $item->processor }}</td>
                    <td>{{ $item->domain }}</td>
                    <td>{{ $item->ip }}</td>
                    <td>{{ $item->location }}</td>
                    <td>{{ $item->cores }}</td>
                    <td>{{ $item->threads }}</td>
                    <td>{{ $item->ram }}GB ({{ $item->ram_type }})</td>
                    <td>{{ $item->storage }}GB ({{ $item->storage_type }})</td>
                    <td>{{ $item->swap }}GB</td>
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
