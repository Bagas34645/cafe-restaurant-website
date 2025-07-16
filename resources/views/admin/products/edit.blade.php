@extends('layouts.admin')

@section('title', 'Edit Product - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h3">Edit Product</h1>
  <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left me-2"></i>Back to Products
  </a>
</div>

<!-- Success/Error Messages -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <h6><i class="fas fa-exclamation-triangle me-2"></i>Please fix the following errors:</h6>
  <ul class="mb-0">
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row justify-content-center">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Product Details</h5>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
              id="name" name="name" value="{{ old('name', $product->name) }}" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror"
              id="description" name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="price" class="form-label">Harga (Rp)</label>
              <input type="number" step="0.01" min="0" class="form-control @error('price') is-invalid @enderror"
                id="price" name="price" value="{{ old('price', $product->price) }}" required>
              @error('price')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6 mb-3">
              <label for="category" class="form-label">Category (Optional)</label>
              <input type="text" class="form-control @error('category') is-invalid @enderror"
                id="category" name="category" value="{{ old('category', $product->category) }}"
                placeholder="e.g., Appetizer, Main Course, Dessert">
              @error('category')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Current Image</label>
            @if($product->image_path)
            <div class="mb-2">
              <img src="{{ asset('storage/' . $product->image_path) }}"
                alt="{{ $product->name }}"
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
              <input type="hidden" name="is_available" value="0">
              <input class="form-check-input" type="checkbox" id="is_available" name="is_available" value="1"
                {{ old('is_available', $product->is_available) ? 'checked' : '' }}>
              <label class="form-check-label" for="is_available">
                Available for order
              </label>
            </div>
          </div>

          <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save me-2"></i>Update Product
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
  // Image preview functionality with validation
  document.getElementById('image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const previewCard = document.getElementById('preview-card');
    const previewImage = document.getElementById('image-preview');
    
    // Clear any previous errors
    const existingErrors = document.querySelectorAll('.image-error');
    existingErrors.forEach(error => error.remove());

    if (file) {
      // Validate file type
      const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
      if (!allowedTypes.includes(file.type)) {
        showImageError('Please select a valid image file (JPEG, PNG, JPG, or GIF)');
        this.value = '';
        previewCard.style.display = 'none';
        return;
      }

      // Validate file size (2MB = 2048KB = 2097152 bytes)
      if (file.size > 2097152) {
        showImageError('File size must be less than 2MB');
        this.value = '';
        previewCard.style.display = 'none';
        return;
      }

      // Show preview
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

  function showImageError(message) {
    const imageInput = document.getElementById('image');
    const errorDiv = document.createElement('div');
    errorDiv.className = 'invalid-feedback image-error d-block';
    errorDiv.textContent = message;
    imageInput.parentNode.appendChild(errorDiv);
    imageInput.classList.add('is-invalid');
  }

  // Clear error when user selects a new file
  document.getElementById('image').addEventListener('click', function() {
    this.classList.remove('is-invalid');
    const existingErrors = document.querySelectorAll('.image-error');
    existingErrors.forEach(error => error.remove());
  });

  // Form submission validation
  document.querySelector('form').addEventListener('submit', function(e) {
    const imageInput = document.getElementById('image');
    const file = imageInput.files[0];
    
    if (file) {
      // Final validation before submit
      const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
      if (!allowedTypes.includes(file.type) || file.size > 2097152) {
        e.preventDefault();
        alert('Please check your image file. It must be a valid image type (JPEG, PNG, JPG, or GIF) and smaller than 2MB.');
        return false;
      }
    }
  });
</script>
@endpush