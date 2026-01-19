<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Trial;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Dashboard extends Component
{

    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        return view('livewire.admin.dashboard', [
            "users" => User::count(),
            "trials" => Trial::count(),
            "pending_trials" => Trial::where('status', 'pending')->count(),
        ]);
    }
}
