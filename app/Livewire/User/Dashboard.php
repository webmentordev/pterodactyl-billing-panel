<?php

namespace App\Livewire\User;

use Exception;
use App\Models\Order;
use App\Models\Billing;
use Livewire\Component;
use Stripe\StripeClient;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class Dashboard extends Component
{
    public $price = 20.0;
    public $activeGateway = null;

    public function mount()
    {
        $this->activeGateway = config('app.gateway');
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
        if ($this->activeGateway == 'lemon_squeezy') {
            $this->lemonCheckout($order);
        }
        if ($this->activeGateway == 'stripe') {
            $this->stripeCheckout($order);
        }
    }

    public function pay(Order $order)
    {
        if ($order->status == 'pending') {
            return redirect($order->checkout_url);
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
}
