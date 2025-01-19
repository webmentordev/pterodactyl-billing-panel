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
                    @if ($order->is_trial && $order->is_active)
                        <x-orders.active-trial-order-item :order="$order" />
                    @elseif ($order->is_trial && !$order->is_active)
                        <x-orders.expired-trial-order-item :order="$order" />
                    @elseif ($order->status == 'paid')
                        <x-orders.active-order-item :order="$order" :refund="$refundPercentage" :days="$refundDays" />
                    @elseif ($order->status == 'cancel')
                        <x-orders.cancel-order-item :order="$order" />
                    @elseif ($order->status == 'pending')
                        <x-orders.pending-order-item :order="$order" />
                    @elseif ($order->status == 'refund')
                        <x-orders.refund-order-item :order="$order" />
                    @elseif ($order->status == 'expired')
                        <x-orders.expired-order-item :order="$order" />
                    @elseif ($order->status == 'suspend')
                        <x-orders.suspend-order-item :order="$order" />
                    @endif
                @endforeach
            @else
                <p class="text-center py-2 text-white/90 text-xl">No orders found.</p>
            @endif
        </div>
        <div class="bg-dark-100 border border-white/10 rounded-lg p-4 mt-6">
            <h3 class="text-white mb-1 text-4xl">Notes from Ahmer, Founder</h3>
            <p class="mb-6 text-gray-300">I wrote these notes to ensure you are informed about Rust and how our system
                operates.</p>
            <ul class="text-gray-200 list-disc ml-5">
                <li class="mb-1">If you see a <strong>Renew</strong> button next to an order, it means you are
                    eligible for a refund, no questions asked.</li>
                <li class="mb-1">You can renew your order early; however, you must wait for the refund period to end
                    before claiming it.</li>
                <li class="mb-1">Renewed orders are also eligible for refunds under the same terms as your original
                    order. The <strong>Renew</strong> button will appear next to your order when applicable.</li>
                <li class="mb-1">There is no limit to the number of refunds you can request. Please refer to <a
                        href="{{ route('refund') }}" class="underline text-rust">our refund policy</a> for complete
                    details.</li>
                <li class="mb-1"><strong>Pending</strong> orders will expire if not paid within 3 hours.</li>
                <li class="mb-1">If you do not renew your order on time, your server will be placed in a suspended
                    state (not deleted)</li>
                <li class="mb-1">You will have 2 days to unsuspend your server by renewing the order.</li>
                <li class="mb-1">If the server is not renewed within this time frame, it will be deleted or marked as
                    expired</li>
                <li class="mb-1">For community servers, compliance with <a
                        href="https://support.facepunchstudios.com/hc/en-us/articles/360009062817-Guidelines-for-community-servers-using-plugins-mods"
                        class="underline text-rust" target="_blank" rel="nofollow">Facepunch Community Server</a> Rules
                    is mandatory.
                </li>
                <li class="mb-1">Breaking these rules may result in Facepunch blocking your server's IP, which will
                    cause all Rust servers on the same IP to disappear from the game.</li>
                <li class="mb-1">If you violate the Community Rules, we will be compelled to delete your server.
                    Please note that in such cases, the server will not be eligible for a refund.
                </li>
            </ul>

            <div class="flex items-center mt-6">
                <p class="text-white">For support and guidance, follow us at: </p>
                <ul class="flex items-center ml-3">
                    <li class="mr-5"><a href="{{ config('app.discord_link') }}" target="_blank"
                            title="RustDedicated Hosting Discord">
                            <img src="https://api.iconify.design/logos:discord-icon.svg"
                                alt="RustDedicated Hosting Discord" width="25px">
                        </a></li>
                    <li class="mr-5"><a href="{{ config('app.yourube_url') }}" target="_blank"
                            title="RustDedicated Hosting YouTube">
                            <img src="https://api.iconify.design/logos:youtube-icon.svg"
                                alt="RustDedicated Hosting YouTube" width="25px">
                        </a></li>
                    <li class="mr-5"><a href="{{ config('app.facebook_link') }}" target="_blank"
                            title="RustDedicated Hosting Facebook">
                            <img src="https://api.iconify.design/logos:facebook.svg"
                                alt="RustDedicated Hosting Facebook" width="24px">
                        </a></li>
                    <li class="mr-5"><a href="{{ config('app.twitter_link') }}" target="_blank"
                            title="RustDedicated Hosting Twitter">
                            <img src="https://api.iconify.design/logos:twitter.svg" alt="RustDedicated Hosting Twitter"
                                width="25px">
                        </a></li>
                    <li class="mr-3"><a href="mailto:support@rustdedicated.com" target="_blank"
                            title="RustDedicated Hosting Support Email">
                            <img src="https://api.iconify.design/twemoji:incoming-envelope.svg"
                                alt="RustDedicated Hosting Support Email" width="25px">
                        </a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
