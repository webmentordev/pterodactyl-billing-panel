<section class="w-full h-full">
    @if (count($refunds))
        @session('success')
            <x-alerts.success :message="$value" />
        @endsession
        <table class="w-full table-fixed">
            <tr>
                <th width="150px">User</th>
                <th>Email</th>
                <th width="340px">OrderID</th>
                <th width="120px">Ammount</th>
                <th width="120px">Refunded</th>
                <th width="120px">Refunded At</th>
                <th class="text-end">Created At</th>
                <th width="130px" class="text-end">Action</th>
            </tr>
            @foreach ($refunds as $item)
                <tr>
                    <td>{{ $item->order->user->name }}</td>
                    <td>{{ $item->order->user->email }}</td>
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
                    <td>
                        @if ($item->refunded_at)
                            {{ $item->refunded_at->format('d M,Y H:i:s') }} UTC
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-end">{{ $item->created_at->format('d M,Y H:i:s') }} UTC</td>
                    <td class="flex justify-end">
                        @if (!$item->refunded_at)
                            <div class="flex items-center h-fit mt-1">
                                <button class="bg-rust-green text-white py-1 px-3 rounded-lg font-semibold"
                                    wire:click='approve("{{ $item->order_id }}")'>
                                    <div wire:target="approve" wire:loading.class="hidden">
                                        Approve
                                    </div>
                                    <div wire:target="approve" wire:loading>
                                        Processing...
                                    </div>
                                </button>
                            </div>
                        @else
                            -
                        @endif
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
