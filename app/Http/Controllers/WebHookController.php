<?php

namespace App\Http\Controllers;

use App\Models\OrderCallback;
use Illuminate\Http\Request;

class WebHookController extends Controller
{
    public function tebexOrder(Request $request)
    {
        $payload = $request->getContent();
        OrderCallback::create(['payload' => $payload]);
        return response()->json(['message' => 'Webhook processed successfully'], 200);
    }
}
