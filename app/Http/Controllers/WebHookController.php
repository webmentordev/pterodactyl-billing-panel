<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderCallback;
use App\Models\Trial;
use Illuminate\Support\Facades\Log;

class WebHookController extends Controller
{
    public function tebexOrder(Request $request)
    {
        $json = file_get_contents('php://input');
        $hashedBody = hash('sha256', $json);
        $secret = config('app.tebex_webhook');
        $computedSignature = hash_hmac('sha256', $hashedBody, $secret);
        $receivedSignature = $request->header('x-signature');

        if (!hash_equals($computedSignature, $receivedSignature)) {
            Log::error('Signature mismatch', [
                'computed' => $computedSignature,
                'received' => $receivedSignature,
                'payload' => $json
            ]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }
        $payload = json_decode($json, true);
        if ($payload['type'] === 'validation.webhook') {
            return response()->json(['id' => $payload['id']], 200);
        }
        OrderCallback::create(['payload' => $json]);
        return response()->json(['message' => 'Webhook processed successfully'], 200);
    }

    public function open_email(Trial $trial){
        $trial->viewed_email = true;
        $trial->save();
        return response()->file(public_path("assets/rust-dedicated-logo.png"), [
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]); 
    }
}