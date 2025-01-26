<section class="w-full h-full">
    @if (count($orders))
        @session('success')
            <x-alerts.success :message="$value" />
        @endsession
        <table class="w-full table-fixed">
            <tr>
                <th width='220px'>Product</th>
                <th width='120px'>OrderID</th>
                <th>CustomerID</th>
                <th>Name</th>
                <th width="270px">Email</th>
                <th>Status</th>
                <th>Price</th>
                <th>Currency</th>
                <th>Refunded</th>
                <th>Refund Price</th>
                <th class="text-end">Created At</th>
                <th class="text-end" width="160px">Action</th>
            </tr>
            @foreach ($orders as $item)
                @php
                    // Decode the JSON payload
                    $data = json_decode($item->payload, true);
                    $attributes = $data['data']['attributes'] ?? [];
                    $firstOrderItem = $attributes['first_order_item'] ?? [];
                @endphp
                <tr>
                    <td>{{ $firstOrderItem['product_name'] ?? 'N/A' }}</td>
                    <td>{{ $data['data']['id'] ?? 'N/A' }}</td>
                    <td>{{ $attributes['customer_id'] ?? 'N/A' }}</td>
                    <td>{{ $attributes['user_name'] ?? 'N/A' }}</td>
                    <td>{{ $attributes['user_email'] ?? 'N/A' }}</td>
                    <td>{{ $attributes['status'] ?? 'N/A' }}</td>
                    <td>{{ $attributes['total_formatted'] ?? 'N/A' }}</td>
                    <td>{{ $attributes['currency'] ?? 'N/A' }}</td>
                    <td>{{ $attributes['refunded'] ? 'Yes' : 'No' }}</td>
                    <td>{{ $attributes['refunded_amount_formatted'] ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($attributes['created_at'])->format('d M,Y H:i:s') }} UTC</td>
                    <td>
                        <div class="flex items-center justify-end" width="160px">
                            <button wire:click='delete("{{ $item->id }}")' wire:confirm="Are you sure?">
                                <img src="https://api.iconify.design/material-symbols:delete.svg?color=%23e92b2b"
                                    width="22">
                            </button>
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
        <p class="mt-4 text-center text-white">No lemon squeezy orders exist in the system!</p>
    @endif
</section>
