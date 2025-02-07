<?php

namespace App\Http\Controllers;

use App\Models\OrderCallback;
use Illuminate\Http\Request;

class WebHookController extends Controller
{
    public function tebexOrder(Request $request)
    {
        $json = $request->getContent();
        $secret = config('app.tebex_webhook');
        $signature = hash_hmac('sha256', hash('sha256', $json), $secret);

        OrderCallback::create([
            'payload' => $json,
            'signature' => $signature
        ]);

        return response()->json([
            'message' => 'Webhook processed successfully',
            'signature' => $signature
        ], 200);
    }
}
