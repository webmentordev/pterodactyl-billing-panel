<?php

namespace App\Http\Controllers;

use App\Models\Trial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RequestController extends Controller
{
    public function requestTrial(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:trials,email']
        ]);
        Trial::create([
            'email' => $request->email,
            'ip_address' => $request->ip()
        ]);
        Http::post(config('app.discord_trial'), [
            'content' => "```Trial Request has been recieved from: \n" . $request->email . "```",
        ]);
        return back()->with('success', 'Your request has been submitted! wait for our email.');
    }
}
