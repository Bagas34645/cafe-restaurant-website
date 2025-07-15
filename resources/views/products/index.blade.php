@extends('layouts.app')

@section('title', 'Produk - Sentra Durian Tegal')

@section('content')
<!-- Menu Header -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center">
      <h1 class="display-4 fw-bold">Our Menu</h1>
      <p class="lead text-muted">Discover our carefully crafted dishes made with the finest ingredients</p>
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

            <div class="d-flex justify-content-between align-items-center mt-auto">
              <span class="h5 text-primary mb-0">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
              @if($product->is_available)
              <span class="badge bg-success">Available</span>
              @else
              <span class="badge bg-danger">Unavailable</span>
              @endif
            </div>
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

<!-- Call to Action -->
<section class="py-5 bg-primary text-white">
  <div class="container text-center">
    <h2 class="display-5 fw-bold mb-4">Ready to Order?</h2>
    <p class="lead mb-4">Contact us to make a reservation or place an order for pickup.</p>
    <a href="{{ route('contact') }}" class="btn btn-light btn-lg">Contact Us</a>
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