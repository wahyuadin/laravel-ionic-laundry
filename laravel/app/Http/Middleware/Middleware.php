<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            Alert::error('Gagal', 'Username Atau Password Salah');
            return redirect()->route('login');
        }

        // Jika pengguna terotentikasi, lanjutkan ke pengecekan peran (role)
        if (Auth::user()->role != 1) {
            Alert::warning('Peringatan', 'Login User Tidak Diperbolehkan!');
            return redirect()->route('login');
        }

        return $next($request);
    }
}
