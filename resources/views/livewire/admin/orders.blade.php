<section class="w-full h-full">
    @if (count($orders))
        <table class="w-full">
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Package</th>
                <th>Price</th>
                <th>Payments</th>
                <th>Paid</th>
                <th>Emailed</th>
                <th>Status</th>
                <th class="text-end">Expire At</th>
                <th class="text-end">Created At</th>
                <th class="text-end">Action</th>
            </tr>
            @foreach ($orders as $item)
                <tr>
                    <td>{{ Str::afterLast($item->id, '-') }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->package->name }}</td>
                    <td>${{ $item->price }}</td>
                    <td>{{ $item->total_payments }}</td>
                    <td>
                        @if ($item->has_paid)
                            <img src="https://api.iconify.design/teenyicons:tick-small-solid.svg?color=%2334f31b"
                                width="30px">
                        @else
                            <img src="https://api.iconify.design/fluent-emoji-flat:cross-mark.svg" width="18px">
                        @endif
                    </td>
                    <td>
                        @if ($item->email_sent)
                            <img src="https://api.iconify.design/teenyicons:tick-small-solid.svg?color=%2334f31b"
                                width="30px">
                        @else
                            <img src="https://api.iconify.design/material-symbols:alarm-outline.svg?color=%23f9fd26"
                                width="20px">
                        @endif
                    </td>
                    <td width="50px">
                        @if ($item->status == 'paid')
                            <span
                                class="py-1 px-3 rounded-full border font-semibold text-green-500 border-green-800 bg-green-600/10">Paid</span>
                        @elseif ($item->status == 'cancel')
                            <span
                                class="py-1 px-3 rounded-full border font-semibold text-red-500 border-red-800 bg-red-600/10">Cancel</span>
                        @elseif ($item->status == 'pending')
                            <span
                                class="py-1 px-3 rounded-full border font-semibold text-yellow-500 border-yellow-800 bg-yellow-600/10">Pending</span>
                        @else
                            <span
                                class="py-1 px-3 rounded-full border font-semibold text-blue-500 border-blue-800 bg-blue-600/10">Refunded</span>
                        @endif
                    </td>
                    <td class="text-end" width="280px">
                        @if ($item->expire_at)
                            {{ $item->expire_at->format('d M,Y H:i:s') }} UTC
                        @else
                            -
                        @endif
                    </td>

                    <td class="text-end">{{ $item->created_at->format('d M,Y H:i:s') }} UTC</td>
                    <td class="flex items-center justify-end">
                        <div class="flex items-center h-fit mt-1">
                            <a href="{{ $item->checkout_url }}" target="_blank" class="mr-1">
                                <img src="https://api.iconify.design/ion:eye-sharp.svg?color=%23345cfe" width="18">
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
        @if ($orders->hasPages())
            <div class="mt-3">
                {{ $orders->links }}
            </div>
        @endif
    @else
        <p class="mt-4 text-center">No orders exist in the system!</p>
    @endif
</section>
