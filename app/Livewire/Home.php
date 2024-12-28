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
        return view('livewire.home');
    }
}
