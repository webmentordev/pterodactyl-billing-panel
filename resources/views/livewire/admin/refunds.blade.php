<section class="w-full h-full">
    @if (count($refunds))
        @session('success')
            <x-alerts.success :message="$value" />
        @endsession
        <table class="w-full table-fixed">
            <tr>
                <th width="150px">User</th>
                <th>Email</th>
                <th width="150px">OrderID</th>
                <th width="120px">Gateway</th>
                <th width="120px">Ammount</th>
                <th width="120px">Refunded</th>
                <th width="90px">Reason</th>
                <th class="text-end">Refunded At</th>
                <th class="text-end">Created At</th>
                <th width="130px" class="text-end">Action</th>
            </tr>
            @foreach ($refunds as $item)
                <tr>
                    <td>{{ $item->order->user->name }}</td>
                    <td>{{ $item->order->user->email }}</td>
                    <td>{{ Str::afterLast($item->order_id, '-') }}</td>
                    <td>
                        <img src="{{ asset('assets/tebex-logo.png') }}" width="60">
                    </td>
                    <td>${{ number_format($item->amount, 2) }}</td>
                    <td>
                        @if ($item->refunded_at)
                            <img src="https://api.iconify.design/teenyicons:tick-small-solid.svg?color=%2334f31b"
                                width="30px">
                        @else
                            <img src="https://api.iconify.design/fluent-emoji-flat:cross-mark.svg" width="18px">
                        @endif
                    </td>
                    <td x-data="{ open: false }">
                        <button class="py-1 px-3 rounded-md bg-rust" @click="open = true">Read</button>
                        <div x-show="open" x-cloak x-transition x-on:click.self="open = false"
                            class="fixed top-0 left-0 w-full h-full z-30 bg-dark/70 backdrop-blur-md flex items-center justify-center">
                            <div class="bg-dark-100 p-5 rounded-lg border border-white/10 max-w-lg w-full flex-col">
                                <p class="text-white font-bold text-2xl mb-6">Reason for Refund
                                </p>
                                <p class="text-gray-200 mb-3">{{ $item->reason }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="text-end">
                        @if ($item->refunded_at)
                            {{ $item->refunded_at->format('d M,Y H:i:s') }} UTC
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-end">{{ $item->created_at->format('d M,Y H:i:s') }} UTC</td>
                    <td class="text-end">
                        @if (!$item->refunded_at)
                            <div class="flex items-center h-fit mt-1 justify-end">
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
