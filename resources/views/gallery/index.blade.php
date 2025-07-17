@extends('layouts.app')

@section('title', 'Galeri - Rajane Duren')

@section('content')
  <!-- Gallery Header -->
  <section class="py-5 bg-light">
    <div class="container">
    <div class="text-center">
      <h1 class="display-4 fw-bold">Galeri Sentra Durian</h1>
      <p class="lead text-muted">Jelajahi keindahan restoran kami dan kelezatan kuliner durian yang menggugah selera</p>
    </div>
    </div>
  </section>

  <!-- Gallery Grid -->
  <section class="py-5">
    <div class="container">
    @if($galleries->count() > 0)
    <div class="row" id="gallery-grid">
      @foreach($galleries as $gallery)
      <div class="col-lg-4 col-md-6 mb-4">
      <div class="card border-0 gallery-item">
      <img src="{{ asset('storage/' . $gallery->path_gambar) }}" class="card-img-top rounded"
      alt="{{ $gallery->judul }}" style="height: 300px; object-fit: cover; cursor: pointer;"
      data-bs-toggle="modal" data-bs-target="#imageModal"
      data-image="{{ asset('storage/' . $gallery->path_gambar) }}" data-title="{{ $gallery->judul }}"
      data-description="{{ $gallery->deskripsi }}">
      <div class="card-body text-center">
      <h5 class="card-title">{{ $gallery->judul }}</h5>
      @if($gallery->deskripsi)
      <p class="card-text text-muted">{{ Str::limit($gallery->deskripsi, 100) }}</p>
      @endif
      </div>
      </div>
      </div>
    @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
      <div class="pagination-wrapper">
      {{ $galleries->links('pagination.custom') }}
      </div>
    </div>
    @else
    <div class="text-center py-5">
      <i class="fas fa-images fa-5x text-muted mb-4"></i>
      <h3 class="text-muted">No gallery items found</h3>
      <p class="text-muted">Check back later for beautiful photos of our restaurant and cuisine.</p>
    </div>
    @endif
    </div>
  </section>

  <!-- Image Modal -->
  <div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="modalTitle"></h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
      <img src="" alt="" class="img-fluid rounded" id="modalImage">
      <p class="mt-3 text-muted" id="modalDescription"></p>
      </div>
    </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    // Handle image modal
    document.addEventListener('DOMContentLoaded', function () {
    const imageModal = document.getElementById('imageModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalImage = document.getElementById('modalImage');
    const modalDescription = document.getElementById('modalDescription');

    imageModal.addEventListener('show.bs.modal', function (event) {
      const trigger = event.relatedTarget;
      const imageSrc = trigger.getAttribute('data-image');
      const title = trigger.getAttribute('data-title');
      const description = trigger.getAttribute('data-description');

      modalTitle.textContent = title;
      modalImage.src = imageSrc;
      modalImage.alt = title;
      modalDescription.textContent = description || '';
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