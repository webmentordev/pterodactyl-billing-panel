<?php

namespace App\Livewire\Admin;

use App\Jobs\OrderRefundJob;
use App\Models\Order;
use App\Models\Refund;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class Refunds extends Component
{
    use WithPagination;

    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        return view('livewire.admin.refunds', [
            'refunds' => Refund::latest()->paginate(200)
        ]);
    }

    public function approve(Order $order)
    {
        OrderRefundJob::dispatch($order)->onQueue('refund');
        return session()->flash('success', 'Refund job has been dispatched!');
    }
}
