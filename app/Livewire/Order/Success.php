<?php

namespace App\Livewire\Order;

use Carbon\Carbon;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;

class Success extends Component
{
    public function mount(Request $request, Order $order)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }
        if ($order->status == 'pending') {
            $order->has_paid = true;
            $order->status = "paid";
            $order->expire_at = Carbon::now()->addDays(30);
            $order->total_payments = $order->total_payments + 1;
            $order->save();
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
