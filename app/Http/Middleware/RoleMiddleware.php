<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // 1. Jika lolos pengecekan role yang diminta, silakan masuk
        if (auth()->check() && auth()->user()->role == $role) {
            return $next($request);
        }
        
        // 2. Jika TIDAK LOLOS, cek rolenya untuk dialihkan otomatis ke dashboard masing-masing
        if (auth()->check()) {
            if (auth()->user()->role == 'admin') {
                return redirect('/dashboard/admin');
            }
            
            if (auth()->user()->role == 'petugas') {
                return redirect('/dashboard');
            }
        }

        // 3. Kalau belum login sama sekali, lempar ke landing
        return redirect('/');
    }
}