@extends('layouts.app')

@section('title', 'Profil - Sentra Durian Tegal')

@section('content')
<div class="container py-5">
  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-body text-center">
          <i class="fas fa-user-circle display-3 text-primary mb-3"></i>
          <h5>{{ Auth::user()->name }}</h5>
          <p class="text-muted">{{ Auth::user()->email }}</p>
        </div>
        <div class="list-group list-group-flush">
          <a href="{{ route('profile') }}" class="list-group-item list-group-item-action active">
            <i class="fas fa-user me-2"></i>Profil
          </a>
          <a href="{{ route('orders.history') }}" class="list-group-item list-group-item-action">
            <i class="fas fa-history me-2"></i>Riwayat Pesanan
          </a>
        </div>
      </div>
    </div>

    <div class="col-md-9">
      <div class="card">
        <div class="card-header">
          <h4><i class="fas fa-user me-2"></i>Profil Saya</h4>
        </div>
        <div class="card-body">
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

          <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="name" class="form-label">
                  <i class="fas fa-user me-2"></i>Nama Lengkap
                </label>
                <input type="text"
                  class="form-control @error('name') is-invalid @enderror"
                  id="name"
                  name="name"
                  value="{{ old('name', Auth::user()->name) }}"
                  required>
                @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="email" class="form-label">
                  <i class="fas fa-envelope me-2"></i>Email
                </label>
                <input type="email"
                  class="form-control @error('email') is-invalid @enderror"
                  id="email"
                  name="email"
                  value="{{ old('email', Auth::user()->email) }}"
                  required>
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
                value="{{ old('phone', Auth::user()->phone) }}">
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
                rows="3">{{ old('address', Auth::user()->address) }}</textarea>
              @error('address')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <hr class="my-4">

            <h5 class="mb-3">Ubah Password</h5>
            <p class="text-muted mb-3">Kosongkan jika tidak ingin mengubah password</p>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="current_password" class="form-label">
                  <i class="fas fa-lock me-2"></i>Password Saat Ini
                </label>
                <input type="password"
                  class="form-control @error('current_password') is-invalid @enderror"
                  id="current_password"
                  name="current_password">
                @error('current_password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="password" class="form-label">
                  <i class="fas fa-lock me-2"></i>Password Baru
                </label>
                <input type="password"
                  class="form-control @error('password') is-invalid @enderror"
                  id="password"
                  name="password">
                @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="password_confirmation" class="form-label">
                  <i class="fas fa-lock me-2"></i>Konfirmasi Password Baru
                </label>
                <input type="password"
                  class="form-control"
                  id="password_confirmation"
                  name="password_confirmation">
              </div>
            </div>

            <div class="d-flex justify-content-between">
              <a href="{{ route('home') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
              </a>
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>Simpan Perubahan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@push('styles')
<style>
  .card {
    border-radius: 10px;
    border: none;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }

  .form-control:focus {
    border-color: #e74c3c;
    box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25);
  }

  .btn-primary {
    background: linear-gradient(45deg, #e74c3c, #c0392b);
    border: none;
  }

  .btn-primary:hover {
    background: linear-gradient(45deg, #c0392b, #a93226);
  }

  .list-group-item.active {
    background-color: #e74c3c;
    border-color: #e74c3c;
  }
</style>
@endpush
@endsection