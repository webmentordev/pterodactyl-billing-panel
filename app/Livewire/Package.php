<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Order;
use App\Models\Server;
use Livewire\Component;
use App\Models\Reminder;
use Exception;
use Stripe\StripeClient;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class Package extends Component
{
    public $price = 20.0, $threads = 2, $outOfStock = false, $email;
    public $activeGateway = null;

    public function mount()
    {
        $this->activeGateway = config('app.gateway');
        $server = $this->getServers($this->threads);
        if (!$server) {
            $this->outOfStock = true;
        }
    }

    #[Layout('layouts.livewire.guest')]
    public function render()
    {
        return view('livewire.package');
    }

    public function buyNow()
    {
        if ($this->activeGateway == 'lemon_squeezy') {
            $this->lemonCheckout();
        }
        if ($this->activeGateway == 'stripe') {
            $this->stripeCheckout();
        }
    }

    private function getServers($allowedThreads)
    {
        $servers = Server::withCount('usage')
            ->get()
            ->filter(function ($server) use ($allowedThreads) {
                $totalThreads = $server->threads;
                $maxUsageGroups = intdiv($totalThreads, $allowedThreads);
                return $server->usage_count < $maxUsageGroups;
            });
        return $servers->first();
    }


    public function request()
    {
        $this->validate([
            'email' => ['required', 'email', 'max:255', 'unique:reminders,email'],
        ], [
            'email.unique' => 'The email address already exists in our system. We will use it to notify you.',
        ]);
        Reminder::create(['email' => $this->email]);
        return session()->flash('success', 'Your request has been submitted!');
    }

    private function lemonCheckout()
    {
        if ($this->outOfStock) {
            return;
        }
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $apiToken = config('app.lemon_token');
        $storeID =  config('app.lemon_store');
        $productVarientID =  config('app.lemon_varient');
        $user = Auth::user();
        $userLemonID = $user->lemon_user_id;

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'price' => number_format($this->price)
        ]);

        $returnURL = URL::temporarySignedRoute(
            'order.success',
            now()->addMinutes(30),
            ['order' => $order->id]
        );

        if (!$userLemonID) {
            $userLemonID = $this->createLemonSqueezyUser($user);
        }

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
                    'expires_at' => now()->addDays(1),
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
            $order->gateway_order_id = $result['data']['id'];
            $order->gateway = $this->activeGateway;
            $order->checkout_url = $url;
            $order->save();
            return redirect($url);
        } else {
            Http::post(config('app.discord_exception'), [
                'content' => "```" .  $response->body() . "```",
            ]);
            return abort(500);
        }
    }

    private function stripeCheckout()
    {
        try {
            if ($this->outOfStock) {
                return;
            }
            if (!Auth::check()) {
                return redirect()->route('login');
            }

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


    private function createLemonSqueezyUser($user)
    {
        try {
            $apiToken = config('app.lemon_token');
            $storeID =  config('app.lemon_store');
            $response = Http::withHeaders([
                'Accept' => 'application/vnd.api+json',
                'Content-Type' => 'application/vnd.api+json',
                'Authorization' => 'Bearer ' . $apiToken,
            ])->post('https://api.lemonsqueezy.com/v1/customers', [
                'data' => [
                    'type' => 'customers',
                    'attributes' => [
                        'name' => $user->name,
                        'email' => $user->email,
                    ],
                    'relationships' => [
                        'store' => [
                            'data' => [
                                'type' => 'stores',
                                'id' => $storeID,
                            ],
                        ],
                    ],
                ],
            ]);
            if ($response->successful()) {
                $result = $response->json();
                $lemonUserID = $result['data']['id'];
                $record = User::find($user->id);
                $record->lemon_user_id = $lemonUserID;
                $record->save();
                return $lemonUserID;
            } else {
                Http::post(config('app.discord_exception'), [
                    'content' => "```" . $response->body() . "```",
                ]);
                return abort(500);
            }
        } catch (Exception $e) {
            Http::post(config('app.discord_exception'), [
                'content' => "```" . $e->getMessage() . "```",
            ]);
        }
    }
}
