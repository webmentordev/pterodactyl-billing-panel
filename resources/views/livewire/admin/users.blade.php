<section class="w-full h-full">
    @if (count($users))
        <table class="w-full">
            <tr>
                <th>Logo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Signed</th>
                <th>Admin</th>
                <th>Servers</th>
                <th class="text-end">Joined At</th>
            </tr>
            @foreach ($users as $item)
                <tr>
                    <td>
                        @if ($item->google_avatar)
                            <img src="{{ $item->google_avatar }}" width="30" class="rounded-full">
                        @else
                            <img src="{{ asset('assets/logo.png') }}" width="30">
                        @endif
                    </td>
                    <td>{{ $item->name }}</td>
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
                    <td>#</td>
                    <td class="text-end">{{ $item->created_at->format('d M,Y H:i:s') }} UTC</td>
                </tr>
            @endforeach
        </table>
        @if ($users->hasPages())
            <div class="mt-3">
                {{ $users->links }}
            </div>
        @endif
    @else
        <p class="mt-4 text-center">No users exist in the system!</p>
    @endif
</section>
