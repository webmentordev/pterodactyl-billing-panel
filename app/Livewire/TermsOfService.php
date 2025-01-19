<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class TermsOfService extends Component
{

    public function mount()
    {
        SEOMeta::setTitle('Terms of Service');
        SEOMeta::setDescription("Read RustDedicated Hosting's Terms of Service to learn how the server operates and other important information.");

        OpenGraph::setTitle('Terms of Service');
        OpenGraph::setDescription("Read RustDedicated Hosting's Terms of Service to learn how the server operates and other important information.");
        OpenGraph::addImage(config('app.url') . '/assets/rust-dedicated-terms-of-service.png');

        TwitterCard::setImage(config('app.url') . '/assets/rust-dedicated-terms-of-service.png');

        JsonLd::setTitle('Terms of Service');
        JsonLd::setDescription("Read RustDedicated Hosting's Terms of Service to learn how the server operates and other important information.");
        JsonLd::addImage(config('app.url') . '/assets/rust-dedicated-terms-of-service.png');
    }


    #[Layout('layouts.livewire.guest')]
    public function render()
    {
        return view('livewire.terms-of-service');
    }
}
