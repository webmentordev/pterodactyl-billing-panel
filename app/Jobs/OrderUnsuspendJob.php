<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderUnsuspendJob implements ShouldQueue
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
            $url = config('app.ptero_url') . '/api/application/servers/' . $order->usage->panel_server_id . '/unsuspend';
            $apiKey = config('app.ptero_api');
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $apiKey,
            ])->post($url);
            if ($response->successful()) {
                Http::post(config('app.discord_order'), [
                    'content' => "```Server unsuspended: " . $order->id . "```",
                ]);
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
