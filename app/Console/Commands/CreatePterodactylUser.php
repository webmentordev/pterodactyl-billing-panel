<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CreatePterodactylUser extends Command
{
    protected $signature = 'app:create-pterodactyl-user {userID}';

    protected $description = 'Create User in Pterodactyl Panel';

    public function handle()
    {
        $user = $this->argument('userID');
        $recordUser = User::find($user);
        $password = $this->randomPassword();
        if (!$recordUser->panel_user_id) {
            $url = config('app.ptero_url') . '/api/application/users';
            $apiKey = config('app.ptero_api');
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer $apiKey",
            ])->post($url, [
                'email' => $recordUser->email,
                'username' => str_replace(' ', '-', strtolower($recordUser->name)) . '-' . rand(9, 999999),
                'first_name' => $recordUser->name,
                'last_name' => 'Guest',
                'password' => $password,
            ]);
            if ($response->successful()) {
                $responseData = $response->json();
                $recordUser->panel_user_id = $responseData['attributes']['id'];
                $recordUser->save();
                $this->info($password);
                return 0;
            } else {
                $this->error('Failed to create user: ' . $response->body());
                return 1;
            }
        } else {
            $this->info('0');
            return 0;
        }
    }

    private function randomPassword()
    {
        $alphabet = '!@#$%^&*()_+}{":?ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 20; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }
}
