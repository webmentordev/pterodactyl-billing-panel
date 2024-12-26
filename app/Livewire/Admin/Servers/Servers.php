<?php

namespace App\Livewire\Admin\Servers;

use App\Models\Server;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

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
}
