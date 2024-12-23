<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Billing extends Component
{
    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        return view('livewire.admin.billing');
    }
}
