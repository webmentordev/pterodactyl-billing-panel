<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public $start = 0, $end = 0, $result = 0;
    public function create(): View
    {
        $this->start = rand(9, 99);
        $this->end = rand(9, 99);
        $this->result = $this->start + $this->end;

        session(['math_result' => $this->result]);

        return view('auth.register', [
            'start' => $this->start,
            'end' => $this->end
        ]);
    }

    public function store(Request $request)
    {
        $sessionResult = session('math_result');
        session()->forget('math_result');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'result' => ['required', 'numeric'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($request->result == $sessionResult) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // event(new Registered($user));

            Auth::login($user);

            return redirect(route('dashboard', absolute: false));
        } else {
            return back()->with('failed', 'Wrong answer with basic maths 😑');
        }
    }
}