<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        return view('livewire.admin.users', [
            'users' => User::latest()->paginate(200)
        ]);
    }
}
