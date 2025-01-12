<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Underdevelopment extends Component
{
    #[Layout('layouts.livewire.underdev')]
    public function render()
    {
        return view('livewire.underdevelopment');
    }
}
