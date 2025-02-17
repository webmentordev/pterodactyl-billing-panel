<section class="w-full h-full">
    <div class="w-full mb-3 flex justify-end">
        <a href="{{ route('admin.emails.create') }}" class="py-2 px-4 bg-rust font-semibold text-white cursor-pointer">+
            Send an Email</a>
    </div>

    @if (count($emails))
        @session('success')
            <x-alerts.success :message="$value" />
        @endsession
        <table class="w-full table-fixed">
            <tr>
                <th width="380px">Email</th>
                <th width="450px">Subject</th>
                <th class="text-end">Content</th>
                <th class="text-end" width="240px">Created At</th>
            </tr>
            @foreach ($emails as $item)
                <tr>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->subject }}</td>
                    <td class="relative text-end" x-data="{ pop: false }">
                        <button class="text-rust-green underline font-semibold" @click="pop = !pop">Read</button>
                        <div x-show="pop" x-cloak x-transition
                            class="z-10 top-12 right-0 bg-dark-100 absolute w-[500px] p-4 rounded-2xl border border-white/10 preview">
                            {{ Illuminate\Mail\Markdown::parse($item->body) }}
                        </div>
                    </td>
                    <td class="text-end">{{ $item->created_at->format('d M,Y H:i:s') }} UTC</td>
                </tr>
            @endforeach
        </table>
        @if ($emails->hasPages())
            <div class="mt-3 bg-dark-100 rounded-lg p-3">
                {{ $emails->links() }}
            </div>
        @endif
    @else
        <p class="mt-4 text-center text-white">No custom email exist in the system!</p>
    @endif
</section>
