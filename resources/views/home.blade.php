@extends('layouts.app')

@section('title', 'Beranda - Rajane Duren')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <h1 class="display-4 fw-bold mb-4">Selamat Datang</h1>
        <p class="lead mb-4">Sentra Durian Tegal adalah pusat informasi dan distribusi durian unggulan langsung dari kebun terbaik di Tegal. Kami berkomitmen menyediakan durian berkualitas tinggi untuk konsumsi pribadi maupun kebutuhan bisnis Anda.</p>
        <div class="d-flex gap-3">
          <a href="{{ route('products') }}" class="btn btn-primary btn-lg">Lihat Produk</a>
          <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">Hubungi Kami</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Featured Products Section -->
@if($featuredProducts->count() > 0)
<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="display-5 fw-bold">Produk Durian Unggulan</h2>
      <p class="lead text-muted">Temukan durian berkualitas terbaik dari kebun pilihan kami</p>
    </div>

    <div class="row">
      @foreach($featuredProducts->take(4) as $product)
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          @if($product->image_path)
          <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
          @else
          <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
            <i class="fas fa-leaf fa-3x text-muted"></i>
          </div>
          @endif
          <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text text-muted">{{ Str::limit($product->description, 80) }}</p>
            <div class="d-flex justify-content-between align-items-center">
              <span class="h5 text-primary mb-0">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
              @if($product->category)
              <span class="badge bg-secondary">{{ $product->category }}</span>
              @endif
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <div class="text-center mt-4">
      <a href="{{ route('products') }}" class="btn btn-primary">Lihat Semua Produk</a>
    </div>
  </div>
</section>
@endif

<!-- Gallery Preview Section -->
@if($featuredGalleries->count() > 0)
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="display-5 fw-bold">Galeri Sentra Durian</h2>
      <p class="lead text-muted">Lihat kebun durian dan fasilitas kami</p>
    </div>

    <div class="row">
      @foreach($featuredGalleries->take(6) as $gallery)
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-0">
          <img src="{{ asset('storage/' . $gallery->path_gambar) }}" class="card-img-top rounded" alt="{{ $gallery->judul }}" style="height: 250px; object-fit: cover;">
          <div class="card-body text-center px-0">
            <h6 class="card-title">{{ $gallery->judul }}</h6>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <div class="text-center mt-4">
      <a href="{{ route('gallery') }}" class="btn btn-primary">Lihat Galeri</a>
    </div>
  </div>
</section>
@endif

<!-- Customer Reviews Section -->
@if($approvedReviews->count() > 0)
<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="display-5 fw-bold">Testimoni Pelanggan</h2>
      <p class="lead text-muted">Baca testimoni dari pelanggan yang puas</p>
    </div>

    <div class="row">
      @foreach($approvedReviews->take(3) as $review)
      <div class="col-lg-4 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="star-rating mb-3">
              @for($i = 1; $i <= 5; $i++)
                <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                @endfor
            </div>
            <p class="card-text">"{{ $review->comment }}"</p>
            <footer class="blockquote-footer">
              <strong>{{ $review->customer_name }}</strong>
            </footer>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <div class="text-center mt-4">
      <a href="{{ route('reviews') }}" class="btn btn-primary">Lihat Semua Testimoni</a>
    </div>
  </div>
</section>
@endif

<!-- Call to Action Section -->
<section class="py-5 bg-primary text-white">
  <div class="container text-center">
    <h2 class="display-5 fw-bold mb-4">Siap Memesan Durian Berkualitas?</h2>
    <p class="lead mb-4">Hubungi kami sekarang dan rasakan kelezatan durian terbaik dari Tegal.</p>
    <a href="{{ route('contact') }}" class="btn btn-light btn-lg">Hubungi Kami</a>
  </div>
</section>
@endsection