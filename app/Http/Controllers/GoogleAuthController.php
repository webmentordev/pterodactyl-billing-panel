<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function index()
    {
        return Socialite::driver('google')->redirect();
    }

    public function verify()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::where('email', $googleUser->email)->first();
        if ($user) {
            $user->update([
                'google_id' => $googleUser->id,
                'name' => $googleUser->name,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]);
        } else {
            $user = User::create([
                'google_id' => $googleUser->id,
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'google_refresh_token' => $googleUser->refreshToken,
                'google_avatar' => $googleUser->avatar,
                'password' => $this->randomPassword()
            ]);
        }
        event(new Registered($user));
        Auth::login($user);

        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('dashboard');
    }


    private function randomPassword()
    {
        $alphabet = 'abcdefghijklmno_-+=pqrs#()tuvwxyz*&ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 30; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }
}
