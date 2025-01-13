<section class="w-full h-full">
    @if (count($billing))
        <div class="max-w-7xl m-auto mt-6 w-full">
            <table class="w-full table-fixed rounded-lg overflow-hidden">
                <tr class="bg-dark-100 mt-4">
                    <th width="350px">OrderID #</th>
                    <th width="90px">Price</th>
                    <th width="90px">Paid</th>
                    <th>Status</th>
                    <th class="text-end" width="230px">Order Expire</th>
                    <th class="text-end" width="230px">Created At</th>
                </tr>
                @foreach ($billing as $item)
                    <tr class="odd:bg-white/10 first:border-none border-t border-white/20">
                        <td>{{ $item->id }}</td>
                        <td>${{ $item->order->price }}</td>
                        <td>
                            @if ($item->has_paid)
                                <img src="https://api.iconify.design/teenyicons:tick-small-solid.svg?color=%2334f31b"
                                    width="30px">
                            @else
                                <img src="https://api.iconify.design/fluent-emoji-flat:cross-mark.svg" width="18px">
                            @endif
                        </td>
                        <td width="50px">
                            @if ($item->status == 'paid')
                                <span
                                    class="py-1 px-3 rounded-full border font-semibold text-green-500 border-green-800 bg-green-600/10">Paid</span>
                            @elseif ($item->status == 'cancel')
                                <span
                                    class="py-1 px-3 rounded-full border font-semibold text-red-500 border-red-800 bg-red-600/10">Canceled</span>
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
                                    class="py-1 px-3 rounded-full border font-semibold text-red-500 border-red-800 bg-red-600/10">Expired</span>
                            @endif
                        </td>
                        <td class="text-end" width="280px">
                            @if ($item->expire_at)
                                {{ $item->expire_at->format('d M, Y h:i:s') }} UTC
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-end">{{ $item->created_at->format('d M, Y h:i:s') }} UTC</td>
                    </tr>
                @endforeach
            </table>
            @if ($billing->hasPages())
                <div class="mt-3 bg-dark-100 rounded-lg p-3">
                    {{ $billing->links() }}
                </div>
            @endif
        @else
            <p class="mt-4 text-center text-white text-2xl">Your billing records not found</p>
    @endif
    <div class="bg-dark-100 border border-white/10 rounded-lg p-4 mt-6">
        <h3 class="text-white mb-3 text-4xl">Billing Status Explained:</h3>
        <ul class="text-gray-200">
            <li class="mb-1"><strong class="text-red-500">Canceled:</strong> Your order was canceled because payment
                was not received within the required time frame. This invoice will be deleted, and no further action is
                needed.</li>
            <li class="mb-1"><strong class="text-green-500">Paid:</strong> Your invoice has been paid successfully,
                and
                everything is in order.
            </li>
            <li class="mb-1"><strong class="text-blue-500">Refunded:</strong> You requested a refund for the order,
                which has been processed as guaranteed. Your server has been deleted and marked as expired.
            </li>
            <li class="mb-1"><strong class="text-yellow-500">Pending:</strong> Your order is pending payment. Please
                visit the <a href="{{ route('dashboard') }}" class="underline text-rust">Dashboard</a> and
                complete the payment to initiate the installation of your server.
            </li>
            <li class="mb-1"><strong class="text-indigo-500">Suspended:</strong> Your server has been suspended but
                not
                deleted. If you renew this order later, a new paid invoice will be generated.
            </li>
            <li class="mb-1"><strong class="text-red-500">Expired:</strong> Your server has been deleted because it
                was not renewed on time, even after the 2-day grace period following suspension.
            </li>
        </ul>
    </div>
    </div>
</section>
