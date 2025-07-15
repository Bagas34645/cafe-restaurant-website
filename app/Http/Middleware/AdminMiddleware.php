<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login')
                ->with('error', 'Silakan login terlebih dahulu untuk mengakses halaman admin.');
        }

        // Check if user is admin (you can modify this logic as needed)
        if (!Auth::user()->is_admin ?? false) {
            Auth::logout();
            return redirect()->route('admin.login')
                ->with('error', 'Akun Anda tidak memiliki akses admin.');
        }

        return $next($request);
    }
}
