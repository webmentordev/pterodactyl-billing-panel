<?php

namespace App\Livewire\Order;

use Carbon\Carbon;
use App\Models\Order;
use Livewire\Component;
use App\Mail\OrderRenew;
use App\Models\Billing;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Mail;

class Renew extends Component
{
    public $order;

    public function mount(Request $request, Order $order, Billing $billing)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        if ($billing->status == "pending") {
            $time = $order->expire_at->addDays(31);
            $order->expire_at = $time;
            $order->is_active = true;
            $order->total_payments = $order->total_payments + 1;
            $order->save();

            $billing->expire_at = $time;
            $billing->has_paid = true;
            $billing->status = "paid";
            $billing->save();

            Mail::to($order->user->email)->send(new OrderRenew($order));
            $this->order = $order;
        } else {
            abort(404);
        }
    }

    #[Layout('layouts.livewire.guest')]
    public function render()
    {
        return view('livewire.order.renew');
    }
}
