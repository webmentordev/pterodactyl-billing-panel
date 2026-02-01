<section class="w-full h-full">
    @if (count($orders))
        <table class="w-full table-fixed">
            <tr>
                <th width="130px">ID</th>
                <th width="130px">Bill Order ID</th>
                <th width="170px">User</th>
                <th width="90px">Price</th>
                <th width="90px">Payments</th>
                <th width="150px">Server</th>
                <th width="90px">Paid</th>
                <th width="90px">IsActive</th>
                <th width="90px">Invoices</th>
                <th width="90px">Emailed</th>
                <th width="150px">Status</th>
                <th class="text-end">Expire At</th>
                <th class="text-end">Created At</th>
                <th class="text-end" width="160px">Action</th>
            </tr>
            @foreach ($orders as $item)
                <tr>
                    <td>{{ Str::afterLast($item->id, '-') }}</td>
                    <td>
                        @if ($item->is_trial)
                            <span
                                class="py-1 px-3 rounded-full border font-semibold text-yellow-500 border-yellow-800 bg-yellow-600/10">Trial</span>
                        @elseif (!$item->is_trial && $item->status == 'pending')
                            -
                        @else
                            <x-expand-item text="{{ Str::afterLast($item->gateway_order_id, '-') }}" length="9"/>
                        @endif
                    </td>
                    <td><x-expand-item text="{{ $item->user->name }}" length="15"/></td>
                    <td>${{ $item->price }}</td>
                    <td>{{ $item->total_payments }}</td>
                    <td>
                        @if ($item->server)
                            {{ $item->server->name }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($item->has_paid)
                            <img src="https://api.iconify.design/teenyicons:tick-small-solid.svg?color=%2334f31b"
                                width="30px">
                        @else
                            <img src="https://api.iconify.design/fluent-emoji-flat:cross-mark.svg" width="18px">
                        @endif
                    </td>

                    <td>
                        @if ($item->is_active)
                            <img src="https://api.iconify.design/teenyicons:tick-small-solid.svg?color=%2334f31b"
                                width="30px">
                        @else
                            <img src="https://api.iconify.design/fluent-emoji-flat:cross-mark.svg" width="20px">
                        @endif
                    </td>
                    <td>
                        {{ $item->billings_count }}
                    </td>
                    <td>
                        @if ($item->has_emailed)
                            <img src="https://api.iconify.design/teenyicons:tick-small-solid.svg?color=%2334f31b"
                                width="30px">
                        @else
                            <img src="https://api.iconify.design/fluent-emoji-flat:cross-mark.svg" width="20px">
                        @endif
                    </td>
                    <td>
                        @if ($item->status == 'paid')
                            <span
                                class="py-1 px-3 rounded-full border font-semibold text-green-500 border-green-800 bg-green-600/10">Paid</span>
                        @elseif ($item->status == 'trial')
                            <span
                                class="py-1 px-3 rounded-full border font-semibold text-rust-green border-rust-green bg-rust-green/10">Trial</span>
                        @elseif ($item->status == 'cancel')
                            <span
                                class="py-1 px-3 rounded-full border font-semibold text-red-500 border-red-800 bg-red-600/10">Cancel</span>
                        @elseif ($item->status == 'suspend')
                            <span
                                class="py-1 px-3 rounded-full border font-semibold text-indigo-700 border-indigo-800 bg-indigo-600/10">Suspended</span>
                        @elseif ($item->status == 'pending')
                            <span
                                class="py-1 px-3 rounded-full border font-semibold text-yellow-500 border-yellow-800 bg-yellow-600/10">Pending</span>
                        @elseif ($item->status == 'refund')
                            <span
                                class="py-1 px-3 rounded-full border font-semibold text-blue-500 border-blue-800 bg-blue-600/10">Refunded</span>
                        @elseif ($item->status == 'expired')
                            <span
                                class="py-1 px-3 rounded-full border font-semibold text-red-700 border-red-800 bg-red-600/10">Expired</span>
                        @elseif ($item->status == 'trial_expired')
                            <span
                                class="py-1 px-3 rounded-full border font-semibold text-orange-700 border-orange-800 bg-orange-600/10">Trial
                                Expired</span>
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
        @if ($orders->hasPages())
            <div class="mt-3 bg-dark-100 rounded-lg p-3">
                {{ $orders->links() }}
            </div>
        @endif
    @else
        <p class="mt-4 text-center text-white">No orders exist in the system!</p>
    @endif
</section>
