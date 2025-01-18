<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;

class PrivacyPolicy extends Component
{

    public function mount()
    {
        SEOMeta::setTitle('Privacy Policy');
        SEOMeta::setDescription("Read RustDedicated Hosting's Privacy Policy to learn how we process your data and keep it safe from unauthorized access.");

        OpenGraph::setTitle('Privacy Policy');
        OpenGraph::setDescription("Read RustDedicated Hosting's Privacy Policy to learn how we process your data and keep it safe from unauthorized access.");

        JsonLd::setTitle('Privacy Policy');
        JsonLd::setDescription("Read RustDedicated Hosting's Privacy Policy to learn how we process your data and keep it safe from unauthorized access.");
    }

    #[Layout('layouts.livewire.guest')]
    public function render()
    {
        return view('livewire.privacy-policy');
    }
}
