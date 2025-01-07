<header class="h-screen bg-dark flex items-center justify-center">
    <div class="bg-white rounded-md p-6 max-w-lg w-full text-sm">
        <div class="text-center mb-2">
            <img src="https://api.iconify.design/material-symbols:check-circle.svg?color=%235d7239" class="m-auto mb-3"
                width="50" alt="Checkmark icon">
            <h1 class="text-2xl mb-2">Congratulations!</h1>
            <p class="mb-2">Your order has been renewed</p>
            <p>OrderID# <strong>{{ $order->id }}</strong></p>
        </div>
        <div class="bg-gray-100 p-6 rounded-lg border border-gray-200">
            <h2 class="mb-2 text-2xl">What HAPPENED?</h2>
            <p class="mb-3">Your server expiration date has been extended by 31 days from its original expiration
                date.
            </p>
            <p>In addition, we have sent you an email containing your next server expiration date. You can visit the
                billing section in your client area for more details.</p>
        </div>
        <a href="{{ route('home') }}"
            class="w-full bg-rust-green text-white p-3 rounded-md mt-3 inline-block text-center">Go
            To Home Page!</a>
    </div>
</header>
