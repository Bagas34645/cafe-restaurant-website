@extends('layouts.app')

@section('title', 'Produk - Rajane Duren')

@section('content')
<!-- Menu Header -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center">
      <h1 class="display-4 fw-bold">Produk Kami</h1>
      <p class="lead text-muted">Produk durian dan bibit berkualitas premium langsung dari Tegal</p>
    </div>
  </div>
</section>

<!-- Menu Section -->
<section class="py-5">
  <div class="container">
    <!-- Category Filter -->
    @if($categories->count() > 0)
    <div class="text-center mb-5">
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-outline-primary active" data-filter="all">All Items</button>
        @foreach($categories as $category)
        <button type="button" class="btn btn-outline-primary" data-filter="{{ Str::slug($category) }}">{{ $category }}</button>
        @endforeach
      </div>
    </div>
    @endif

    @if($products->count() > 0)
    <div class="row" id="products-grid">
      @foreach($products as $product)
      <div class="col-lg-4 col-md-6 mb-4 product-item" data-category="{{ $product->category ? Str::slug($product->category) : 'uncategorized' }}">
        <div class="card h-100">
          @if($product->image_path)
          <img src="{{ asset('storage/' . $product->image_path) }}"
            class="card-img-top"
            alt="{{ $product->name }}"
            style="height: 250px; object-fit: cover;">
          @else
          <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
            <i class="fas fa-utensils fa-3x text-muted"></i>
          </div>
          @endif

          <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <h5 class="card-title">{{ $product->name }}</h5>
              @if($product->category)
              <span class="badge bg-secondary">{{ $product->category }}</span>
              @endif
            </div>

            <p class="card-text text-muted flex-grow-1">{{ $product->description }}</p>

            <div class="d-flex justify-content-between align-items-center mt-auto mb-3">
              <span class="h5 text-primary mb-0">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
              @if($product->is_available)
              <span class="badge bg-success">Available</span>
              @else
              <span class="badge bg-danger">Unavailable</span>
              @endif
            </div>

            @if($product->is_available)
            <div class="d-flex align-items-center gap-2">
              @auth
              <div class="input-group input-group-sm" style="max-width: 120px;">
                <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="decrease">-</button>
                <input type="number" class="form-control text-center quantity-input" value="1" min="1" max="99" data-product-id="{{ $product->id }}">
                <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="increase">+</button>
              </div>
              <button class="btn btn-primary flex-fill add-to-cart-btn" data-product-id="{{ $product->id }}">
                <i class="fas fa-cart-plus"></i> Add to Cart
              </button>
              @else
              <button class="btn btn-warning w-100 login-required-btn" data-bs-toggle="modal" data-bs-target="#loginModal">
                <i class="fas fa-sign-in-alt"></i> Login untuk Menambah ke Keranjang
              </button>
              @endauth
            </div>
            @else
            <button class="btn btn-secondary w-100" disabled>
              <i class="fas fa-ban"></i> Out of Stock
            </button>
            @endif
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
      <div class="pagination-wrapper">
        {{ $products->links('pagination.custom') }}
      </div>
    </div>
    @else
    <div class="text-center py-5">
      <i class="fas fa-utensils fa-5x text-muted mb-4"></i>
      <h3 class="text-muted">No menu items found</h3>
      <p class="text-muted">Our menu is being updated. Please check back later!</p>
    </div>
    @endif
  </div>
</section>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login Diperlukan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <i class="fas fa-shopping-cart fa-3x text-primary mb-3"></i>
        <h5>Silakan Login Terlebih Dahulu</h5>
        <p class="text-muted">Untuk menambahkan produk ke keranjang, Anda harus login terlebih dahulu.</p>
      </div>
      <div class="modal-footer">
        <a href="{{ route('login') }}" class="btn btn-primary">
          <i class="fas fa-sign-in-alt"></i> Login Sekarang
        </a>
        <a href="{{ route('register') }}" class="btn btn-outline-primary">
          <i class="fas fa-user-plus"></i> Daftar Akun Baru
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Call to Action -->
<section class="py-5 bg-primary text-white">
  <div class="container text-center">
    <h2 class="display-5 fw-bold mb-4">Siap untuk memesan?</h2>
    <p class="lead mb-4">Hubungi kami untuk membuat reservasi atau melakukan pemesanan untuk diambil.</p>
    <a href="{{ route('contact') }}" class="btn btn-light btn-lg">Hubungi Kami</a>
  </div>
</section>
@endsection

@push('scripts')
<script>
  // Category filtering
  document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('[data-filter]');
    const productItems = document.querySelectorAll('.product-item');

    filterButtons.forEach(button => {
      button.addEventListener('click', function() {
        // Remove active class from all buttons
        filterButtons.forEach(btn => btn.classList.remove('active'));
        // Add active class to clicked button
        this.classList.add('active');

        const filterValue = this.getAttribute('data-filter');

        productItems.forEach(item => {
          if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
  });
</script>
@endpush

@push('styles')
<style>
  /* Enhanced Pagination Styles */
  .pagination-wrapper {
    width: 100%;
    max-width: 800px;
  }

  .pagination-navigation .pagination {
    margin-bottom: 0;
    flex-wrap: wrap;
    justify-content: center;
  }

  .pagination-navigation .page-link {
    position: relative;
    display: block;
    padding: 0.75rem 1rem;
    margin: 0 2px;
    color: #495057;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    transition: all 0.3s ease-in-out;
    min-width: 45px;
    text-align: center;
  }

  .pagination-navigation .page-link:hover {
    z-index: 2;
    color: #e74c3c;
    background-color: #f8f9fa;
    border-color: #e74c3c;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(231, 76, 60, 0.2);
  }

  .pagination-navigation .page-link:focus {
    z-index: 3;
    color: #e74c3c;
    background-color: #f8f9fa;
    border-color: #e74c3c;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(231, 76, 60, 0.25);
  }

  .pagination-navigation .page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #e74c3c;
    border-color: #e74c3c;
    box-shadow: 0 4px 12px rgba(231, 76, 60, 0.4);
    transform: translateY(-1px);
  }

  .pagination-navigation .page-item.disabled .page-link {
    color: #6c757d;
    background-color: #fff;
    border-color: #dee2e6;
    opacity: 0.5;
    cursor: not-allowed;
  }

  .pagination-navigation .page-item:first-child .page-link {
    margin-left: 0;
  }

  .pagination-navigation .page-item:last-child .page-link {
    margin-right: 0;
  }

  /* Mobile responsive adjustments */
  @media (max-width: 576px) {
    .pagination-navigation .page-link {
      padding: 0.5rem 0.75rem;
      font-size: 0.875rem;
      min-width: 40px;
    }

    .pagination-navigation .pagination {
      gap: 2px;
    }
  }

  /* Results info styling */
  .pagination-navigation small {
    padding: 0.5rem 1rem;
    background-color: #f8f9fa;
    border-radius: 1rem;
    display: inline-block;
  }
</style>
@endpush

@push('scripts')
<script>
  $(document).ready(function() {
    // Quantity controls
    $('.quantity-btn').click(function() {
      let button = $(this);
      let input = button.siblings('.quantity-input');
      let currentValue = parseInt(input.val());
      let action = button.data('action');

      let newValue = action === 'increase' ? currentValue + 1 : Math.max(1, currentValue - 1);
      input.val(newValue);
    });

    $('.quantity-input').change(function() {
      let value = Math.max(1, parseInt($(this).val()) || 1);
      $(this).val(value);
    });

    // Add to cart
    $('.add-to-cart-btn').click(function() {
      let button = $(this);
      let productId = button.data('product-id');
      let quantityInput = button.closest('.card-body').find('.quantity-input');
      let quantity = parseInt(quantityInput.val());

      // Disable button
      button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Adding...');

      $.ajax({
        url: '/cart/add',
        method: 'POST',
        data: {
          product_id: productId,
          quantity: quantity,
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          if (response.success) {
            // Reset quantity
            quantityInput.val(1);

            // Update cart count
            updateCartCount();

            // Show success message
            showToast('success', response.message);

            // Reset button
            button.prop('disabled', false).html('<i class="fas fa-cart-plus"></i> Add to Cart');
          } else {
            showToast('error', response.message);
            button.prop('disabled', false).html('<i class="fas fa-cart-plus"></i> Add to Cart');
          }
        },
        error: function(xhr) {
          let response = xhr.responseJSON;

          if (xhr.status === 401 && response && response.redirect) {
            // User not authenticated, redirect to login
            showLoginModal(response.message);
          } else {
            showToast('error', response?.message || 'Terjadi kesalahan saat menambahkan produk ke keranjang');
          }

          button.prop('disabled', false).html('<i class="fas fa-cart-plus"></i> Add to Cart');
        }
      });
    });

    function showLoginModal(message) {
      // Update modal message if provided
      if (message) {
        $('#loginModal .modal-body p').text(message);
      }

      // Show modal
      const modal = new bootstrap.Modal(document.getElementById('loginModal'));
      modal.show();
    }

    function updateCartCount() {
      $.get('/cart/count', function(response) {
        $('.cart-count').text(response.count || 0);
      });
    }

    function showToast(type, message) {
      let alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
      let icon = type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';

      let toast = $('<div class="alert ' + alertClass + ' alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;">' +
        '<i class="' + icon + '"></i> ' + message +
        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
        '</div>');

      $('body').append(toast);

      setTimeout(function() {
        toast.alert('close');
      }, 3000);
    }

    // Load cart count on page load
    updateCartCount();
  });
</script>
@endpush