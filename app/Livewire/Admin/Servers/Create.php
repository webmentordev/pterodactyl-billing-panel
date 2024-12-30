<?php

namespace App\Livewire\Admin\Servers;

use App\Models\Server;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Create extends Component
{
    public $name, $ip, $location, $domain, $threads, $swap, $storage, $storage_type, $cores, $ram, $ram_type;

    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        return view('livewire.admin.servers.create');
    }

    public function addNewServer()
    {
        $this->validate([
            'name' => ['required', 'max:255', 'unique:servers,name'],
            'domain' => ['required', 'max:255', 'unique:servers,domain'],
            'ip' => ['required', 'ipv4'],
            'location' => ['required'],
            'threads' => ['required', 'numeric', 'min:1'],
            'swap' => ['required', 'numeric', 'min:1'],
            'storage' => ['required', 'numeric', 'min:1'],
            'storage_type' => ['required'],
            'cores' => ['required', 'numeric', 'min:1'],
            'ram' => ['required', 'numeric', 'min:1'],
            'ram_type' => ['required', 'max:255']
        ]);
        Server::create([
            'name' => $this->name,
            'domain' => $this->domain,
            'threads' => $this->threads,
            'swap' => $this->swap,
            'ip' => $this->ip,
            'location' => $this->location,
            'storage' => $this->storage,
            'storage_type' => $this->storage_type,
            'cores' => $this->cores,
            'ram' => $this->ram,
            'ram_type' => $this->ram_type
        ]);
        session()->flash('success', 'New server has been added!');
    }
}
