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
        $computedSignature = hash_hmac('sha256', $json, $secret);
        $receivedSignature = $request->header('X-Signature');
        if (!hash_equals($computedSignature, $receivedSignature)) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }
        OrderCallback::create(['payload' => $json]);
        return response()->json(['message' => 'Webhook processed successfully'], 200);
    }
}
