<?php

namespace App\Livewire;

use App\Models\Review;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Home extends Component
{
    public $price = 20;

    public function mount()
    {
        $this->price = config('app.price');
    }

    #[Layout('layouts.livewire.guest')]
    public function render()
    {
        return view('livewire.home', [
            'reviews' => Review::latest()->get()
        ]);
    }
}
