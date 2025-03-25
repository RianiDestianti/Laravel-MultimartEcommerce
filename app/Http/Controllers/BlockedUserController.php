<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BlockedUserController extends Controller
{
    // Menampilkan daftar pengguna yang diblokir
    public function index()
    {
        $blockedUsers = User::where('is_blocked', true)
                            ->whereNotNull('blocked_until')
                            ->get();

        return view('admin.block_user', compact('blockedUsers'));
    }

    // Menyimpan laporan pengguna yang diblokir ke dalam file CSV
    public function export()
    {
        $blockedUsers = User::where('is_blocked', true)
                            ->whereNotNull('blocked_until')
                            ->get();

        $filename = "blocked_users_report_" . now()->format('Y_m_d_H_i_s') . ".csv";
        
        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['Name', 'Email', 'Blocked Until', 'Reason']);

        foreach ($blockedUsers as $user) {
            fputcsv($handle, [
                $user->name,
                $user->email,
                $user->blocked_until ? $user->blocked_until->format('d M Y H:i') : 'N/A',
                $user->block_reason ?? 'N/A' // Asumsikan ada field `block_reason` jika ada
            ]);
        }

        fclose($handle);

        return Response::stream(function () use ($handle) {
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }
    protected function attemptLogin(Request $request)
{
    $user = \App\Models\User::where('email', $request->email)->first();

    if ($user) {
        // Cek apakah pengguna diblokir
        if ($user->is_blocked && now()->lessThan($user->blocked_until)) {
            // Jika masih dalam masa blokir, tolak login
            return false;
        }
    }

    return $this->guard()->attempt(
        $this->credentials($request),
        $request->filled('remember')
    );
}
}
