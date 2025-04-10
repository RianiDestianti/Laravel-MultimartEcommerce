<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckUserBlocked
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Jika user sudah login dan diblokir
        if ($user && $user->is_blocked) {
            // Cek apakah masa blokir belum habis
            if ($user->blocked_until && Carbon::now()->lt($user->blocked_until)) {
                // Logout user dan invalidate session
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                // Tampilkan halaman blokir dengan informasi masa blokir
                return response()->view('auth.blocked', [
                    'blocked_until' => $user->blocked_until->format('d M Y H:i'),
                    'message' => 'Akun Anda telah diblokir hingga ' // Pesan blokir
                ]);
            }
        }

        // Jika tidak diblokir 
        // atau masa blokir sudah lewat, lanjutkan permintaan
        return $next($request);
    }
}

