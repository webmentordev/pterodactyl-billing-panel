<?php

namespace App\Livewire\Admin\Packages;

use App\Models\Package;
use Livewire\Component;
use Stripe\StripeClient;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Renderless;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name, $image, $price, $body, $players, $storage, $storage_type, $cores, $ram, $ram_type;

    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        return view('livewire.admin.packages.create');
    }


    public function createNewPackage()
    {
        $this->validate([
            'name' => ['required', 'max:255', 'unique:packages,name'],
            'image' => ['required', 'image', 'mimes:png'],
            'price' => ['required', 'numeric', 'min:1'],
            'body' => ['required'],
            'players' => ['required', 'numeric', 'min:1'],
            'storage' => ['required', 'numeric', 'min:1'],
            'storage_type' => ['required'],
            'cores' => ['required', 'numeric', 'min:1'],
            'ram' => ['required', 'numeric', 'min:1'],
            'ram_type' => ['required', 'max:255']
        ]);
        $image = $this->image->store('packages');
        $stripe = new StripeClient(config('app.stripe_token'));
        $package = $stripe->products->create([
            'name' => config('app.name') . ' - ' . $this->name,
            'images' => [
                config('app.url') . '/storage/' . $image
            ]
        ]);
        Package::create([
            'name' => $this->name,
            'stripe_id' => $package['id'],
            'image' => $image,
            'price' => $this->price,
            'body' => $this->body,
            'players' => $this->players,
            'storage' => $this->storage,
            'storage_type' => $this->storage_type,
            'cores' => $this->cores,
            'ram' => $this->ram,
            'ram_type' => $this->ram_type,
            'user_id' => Auth::user()->id
        ]);
        session()->flash('success', 'New package has been added!');
    }
}
