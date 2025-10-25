<section class="w-full h-full">
    @if (count($trials))
    @session('failed')
    <x-alerts.failed class="text-white" :message="$value" />
    @endsession
    <table class="w-full table-fixed">
        <tr>
            <th width="300px">Email</th>
            <th width="120px">IP Address</th>
            <th width="120px">Status</th>
            <th>User Agent</th>
            <th width="90px">Viewed?</th>
            <th class="text-end" width="180px">Created At</th>
            <th class="text-end" width="330px">Action</th>
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
            <td x-data="{read: false}">
                @if ($item->user_agent)
                <span class="cursor-pointer" x-show="!read"
                    @click="read = true">{{ Str::limit($item->user_agent, 50, '...') }}</span>
                <span class="cursor-pointer" x-show="read" @click="read = false">{{ $item->user_agent }}</span>
                @else
                -
                @endif
            </td>
            <td>
                @if ($item->viewed_email)
                <strong class="py-1 px-3 bg-rust-green">Yes</strong>
                @else
                <strong class="py-1 px-3 bg-rust">No</strong>
                @endif
            </td>
            <td class="text-end">{{ $item->created_at->format('d M,Y H:i') }}</td>
            <td class="text-end">
                @if ($item->status == 'pending')
                <div class="flex items-center h-fit">
                    <button class="bg-rust-green text-white py-1 px-3 rounded-lg font-semibold mr-2"
                        wire:click='approve("{{ $item->id }}")'>
                        <div wire:target="approve" wire:loading.class="hidden">
                            Approve
                        </div>
                        <div wire:target="approve" wire:loading>
                            Processing...
                        </div>
                    </button>
                    <button class="bg-red-600 text-white py-1 px-3 rounded-lg font-semibold mr-2"
                        wire:click='reject_delete("{{ $item->id }}")'>
                        <div wire:target="reject_delete" wire:loading.class="hidden">
                            Reject & Delete
                        </div>
                        <div wire:target="reject_delete" wire:loading>
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