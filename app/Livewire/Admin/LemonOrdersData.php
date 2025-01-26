<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\LemonOrders;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class LemonOrdersData extends Component
{
    use WithPagination;

    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        return view('livewire.admin.lemon-orders-data', [
            'orders' => LemonOrders::latest()->paginate(200)
        ]);
    }

    public function delete(LemonOrders $order)
    {
        $order->delete();
        return back()->with('success', 'Lemon has been deleted!');
    }
}
