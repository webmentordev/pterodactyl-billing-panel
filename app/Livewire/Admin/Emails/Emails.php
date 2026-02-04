<?php

namespace App\Livewire\Admin\Emails;

use App\Models\CustomEmail;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class Emails extends Component
{
    use WithPagination;

    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        return view('livewire.admin.emails.emails', [
            'emails' => CustomEmail::latest()->paginate(200)
        ]);
    }


    public function delete_email(CustomEmail $email){
        $email->delete();
        return session()->flash("success", "Email has been deleted!");
    }
}
