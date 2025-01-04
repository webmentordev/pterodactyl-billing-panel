<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Reminder;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class Reminders extends Component
{
    use WithPagination;

    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        return view('livewire.admin.reminders', [
            'reminders' => Reminder::latest()->paginate(200)
        ]);
    }
}
