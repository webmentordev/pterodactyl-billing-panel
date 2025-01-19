<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Trial;
use App\Mail\TrialServerCreate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class TrialOrderCreateJob implements ShouldQueue
{
    use Queueable;

    public $trial;

    public function __construct(Trial $trial)
    {
        $this->trial = $trial;
    }

    public function handle(): void
    {
        try {
            $trialRecord = $this->trial;
            $newUser = false;
            $user = User::where('email', $trialRecord->email)->first();
            $newPassword = $this->generatePassword();
            if ($user) {
                $userRecord = $user;
            } else {
                $userRecord = User::create([
                    'name' => 'User-' . rand(999, 999999),
                    'email' => $trialRecord->email,
                    'password' => $newPassword
                ]);
                $newUser = true;
            }

            $time = Carbon::now()->addDays(1);
            $order = Order::create([
                'user_id' => $userRecord->id,
                'price' => 0,
                'has_paid' => false,
                'is_active' => true,
                'status' => "trial",
                'expire_at' => $time,
                'refund_at' => null,
                'is_trial' => true,
                'total_payments' => 0
            ]);

            Artisan::call('app:create-pterodactyl-user', ['userID' => $order->user->id]);
            $resultPassword = trim(Artisan::output());

            Artisan::call('app:create-pterodactyl-server', ['orderID' => $order->id]);
            Mail::to($order->user->email)->send(new TrialServerCreate($order, $resultPassword, $newUser, $newPassword));
        } catch (\Exception $e) {
            Http::post(config('app.discord_exception'), [
                'content' => "```Trial Order Creation Job:\n" . $e->getMessage() . "```",
            ]);
        }
    }

    private function generatePassword()
    {
        $alphabet = 'abcdefghij&*()^%$#@!_+{}":?><klmnopqrstuvwzxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 15; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }
}
