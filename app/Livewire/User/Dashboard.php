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

    public function mount()
    {
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

        $billing = Billing::where([
            ['order_id', $order->id],
            ['status', 'pending'],
        ])->latest()->first();
        if ($billing) {
            return redirect($billing->checkout_url);
        }

        $this->tebexCheckout($order);
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

    private function tebexCheckout(Order $order)
    {
        $tebexUser = config('app.tebex_user');
        $tebexPrivate =  config('app.tebex_private');

        $billing = Billing::create([
            'order_id' => $order->id,
            'status' => 'pending'
        ]);

        $completeURL = URL::temporarySignedRoute(
            'order.renew',
            now()->addHours(3),
            ['order' => $order->id, 'billing' => $billing->id]
        );

        $data = [
            'basket' => [
                'first_name' => Auth::user()->name,
                'last_name' => 'User',
                'email' => Auth::user()->email,
                'return_url' => config('app.url'),
                'complete_url' => $completeURL,
                'expires_at' => Carbon::now()->addHours(3)->toIso8601String(),
                'custom' => [
                    'order_id' => $order->id
                ]
            ],
            'items' => [
                [
                    'package' => [
                        'price' => number_format($this->price),
                        'name' => 'Rust Game Server - Renew'
                    ]
                ],
            ]
        ];
        $response = Http::withBasicAuth($tebexUser, $tebexPrivate)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ])
            ->post('https://checkout.tebex.io/api/checkout', $data);
        if ($response->successful()) {
            $result = $response->json();
            $url = $result['links']['checkout'];
            $billing->gateway_order_id = $result['ident'];
            $billing->gateway = 'tebex';
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
