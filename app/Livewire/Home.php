<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Package;
use Livewire\Component;
use Stripe\StripeClient;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class Home extends Component
{
    #[Layout('layouts.livewire.guest')]
    public function render()
    {
        return view('livewire.home', [
            'packages' => Package::orderBy('price', 'asc')->get()
        ]);
    }

    public function purchase($package)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $record = Package::where('name', $package)->first();
        if ($record) {
            $this->buyNow($record);
        } else {
            abort(500);
        }
    }

    private function buyNow($package)
    {
        $stripe = new StripeClient(config('app.stripe_token'));
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'package_id' => $package->id,
            'price' => number_format($package->price)
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
                        'product' => $package->stripe_id,
                        'unit_amount' => intval($package->price * 100),
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'expires_at' => time() + (30 * 60),
        ]);
        $order->stripe_order_id = $record['id'];
        $order->checkout_url = $record['url'];
        $order->save();
        return redirect($record['url']);
    }
}
