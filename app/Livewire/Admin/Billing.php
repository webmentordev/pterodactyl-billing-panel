<?php

namespace App\Livewire\Admin;

use App\Models\Billing as BillingModel;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class Billing extends Component
{
    use WithPagination;

    public $bill;

    public function mount($order = null)
    {
        $this->bill = $order;
    }

    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        if ($this->bill) {
            return view('livewire.admin.billing', [
                'billing' => BillingModel::latest()->where('order_id', $this->bill)->paginate(200)
            ]);
        }

        return view('livewire.admin.billing', [
            'billing' => BillingModel::latest()->paginate(200)
        ]);
    }
}
