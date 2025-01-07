<section class="w-full h-full">
    @if (count($reminders))
        <table class="w-full">
            <tr>
                <th>Email</th>
                <th class="text-end">Created At</th>
            </tr>
            @foreach ($reminders as $item)
                <tr>
                    <td>{{ $item->email }}</td>
                    <td class="text-end">{{ $item->created_at->format('d M,Y H:i:s') }} UTC</td>
                </tr>
            @endforeach
        </table>
        @if ($reminders->hasPages())
            <div class="mt-3 bg-dark-100 rounded-lg p-3">
                {{ $reminders->links() }}
            </div>
        @endif
    @else
        <p class="mt-4 text-center text-white">No reminders exist in the system!</p>
    @endif
</section>
