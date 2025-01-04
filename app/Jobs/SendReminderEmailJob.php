<?php

namespace App\Jobs;

use App\Mail\Reminder;
use App\Models\Reminder as ModelsReminder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReminderEmailJob implements ShouldQueue
{
    use Queueable;

    public $reminder;

    public function __construct(ModelsReminder $reminder)
    {
        $this->reminder = $reminder;
    }

    public function handle(): void
    {
        Mail::to($this->reminder->email)->send(new Reminder());
        $this->reminder->delete();
    }
}
