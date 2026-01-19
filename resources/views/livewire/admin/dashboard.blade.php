<section class="w-full h-full">
    <div class="max-w-xl m-auto w-full grid grid-cols-2 gap-3">
        <div class="p-5 bg-dark rounded-lg shadow-sm">
            <h3 class="text-3xl mb-3 text-white">Registered Users</h3>
            <span class="text-gray-300">Total: <strong>{{ $users }}</strong></span>
        </div>
        <div class="p-5 bg-dark rounded-lg shadow-sm">
            <h3 class="text-3xl mb-3 text-white">Trial Requests</h3>
            <span class="text-gray-300">Total: <strong>{{ $trials }}</strong></span>
        </div>
        <div class="p-5 bg-dark rounded-lg shadow-sm">
            <h3 class="text-3xl mb-3 text-rust">Pending Trials</h3>
            <span class="text-gray-300">Total: <strong>{{ $pending_trials }}</strong></span>
        </div>
    </div>
</section>
