<?php

namespace App\Livewire\User;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    #[Layout('layouts.livewire.user')]
    public function render()
    {
        return view('livewire.user.dashboard', [
            'orders' => Order::where('user_id', Auth::user()->id)->latest()->get()
        ]);
    }

    public function renew(Order $order)
    {
        dd($order);
    }

    public function pay(Order $order)
    {
        return redirect($order->checkout_url);
    }
}
