<?php

namespace App\Livewire\User;

use Exception;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Refund;
use App\Models\Billing;
use Livewire\Component;
use Stripe\StripeClient;
use App\Jobs\OrderRefundJob;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class Dashboard extends Component
{
    public $price = 20.0, $refundPercentage = 85, $refundDays = 4, $reason;
    public $activeGateway = null;

    public function mount()
    {
        $this->activeGateway = config('app.gateway');
        $this->price = config('app.price');
        $this->refundPercentage = config('app.refund_percentage');
        $this->refundDays = config('app.refund_days');
    }

    #[Layout('layouts.livewire.user')]
    public function render()
    {
        return view('livewire.user.dashboard', [
            'orders' => Order::where('user_id', Auth::user()->id)->latest()->get()
        ]);
    }

    public function renew(Order $order)
    {
        $this->owner($order);
        $refundDate = Carbon::parse($order->refund_at);
        if (!$refundDate->isPast()) {
            return session()->flash('failed', 'You cannot renew until your refund period has ended.');
        }

        if ($this->activeGateway == 'lemon_squeezy') {
            $this->lemonCheckout($order);
        }
        if ($this->activeGateway == 'stripe') {
            $this->stripeCheckout($order);
        }
    }

    public function pay(Order $order)
    {
        $this->owner($order);
        if ($order->status == 'pending' && $order->has_paid == false) {
            return redirect($order->checkout_url);
        } else {
            return session()->flash('failed', 'Something went wrong with the request.');
        }
    }


    private function lemonCheckout(Order $order)
    {
        $apiToken = config('app.lemon_token');
        $storeID =  config('app.lemon_store');
        $productVarientID =  config('app.lemon_varient');
        $user = Auth::user();
        $userLemonID = $user->lemon_user_id;

        $billing = Billing::create([
            'order_id' => $order->id,
            'status' => 'pending'
        ]);

        $returnURL = URL::temporarySignedRoute(
            'order.renew',
            now()->addHours(3),
            ['order' => $order->id, 'billing' => $billing->id]
        );

        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . $apiToken,
        ])->post('https://api.lemonsqueezy.com/v1/checkouts', [
            'data' => [
                'type' => 'checkouts',
                'attributes' => [
                    'custom_price' => $this->price * 100,
                    'product_options' => [
                        'redirect_url' => "$returnURL"
                    ],
                    'checkout_data' => [
                        'custom' => [
                            'user_id' => "$userLemonID",
                        ],
                    ],
                    'expires_at' => now()->addHours(3),
                    'preview' => true,
                ],
                'relationships' => [
                    'store' => [
                        'data' => [
                            'type' => 'stores',
                            'id' => "$storeID",
                        ],
                    ],
                    'variant' => [
                        'data' => [
                            'type' => 'variants',
                            'id' => "$productVarientID",
                        ],
                    ],
                ],
            ],
        ]);
        if ($response->successful()) {
            $result = $response->json();
            $url = $result['data']['attributes']['url'];
            $billing->gateway_order_id = $result['data']['id'];
            $billing->gateway = $this->activeGateway;
            $billing->checkout_url = $url;
            $billing->save();
            return redirect($url);
        } else {
            Http::post(config('app.discord_exception'), [
                'content' => "```" .  $response->body() . "```",
            ]);
            return abort(500);
        }
    }

    private function stripeCheckout(Order $order)
    {
        try {
            $stripe = new StripeClient(config('app.stripe_token'));
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'price' => number_format($this->price)
            ]);
            $success = URL::temporarySignedRoute(
                'order.success',
                now()->addMinutes(30),
                ['order' => $order->id]
            );
            $failed = URL::temporarySignedRoute(
                'order.cancel',
                now()->addMinutes(30),
                ['order' => $order->id]
            );
            $record = $stripe->checkout->sessions->create([
                'success_url' => $success,
                'cancel_url' => $failed,
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product' => config('app.stripe_product_id'),
                            'unit_amount' => intval($this->price * 100),
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'expires_at' => time() + (30 * 60),
            ]);
            $order->gateway_order_id = $record['id'];
            $order->gateway = $this->activeGateway;
            $order->checkout_url = $record['url'];
            $order->save();
            return redirect($record['url']);
        } catch (Exception $e) {
            Http::post(config('app.discord_exception'), [
                'content' => "```" . $e->getMessage() . "```",
            ]);
        }
    }

    public function refund(Order $order)
    {
        $this->owner($order);

        $this->validate([
            'reason' => ['required']
        ]);
        $refundDate = Carbon::parse($order->refund_at);
        if ($order->is_trial) {
            return session()->flash('failed', 'Order is a trial. You can not request refund for this order.');
        }
        if ($order->refund) {
            return session()->flash('failed', 'Order refund is already in progress.');
        }
        if ($refundDate->isPast()) {
            return session()->flash('failed', 'Your refund request period has passed.');
        }
        Refund::create([
            'order_id' => $order->id,
            'reason' => $this->reason,
            'amount' => ($this->refundPercentage / 100) * $order->price
        ]);
        Http::post(config('app.discord_refund'), [
            'content' => "```Order Refund Request: " . $order->id . "\nReason:" . $this->reason . "```",
        ]);
        $this->reset(['reason']);
        return session()->flash('success', 'Your refund request has been submitted. You will receive an email when the refund is initiated.');
    }

    public function cancel(Order $order)
    {
        $this->owner($order);
        if ($order->is_trial) {
            return session()->flash('failed', 'Order is a trial. You can not cancel this order.');
        }
        if (!$order->refund) {
            return session()->flash('failed', 'Order does not have a refund request.');
        }
        $order->refund->delete();
        Http::post(config('app.discord_refund'), [
            'content' => "```Order Refund Cancel Request: " . $order->id . "```",
        ]);
        return session()->flash('success', 'Your refund request has been successfully canceled.');
    }

    private function owner($order)
    {
        if ($order->user_id != Auth::user()->id) {
            return abort(403);
        }
    }
}
