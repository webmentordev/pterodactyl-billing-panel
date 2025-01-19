<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class FreeTrial extends Component
{
    public function mount()
    {
        SEOMeta::setTitle('Free Rust Server Trial');
        SEOMeta::setDescription("Get your free 24-hour Rust server trial today—no credit card required or minimum contract!");

        OpenGraph::setTitle('Free Rust Server Trial');
        OpenGraph::setDescription("Get your free 24-hour Rust server trial today—no credit card required or minimum contract!");
        OpenGraph::addImage(config('app.url') . '/assets/rust-dedicated-free-trial.png');

        TwitterCard::setImage(config('app.url') . '/assets/rust-dedicated-free-trial.png');

        JsonLd::setTitle('Free Rust Server Trial');
        JsonLd::setDescription("Get your free 24-hour Rust server trial today—no credit card required or minimum contract!");
        JsonLd::addImage(config('app.url') . '/assets/rust-dedicated-free-trial.png');
    }

    #[Layout('layouts.livewire.guest')]
    public function render()
    {
        return view('livewire.free-trial');
    }
}
