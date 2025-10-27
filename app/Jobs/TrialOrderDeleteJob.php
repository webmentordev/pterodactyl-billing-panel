<?php

namespace App\Jobs;

use App\Mail\TrialServerDelete;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class TrialOrderDeleteJob implements ShouldQueue
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
                $order->status = 'trial_expired';
                $order->is_active = false;
                $order->save();
                $order->usage->delete();
                Mail::to($order->user->email)->send(new TrialServerDelete($order));
            } else {
                Http::post(config('app.discord_exception'), [
                    'content' => "```Trials Server Delete Error Panel:\n" . $response->body() . "```",
                ]);
            }
        } catch (\Exception $e) {
            Http::post(config('app.discord_exception'), [
                'content' => "```Trials Server Delete Exception:\n" . $e->getMessage() . "```",
            ]);
        }
    }
}