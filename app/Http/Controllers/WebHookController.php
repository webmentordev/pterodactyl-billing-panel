<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderCallback;
use Illuminate\Support\Facades\Log;

class WebHookController extends Controller
{
    public function tebexOrder(Request $request)
    {
        $json = file_get_contents('php://input');
        $secret = config('app.tebex_webhook');
        $computedSignature = hash_hmac('sha256', $json, $secret);
        $receivedSignature = $request->header('X-Tebex-Signature');

        if (!hash_equals($computedSignature, $receivedSignature)) {
            Log::error('Signature mismatch', [
                'computed' => $computedSignature,
                'received' => $receivedSignature,
                'payload' => $json
            ]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        OrderCallback::create(['payload' => $json]);
        return response()->json(['message' => 'Webhook processed successfully'], 200);
    }
}
