@extends('layouts.app')

@section('title', 'Keranjang Belanja - Rajane Duren')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/cart-modern.css') }}">
@endpush

@section('content')
<div class="cart-container">
  <div class="container py-4">
    <!-- Cart Header -->
    <div class="cart-header">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h1><i class="fas fa-shopping-cart me-3"></i>Keranjang Belanja</h1>
          <p>Periksa dan kelola produk durian pilihan Anda</p>
        </div>
        <div class="col-md-4 text-md-end">
          @if(!$cartItems->isEmpty())
          <div class="d-flex align-items-center justify-content-md-end">
            <i class="fas fa-box me-2"></i>
            <span class="fs-5 fw-bold">{{ $cartItems->sum('quantity') }} Item</span>
          </div>
          @endif
        </div>
      </div>
    </div>

    @if(isset($requireLogin) && $requireLogin)
    <div class="login-required-card">
      <i class="fas fa-lock login-icon"></i>
      <h3 class="fw-bold mb-3">Login Diperlukan</h3>
      <p class="text-muted mb-4">Silakan login terlebih dahulu untuk melihat keranjang belanja Anda dan melakukan pemesanan.</p>
      <div class="d-flex gap-3 justify-content-center flex-wrap">
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
          <i class="fas fa-sign-in-alt me-2"></i>Login Sekarang
        </a>
        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
          <i class="fas fa-user-plus me-2"></i>Daftar Akun Baru
        </a>
      </div>
    </div>
    @elseif($cartItems->isEmpty())
    <div class="empty-cart-card">
      <i class="fas fa-shopping-cart empty-cart-icon"></i>
      <h3 class="fw-bold mb-3">Keranjang Belanja Kosong</h3>
      <p class="text-muted mb-4">Belum ada produk durian dalam keranjang belanja Anda. Mari mulai berbelanja produk durian berkualitas tinggi!</p>
      <a href="{{ route('products') }}" class="btn btn-primary btn-lg">
        <i class="fas fa-shopping-bag me-2"></i>Mulai Belanja
      </a>
    </div>
    @else
    <div class="row">
      <div class="col-lg-8">
        <!-- Cart Items -->
        <div class="cart-items-section">
          @foreach($cartItems as $item)
          <div class="cart-item-card" data-id="{{ $item->id }}">
            <div class="row align-items-center">
              <!-- Product Image -->
              <div class="col-md-2 col-3">
                <img src="{{ $item->product->image_path ? asset('storage/' . $item->product->image_path) : asset('images/default-product.jpg') }}"
                  alt="{{ $item->product->name }}"
                  class="product-image">
              </div>

              <!-- Product Info -->
              <div class="col-md-4 col-9">
                <h5 class="fw-bold mb-1">{{ $item->product->name }}</h5>
                <p class="text-muted mb-1">
                  <i class="fas fa-tag me-1"></i>{{ $item->product->category }}
                </p>
                <p class="text-success fw-bold mb-0">
                  <i class="fas fa-money-bill-wave me-1"></i>Rp {{ number_format($item->price, 0, ',', '.') }}
                </p>
              </div>

              <!-- Quantity Controls -->
              <div class="col-md-3 col-6 mt-3 mt-md-0">
                <label class="form-label small text-muted">Jumlah:</label>
                <div class="quantity-controls">
                  <button class="quantity-btn" type="button" data-action="decrease">
                    <i class="fas fa-minus"></i>
                  </button>
                  <input type="number" class="quantity-input form-control"
                    value="{{ $item->quantity }}" min="1" max="99" readonly>
                  <button class="quantity-btn" type="button" data-action="increase">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>

              <!-- Subtotal & Remove -->
              <div class="col-md-2 col-4 mt-3 mt-md-0">
                <div class="text-center">
                  <p class="fw-bold text-primary mb-2 subtotal">
                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                  </p>
                  <button class="remove-btn remove-item" title="Hapus dari keranjang">
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              </div>

              <!-- Mobile Quantity Controls (Hidden on desktop) -->
              <div class="col-2 d-md-none mt-3">
                <button class="remove-btn remove-item w-100" title="Hapus">
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            </div>
          </div>
          @endforeach

          <!-- Clear Cart Button -->
          <div class="text-center mt-4">
            <button class="clear-cart-btn clear-cart">
              <i class="fas fa-trash-alt me-2"></i>Kosongkan Semua Keranjang
            </button>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <!-- Order Summary -->
        <div class="summary-card">
          <div class="summary-header">
            <h4 class="mb-0"><i class="fas fa-receipt me-2"></i>Ringkasan Pesanan</h4>
          </div>
          <div class="summary-body">
            <div class="summary-row">
              <span>Subtotal ({{ $cartItems->sum('quantity') }} item)</span>
              <strong class="total-amount">Rp {{ number_format($total, 0, ',', '.') }}</strong>
            </div>
            <div class="summary-row">
              <span><i class="fas fa-shipping-fast me-1"></i>Biaya Pengiriman</span>
              <span class="text-success fw-bold">GRATIS</span>
            </div>
            <div class="summary-row">
              <span><i class="fas fa-gift me-1"></i>Discount</span>
              <span class="text-success">Rp 0</span>
            </div>
            <hr class="my-3">
            <div class="summary-row">
              <strong>Total Pembayaran</strong>
              <strong class="total-amount text-primary fs-4">Rp {{ number_format($total, 0, ',', '.') }}</strong>
            </div>

            <!-- Action Buttons -->
            <div class="mt-4">
              <a href="{{ route('checkout.index') }}" class="btn btn-checkout w-100 mb-3">
                <i class="fas fa-credit-card me-2"></i>Lanjut ke Checkout
              </a>
              <a href="{{ route('products') }}" class="btn btn-continue w-100">
                <i class="fas fa-arrow-left me-2"></i>Lanjut Belanja
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
</div>

@push('scripts')
<script>
  $(document).ready(function() {
    // Update quantity
    $('.quantity-btn').click(function() {
      let button = $(this);
      let cartItem = button.closest('.cart-item-card');
      let input = cartItem.find('.quantity-input');
      let currentValue = parseInt(input.val());
      let action = button.data('action');

      let newValue = action === 'increase' ? currentValue + 1 : Math.max(1, currentValue - 1);
      input.val(newValue);

      updateCartItem(cartItem.data('id'), newValue, cartItem);
    });

    $('.quantity-input').change(function() {
      let input = $(this);
      let cartItem = input.closest('.cart-item-card');
      let value = Math.max(1, parseInt(input.val()) || 1);
      input.val(value);

      updateCartItem(cartItem.data('id'), value, cartItem);
    });

    // Remove item
    $('.remove-item').click(function() {
      let cartItem = $(this).closest('.cart-item-card');
      let itemId = cartItem.data('id');

      Swal.fire({
        title: 'Hapus Produk?',
        text: 'Apakah Anda yakin ingin menghapus produk ini dari keranjang?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          removeCartItem(itemId, cartItem);
        }
      });
    });

    // Clear cart
    $('.clear-cart').click(function() {
      Swal.fire({
        title: 'Kosongkan Keranjang?',
        text: 'Apakah Anda yakin ingin mengosongkan seluruh keranjang belanja?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Kosongkan!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          clearCart();
        }
      });
    });

    function updateCartItem(itemId, quantity, cartItem) {
      // Show loading state
      cartItem.find('.quantity-btn').prop('disabled', true);

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
            updateCartHeader();

            // Show success toast
            showToast('success', response.message || 'Keranjang berhasil diperbarui');
          }
        },
        error: function() {
          showToast('error', 'Terjadi kesalahan saat memperbarui keranjang');
          // Reset quantity on error
          location.reload();
        },
        complete: function() {
          cartItem.find('.quantity-btn').prop('disabled', false);
        }
      });
    }

    function removeCartItem(itemId, cartItem) {
      // Add removing animation
      cartItem.addClass('removing');

      $.ajax({
        url: '/cart/' + itemId,
        method: 'DELETE',
        data: {
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          if (response.success) {
            cartItem.fadeOut(400, function() {
              $(this).remove();
              updateCartCount();
              updateCartHeader();
              checkEmptyCart();
            });

            showToast('success', response.message || 'Produk berhasil dihapus dari keranjang');
          }
        },
        error: function() {
          cartItem.removeClass('removing');
          showToast('error', 'Terjadi kesalahan saat menghapus produk');
        }
      });
    }

    function clearCart() {
      $('.cart-items-section').addClass('removing');

      $.ajax({
        url: '/cart',
        method: 'DELETE',
        data: {
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          if (response.success) {
            // Animate all items out
            $('.cart-item-card').fadeOut(300, function() {
              location.reload();
            });
            showToast('success', 'Keranjang berhasil dikosongkan');
          }
        },
        error: function() {
          $('.cart-items-section').removeClass('removing');
          showToast('error', 'Terjadi kesalahan saat mengosongkan keranjang');
        }
      });
    }

    function checkEmptyCart() {
      if ($('.cart-item-card').length === 0) {
        setTimeout(function() {
          location.reload();
        }, 500);
      }
    }

    function updateCartCount() {
      $.get('/cart/count', function(response) {
        $('.cart-count').text(response.count || 0);
        if (window.updateCartIcon) {
          window.updateCartIcon();
        }
      });
    }

    function updateCartHeader() {
      // Update item count in header
      const totalItems = $('.cart-item-card').length;
      const totalQuantity = $('.quantity-input').toArray().reduce((sum, input) => {
        return sum + parseInt($(input).val());
      }, 0);

      $('.cart-header .fs-5').text(totalQuantity + ' Item');
    }

    function numberFormat(number) {
      return new Intl.NumberFormat('id-ID').format(number);
    }

    function showToast(type, message) {
      const iconClass = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
      const bgClass = type === 'success' ? 'bg-success' : 'bg-danger';

      const toast = $(`
        <div class="toast-notification position-fixed ${bgClass} text-white" 
             style="top: 20px; right: 20px; z-index: 9999; padding: 1rem 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); max-width: 300px;">
          <div class="d-flex align-items-center">
            <i class="fas ${iconClass} me-2"></i>
            <span>${message}</span>
            <button type="button" class="btn-close btn-close-white ms-auto" style="font-size: 0.8rem;"></button>
          </div>
        </div>
      `);

      $('body').append(toast);

      // Animate in
      toast.hide().fadeIn(300);

      // Auto close
      setTimeout(function() {
        toast.fadeOut(300, function() {
          $(this).remove();
        });
      }, 4000);

      // Manual close
      toast.find('.btn-close').click(function() {
        toast.fadeOut(300, function() {
          $(this).remove();
        });
      });
    }

    // Add loading states
    $('body').on('ajaxStart', function() {
      $('.btn-checkout').append(' <span class="spinner-border spinner-border-sm ms-2" role="status"></span>');
    }).on('ajaxStop', function() {
      $('.spinner-border').remove();
    });
  });
</script>

<!-- Include SweetAlert2 for better alerts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@endsection