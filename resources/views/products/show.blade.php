@extends('layouts.app')

@section('title', $product->name . ' - Rajane Duren')

@section('content')
<div class="container py-5">
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
      <li class="breadcrumb-item"><a href="{{ route('products') }}">Produk</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
    </ol>
  </nav>

  <div class="row">
    <!-- Product Images -->
    <div class="col-lg-6">
      <div class="product-gallery">
        <!-- Main Image -->
        <div class="main-image mb-3">
          <img id="mainImage"
            src="{{ $product->image_path ? asset('storage/' . $product->image_path) : asset('images/placeholder.jpg') }}"
            class="img-fluid rounded shadow"
            alt="{{ $product->name }}"
            style="width: 100%; height: 400px; object-fit: cover;">
        </div>

        <!-- Thumbnail Images -->
        @if($product->all_images && count($product->all_images) > 1)
        <div class="thumbnail-images">
          <div class="row g-2">
            @foreach($product->all_images as $index => $image)
            <div class="col-3">
              <img src="{{ asset('storage/' . $image) }}"
                class="img-fluid rounded thumbnail-img {{ $index === 0 ? 'active' : '' }}"
                alt="{{ $product->name }}"
                style="width: 100%; height: 80px; object-fit: cover; cursor: pointer; border: 2px solid transparent;"
                onclick="changeMainImage('{{ asset('storage/' . $image) }}', this)">
            </div>
            @endforeach
          </div>
        </div>
        @endif
      </div>
    </div>

    <!-- Product Info -->
    <div class="col-lg-6">
      <div class="product-info">
        <!-- Product Title & SKU -->
        <h1 class="product-title fw-bold mb-2">{{ $product->name }}</h1>
        @if($product->sku)
        <p class="text-muted mb-3">SKU: {{ $product->sku }}</p>
        @endif

        <!-- Category & Origin -->
        <div class="mb-3">
          <span class="badge bg-primary me-2">{{ $product->category_display_name }}</span>
          @if($product->origin)
          <span class="badge bg-secondary">Asal: {{ $product->origin }}</span>
          @endif
          @if($product->is_featured)
          <span class="badge bg-warning text-dark">Featured</span>
          @endif
        </div>

        <!-- Price -->
        <div class="price-section mb-4">
          @if($product->hasDiscount())
          <div class="d-flex align-items-center mb-2">
            <span class="price-original text-decoration-line-through text-muted me-3 fs-5">
              Rp{{ number_format($product->price, 0, ',', '.') }}
            </span>
            <span class="badge bg-danger">{{ $product->discount_percentage }}% OFF</span>
          </div>
          <h3 class="price-final text-success fw-bold mb-0">
            Rp{{ number_format($product->final_price, 0, ',', '.') }}
          </h3>
          @else
          <h3 class="price-final text-success fw-bold mb-0">
            Rp{{ number_format($product->price, 0, ',', '.') }}
          </h3>
          @endif
        </div>

        <!-- Stock Status -->
        <div class="stock-status mb-4">
          @if($product->stock_status === 'in_stock')
          <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>
            <strong>Stok Tersedia</strong> ({{ $product->stock_quantity }} item)
          </div>
          @elseif($product->stock_status === 'low_stock')
          <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Stok Terbatas</strong> ({{ $product->stock_quantity }} item tersisa)
          </div>
          @else
          <div class="alert alert-danger">
            <i class="fas fa-times-circle me-2"></i>
            <strong>Stok Habis</strong>
          </div>
          @endif
        </div>

        <!-- Product Specifications -->
        @if($product->weight || $product->specifications)
        <div class="specifications mb-4">
          <h5 class="fw-bold mb-3">Spesifikasi Produk</h5>
          <div class="row">
            @if($product->weight)
            <div class="col-6 mb-2">
              <strong>Berat:</strong> {{ $product->formatted_weight }}
            </div>
            @endif
            @if($product->harvest_date)
            <div class="col-6 mb-2">
              <strong>Tanggal Panen:</strong> {{ $product->harvest_date->format('d M Y') }}
            </div>
            @endif
            @if($product->specifications)
            @foreach($product->specifications as $key => $value)
            <div class="col-6 mb-2">
              <strong>{{ ucfirst($key) }}:</strong> {{ $value }}
            </div>
            @endforeach
            @endif
          </div>
        </div>
        @endif

        <!-- Add to Cart Section -->
        <!-- Add to Cart Section removed as requested -->

        <!-- Action Buttons -->
        <div class="action-buttons">
          <div class="d-grid gap-2 d-md-flex">
            <button class="btn btn-success flex-fill me-2" onclick="openBuyNowModal()">
              <i class="fas fa-shopping-cart me-2"></i>Beli Sekarang
            </button>
            <button class="btn btn-outline-primary flex-fill" onclick="shareProduct()">
              <i class="fas fa-share-alt me-2"></i>Bagikan
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Product Description Tabs -->
  <div class="row mt-5">
    <div class="col-12">
      <ul class="nav nav-tabs" id="productTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description"
            type="button" role="tab" aria-controls="description" aria-selected="true">
            Deskripsi
          </button>
        </li>
        @if($product->care_instructions)
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="care-tab" data-bs-toggle="tab" data-bs-target="#care"
            type="button" role="tab" aria-controls="care" aria-selected="false">
            Perawatan
          </button>
        </li>
        @endif
        @if($product->specifications)
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs"
            type="button" role="tab" aria-controls="specs" aria-selected="false">
            Spesifikasi Lengkap
          </button>
        </li>
        @endif
      </ul>

      <div class="tab-content mt-3" id="productTabsContent">
        <!-- Description Tab -->
        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
          <div class="card">
            <div class="card-body">
              <p>{{ $product->description }}</p>
              @if($product->detailed_description)
              <hr>
              <h6 class="fw-bold">Detail Lengkap:</h6>
              <div class="detailed-description">
                {!! nl2br(e($product->detailed_description)) !!}
              </div>
              @endif
            </div>
          </div>
        </div>

        <!-- Care Instructions Tab -->
        @if($product->care_instructions)
        <div class="tab-pane fade" id="care" role="tabpanel" aria-labelledby="care-tab">
          <div class="card">
            <div class="card-body">
              <h6 class="fw-bold mb-3">Panduan Perawatan</h6>
              <div class="care-instructions">
                {!! nl2br(e($product->care_instructions)) !!}
              </div>
            </div>
          </div>
        </div>
        @endif

        <!-- Specifications Tab -->
        @if($product->specifications)
        <div class="tab-pane fade" id="specs" role="tabpanel" aria-labelledby="specs-tab">
          <div class="card">
            <div class="card-body">
              <h6 class="fw-bold mb-3">Spesifikasi Lengkap</h6>
              <div class="table-responsive">
                <table class="table table-striped">
                  <tbody>
                    @if($product->weight)
                    <tr>
                      <td><strong>Berat</strong></td>
                      <td>{{ $product->formatted_weight }}</td>
                    </tr>
                    @endif
                    @if($product->origin)
                    <tr>
                      <td><strong>Asal</strong></td>
                      <td>{{ $product->origin }}</td>
                    </tr>
                    @endif
                    @if($product->harvest_date)
                    <tr>
                      <td><strong>Tanggal Panen</strong></td>
                      <td>{{ $product->harvest_date->format('d M Y') }}</td>
                    </tr>
                    @endif
                    @foreach($product->specifications as $key => $value)
                    <tr>
                      <td><strong>{{ ucfirst($key) }}</strong></td>
                      <td>{{ $value }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>

  <!-- Related Products -->
  @if($relatedProducts->count() > 0)
  <div class="row mt-5">
    <div class="col-12">
      <h4 class="fw-bold mb-4">Produk Serupa</h4>
      <div class="row">
        @foreach($relatedProducts as $relatedProduct)
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card h-100">
            <div class="position-relative">
              <img src="{{ $relatedProduct->image_path ? asset('storage/' . $relatedProduct->image_path) : asset('images/placeholder.jpg') }}"
                class="card-img-top" alt="{{ $relatedProduct->name }}"
                style="height: 200px; object-fit: cover;">
              @if($relatedProduct->hasDiscount())
              <span class="position-absolute top-0 end-0 badge bg-danger m-2">
                {{ $relatedProduct->discount_percentage }}% OFF
              </span>
              @endif
            </div>
            <div class="card-body d-flex flex-column">
              <h6 class="card-title">{{ Str::limit($relatedProduct->name, 50) }}</h6>
              <p class="card-text text-muted small flex-grow-1">
                {{ Str::limit($relatedProduct->description, 80) }}
              </p>
              <div class="price-section mb-3">
                @if($relatedProduct->hasDiscount())
                <small class="text-decoration-line-through text-muted d-block">
                  Rp{{ number_format($relatedProduct->price, 0, ',', '.') }}
                </small>
                <span class="fw-bold text-success">
                  Rp{{ number_format($relatedProduct->final_price, 0, ',', '.') }}
                </span>
                @else
                <span class="fw-bold text-success">
                  Rp{{ number_format($relatedProduct->price, 0, ',', '.') }}
                </span>
                @endif
              </div>
              <a href="{{ route('products.show', $relatedProduct->id) }}" class="btn btn-outline-primary btn-sm">
                Lihat Detail
              </a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @endif
</div>
<!-- Buy Now Modal -->
<div class="modal fade" id="buyNowModal" tabindex="-1" aria-labelledby="buyNowModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buyNowModalLabel">Pilih Platform Pembelian</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-4">Silakan pilih platform untuk membeli produk ini:</p>
        <div class="d-grid gap-3">
          <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20membeli%20produk%20{{ urlencode($product->name) }}" target="_blank" class="btn btn-success btn-lg">
            <i class="fab fa-whatsapp me-2"></i>WhatsApp
          </a>
          <a href="https://www.tokopedia.com/yourstore" target="_blank" class="btn btn-lg" style="background:#fff; border:2px solid #03AC0E; color:#03AC0E; font-weight:600;">
            <img src="{{ asset('images/Tokopedia_Mascot.png') }}" alt="Tokopedia" style="height: 28px; width: 28px; margin-right: 8px; vertical-align: middle;">
            <img src="{{ asset('images/Tokopedia_Logo.png') }}" alt="Tokopedia Logo" style="height: 28px; vertical-align: middle;">
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .thumbnail-img.active {
    border-color: #198754 !important;
  }

  .thumbnail-img:hover {
    border-color: #198754 !important;
    opacity: 0.8;
  }

  .price-original {
    font-size: 1.1rem;
  }

  .price-final {
    font-size: 2rem;
  }

  .specifications .row>div {
    padding: 0.5rem 0;
    border-bottom: 1px solid #f0f0f0;
  }

  .product-gallery {
    position: sticky;
    top: 100px;
  }

  /* Rating input styles */
  .rating-input {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-end;
    gap: 0.1rem;
  }

  .rating-input input[type="radio"] {
    display: none;
  }

  .rating-input label {
    font-size: 2rem;
    color: #ddd;
    cursor: pointer;
    transition: color 0.2s;
  }

  .rating-input label:hover,
  .rating-input label:hover~label,
  .rating-input input[type="radio"]:checked~label {
    color: #ffc107;
  }

  @media (max-width: 768px) {
    .product-gallery {
      position: static;
    }

    .price-final {
      font-size: 1.5rem;
    }

    .rating-input label {
      font-size: 1.5rem;
    }
  }
</style>

<script>
  function changeMainImage(src, thumbnail) {
    document.getElementById('mainImage').src = src;

    // Remove active class from all thumbnails
    document.querySelectorAll('.thumbnail-img').forEach(img => {
      img.classList.remove('active');
    });

    // Add active class to clicked thumbnail
    thumbnail.classList.add('active');
  }

  function changeQuantity(change) {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value);
    const max = parseInt(quantityInput.max);
    const min = parseInt(quantityInput.min);

    const newValue = currentValue + change;

    if (newValue >= min && newValue <= max) {
      quantityInput.value = newValue;
    }
  }

  function shareProduct() {
    if (navigator.share) {
      navigator.share({
        title: '{{ $product->name }}',
        text: '{{ Str::limit($product->description, 100) }}',
        url: window.location.href
      });
    } else {
      // Fallback: copy to clipboard
      navigator.clipboard.writeText(window.location.href).then(() => {
        alert('Link produk berhasil disalin!');
      });
    }
  }

  function addToWishlist() {
    // Implement wishlist functionality
    alert('Fitur wishlist akan segera hadir!');
  }
  function openBuyNowModal() {
    var modal = new bootstrap.Modal(document.getElementById('buyNowModal'));
    modal.show();
  }
  // ...existing code...
</script>
@endsection