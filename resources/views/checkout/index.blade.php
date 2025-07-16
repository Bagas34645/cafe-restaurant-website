@extends('layouts.app')

@section('title', 'Checkout - Rajane Duren')

@section('content')
<div class="container py-5">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mb-4"><i class="fas fa-credit-card"></i> Checkout</h2>

      <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
        @csrf
        <div class="row">
          <div class="col-lg-8">
            <!-- Customer Information -->
            <div class="card mb-4">
              <div class="card-header">
                <h5><i class="fas fa-user"></i> Informasi Pelanggan</h5>
              </div>
              <div class="card-body">
                @if($user)
                <div class="alert alert-info mb-3">
                  <i class="fas fa-info-circle"></i>
                  Informasi di bawah ini telah diisi otomatis berdasarkan data akun Anda. Silakan periksa dan ubah jika diperlukan.
                </div>
                @endif
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="customer_name" class="form-label">Nama Lengkap *</label>
                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                      id="customer_name" name="customer_name"
                      value="{{ old('customer_name', $user ? $user->name : '') }}" required>
                    @error('customer_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="customer_email" class="form-label">Email *</label>
                    <input type="email" class="form-control @error('customer_email') is-invalid @enderror"
                      id="customer_email" name="customer_email"
                      value="{{ old('customer_email', $user ? $user->email : '') }}" required>
                    @error('customer_email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="customer_phone" class="form-label">No. Telepon *</label>
                    <input type="tel" class="form-control @error('customer_phone') is-invalid @enderror"
                      id="customer_phone" name="customer_phone"
                      value="{{ old('customer_phone', $user ? $user->phone : '') }}" required>
                    @error('customer_phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="customer_address" class="form-label">Alamat Lengkap *</label>
                    <textarea class="form-control @error('customer_address') is-invalid @enderror"
                      id="customer_address" name="customer_address" rows="3" required>{{ old('customer_address', $user ? $user->address : '') }}</textarea>
                    @error('customer_address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
            </div>

            <!-- Payment Method -->
            <div class="card mb-4">
              <div class="card-header">
                <h5><i class="fas fa-credit-card"></i> Metode Pembayaran</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <div class="form-check payment-option">
                      <input class="form-check-input" type="radio" name="payment_method"
                        id="midtrans" value="midtrans" {{ old('payment_method') == 'midtrans' ? 'checked' : 'checked' }}>
                      <label class="form-check-label" for="midtrans">
                        <div class="payment-card">
                          <i class="fas fa-credit-card text-primary"></i>
                          <strong>Payment Gateway</strong>
                          <small class="d-block text-muted">Transfer Bank, E-Wallet, Kartu Kredit</small>
                        </div>
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <div class="form-check payment-option">
                      <input class="form-check-input" type="radio" name="payment_method"
                        id="cod" value="cod" {{ old('payment_method') == 'cod' ? 'checked' : '' }}>
                      <label class="form-check-label" for="cod">
                        <div class="payment-card">
                          <i class="fas fa-hand-holding-usd text-success"></i>
                          <strong>Cash on Delivery</strong>
                          <small class="d-block text-muted">Bayar saat barang sampai</small>
                        </div>
                      </label>
                    </div>
                  </div>
                </div>
                @error('payment_method')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Notes -->
            <div class="card mb-4">
              <div class="card-header">
                <h5><i class="fas fa-sticky-note"></i> Catatan Pesanan</h5>
              </div>
              <div class="card-body">
                <textarea class="form-control" name="notes" rows="3"
                  placeholder="Catatan tambahan untuk pesanan Anda (opsional)">{{ old('notes') }}</textarea>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <!-- Order Summary -->
            <div class="card sticky-top" style="top: 20px;">
              <div class="card-header">
                <h5><i class="fas fa-receipt"></i> Ringkasan Pesanan</h5>
              </div>
              <div class="card-body">
                @foreach($cartItems as $item)
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <div class="flex-grow-1">
                    <small>{{ $item->product->name }}</small>
                    <small class="text-muted d-block">{{ $item->quantity }}x Rp {{ number_format($item->price, 0, ',', '.') }}</small>
                  </div>
                  <div>
                    <small><strong>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong></small>
                  </div>
                </div>
                @endforeach

                <hr>

                <div class="d-flex justify-content-between mb-2">
                  <span>Subtotal ({{ $cartItems->sum('quantity') }} item)</span>
                  <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                </div>
                <div class="d-flex justify-content-between mb-3">
                  <span>Biaya Pengiriman</span>
                  <span class="text-success">GRATIS</span>
                </div>

                <hr>

                <div class="d-flex justify-content-between mb-4">
                  <strong>Total</strong>
                  <strong class="text-primary fs-5">Rp {{ number_format($total, 0, ',', '.') }}</strong>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-2" id="submitBtn">
                  <i class="fas fa-check"></i> Buat Pesanan
                </button>
                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100">
                  <i class="fas fa-arrow-left"></i> Kembali ke Keranjang
                </a>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@push('styles')
<style>
  .payment-option {
    margin: 0;
  }

  .payment-card {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 15px;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
    height: 100%;
  }

  .form-check-input:checked+.form-check-label .payment-card {
    border-color: #007bff;
    background-color: #f8f9ff;
  }

  .payment-card:hover {
    border-color: #007bff;
    background-color: #f8f9ff;
  }

  .payment-card i {
    font-size: 2rem;
    margin-bottom: 10px;
  }
</style>
@endpush

@push('scripts')
<script>
  $(document).ready(function() {
    // Add visual indicator for auto-filled fields
    @if($user)
    const autoFilledFields = ['customer_name', 'customer_email', 'customer_phone', 'customer_address'];
    autoFilledFields.forEach(function(fieldId) {
      const field = $('#' + fieldId);
      if (field.val().trim()) {
        field.addClass('bg-light');
        field.attr('title', 'Informasi ini diisi otomatis dari akun Anda');
      }
    });
    @endif

    // Handle payment method selection
    $('input[name="payment_method"]').change(function() {
      let selectedMethod = $(this).val();
      let submitBtn = $('#submitBtn');

      if (selectedMethod === 'midtrans') {
        submitBtn.html('<i class="fas fa-credit-card"></i> Bayar Sekarang');
      } else {
        submitBtn.html('<i class="fas fa-check"></i> Buat Pesanan');
      }
    });

    // Form validation
    $('#checkoutForm').submit(function(e) {
      let isValid = true;
      let requiredFields = ['customer_name', 'customer_email', 'customer_phone', 'customer_address'];

      requiredFields.forEach(function(field) {
        let input = $('#' + field);
        if (!input.val().trim()) {
          input.addClass('is-invalid');
          isValid = false;
        } else {
          input.removeClass('is-invalid');
        }
      });

      if (!$('input[name="payment_method"]:checked').length) {
        alert('Silakan pilih metode pembayaran');
        isValid = false;
      }

      if (!isValid) {
        e.preventDefault();
        $('html, body').animate({
          scrollTop: $('.is-invalid').first().offset().top - 100
        }, 500);
      }
    });

    // Remove validation errors on input and auto-fill styling
    $('.form-control').on('input', function() {
      $(this).removeClass('is-invalid bg-light');
      $(this).removeAttr('title');
    });
  });
</script>
@endpush
@endsection