<?php

namespace App\Livewire\Order;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Billing;
use Livewire\Component;
use App\Mail\OrderSuccess;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Mail;

class Success extends Component
{
    public function mount(Request $request, Order $order)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }
        if ($order->status == 'pending') {
            $time = Carbon::now()->addDays(30);
            $order->has_paid = true;
            $order->email_sent = true;
            $order->status = "paid";
            $order->expire_at = $time;
            $order->total_payments = $order->total_payments + 1;
            $order->save();
            Billing::create([
                'order_id' => $order->id,
                'has_paid' => true,
                'status' => 'paid',
                'checkout_url' => $order->checkout_url,
                'expire_at' => $time,
            ]);
            Mail::to($order->user->email)->send(new OrderSuccess($order));
        } else {
            abort(401);
        }
    }

    #[Layout('layouts.livewire.guest')]
    public function render()
    {
        return view('livewire.order.success');
    }
}
