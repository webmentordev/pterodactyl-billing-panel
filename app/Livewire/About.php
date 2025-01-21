<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class About extends Component
{

    public function mount()
    {
        SEOMeta::setTitle('About Us');
        SEOMeta::setDescription("Everything you need to know about RustDedicated Hosting and how we operate Rust servers for our customers.");

        OpenGraph::setTitle('About Us');
        OpenGraph::setDescription("Everything you need to know about RustDedicated Hosting and how we operate Rust servers for our customers.");
        OpenGraph::addImage(config('app.url') . '/assets/rust-dedicated-about-us.png');

        TwitterCard::setImage(config('app.url') . '/assets/rust-dedicated-about-us.png');

        JsonLd::setTitle('About Us');
        JsonLd::setDescription("Everything you need to know about RustDedicated Hosting and how we operate Rust servers for our customers.");
        JsonLd::addImage(config('app.url') . '/assets/rust-dedicated-about-us.png');
    }



    #[Layout('layouts.livewire.guest')]
    public function render()
    {
        return view('livewire.about');
    }
}
