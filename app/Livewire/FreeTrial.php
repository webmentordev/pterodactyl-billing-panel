<?php

namespace App\Livewire;

use App\Models\Trial;
use Livewire\Component;
use Livewire\Attributes\Layout;

use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;

class FreeTrial extends Component
{
    public function mount()
    {
        SEOMeta::setTitle('Free Rust Server Trial');
        SEOMeta::setDescription("Get a high-performance Dedicated Rust server for free for 24 hours without requiring a credit card or login");

        OpenGraph::setTitle('Free Rust Server Trial');
        OpenGraph::setDescription("Get a high-performance Dedicated Rust server for free for 24 hours without requiring a credit card or login");
        OpenGraph::addImage(config('app.url') . '/assets/rust-dedicated-free-trial.png');

        TwitterCard::setImage(config('app.url') . '/assets/rust-dedicated-free-trial.png');

        JsonLd::setTitle('Free Rust Server Trial');
        JsonLd::setDescription("Get a high-performance Dedicated Rust server for free for 24 hours without requiring a credit card or login");
        JsonLd::addImage(config('app.url') . '/assets/rust-dedicated-free-trial.png');
    }

    #[Layout('layouts.livewire.guest')]
    public function render()
    {
        return view('livewire.free-trial');
    }
}
