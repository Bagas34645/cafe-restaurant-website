@extends('layouts.app')

@section('title', 'Produk - Rajane Duren')

@section('content')
<!-- Menu Header -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center">
      <h1 class="display-4 fw-bold">Produk Kami</h1>
      <p class="lead text-muted">Produk durian dan bibit berkualitas premium langsung dari Tegal</p>

      <!-- Search Box -->
      <div class="row justify-content-center mt-4">
        <div class="col-md-6">
          <form method="GET" action="{{ route('products') }}" class="search-form">
            <div class="input-group">
              <input type="text"
                class="form-control form-control-lg"
                name="search"
                placeholder="Cari produk durian..."
                value="{{ request('search') }}"
                id="searchInput">
              <button class="btn btn-primary" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
            @if(request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
          </form>

          @if(request('search'))
          <div class="mt-2">
            <small class="text-muted">
              Hasil pencarian untuk: "<strong>{{ request('search') }}</strong>"
              <a href="{{ route('products') }}" class="btn btn-sm btn-outline-secondary ms-2">
                <i class="fas fa-times"></i> Hapus Filter
              </a>
            </small>
          </div>
          @endif
        </div>
      </div>
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
        <a href="{{ route('products', array_merge(request()->query(), ['category' => 'all'])) }}"
          class="btn btn-outline-primary {{ !request('category') || request('category') === 'all' ? 'active' : '' }}">
          All Items
        </a>
        @foreach($categories as $category)
        <a href="{{ route('products', array_merge(request()->query(), ['category' => $category])) }}"
          class="btn btn-outline-primary {{ request('category') === $category ? 'active' : '' }}">
          {{ $category }}
        </a>
        @endforeach
      </div>
    </div>
    @endif

    @if($products->count() > 0)

    <!-- Search Results Info -->
    @if(request('search') || request('category'))
    <div class="row justify-content-center mb-4">
      <div class="col-md-8">
        <div class="alert alert-info d-flex align-items-center">
          <i class="fas fa-info-circle me-2"></i>
          <div>
            Menampilkan {{ $products->count() }} dari {{ $products->total() }} produk
            @if(request('search'))
            untuk pencarian "<strong>{{ request('search') }}</strong>"
            @endif
            @if(request('category') && request('category') !== 'all')
            dalam kategori "<strong>{{ request('category') }}</strong>"
            @endif
          </div>
        </div>
      </div>
    </div>
    @endif

    <div class="row" id="products-grid">
      @foreach($products as $product)
      <div class="col-lg-4 col-md-6 mb-4 product-item" data-category="{{ $product->category ? Str::slug($product->category) : 'uncategorized' }}">
        <div class="card h-100">
          @if($product->image_path)
          <div class="position-relative">
            <img src="{{ asset('storage/' . $product->image_path) }}"
              class="card-img-top"
              alt="{{ $product->name }}"
              style="height: 250px; object-fit: cover;">
            @if($product->hasDiscount())
            <span class="position-absolute top-0 end-0 badge bg-danger m-2">
              {{ $product->discount_percentage }}% OFF
            </span>
            @endif
            @if($product->is_featured)
            <span class="position-absolute top-0 start-0 badge bg-warning text-dark m-2">
              Featured
            </span>
            @endif
          </div>
          @else
          <div class="card-img-top bg-light d-flex align-items-center justify-content-center position-relative" style="height: 250px;">
            <i class="fas fa-utensils fa-3x text-muted"></i>
            @if($product->hasDiscount())
            <span class="position-absolute top-0 end-0 badge bg-danger m-2">
              {{ $product->discount_percentage }}% OFF
            </span>
            @endif
            @if($product->is_featured)
            <span class="position-absolute top-0 start-0 badge bg-warning text-dark m-2">
              Featured
            </span>
            @endif
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
              <div class="price-section">
                @if($product->hasDiscount())
                <small class="text-decoration-line-through text-muted d-block">
                  Rp{{ number_format($product->price, 0, ',', '.') }}
                </small>
                <span class="h5 text-success mb-0">Rp{{ number_format($product->final_price, 0, ',', '.') }}</span>
                @else
                <span class="h5 text-success mb-0">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                @endif
              </div>
              <div class="d-flex flex-column align-items-end">
                @if($product->is_available)
                <span class="badge bg-success mb-1">Available</span>
                @else
                <span class="badge bg-danger mb-1">Unavailable</span>
                @endif
                @if($product->total_reviews > 0)
                <small class="text-warning">
                  ★ {{ number_format($product->average_rating, 1) }} ({{ $product->total_reviews }})
                </small>
                @endif
              </div>
            </div>

            @if($product->is_available)
            <div class="d-flex flex-column gap-2">
              <!-- Detail Button Only -->
              <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary w-100">
                <i class="fas fa-eye"></i> Lihat Detail
              </a>
            </div>
            @else
            <div class="d-flex flex-column gap-2">
              <button class="btn btn-secondary w-100" disabled>
                <i class="fas fa-ban"></i> Out of Stock
              </button>
              <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary w-100">
                <i class="fas fa-eye"></i> Lihat Detail
              </a>
            </div>
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
      <i class="fas fa-search fa-5x text-muted mb-4"></i>
      @if(request('search'))
      <h3 class="text-muted">Tidak ada produk yang ditemukan</h3>
      <p class="text-muted">Tidak ada produk yang cocok dengan pencarian "{{ request('search') }}"</p>
      <a href="{{ route('products') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Kembali ke Semua Produk
      </a>
      @else
      <h3 class="text-muted">No menu items found</h3>
      <p class="text-muted">Our menu is being updated. Please check back later!</p>
      @endif
    </div>
    @endif
  </div>
</section>


<!-- Call to Action -->
<section class="py-5 bg-primary text-white">
  <div class="container text-center">
    <h2 class="display-5 fw-bold mb-4">Siap untuk memesan?</h2>
    <p class="lead mb-4">Hubungi kami untuk membuat reservasi atau melakukan pemesanan untuk diambil.</p>
    <a href="{{ route('contact') }}" class="btn btn-light btn-lg">Hubungi Kami</a>
  </div>
</section>
@endsection



@push('styles')
<style>
  /* Search Box Styles */
  .search-form .input-group {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    border-radius: 50px;
    overflow: hidden;
    transition: all 0.3s ease;
  }

  .search-form .input-group:focus-within {
    box-shadow: 0 6px 20px rgba(47, 163, 101, 0.2);
    transform: translateY(-2px);
  }

  .search-form .form-control {
    border: none;
    padding: 1rem 1.5rem;
    font-size: 1.1rem;
    background: white;
  }

  .search-form .form-control:focus {
    box-shadow: none;
    border: none;
  }

  .search-form .btn {
    border: none;
    padding: 1rem 1.5rem;
    background: linear-gradient(135deg, #2FA365, #1C5B40);
    border-radius: 0;
    color: white;
  }

  .search-form .btn:hover {
    background: linear-gradient(135deg, #1C5B40, #155040);
    transform: none;
    color: white;
  }

  .search-form .input-group .form-control {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
  }

  .search-form .input-group .btn {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
  }

  /* Category Filter Enhancement */
  .btn-group .btn-outline-primary {
    transition: all 0.3s ease;
    margin: 0 2px;
    border-radius: 25px !important;
  }

  .btn-group .btn-outline-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(47, 163, 101, 0.3);
  }

  /* Hide number input arrows/spinners */
  .quantity-input::-webkit-outer-spin-button,
  .quantity-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  .quantity-input[type=number] {
    -moz-appearance: textfield;
    appearance: textfield;
  }

  .btn-group .btn-outline-primary.active {
    background-color: #2FA365;
    border-color: #2FA365;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(47, 163, 101, 0.4);
  }

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
    color: #2FA365;
    background-color: #f8f9fa;
    border-color: #2FA365;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(47, 163, 101, 0.2);
  }

  .pagination-navigation .page-link:focus {
    z-index: 3;
    color: #2FA365;
    background-color: #f8f9fa;
    border-color: #2FA365;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(47, 163, 101, 0.25);
  }

  .pagination-navigation .page-item.active .page-link {
    z-index: 3;
    color: white;
    background-color: #2FA365;
    border-color: #2FA365;
    box-shadow: 0 4px 12px rgba(47, 163, 101, 0.4);
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
    .search-form .form-control {
      font-size: 1rem;
      padding: 0.875rem 1.25rem;
    }

    .search-form .btn {
      padding: 0.875rem 1.25rem;
    }

    .btn-group .btn-outline-primary {
      font-size: 0.875rem;
      padding: 0.5rem 1rem;
      margin: 2px;
    }

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