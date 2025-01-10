<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Refund;
use App\Models\Billing;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderRefundJob implements ShouldQueue
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
            $url = config('app.ptero_url') . '/api/application/servers/' . $order->usage->panel_server_id . '/force';
            $apiKey = config('app.ptero_api');
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $apiKey,
            ])->delete($url);
            if ($response->successful()) {
                $order->status = 'refund';
                $order->is_active = false;
                $billing = Billing::where('gateway_order_id', $order->gateway_order_id)->first();
                $billing->status = 'refund';
                $refund = Refund::where('order_id', $order->id)->first();
                $refund->refunded_at = Carbon::now();
                $order->save();
                $billing->save();
                $refund->save();
                $order->usage->delete();
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
