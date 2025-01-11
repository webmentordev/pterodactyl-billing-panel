<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\Billing;
use App\Mail\OrderSuspended;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderSuspendJob implements ShouldQueue
{
    use Queueable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle(): void
    {
        try {
            $order = $this->order;
            $url = config('app.ptero_url') . '/api/application/servers/' . $order->usage->panel_server_id . '/suspend';
            $apiKey = config('app.ptero_api');
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $apiKey,
            ])->post($url);
            if ($response->successful()) {
                $order->status = 'suspend';
                $order->is_active = false;
                $billing = Billing::where('gateway_order_id', $order->gateway_order_id)->first();
                $billing->status = 'refund';
                $order->save();
                $billing->save();
                Mail::to($order->user->email)->send(new OrderSuspended($order));
            } else {
                Http::post(config('app.discord_exception'), [
                    'content' => "```" . $response->body() . "```",
                ]);
            }
        } catch (\Exception $e) {
            Http::post(config('app.discord_exception'), [
                'content' => "```" . $e->getMessage() . "```",
            ]);
        }
    }
}
