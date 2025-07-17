@extends('layouts.app')

@section('title', 'Testimoni - Rajane Duren')

@section('content')
  <!-- Reviews Header -->
  <section class="py-5 bg-light">
    <div class="container">
    <div class="text-center">
      <h1 class="display-4 fw-bold">Ulasan Pelanggan</h1>
      <p class="lead text-muted">Lihat apa yang pelanggan kami katakan tentang pengalaman bersantap mereka</p>
    </div>
    </div>
  </section>

  <!-- Add Review Section -->
  <section class="py-5">
    <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
      <div class="card">
        <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-star me-2"></i>Bagikan Pengalaman Anda</h5>
        </div>
        <div class="card-body">
        <form action="{{ route('reviews.store') }}" method="POST">
          @csrf
          <div class="row">
          <div class="col-md-6 mb-3">
            <label for="customer_name" class="form-label">Nama</label>
            <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
            id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
            @error('customer_name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
          </div>
          <div class="col-md-6 mb-3">
            <label for="customer_email" class="form-label">Email</label>
            <input type="email" class="form-control @error('customer_email') is-invalid @enderror"
            id="customer_email" name="customer_email" value="{{ old('customer_email') }}" required>
            @error('customer_email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
          </div>
          </div>

          <div class="mb-3">
          <label for="rating" class="form-label">Rating</label>
          <div class="rating-input">
            <input type="hidden" name="rating" id="rating" value="{{ old('rating', 5) }}">
            <div class="star-rating-input">
            @for($i = 1; $i <= 5; $i++)
        <i class="fas fa-star star" data-rating="{{ $i }}"></i>
        @endfor
            </div>
          </div>
          @error('rating')
        <div class="text-danger">{{ $message }}</div>
      @enderror
          </div>

          <div class="mb-3">
          <label for="comment" class="form-label">Komentar</label>
          <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment"
            rows="4" required>{{ old('comment') }}</textarea>
          @error('comment')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
          </div>

          <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
        </div>
      </div>
      </div>
    </div>
    </div>
  </section>

  <!-- Reviews List -->
  <section class="py-5 bg-light">
    <div class="container">
    <h2 class="text-center mb-5">Ulasan Pelanggan</h2>

    @if($reviews->count() > 0)
    <div class="row">
      @foreach($reviews as $review)
      <div class="col-lg-6 mb-4">
      <div class="card h-100">
      <div class="card-body">
      <div class="d-flex justify-content-between align-items-start mb-3">
      <div>
      <h6 class="card-title mb-1">{{ $review->customer_name }}</h6>
      <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
      </div>
      <div class="star-rating">
      @for($i = 1; $i <= 5; $i++)
      <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
      @endfor
      </div>
      </div>
      <p class="card-text">"{{ $review->comment }}"</p>
      </div>
      </div>
      </div>
    @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
      <div class="pagination-wrapper">
      {{ $reviews->links('pagination.custom') }}
      </div>
    </div>
    @else
    <div class="text-center py-5">
      <i class="fas fa-comments fa-5x text-muted mb-4"></i>
      <h3 class="text-muted">No reviews yet</h3>
      <p class="text-muted">Be the first to share your experience with us!</p>
    </div>
    @endif
    </div>
  </section>
@endsection

@push('styles')
  <style>
    .star-rating-input {
    font-size: 2rem;
    color: #ddd;
    cursor: pointer;
    }

    .star-rating-input .star {
    transition: color 0.2s;
    }

    .star-rating-input .star:hover,
    .star-rating-input .star.active {
    color: #ffc107;
    }

    .star-rating {
    color: #ffc107;
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
    color: #fff;
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
    // Star rating functionality
    document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
      star.addEventListener('click', function () {
      const rating = this.getAttribute('data-rating');
      ratingInput.value = rating;

      // Update visual state
      stars.forEach((s, index) => {
        if (index < rating) {
        s.classList.add('active');
        } else {
        s.classList.remove('active');
        }
      });
      });

      star.addEventListener('mouseover', function () {
      const rating = this.getAttribute('data-rating');
      stars.forEach((s, index) => {
        if (index < rating) {
        s.style.color = '#ffc107';
        } else {
        s.style.color = '#ddd';
        }
      });
      });
    });

    // Reset to current rating on mouse leave
    document.querySelector('.star-rating-input').addEventListener('mouseleave', function () {
      const currentRating = ratingInput.value;
      stars.forEach((s, index) => {
      if (index < currentRating) {
        s.style.color = '#ffc107';
      } else {
        s.style.color = '#ddd';
      }
      });
    });

    // Initialize with default rating
    const defaultRating = ratingInput.value;
    stars.forEach((s, index) => {
      if (index < defaultRating) {
      s.classList.add('active');
      }
    });
    });
  </script>
@endpush