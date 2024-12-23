<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class Orders extends Component
{
    use WithPagination;

    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        return view('livewire.admin.orders', [
            'orders' => Order::latest()->paginate(200)
        ]);
    }
}
