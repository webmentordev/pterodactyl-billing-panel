<?php

namespace App\Http\Controllers;

use App\Models\LemonOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LemonOrdersController extends Controller
{
    public function store(Request $request)
    {
        $signature = $request->header('X-Signature');
        $secret = config('app.lemon_webhook_key');
        $computedSignature = hash_hmac('sha256', $request->getContent(), $secret);
        if (!hash_equals($computedSignature, $signature)) {
            Log::warning('Invalid webhook signature.', [
                'expected' => $computedSignature,
                'received' => $signature,
            ]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }
        $payload = $request->getContent();
        LemonOrders::create(['payload' => $payload]);
        return response()->json(['message' => 'Webhook processed successfully'], 200);
    }
}
