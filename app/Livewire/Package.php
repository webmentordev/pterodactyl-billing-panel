<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Reminder;
use App\Models\Server;
use Livewire\Component;
use Stripe\StripeClient;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class Package extends Component
{
    public $price = 20.0, $threads = 2, $outOfStock = false, $email;

    public function mount()
    {
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
        $order->stripe_order_id = $record['id'];
        $order->checkout_url = $record['url'];
        $order->save();
        return redirect($record['url']);
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
}
