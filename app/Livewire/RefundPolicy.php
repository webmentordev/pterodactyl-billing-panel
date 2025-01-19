<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class RefundPolicy extends Component
{
    public function mount()
    {
        SEOMeta::setTitle('Refund Policy');
        SEOMeta::setDescription("Read RustDedicated Hosting's Refund Policy to understand what to do if you need a refund.");

        OpenGraph::setTitle('Refund Policy');
        OpenGraph::setDescription("Read RustDedicated Hosting's Refund Policy to understand what to do if you need a refund.");
        OpenGraph::addImage(config('app.url') . '/assets/rust-dedicated-refund-policy.png');

        TwitterCard::setImage(config('app.url') . '/assets/rust-dedicated-refund-policy.png');

        JsonLd::setTitle('Refund Policy');
        JsonLd::setDescription("Read RustDedicated Hosting's Refund Policy to understand what to do if you need a refund.");
        JsonLd::addImage(config('app.url') . '/assets/rust-dedicated-refund-policy.png');
    }

    #[Layout('layouts.livewire.guest')]
    public function render()
    {
        return view('livewire.refund-policy');
    }
}
