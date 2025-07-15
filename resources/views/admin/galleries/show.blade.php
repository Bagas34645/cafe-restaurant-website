@extends('layouts.admin')

@section('title', 'Gallery Item Details - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h3">Gallery Item Details</h1>
  <div class="d-flex gap-2">
    <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-warning">
      <i class="fas fa-edit me-2"></i>Edit
    </a>
    <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">
      <i class="fas fa-arrow-left me-2"></i>Back to Gallery
    </a>
  </div>
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Gallery Information</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Title:</label>
            <p class="mb-0">{{ $gallery->judul }}</p>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Status:</label>
            <p class="mb-0">
              <span class="badge bg-{{ $gallery->aktif ? 'success' : 'secondary' }} fs-6">
                {{ $gallery->aktif ? 'Aktif' : 'Tidak Aktif' }}
              </span>
            </p>
          </div>
        </div>

        @if($gallery->deskripsi)
        <div class="mb-3">
          <label class="form-label fw-bold">Deskripsi:</label>
          <p class="mb-0">{{ $gallery->deskripsi }}</p>
        </div>
        @endif

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Created:</label>
            <p class="mb-0">{{ $gallery->created_at->format('F j, Y \a\t g:i A') }}</p>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Last Updated:</label>
            <p class="mb-0">{{ $gallery->updated_at->format('F j, Y \a\t g:i A') }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card">
      <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-image me-2"></i>Gallery Image</h5>
      </div>
      <div class="card-body text-center">
        @if($gallery->path_gambar)
        <img src="{{ asset('storage/' . $gallery->path_gambar) }}"
          alt="{{ $gallery->judul }}"
          class="img-fluid rounded shadow"
          style="max-height: 400px;">
        @else
        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 200px;">
          <div class="text-center text-muted">
            <i class="fas fa-image fa-3x mb-2"></i>
            <p>No image available</p>
          </div>
        </div>
        @endif
      </div>
    </div>

    <div class="card mt-4">
      <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-cogs me-2"></i>Actions</h5>
      </div>
      <div class="card-body">
        <div class="d-grid gap-2">
          <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Edit Gallery Item
          </a>

          <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger w-100"
              onclick="return confirm('Are you sure you want to delete this gallery item? This action cannot be undone.')">
              <i class="fas fa-trash me-2"></i>Delete Gallery Item
            </button>
          </form>

          @if($gallery->aktif)
          <a href="{{ route('gallery') }}" target="_blank" class="btn btn-success">
            <i class="fas fa-external-link-alt me-2"></i>View on Website
          </a>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection