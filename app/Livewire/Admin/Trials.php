<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\Trial;
use App\Models\Server;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Jobs\TrialOrderCreateJob;
use App\Mail\TrialRequestRejected;
use Illuminate\Support\Facades\Mail;

class Trials extends Component
{
    use WithPagination;
    public $threads = 2;

    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        return view('livewire.admin.trials', [
            'trials' => Trial::latest()->paginate(200)
        ]);
    }

    public function approve(Trial $trial)
    {
        $server = $this->getServers($this->threads);
        if ($server) {
            $trial->status = 'approved';
            $trial->save();
            TrialOrderCreateJob::dispatch($trial)->onQueue('trial');
        } else {
            return session()->flash('failed', 'We do not have active servers.');
        }
    }

    private function getServers($allowedThreads)
    {
        $servers = Server::withCount('usage')->where('is_active', true)
            ->get()
            ->filter(function ($server) use ($allowedThreads) {
                $totalThreads = $server->threads_limit;
                $maxUsageGroups = intdiv($totalThreads, $allowedThreads);
                return $server->usage_count < $maxUsageGroups;
            });
        return $servers->first();
    }

    public function reject(Trial $trial)
    {
        $trial->status = 'rejected';
        $trial->save();
        Mail::to($trial->email)->send(new TrialRequestRejected());
    }

    public function deleteTrial(Trial $trial)
    {
        $trial->delete();
    }
}