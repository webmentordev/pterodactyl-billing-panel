<section class="w-full h-full">
    <div class="w-full mb-3 flex justify-end">

        <a href="{{ route('admin.packages.create') }}" class="py-2 px-4 bg-rust font-semibold text-white cursor-pointer">+
            Add new
            package</a>
    </div>

    @if (count($packages))
        <table class="w-full">
            <tr>
                <th style="width: 100px">Image</th>
                <th>Stripe</th>
                <th>Name</th>
                <th>Price</th>
                <th>Players</th>
                <th>Storage</th>
                <th>Cores</th>
                <th>RAM</th>
                <th class="text-end">Created At</th>
                <th class="text-end">Action</th>
            </tr>
            @foreach ($packages as $item)
                <tr>
                    <td style="width: 100px">
                        <img src="{{ asset('storage/' . $item->image) }}" width="30" class="rounded-full">
                    </td>
                    <td>{{ $item->stripe_id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>${{ $item->price }}</td>
                    <td>{{ $item->players }}</td>
                    <td>{{ $item->storage }} ({{ $item->storage_type }})</td>
                    <td>{{ $item->cores }} vCores</td>
                    <td>{{ $item->ram }} ({{ $item->ram_type }})</td>
                    <td class="text-end">{{ $item->created_at->format('d M,Y H:i:s') }} UTC</td>
                    <td class="flex items-center justify-end">
                        <div class="flex items-center h-fit mt-1">
                            <a href="{{ route('admin.package.update', $item->id) }}" class="mr-1">
                                <img src="https://api.iconify.design/solar:pen-new-square-outline.svg?color=%233998fe"
                                    width="18">
                            </a>
                            <button wire:confirm="are you sure?" wire:click='deletePackage("{{ $item->id }}")'
                                type="submit" class="mr-1">
                                <img src="https://api.iconify.design/material-symbols:delete-outline.svg?color=%23d72d2d"
                                    width="20">
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        @if ($packages->hasPages())
            <div class="mt-3">
                {{ $packages->links }}
            </div>
        @endif
    @else
        <p class="mt-4 text-center">No package exist in the system!</p>
    @endif
</section>
