<section class="w-full h-full">
    @if (count($users))
        <table class="w-full table-fixed">
            <tr>
                <th width="60px">Logo</th>
                <th>Name</th>
                <th>IP Address</th>
                <th>Email</th>
                <th width="80px">Signed</th>
                <th>Admin</th>
                <th>Orders</th>
                <th>Paid Invoices</th>
                <th>Trials</th>
                <th class="text-end">Joined At</th>
            </tr>
            @foreach ($users as $item)
                <tr>
                    <td>
                        @if ($item->google_avatar)
                            <img src="{{ $item->google_avatar }}" width="30" class="rounded-full">
                        @else
                            <img src="{{ asset('assets/rust-dedicated-favicon.png') }}" width="30"
                                title="Rust Dedicated Server" alt="Rust Dedicated Server">
                        @endif
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->ip_address ? $item->ip_address : '-' }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        @if ($item->google_id)
                            <img src="https://api.iconify.design/skill-icons:gmail-dark.svg" width="25px">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($item->is_admin)
                            <img src="https://api.iconify.design/teenyicons:tick-small-solid.svg?color=%2334f31b"
                                width="30px">
                        @else
                            <img src="https://api.iconify.design/fluent-emoji-flat:cross-mark.svg" width="20px">
                        @endif
                    </td>
                    <td><a href="{{ route('admin.orders', [$item->id]) }}"
                            class="underline text-rust">{{ $item->orders_count }}</a></td>
                    <td>{{ $item->billings_count }}</td>
                    <td>{{ $item->trials_count }}</td>
                    <td class="text-end">{{ $item->created_at->format('d M,Y H:i:s') }} UTC</td>
                </tr>
            @endforeach
        </table>
        @if ($users->hasPages())
            <div class="mt-3 bg-dark-100 rounded-lg p-3">
                {{ $users->links() }}
            </div>
        @endif
    @else
        <p class="mt-4 text-center text-white">No users exist in the system!</p>
    @endif
</section>
