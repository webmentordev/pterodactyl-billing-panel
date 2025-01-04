<?php

namespace App\Jobs;

use App\Models\Reminder;
use App\Jobs\SendReminderEmailJob;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateReminderEmailJobs implements ShouldQueue
{
    use Queueable;

    public function __construct() {}

    public function handle(): void
    {
        foreach (Reminder::cursor() as $reminder) {
            SendReminderEmailJob::dispatch($reminder)->onQueue('reminder');
        }
    }
}
