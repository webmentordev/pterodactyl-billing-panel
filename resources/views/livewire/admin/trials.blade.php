<section class="w-full h-full">
    @if (count($trials))
        @session('failed')
            <x-alerts.failed class="text-white" :message="$value" />
        @endsession
        <table class="w-full">
            <tr>
                <th width="350px">Email</th>
                <th width="150px">IP Address</th>
                <th>Status</th>
                <th class="text-end">Created At</th>
                <th class="text-end" width="200px">Action</th>
            </tr>
            @foreach ($trials as $item)
                <tr wire:key="{{ $item->id }}">
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->ip_address }}</td>
                    <td>
                        @if ($item->status == 'approved')
                            <span
                                class="py-1 px-3 rounded-full border font-semibold text-green-500 border-green-800 bg-green-600/10">Approved</span>
                        @elseif ($item->status == 'rejected')
                            <span
                                class="py-1 px-3 rounded-full border font-semibold text-red-500 border-red-800 bg-red-600/10">Rejected</span>
                        @elseif ($item->status == 'pending')
                            <span
                                class="py-1 px-3 rounded-full border font-semibold text-yellow-500 border-yellow-800 bg-yellow-600/10">Pending</span>
                        @endif
                    </td>
                    <td class="text-end">{{ $item->created_at->format('d M,Y H:i:s') }} UTC</td>
                    <td class="text-end">
                        @if ($item->status == 'pending')
                            <div class="flex items-center h-fit mt-1 justify-end">
                                <button class="bg-rust-green text-white py-1 px-3 rounded-lg font-semibold mr-2"
                                    wire:click='approve("{{ $item->id }}")'>
                                    <div wire:target="approve" wire:loading.class="hidden">
                                        Approve
                                    </div>
                                    <div wire:target="approve" wire:loading>
                                        Processing...
                                    </div>
                                </button>
                                <button class="bg-rust text-white py-1 px-3 rounded-lg font-semibold"
                                    wire:click='reject("{{ $item->id }}")'>
                                    <div wire:target="reject" wire:loading.class="hidden">
                                        Reject
                                    </div>
                                    <div wire:target="reject" wire:loading>
                                        Processing...
                                    </div>
                                </button>
                            </div>
                        @elseif ($item->status == 'approved')
                            <span
                                class="border-rust-green border bg-rust-green/10 text-white py-1 px-3 rounded-lg font-semibold">Approved</span>
                        @elseif ($item->status == 'rejected')
                            <span
                                class="border-rust border bg-rust/10 text-white py-1 px-3 rounded-lg font-semibold">Rejected</span>
                        @endif
                        @if ($item->status !== 'approved')
                            <button wire:confirm="are you sure?"
                                class="border-rust-green border bg-rust-green/10 text-white py-1 px-3 rounded-lg font-semibold"
                                wire:click='deleteTrial({{ $item->id }})'>
                                <div wire:target="deleteTrial" wire:loading.class="hidden">
                                    Delete
                                </div>
                                <div wire:target="deleteTrial" wire:loading>
                                    Processing...
                                </div>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
        @if ($trials->hasPages())
            <div class="mt-3 bg-dark-100 rounded-lg p-3">
                {{ $trials->links() }}
            </div>
        @endif
    @else
        <p class="mt-4 text-center text-white">No trail requests exist in the system!</p>
    @endif
</section>
