<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class Orders extends Component
{
    use WithPagination;

    public $user;

    public function mount($user = null)
    {
        $this->user = $user;
    }

    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        if ($this->user) {
            return view('livewire.admin.orders', [
                'billing' => Order::where('user_id', $this->user)->latest()->withCount(['billings'])->paginate(200)
            ]);
        }

        return view('livewire.admin.orders', [
            'orders' => Order::latest()->withCount(['billings'])->paginate(200)
        ]);
    }
}
