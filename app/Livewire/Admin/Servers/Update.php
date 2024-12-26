<?php

namespace App\Livewire\Admin\Servers;

use App\Models\Server;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Update extends Component
{
    public $server, $name, $ip, $location, $storage, $storage_type, $cores, $ram, $ram_type;

    public function mount(Server $server)
    {
        $this->name = $server->name;
        $this->ip = $server->ip;
        $this->location = $server->location;
        $this->storage = $server->storage;
        $this->storage_type = $server->storage_type;
        $this->cores = $server->cores;
        $this->ram = $server->ram;
        $this->ram_type = $server->ram_type;
        $this->server = $server;
    }

    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        return view('livewire.admin.servers.update');
    }

    public function updateServer()
    {
        $this->validate([
            'name' => ['required', 'max:255'],
            'ip' => ['required', 'ipv4'],
            'location' => ['required'],
            'storage' => ['required', 'numeric', 'min:1'],
            'storage_type' => ['required'],
            'cores' => ['required', 'numeric', 'min:1'],
            'ram' => ['required', 'numeric', 'min:1'],
            'ram_type' => ['required', 'max:255']
        ]);

        $this->server->update(array_filter([
            'name' => $this->name,
            'ip' => $this->ip,
            'location' => $this->location,
            'storage' => $this->storage,
            'storage_type' => $this->storage_type,
            'cores' => $this->cores,
            'ram' => $this->ram,
            'ram_type' => $this->ram_type
        ]));

        session()->flash('success', 'Package has been updated!');
    }
}
