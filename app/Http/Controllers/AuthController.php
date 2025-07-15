<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
  /**
   * Show the admin login form
   */
  public function showLoginForm()
  {
    if (Auth::check()) {
      return redirect()->route('admin.dashboard');
    }

    return view('admin.auth.login');
  }

  /**
   * Handle admin login
   */
  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required|min:6',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials, $request->has('remember'))) {
      $request->session()->regenerate();

      // Check if user is admin (you can modify this logic as needed)
      if (Auth::user()->is_admin ?? false) {
        return redirect()->intended(route('admin.dashboard'))
          ->with('success', 'Login berhasil! Selamat datang di dashboard admin.');
      } else {
        Auth::logout();
        return back()->withErrors([
          'email' => 'Akun ini tidak memiliki akses admin.',
        ]);
      }
    }

    return back()->withErrors([
      'email' => 'Email atau password salah.',
    ])->withInput($request->except('password'));
  }

  /**
   * Handle admin logout
   */
  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login')
      ->with('success', 'Anda telah berhasil logout.');
  }
}
