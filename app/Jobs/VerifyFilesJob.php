<?php

namespace App\Jobs;

use Exception;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyFilesJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public Order $order)
    {
        //
    }

    public function handle(): void
    {
        $user = $this->order->user;
        if($user->active_orders()->doesntExist()){
            $uploads = $user->uploads; // Load once, reuse
            if($uploads->isNotEmpty()){
                try{
                    foreach ($uploads as $upload){
                        Storage::disk('public')->delete($upload->name);
                        $upload->delete();
                    }
                }catch(Exception $e){
                    Http::post(config('app.discord_exception'), [
                        'content' => "```Delete File Job Exception:\n" . $e->getMessage() . "```",
                    ]);
                }
            }
        }
    }
}