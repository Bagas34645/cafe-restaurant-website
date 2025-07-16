@extends('layouts.app')

@section('title', 'Keranjang Belanja - Rajane Duren')

@section('content')
<div class="container py-5">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mb-4"><i class="fas fa-shopping-cart"></i> Keranjang Belanja</h2>

      @if(isset($requireLogin) && $requireLogin)
      <div class="card">
        <div class="card-body text-center py-5">
          <i class="fas fa-lock fa-3x text-warning mb-3"></i>
          <h4>Login Diperlukan</h4>
          <p class="text-muted">Silakan login terlebih dahulu untuk melihat keranjang belanja Anda.</p>
          <div class="d-flex gap-3 justify-content-center">
            <a href="{{ route('login') }}" class="btn btn-primary">
              <i class="fas fa-sign-in-alt"></i> Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary">
              <i class="fas fa-user-plus"></i> Daftar
            </a>
          </div>
        </div>
      </div>
      @elseif($cartItems->isEmpty())
      <div class="card">
        <div class="card-body text-center py-5">
          <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
          <h4>Keranjang Belanja Kosong</h4>
          <p class="text-muted">Belum ada produk dalam keranjang belanja Anda.</p>
          <a href="{{ route('products') }}" class="btn btn-primary">
            <i class="fas fa-shopping-bag"></i> Belanja Sekarang
          </a>
        </div>
      </div>
      @else
      <div class="row">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-header">
              <h5>Produk dalam Keranjang</h5>
            </div>
            <div class="card-body">
              @foreach($cartItems as $item)
              <div class="row cart-item mb-3 pb-3 border-bottom" data-id="{{ $item->id }}">
                <div class="col-md-2">
                  <img src="{{ $item->product->image_path ? asset('storage/' . $item->product->image_path) : asset('images/default-product.jpg') }}"
                    alt="{{ $item->product->name }}"
                    class="img-fluid rounded">
                </div>
                <div class="col-md-4">
                  <h6>{{ $item->product->name }}</h6>
                  <small class="text-muted">{{ $item->product->category }}</small>
                </div>
                <div class="col-md-2">
                  <strong>Rp {{ number_format($item->price, 0, ',', '.') }}</strong>
                </div>
                <div class="col-md-2">
                  <div class="input-group">
                    <button class="btn btn-outline-secondary btn-sm quantity-btn" type="button" data-action="decrease">-</button>
                    <input type="number" class="form-control form-control-sm text-center quantity-input"
                      value="{{ $item->quantity }}" min="1" max="99">
                    <button class="btn btn-outline-secondary btn-sm quantity-btn" type="button" data-action="increase">+</button>
                  </div>
                </div>
                <div class="col-md-1">
                  <strong class="subtotal">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong>
                </div>
                <div class="col-md-1">
                  <button class="btn btn-danger btn-sm remove-item" title="Hapus">
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              </div>
              @endforeach

              <div class="text-end mt-3">
                <button class="btn btn-outline-danger clear-cart">
                  <i class="fas fa-trash"></i> Kosongkan Keranjang
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card">
            <div class="card-header">
              <h5>Ringkasan Pesanan</h5>
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-between mb-2">
                <span>Subtotal ({{ $cartItems->sum('quantity') }} item)</span>
                <strong class="total-amount">Rp {{ number_format($total, 0, ',', '.') }}</strong>
              </div>
              <div class="d-flex justify-content-between mb-3">
                <span>Biaya Pengiriman</span>
                <span class="text-success">GRATIS</span>
              </div>
              <hr>
              <div class="d-flex justify-content-between mb-3">
                <strong>Total</strong>
                <strong class="total-amount text-primary">Rp {{ number_format($total, 0, ',', '.') }}</strong>
              </div>

              <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100 mb-2">
                <i class="fas fa-credit-card"></i> Checkout
              </a>
              <a href="{{ route('products') }}" class="btn btn-outline-secondary w-100">
                <i class="fas fa-arrow-left"></i> Lanjut Belanja
              </a>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>

@push('scripts')
<script>
  $(document).ready(function() {
    // Update quantity
    $('.quantity-btn').click(function() {
      let button = $(this);
      let cartItem = button.closest('.cart-item');
      let input = cartItem.find('.quantity-input');
      let currentValue = parseInt(input.val());
      let action = button.data('action');

      let newValue = action === 'increase' ? currentValue + 1 : Math.max(1, currentValue - 1);
      input.val(newValue);

      updateCartItem(cartItem.data('id'), newValue, cartItem);
    });

    $('.quantity-input').change(function() {
      let input = $(this);
      let cartItem = input.closest('.cart-item');
      let value = Math.max(1, parseInt(input.val()) || 1);
      input.val(value);

      updateCartItem(cartItem.data('id'), value, cartItem);
    });

    // Remove item
    $('.remove-item').click(function() {
      let cartItem = $(this).closest('.cart-item');
      let itemId = cartItem.data('id');

      if (confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')) {
        removeCartItem(itemId, cartItem);
      }
    });

    // Clear cart
    $('.clear-cart').click(function() {
      if (confirm('Apakah Anda yakin ingin mengosongkan keranjang belanja?')) {
        clearCart();
      }
    });

    function updateCartItem(itemId, quantity, cartItem) {
      $.ajax({
        url: '/cart/' + itemId,
        method: 'PATCH',
        data: {
          quantity: quantity,
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          if (response.success) {
            cartItem.find('.subtotal').text('Rp ' + numberFormat(response.subtotal));
            $('.total-amount').text('Rp ' + numberFormat(response.total));
            updateCartCount();

            // Show success message
            showToast('success', response.message);
          }
        },
        error: function() {
          showToast('error', 'Terjadi kesalahan saat memperbarui keranjang');
        }
      });
    }

    function removeCartItem(itemId, cartItem) {
      $.ajax({
        url: '/cart/' + itemId,
        method: 'DELETE',
        data: {
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          if (response.success) {
            cartItem.fadeOut(300, function() {
              $(this).remove();
              updateCartCount();
              checkEmptyCart();
            });

            showToast('success', response.message);
          }
        },
        error: function() {
          showToast('error', 'Terjadi kesalahan saat menghapus produk');
        }
      });
    }

    function clearCart() {
      $.ajax({
        url: '/cart',
        method: 'DELETE',
        data: {
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          if (response.success) {
            location.reload();
          }
        },
        error: function() {
          showToast('error', 'Terjadi kesalahan saat mengosongkan keranjang');
        }
      });
    }

    function checkEmptyCart() {
      if ($('.cart-item').length === 0) {
        location.reload();
      }
    }

    function updateCartCount() {
      $.get('/cart/count', function(response) {
        $('.cart-count').text(response.count);
      });
    }

    function numberFormat(number) {
      return new Intl.NumberFormat('id-ID').format(number);
    }

    function showToast(type, message) {
      // Simple toast implementation
      let alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
      let toast = $('<div class="alert ' + alertClass + ' alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999;">' +
        '<span>' + message + '</span>' +
        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
        '</div>');

      $('body').append(toast);

      setTimeout(function() {
        toast.alert('close');
      }, 3000);
    }
  });
</script>
@endpush
@endsection