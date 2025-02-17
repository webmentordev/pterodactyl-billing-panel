<?php

namespace App\Livewire\Admin\Emails;

use Livewire\Component;
use App\Mail\CustomEmail;
use App\Models\CustomEmail as ModelsCustomEmail;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Mail;

class Create extends Component
{
    public $subject, $email, $body = "";

    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        return view('livewire.admin.emails.create');
    }

    public function sendIt()
    {
        $this->validate([
            'subject' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email'],
            'body' => ['required']
        ]);
        ModelsCustomEmail::create([
            'email' => $this->email,
            'subject' => $this->subject,
            'body' => $this->body
        ]);
        Mail::to($this->email)->send(new CustomEmail($this->body, $this->subject));
        return session()->flash('success', 'Email has been sent!');
    }
}
