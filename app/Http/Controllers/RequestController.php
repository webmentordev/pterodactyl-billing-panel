<?php

namespace App\Http\Controllers;

use App\Models\Trial;
use Illuminate\Http\Request;

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
        return back()->with('success', 'Your request has been submitted! wait for our email.');
    }
}
