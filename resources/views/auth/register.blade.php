@extends('layouts.app')

@section('title', 'Daftar - Sentra Durian Tegal')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow border-0">
        <div class="card-body p-5">
          <div class="text-center mb-4">
            <i class="fas fa-user-plus display-4 text-primary mb-3"></i>
            <h2 class="card-title">Daftar Akun Baru</h2>
            <p class="text-muted">Bergabung dengan Sentra Durian Tegal</p>
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

          <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="name" class="form-label">
                  <i class="fas fa-user me-2"></i>Nama Lengkap <span class="text-danger">*</span>
                </label>
                <input type="text"
                  class="form-control @error('name') is-invalid @enderror"
                  id="name"
                  name="name"
                  value="{{ old('name') }}"
                  required
                  autocomplete="name"
                  autofocus
                  placeholder="Masukkan nama lengkap">
                @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="email" class="form-label">
                  <i class="fas fa-envelope me-2"></i>Email <span class="text-danger">*</span>
                </label>
                <input type="email"
                  class="form-control @error('email') is-invalid @enderror"
                  id="email"
                  name="email"
                  value="{{ old('email') }}"
                  required
                  autocomplete="email"
                  placeholder="Masukkan email">
                @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>

            <div class="mb-3">
              <label for="phone" class="form-label">
                <i class="fas fa-phone me-2"></i>No. Telepon
              </label>
              <input type="tel"
                class="form-control @error('phone') is-invalid @enderror"
                id="phone"
                name="phone"
                value="{{ old('phone') }}"
                autocomplete="tel"
                placeholder="Masukkan nomor telepon (opsional)">
              @error('phone')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="address" class="form-label">
                <i class="fas fa-map-marker-alt me-2"></i>Alamat
              </label>
              <textarea class="form-control @error('address') is-invalid @enderror"
                id="address"
                name="address"
                rows="3"
                autocomplete="address-line1"
                placeholder="Masukkan alamat lengkap (opsional)">{{ old('address') }}</textarea>
              @error('address')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="password" class="form-label">
                  <i class="fas fa-lock me-2"></i>Password <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                  <input type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    id="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Minimal 8 karakter">
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

              <div class="col-md-6 mb-3">
                <label for="password_confirmation" class="form-label">
                  <i class="fas fa-lock me-2"></i>Konfirmasi Password <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                  <input type="password"
                    class="form-control @error('password_confirmation') is-invalid @enderror"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Ulangi password">
                  <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                    <i class="fas fa-eye" id="toggleIconConfirm"></i>
                  </button>
                </div>
                @error('password_confirmation')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>

            <div class="mb-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="agreement" name="agreement" required>
                <label class="form-check-label" for="agreement">
                  Saya setuju dengan <a href="#" class="text-primary">syarat dan ketentuan</a> yang berlaku.
                </label>
              </div>
            </div>

            <div class="d-grid mb-3">
              <button type="submit" class="btn btn-primary py-2">
                <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
              </button>
            </div>

            <hr class="my-4">

            <div class="text-center">
              <p class="mb-0">Sudah punya akun?</p>
              <a href="{{ route('login') }}" class="btn btn-outline-primary mt-2">
                <i class="fas fa-sign-in-alt me-2"></i>Login Disini
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
  // Toggle password visibility
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

  // Toggle password confirmation visibility
  document.getElementById('togglePasswordConfirm').addEventListener('click', function() {
    const passwordInput = document.getElementById('password_confirmation');
    const toggleIcon = document.getElementById('toggleIconConfirm');

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

  // Password strength indicator
  document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strengthIndicator = document.getElementById('passwordStrength');

    if (password.length >= 8) {
      this.classList.remove('is-invalid');
      this.classList.add('is-valid');
    } else {
      this.classList.remove('is-valid');
    }
  });

  // Confirm password match
  document.getElementById('password_confirmation').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmPassword = this.value;

    if (password === confirmPassword && password.length > 0) {
      this.classList.remove('is-invalid');
      this.classList.add('is-valid');
    } else {
      this.classList.remove('is-valid');
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

  .text-danger {
    color: #e74c3c !important;
  }

  .form-control.is-valid {
    border-color: #28a745;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='m2.3 6.73.94-.94 2.94 2.94'/%3e%3c/svg%3e");
  }
</style>
@endpush
@endsection