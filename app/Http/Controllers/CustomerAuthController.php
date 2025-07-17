<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;

class CustomerAuthController extends Controller
{
  /**
   * Show the customer login form
   */
  public function showLoginForm()
  {
    if (Auth::check() && !Auth::user()->is_admin) {
      return redirect()->route('home');
    }
    return view('auth.login');
  }

  /**
   * Handle customer login
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

      // Check if user is NOT admin (customer only)
      if (!Auth::user()->is_admin) {
        return redirect()->intended(route('home'))
          ->with('success', 'Login berhasil! Selamat datang ' . Auth::user()->name);
      } else {
        Auth::logout();
        return back()->withErrors([
          'email' => 'Akun admin tidak dapat login melalui halaman ini. Silakan gunakan halaman login admin.',
        ])->withInput($request->except('password'));
      }
    }

    return back()->withErrors([
      'email' => 'Email atau password tidak valid.',
    ])->withInput($request->except('password'));
  }

  /**
   * Show the customer registration form
   */
  public function showRegistrationForm()
  {
    if (Auth::check() && !Auth::user()->is_admin) {
      return redirect()->route('home');
    }
    return view('auth.register');
  }

  /**
   * Handle customer registration
   */
  public function register(Request $request)
  {
    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
      'phone' => ['nullable', 'string', 'max:20'],
      'address' => ['nullable', 'string', 'max:500'],
    ]);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'phone' => $request->phone,
      'address' => $request->address,
      'is_admin' => false,
    ]);

    Auth::login($user);

    return redirect()->route('home')
      ->with('success', 'Registrasi berhasil! Selamat datang ' . $user->name);
  }

  /**
   * Handle customer logout
   */
  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('home')
      ->with('success', 'Logout berhasil! Terima kasih telah menggunakan layanan kami.');
  }

  /**
   * Show customer profile
   */
  public function profile()
  {
    if (!Auth::check() || Auth::user()->is_admin) {
      return redirect()->route('login');
    }

    return view('auth.profile');
  }

  /**
   * Update customer profile
   */
  public function updateProfile(Request $request)
  {
    if (!Auth::check() || Auth::user()->is_admin) {
      return redirect()->route('login');
    }

    $user = Auth::user();

    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
      'phone' => ['nullable', 'string', 'max:20'],
      'address' => ['nullable', 'string', 'max:500'],
      'current_password' => ['nullable', 'required_with:password'],
      'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
    ]);

    // Check current password if user wants to change password
    if ($request->filled('password')) {
      if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors([
          'current_password' => 'Password saat ini tidak benar.'
        ]);
      }
      $user->password = Hash::make($request->password);
    }

    $user->update([
      'name' => $request->name,
      'email' => $request->email,
      'phone' => $request->phone,
      'address' => $request->address,
    ]);

    if ($request->filled('password')) {
      $user->save();
    }

    return back()->with('success', 'Profil berhasil diperbarui!');
  }

  /**
   * Show customer order history
   */
  public function orderHistory()
  {
    if (!Auth::check() || Auth::user()->is_admin) {
      return redirect()->route('login');
    }

    $orders = Auth::user()->orders()->with('items.product')->latest()->paginate(10);

    return view('auth.orders', compact('orders'));
  }
}
