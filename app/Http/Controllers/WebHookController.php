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

        // Compute HMAC signature
        $computedSignature = hash_hmac('sha256', $json, $secret);

        // Get the Tebex-provided signature from the request header
        $receivedSignature = $request->header('X-Signature');

        // Verify signature
        if (!hash_equals($computedSignature, $receivedSignature)) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Store webhook payload if valid
        OrderCallback::create(['payload' => $json]);

        return response()->json(['message' => 'Webhook processed successfully'], 200);
    }
}
