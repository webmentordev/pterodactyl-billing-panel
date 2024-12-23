<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Servers extends Component
{
    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        return view('livewire.admin.servers');
    }
}
