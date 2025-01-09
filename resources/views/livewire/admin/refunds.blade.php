<section class="w-full h-full">
    @if (count($refunds))
        <table class="w-full table-fixed">
            <tr>
                <th>User</th>
                <th>Email</th>
                <th>OrderID</th>
                <th>Redunded</th>
                <th class="text-end">Refunded At</th>
                <th class="text-end">Created At</th>
                <th class="text-end">Action</th>
            </tr>
            @foreach ($refunds as $item)
                <tr>
                    <td>{{ $item->order->user->name }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->order_id }}</td>
                    <td>${{ number_format($item->amount, 2) }}</td>
                    <td>
                        @if ($item->refunded_at)
                            <img src="https://api.iconify.design/teenyicons:tick-small-solid.svg?color=%2334f31b"
                                width="30px">
                        @else
                            <img src="https://api.iconify.design/fluent-emoji-flat:cross-mark.svg" width="18px">
                        @endif
                    </td>
                    <td class="text-end" width="280px">
                        @if ($item->refunded_at)
                            {{ $item->refunded_at->format('d M,Y H:i:s') }} UTC
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-end">{{ $item->created_at->format('d M,Y H:i:s') }} UTC</td>
                    <td class="flex items-center justify-end" width="160px">
                        <div class="flex items-center h-fit mt-1">
                            <a href="{{ route('admin.billing', $item->id) }}" class="mr-1">
                                <img src="https://api.iconify.design/mdi:eye-settings-outline.svg?color=%2358bcee"
                                    width="18">
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        @if ($refunds->hasPages())
            <div class="mt-3 bg-dark-100 rounded-lg p-3">
                {{ $refunds->links() }}
            </div>
        @endif
    @else
        <p class="mt-4 text-center text-white">No refund requests exist in the system!</p>
    @endif
</section>
