<?php

namespace App\Livewire\Admin\Servers;

use App\Models\Server;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Jobs\CreateReminderEmailJobs;

class Servers extends Component
{
    use WithPagination;

    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        return view('livewire.admin.servers.servers', [
            'servers' => Server::latest()->paginate(200)
        ]);
    }

    public function sendReminder()
    {
        CreateReminderEmailJobs::dispatch()->onQueue('reminder');
        return session()->flash('success', 'Server reminder job has been dispatched!');
    }

    public function activeStatus(Server $server)
    {
        $server->is_active = !$server->is_active;
        $server->save();
        return session()->flash('success', 'Server Decommission status has been changed!');
    }
}
