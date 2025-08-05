@extends('layouts.app')

@section('title', 'Jual Durian Tegal | Sentra Durian Tegal - Pusat Durian & Bibit Unggul')
@section('meta_description', 'Jual durian segar, bibit durian unggul, dan kuliner durian terbaik di Tegal. Sentra Durian Tegal melayani pembelian durian langsung, harga terjangkau, kualitas premium. Pesan durian Tegal sekarang!')
@section('meta_robots', 'index, follow')

@push('styles')
<style>
  body {
    /* Override main padding for hero section */
  }

  .hero-section {
    padding-top: 80px;
    /* Add navbar height to hero section padding */
  }

  /* Custom hover effect for primary button in hero section */
  .hero-section .btn-primary {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    background-color: #28a745;
    border-color: #28a745;
  }

  .hero-section .btn-primary:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
    background-color: #28a745 !important;
    /* Keep green color */
    border-color: #28a745 !important;
    /* Keep green border */
  }

  .hero-section .btn-primary:active {
    transform: scale(0.98);
    background-color: #218838 !important;
    /* Slightly darker green when clicked */
    border-color: #218838 !important;
  }

  /* Custom hover effect for outline button in hero section */
  .hero-section .btn-outline-light {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
  }

  .hero-section .btn-outline-light:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
    background-color: #fff !important;
    /* Keep white background on hover */
    border-color: #fff !important;
    /* Keep white border */
    color: #28a745 !important;
    /* Change text to green */
  }

  .hero-section .btn-outline-light:active {
    transform: scale(0.98);
    background-color: #f8f9fa !important;
    /* Slightly gray when clicked */
    border-color: #f8f9fa !important;
  }

  /* Gallery Slideshow Styles */
  .gallery-slideshow {
    overflow: hidden;
    position: relative;
    margin: 0 20px;
    /* Add margin for navigation buttons */
  }

  .gallery-container {
    transition: transform 0.3s ease-in-out;
    scroll-behavior: smooth;
    display: flex;
    align-items: stretch;
    will-change: transform;
  }

  .gallery-slide {
    min-width: 300px;
    flex: 0 0 300px;
    margin-right: 20px;
  }

  .gallery-slide:last-child {
    margin-right: 0;
  }

  .gallery-slide .card {
    height: 100%;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border-radius: 12px;
    overflow: hidden;
  }

  .gallery-slide .card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15) !important;
  }

  .gallery-slide img {
    width: 100% !important;
    height: 250px !important;
    object-fit: cover;
    object-position: center;
    display: block;
    background-color: #f8f9fa;
    transition: transform 0.3s ease;
  }

  .gallery-slide img:hover {
    transform: scale(1.08);
  }

  /* Loading state for images */
  .gallery-slide img[src=""] {
    opacity: 0;
  }

  .gallery-slide img {
    opacity: 1;
    transition: opacity 0.3s ease, transform 0.3s ease;
  }

  .gallery-nav {
    opacity: 0.9;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    border: none;
    background: linear-gradient(45deg, #28a745, #20c997);
    backdrop-filter: blur(10px);
  }

  .gallery-nav:hover {
    opacity: 1;
    transform: translateY(-50%) scale(1.15);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    background: linear-gradient(45deg, #218838, #1e7e34);
  }

  .gallery-nav:disabled,
  .gallery-nav.fade-out {
    opacity: 0;
    visibility: hidden;
    transform: translateY(-50%) scale(0.8);
    pointer-events: none;
  }

  .gallery-nav i {
    font-size: 16px;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .gallery-slideshow {
      margin: 0 10px;
    }

    .gallery-slide {
      min-width: 280px;
      flex: 0 0 280px;
      margin-right: 15px;
    }

    .gallery-slide img {
      height: 200px !important;
    }

    .gallery-nav {
      width: 40px;
      height: 40px;
    }

    .gallery-nav i {
      font-size: 14px;
    }
  }

  @media (max-width: 576px) {
    .gallery-slideshow {
      margin: 0 5px;
    }

    .gallery-slide {
      min-width: 250px;
      flex: 0 0 250px;
      margin-right: 10px;
    }

    .gallery-nav {
      width: 35px;
      height: 35px;
    }

    .gallery-nav i {
      font-size: 12px;
    }
  }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <h1 class="display-4 fw-bold mb-4">{{ cms_content('home_hero_title', 'Jual Durian Tegal Segar & Berkualitas') }}</h1>
        <p class="lead mb-4">{{ cms_content('home_hero_subtitle', 'Sentra Durian Tegal adalah pusat jual durian Tegal segar, bibit durian unggul, dan kuliner durian terbaik langsung dari kebun pilihan. Kami berkomitmen menyediakan durian berkualitas tinggi untuk konsumsi pribadi maupun kebutuhan bisnis Anda.') }}</p>
<div class="d-flex gap-3 justify-content-start justify-content-md-start justify-content-lg-start justify-content-xl-start justify-content-xxl-start justify-content-center flex-column flex-sm-row align-items-center">
  <a href="{{ route('products') }}" class="btn btn-primary btn-lg w-100 w-sm-auto mb-2 mb-sm-0 me-sm-3">Lihat Produk</a>
  <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg w-100 w-sm-auto">Hubungi Kami</a>
</div>
      </div>
      <div class="col-lg-4">
        @php
        $heroImage = \App\Models\Content::where('key', 'home_hero_image')->where('is_active', true)->first();
        @endphp
        @if($heroImage && $heroImage->image_path)
        <div class="text-center">
          <img src="{{ asset('storage/' . $heroImage->image_path) }}"
            alt="{{ $heroImage->title ?? 'Hero Image' }}"
            class="img-fluid rounded shadow-lg hero-image"
            style="max-height: 400px; width: auto;">
        </div>
        @else
        <div class="text-center">
          <div class="placeholder-image d-flex align-items-center justify-content-center"
            style="height: 300px;">
            <div class="text-white-50 text-center">
              <i class="fas fa-image fa-3x mb-3"></i>
              <p class="mb-1 fw-bold">Gambar Hero</p>
              <small>Upload melalui Admin → Konten</small>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</section>

<!-- Featured Products Section -->
@if($featuredProducts->count() > 0)
<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="display-5 fw-bold">{{ cms_content('home_featured_title', 'Produk Durian Unggulan') }}</h2>
      <p class="lead text-muted">{{ cms_content('home_featured_subtitle', 'Temukan durian berkualitas terbaik dari kebun pilihan kami') }}</p>
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

    <!-- Gallery Slideshow -->
    <div class="gallery-slideshow position-relative">
      <div class="gallery-container d-flex" id="galleryContainer">
        @foreach($featuredGalleries as $gallery)
        <div class="gallery-slide flex-shrink-0">
          <div class="card border-0 shadow-sm h-100">
            <div class="position-relative overflow-hidden">
              @if($gallery->path_gambar && file_exists(public_path('storage/' . $gallery->path_gambar)))
              <img src="{{ asset('storage/' . $gallery->path_gambar) }}"
                class="card-img-top"
                alt="{{ $gallery->judul }}"
                loading="lazy"
                onerror="this.onerror=null; this.src='{{ asset('images/durian-farm.jpg') }}'; this.alt='Gambar tidak tersedia';">
              @else
              <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                <div class="text-center text-muted">
                  <i class="fas fa-image fa-3x mb-2"></i>
                  <p class="mb-0 small">Gambar tidak tersedia</p>
                </div>
              </div>
              @endif
            </div>
            <div class="card-body text-center py-3">
              <h6 class="card-title mb-0 text-truncate" title="{{ $gallery->judul }}">{{ $gallery->judul }}</h6>
              @if($gallery->deskripsi)
              <small class="text-muted d-block mt-1">{{ Str::limit($gallery->deskripsi, 50) }}</small>
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <!-- Navigation Buttons -->
      @if($featuredGalleries->count() > 1)
      <button class="btn btn-primary gallery-nav gallery-prev position-absolute"
        id="galleryPrev"
        style="left: -10px; top: 50%; transform: translateY(-50%); z-index: 20; border-radius: 50%; width: 50px; height: 50px;"
        aria-label="Previous">
        <i class="fas fa-chevron-left"></i>
      </button>
      <button class="btn btn-primary gallery-nav gallery-next position-absolute"
        id="galleryNext"
        style="right: -10px; top: 50%; transform: translateY(-50%); z-index: 20; border-radius: 50%; width: 50px; height: 50px;"
        aria-label="Next">
        <i class="fas fa-chevron-right"></i>
      </button>
      @endif

      <!-- No gallery message -->
      @if($featuredGalleries->count() === 0)
      <div class="text-center py-5">
        <div class="text-muted">
          <i class="fas fa-images fa-3x mb-3"></i>
          <h5>Belum Ada Galeri</h5>
          <p>Galeri akan ditampilkan setelah admin menambahkan konten.</p>
        </div>
      </div>
      @endif
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
      <p class="lead text-muted">Baca testimoni dari pelanggan kami</p>
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

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const galleryContainer = document.getElementById('galleryContainer');
    const prevBtn = document.getElementById('galleryPrev');
    const nextBtn = document.getElementById('galleryNext');

    if (!galleryContainer) return;

    const slides = galleryContainer.querySelectorAll('.gallery-slide');
    if (slides.length === 0) return;

    let currentIndex = 0;
    let slideWidth = 320; // 300px + 20px margin
    let visibleSlides = 1;

    function calculateDimensions() {
      const containerWidth = galleryContainer.parentElement.offsetWidth - 40; // Account for margins

      // Responsive slide width
      if (window.innerWidth <= 576) {
        slideWidth = 270; // 250px + 20px margin
      } else if (window.innerWidth <= 768) {
        slideWidth = 300; // 280px + 20px margin  
      } else {
        slideWidth = 320; // 300px + 20px margin
      }

      visibleSlides = Math.floor(containerWidth / slideWidth);
      visibleSlides = Math.max(1, visibleSlides); // At least 1 slide visible

      return Math.max(0, slides.length - visibleSlides);
    }

    function updateSlideshow() {
      const maxIndex = calculateDimensions();

      // Adjust current index if it's out of bounds
      if (currentIndex > maxIndex) {
        currentIndex = maxIndex;
      }

      const translateX = -currentIndex * slideWidth;
      galleryContainer.style.transform = `translateX(${translateX}px)`;

      // Update button states and visibility
      if (prevBtn && nextBtn) {
        // Previous button
        if (currentIndex === 0) {
          prevBtn.disabled = true;
          prevBtn.classList.add('fade-out');
        } else {
          prevBtn.disabled = false;
          prevBtn.classList.remove('fade-out');
        }

        // Next button
        if (currentIndex >= maxIndex || slides.length <= visibleSlides) {
          nextBtn.disabled = true;
          nextBtn.classList.add('fade-out');
        } else {
          nextBtn.disabled = false;
          nextBtn.classList.remove('fade-out');
        }

        // Hide both buttons if all slides are visible
        if (slides.length <= visibleSlides) {
          prevBtn.style.display = 'none';
          nextBtn.style.display = 'none';
        } else {
          prevBtn.style.display = 'block';
          nextBtn.style.display = 'block';
        }
      }
    }

    function slideNext() {
      const maxIndex = calculateDimensions();
      if (currentIndex < maxIndex) {
        currentIndex++;
        updateSlideshow();
      }
    }

    function slidePrev() {
      if (currentIndex > 0) {
        currentIndex--;
        updateSlideshow();
      }
    }

    // Event listeners
    if (nextBtn) nextBtn.addEventListener('click', slideNext);
    if (prevBtn) prevBtn.addEventListener('click', slidePrev);

    // Touch/swipe support for mobile
    let startX = 0;
    let isDragging = false;

    galleryContainer.addEventListener('touchstart', function(e) {
      startX = e.touches[0].clientX;
      isDragging = true;
    }, {
      passive: true
    });

    galleryContainer.addEventListener('touchmove', function(e) {
      if (!isDragging) return;
    }, {
      passive: true
    });

    galleryContainer.addEventListener('touchend', function(e) {
      if (!isDragging) return;

      const endX = e.changedTouches[0].clientX;
      const diffX = startX - endX;

      if (Math.abs(diffX) > 50) { // Minimum swipe distance
        if (diffX > 0) {
          slideNext(); // Swipe left - go to next
        } else {
          slidePrev(); // Swipe right - go to previous
        }
      }

      isDragging = false;
    }, {
      passive: true
    });

    // Mouse drag support for desktop
    let mouseStartX = 0;
    let isMouseDragging = false;

    galleryContainer.addEventListener('mousedown', function(e) {
      mouseStartX = e.clientX;
      isMouseDragging = true;
      galleryContainer.style.cursor = 'grabbing';
      e.preventDefault();
    });

    document.addEventListener('mousemove', function(e) {
      if (!isMouseDragging) return;
      e.preventDefault();
    });

    document.addEventListener('mouseup', function(e) {
      if (!isMouseDragging) return;

      const endX = e.clientX;
      const diffX = mouseStartX - endX;

      if (Math.abs(diffX) > 50) { // Minimum drag distance
        if (diffX > 0) {
          slideNext(); // Drag left - go to next
        } else {
          slidePrev(); // Drag right - go to previous
        }
      }

      isMouseDragging = false;
      galleryContainer.style.cursor = 'grab';
    });

    // Initialize
    galleryContainer.style.cursor = 'grab';

    // Auto-slide (optional)
    let autoSlideInterval;

    function startAutoSlide() {
      if (slides.length <= visibleSlides) return; // Don't auto-slide if all slides are visible

      autoSlideInterval = setInterval(function() {
        const maxIndex = calculateDimensions();
        if (currentIndex >= maxIndex) {
          currentIndex = 0;
        } else {
          currentIndex++;
        }
        updateSlideshow();
      }, 5000); // Change slide every 5 seconds
    }

    function stopAutoSlide() {
      clearInterval(autoSlideInterval);
    }

    // Start auto-slide
    startAutoSlide();

    // Pause auto-slide on hover
    galleryContainer.addEventListener('mouseenter', stopAutoSlide);
    galleryContainer.addEventListener('mouseleave', startAutoSlide);

    // Handle window resize
    let resizeTimeout;
    window.addEventListener('resize', function() {
      clearTimeout(resizeTimeout);
      resizeTimeout = setTimeout(function() {
        updateSlideshow();
      }, 250);
    });

    // Initial setup
    updateSlideshow();

    // Ensure images are loaded
    const images = galleryContainer.querySelectorAll('img');
    let loadedImages = 0;

    function checkAllImagesLoaded() {
      loadedImages++;
      if (loadedImages === images.length) {
        setTimeout(updateSlideshow, 100); // Small delay to ensure layout is complete
      }
    }

    function handleImageError(img) {
      console.log('Failed to load image:', img.src);
      // Try alternative paths or show placeholder
      if (img.src.includes('/storage/gallery/')) {
        img.src = img.src.replace('/storage/gallery/', '/storage/galleries/');
      } else if (img.src.includes('/storage/galleries/')) {
        img.src = '{{ asset("images/durian-farm.jpg") }}';
      }
    }

    images.forEach(function(img) {
      if (img.complete && img.naturalHeight !== 0) {
        checkAllImagesLoaded();
      } else {
        img.addEventListener('load', function() {
          checkAllImagesLoaded();
        });
        img.addEventListener('error', function() {
          handleImageError(this);
          checkAllImagesLoaded();
        });
      }
    });
  });
</script>
@endpush