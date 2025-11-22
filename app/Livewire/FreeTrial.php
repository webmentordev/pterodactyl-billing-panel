<?php

namespace App\Livewire;

use App\Models\Trial;
use Livewire\Component;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Http;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class FreeTrial extends Component
{
    public $email;
    public string $trustileResponse = "";
    
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

    public function requestTrial(Request $request)
    {
        $this->validate([
            'email' => ['required', 'email', 'unique:trials,email'],
            'trustileResponse' => ['required', Rule::turnstile()]
        ]);
        Trial::create([
            'email' => $this->email,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'token' => Str::uuid()
        ]);
        Http::post(config('app.discord_trial'), [
            'content' => "```Trial Request has been recieved from: \n" . $request->email . "```",
        ]);
        return back()->with('success', 'Your request has been submitted! wait for our email.');
    }
}