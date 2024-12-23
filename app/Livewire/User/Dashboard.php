<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Dashboard extends Component
{
    #[Layout('layouts.livewire.user')]
    public function render()
    {
        return view('livewire.user.dashboard');
    }
}
