<?php

namespace App\Livewire\User;

use App\Models\Billing;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class Billings extends Component
{
    use WithPagination;

    #[Layout('layouts.livewire.user')]
    public function render()
    {
        return view('livewire.user.billings', [
            'billing' => Billing::latest()->paginate(200)
        ]);
    }
}
