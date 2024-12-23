<?php

namespace App\Livewire\Admin\Packages;

use App\Models\Package;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

class Update extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name, $image = null, $price, $body, $players, $storage, $storage_type, $cores, $ram, $ram_type, $package;

    public function mount(Package $package)
    {
        $this->name = $package->name;
        $this->price = $package->price;
        $this->body = $package->body;
        $this->players = $package->players;
        $this->storage = $package->storage;
        $this->storage_type = $package->storage_type;
        $this->cores = $package->cores;
        $this->ram = $package->ram;
        $this->ram_type = $package->ram_type;
        $this->name = $package->name;
        $this->package = $package;
    }

    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        return view('livewire.admin.packages.update');
    }

    public function updatePackage()
    {
        $this->validate([
            'name' => ['required', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:png'],
            'price' => ['required', 'numeric', 'min:1'],
            'body' => ['required'],
            'players' => ['required', 'numeric', 'min:1'],
            'storage' => ['required', 'numeric', 'min:1'],
            'storage_type' => ['required'],
            'cores' => ['required', 'numeric', 'min:1'],
            'ram' => ['required', 'numeric', 'min:1'],
            'ram_type' => ['required', 'max:255']
        ]);

        $image = null;
        if ($this->image) {
            Storage::disk('public')->delete($this->package->image);
            $image = $this->image->store('packages');
        }

        $this->package->update(array_filter([
            'name' => $this->name,
            'image' => $image,
            'price' => $this->price,
            'body' => $this->body,
            'players' => $this->players,
            'storage' => $this->storage,
            'storage_type' => $this->storage_type,
            'cores' => $this->cores,
            'ram' => $this->ram,
            'ram_type' => $this->ram_type
        ]));
        session()->flash('success', 'Package has been updated!');
    }
}
