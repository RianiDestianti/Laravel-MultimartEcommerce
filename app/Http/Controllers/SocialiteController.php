<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function callback()
{
    $userFromGoogle = Socialite::driver('google')->stateless()->user();

    $userFromDb = User::where('google_id', $userFromGoogle->getId())->first();

    if (!$userFromDb) {
        $userFromDb = new User();
        $userFromDb->email = $userFromGoogle->getEmail();
        $userFromDb->google_id = $userFromGoogle->getId();
        $userFromDb->name = $userFromGoogle->getName();
        $userFromDb->save();
    }

    // cek apakah user diblokir
    if ($userFromDb->is_blocked && $userFromDb->blocked_until && \Carbon\Carbon::parse($userFromDb->blocked_until)->isFuture()) {
        return view('auth.blocked', [
            'message' => 'Akun kamu diblokir sampai',
            'blocked_until' => \Carbon\Carbon::parse($userFromDb->blocked_until)->format('d M Y')
        ]);
    }

    auth('web')->login($userFromDb);
    session()->regenerate();

    return redirect('/');
}



}
