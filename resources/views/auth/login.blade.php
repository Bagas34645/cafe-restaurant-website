@extends('layouts.app')

@section('title', 'Login - Sentra Durian Tegal')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card shadow border-0">
        <div class="card-body p-5">
          <div class="text-center mb-4">
            <i class="fas fa-user-circle display-4 text-primary mb-3"></i>
            <h2 class="card-title">Login Pelanggan</h2>
            <p class="text-muted">Masuk ke akun Anda untuk melanjutkan</p>
          </div>

          @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
          @endif

          @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
          @endif

          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
              <label for="email" class="form-label">
                <i class="fas fa-envelope me-2"></i>Email
              </label>
              <input type="email"
                class="form-control @error('email') is-invalid @enderror"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                autofocus
                placeholder="Masukkan email Anda">
              @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">
                <i class="fas fa-lock me-2"></i>Password
              </label>
              <div class="input-group">
                <input type="password"
                  class="form-control @error('password') is-invalid @enderror"
                  id="password"
                  name="password"
                  required
                  autocomplete="current-password"
                  placeholder="Masukkan password Anda">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                  <i class="fas fa-eye" id="toggleIcon"></i>
                </button>
              </div>
              @error('password')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                  Ingat saya
                </label>
              </div>
            </div>

            <div class="d-grid mb-3">
              <button type="submit" class="btn btn-primary py-2">
                <i class="fas fa-sign-in-alt me-2"></i>Login
              </button>
            </div>

            <hr class="my-4">

            <div class="text-center">
              <p class="mb-0">Belum punya akun?</p>
              <a href="{{ route('register') }}" class="btn btn-outline-primary mt-2">
                <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="text-center mt-3">
        <a href="{{ route('home') }}" class="text-decoration-none">
          <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
        </a>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      toggleIcon.classList.remove('fa-eye');
      toggleIcon.classList.add('fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      toggleIcon.classList.remove('fa-eye-slash');
      toggleIcon.classList.add('fa-eye');
    }
  });
</script>
@endpush

@push('styles')
<style>
  .card {
    border-radius: 15px;
  }

  .form-control:focus {
    border-color: #e74c3c;
    box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25);
  }

  .btn-primary {
    background: linear-gradient(45deg, #e74c3c, #c0392b);
    border: none;
    border-radius: 8px;
    transition: all 0.3s ease;
  }

  .btn-primary:hover {
    background: linear-gradient(45deg, #c0392b, #a93226);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }

  .btn-outline-primary {
    border-color: #e74c3c;
    color: #e74c3c;
  }

  .btn-outline-primary:hover {
    background-color: #e74c3c;
    border-color: #e74c3c;
  }
</style>
@endpush
@endsection