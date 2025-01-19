<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\Trial;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Jobs\TrialOrderCreateJob;
use App\Mail\TrialRequestRejected;
use Illuminate\Support\Facades\Mail;

class Trials extends Component
{
    use WithPagination;

    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        return view('livewire.admin.trials', [
            'trials' => Trial::latest()->paginate(200)
        ]);
    }

    public function approve(Trial $trial)
    {
        $trial->status = 'approved';
        $trial->save();
        TrialOrderCreateJob::dispatch($trial)->onQueue('trial');
    }

    public function reject(Trial $trial)
    {
        $trial->status = 'rejected';
        $trial->save();
        Mail::to($trial->email)->send(new TrialRequestRejected());
    }
}
