@extends('layouts.app')

@section('title', 'Gallery - Cafe Restaurant')

@section('content')
<!-- Gallery Header -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center">
      <h1 class="display-4 fw-bold">Restaurant Gallery</h1>
      <p class="lead text-muted">Take a visual journey through our beautiful restaurant and delicious cuisine</p>
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
          <img src="{{ asset('storage/' . $gallery->image_path) }}"
            class="card-img-top rounded"
            alt="{{ $gallery->title }}"
            style="height: 300px; object-fit: cover; cursor: pointer;"
            data-bs-toggle="modal"
            data-bs-target="#imageModal"
            data-image="{{ asset('storage/' . $gallery->image_path) }}"
            data-title="{{ $gallery->title }}"
            data-description="{{ $gallery->description }}">
          <div class="card-body text-center">
            <h5 class="card-title">{{ $gallery->title }}</h5>
            @if($gallery->description)
            <p class="card-text text-muted">{{ Str::limit($gallery->description, 100) }}</p>
            @endif
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
      {{ $galleries->links() }}
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
  document.addEventListener('DOMContentLoaded', function() {
    const imageModal = document.getElementById('imageModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalImage = document.getElementById('modalImage');
    const modalDescription = document.getElementById('modalDescription');

    imageModal.addEventListener('show.bs.modal', function(event) {
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