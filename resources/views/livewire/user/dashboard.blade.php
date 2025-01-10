<section class="w-full mt-4">
    <div class="py-2 max-w-7xl m-auto">
        @session('failed')
            <x-alerts.failed class="text-white" :message="$value" />
        @endsession
        @session('success')
            <x-alerts.success :message="$value" />
        @endsession
        <div class="flex flex-col">
            @if (count($orders))
                @foreach ($orders as $order)
                    @if ($order->status == 'paid')
                        <x-orders.active-order-item :order="$order" :refund="$refundPercentage" :days="$refundDays" />
                    @elseif ($order->status == 'cancel')
                        <x-orders.cancel-order-item :order="$order" />
                    @elseif ($order->status == 'pending')
                        <x-orders.pending-order-item :order="$order" />
                    @elseif ($order->status == 'refund')
                        <x-orders.refund-order-item :order="$order" />
                    @endif
                @endforeach
            @else
                <p class="text-center py-2 text-white/90 text-xl">No orders found.</p>
            @endif
        </div>
    </div>
</section>
