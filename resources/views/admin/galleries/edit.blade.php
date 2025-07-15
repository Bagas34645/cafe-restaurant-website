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
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror"
              id="judul" name="judul" value="{{ old('judul', $gallery->judul) }}" required>
            @error('judul')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
              id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $gallery->deskripsi) }}</textarea>
            @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
              <option value="">Pilih Kategori</option>
              @foreach(App\Models\Gallery::getKategoriTersedia() as $key => $label)
              <option value="{{ $key }}" {{ old('kategori', $gallery->kategori) == $key ? 'selected' : '' }}>{{ $label }}</option>
              @endforeach
            </select>
            @error('kategori')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="urutan" class="form-label">Urutan Tampilan</label>
            <input type="number" class="form-control @error('urutan') is-invalid @enderror"
              id="urutan" name="urutan" value="{{ old('urutan', $gallery->urutan) }}" min="0">
            @error('urutan')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Angka yang lebih kecil akan ditampilkan lebih dulu</div>
          </div>

          <div class="mb-3">
            <label class="form-label">Current Image</label>
            @if($gallery->path_gambar)
            <div class="mb-2">
              <img src="{{ asset('storage/' . $gallery->path_gambar) }}"
                alt="{{ $gallery->judul }}"
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
              <input class="form-check-input" type="checkbox" id="aktif" name="aktif"
                {{ old('aktif', $gallery->aktif) ? 'checked' : '' }}>
              <label class="form-check-label" for="aktif">
                Aktif (Tampilkan di website)
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