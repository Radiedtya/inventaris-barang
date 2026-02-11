<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->stateless()
            ->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')
            ->stateless()
            ->user();

        $user = User::updateOrCreate(
            [
                'google_id' => $googleUser->id,
            ],
            [
                'name'  => $googleUser->name,
                'email' => $googleUser->email,
            ]
        );

        Auth::login($user);

        return redirect('/')->with('success', 'Login dengan Google berhasil!');
    }

}