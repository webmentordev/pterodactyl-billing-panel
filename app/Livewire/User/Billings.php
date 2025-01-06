<?php

namespace App\Livewire\User;

use App\Models\Billing;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Billings extends Component
{
    use WithPagination;

    #[Layout('layouts.livewire.user')]
    public function render()
    {
        $user = Auth::user();
        $billings = Billing::whereHas('order', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->paginate(200);

        return view('livewire.user.billings', [
            'billing' => $billings
        ]);
    }
}
