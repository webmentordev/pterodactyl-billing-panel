<?php

namespace App\Livewire\Admin\Packages;

use App\Models\Package;
use Livewire\Component;
use Stripe\StripeClient;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

class Packages extends Component
{
    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        return view('livewire.admin.packages.packages', [
            'packages' => Package::latest()->paginate(200)
        ]);
    }

    public function deletePackage(Package $package)
    {
        $stripe = new StripeClient(config('app.stripe_token'));
        $stripe->products->delete($package->stripe_id, []);
        Storage::disk('public')->delete($package->image);
        $package->delete();
    }
}
