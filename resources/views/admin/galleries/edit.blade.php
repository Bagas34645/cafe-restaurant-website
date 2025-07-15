@extends('layouts.admin')

@section('title', 'Edit Gallery Item - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h3">Edit Gallery Item</h1>
  <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left me-2"></i>Back to Gallery
  </a>
</div>

<div class="row justify-content-center">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Gallery Item</h5>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror"
              id="title" name="title" value="{{ old('title', $gallery->title) }}" required>
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description (Optional)</label>
            <textarea class="form-control @error('description') is-invalid @enderror"
              id="description" name="description" rows="3">{{ old('description', $gallery->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Current Image</label>
            @if($gallery->image_path)
            <div class="mb-2">
              <img src="{{ asset('storage/' . $gallery->image_path) }}"
                alt="{{ $gallery->title }}"
                class="img-thumbnail"
                style="max-height: 200px;">
            </div>
            @endif

            <label for="image" class="form-label">New Image (Optional)</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror"
              id="image" name="image" accept="image/*">
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Leave empty to keep current image. Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB</div>
          </div>

          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}>
              <label class="form-check-label" for="is_active">
                Active (Display on website)
              </label>
            </div>
          </div>

          <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save me-2"></i>Update Gallery Item
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Image Preview -->
<div class="row justify-content-center mt-4">
  <div class="col-lg-8">
    <div class="card" id="preview-card" style="display: none;">
      <div class="card-header">
        <h6 class="mb-0">New Image Preview</h6>
      </div>
      <div class="card-body text-center">
        <img id="image-preview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 300px;">
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  // Image preview functionality
  document.getElementById('image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const previewCard = document.getElementById('preview-card');
    const previewImage = document.getElementById('image-preview');

    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        previewImage.src = e.target.result;
        previewCard.style.display = 'block';
      };
      reader.readAsDataURL(file);
    } else {
      previewCard.style.display = 'none';
    }
  });
</script>
@endpush