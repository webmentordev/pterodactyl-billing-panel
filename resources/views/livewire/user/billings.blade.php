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
    </div>
</section>
