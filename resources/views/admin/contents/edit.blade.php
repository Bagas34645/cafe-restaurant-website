@extends('layouts.admin')

@section('title', 'Edit Konten')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h3">Edit Konten</h1>
  <a href="{{ route('admin.contents.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left me-1"></i> Kembali
  </a>
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Edit Konten</h6>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.contents.update', $content) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="key">Key Konten <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('key') is-invalid @enderror"
                  id="key" name="key" value="{{ old('key', $content->key) }}"
                  placeholder="contoh: home_hero_title">
                @error('key')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Key unik untuk mengidentifikasi konten</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror"
                  id="title" name="title" value="{{ old('title', $content->title) }}"
                  placeholder="Judul untuk admin (opsional)">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="type">Tipe Konten <span class="text-danger">*</span></label>
                <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                  <option value="">Pilih Tipe</option>
                  <option value="text" {{ old('type', $content->type) == 'text' ? 'selected' : '' }}>Text</option>
                  <option value="image" {{ old('type', $content->type) == 'image' ? 'selected' : '' }}>Image</option>
                  <option value="section" {{ old('type', $content->type) == 'section' ? 'selected' : '' }}>Section</option>
                  <option value="hero" {{ old('type', $content->type) == 'hero' ? 'selected' : '' }}>Hero</option>
                  <option value="feature" {{ old('type', $content->type) == 'feature' ? 'selected' : '' }}>Feature</option>
                </select>
                @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="section">Section <span class="text-danger">*</span></label>
                <select class="form-control @error('section') is-invalid @enderror" id="section" name="section">
                  <option value="">Pilih Section</option>
                  <option value="home" {{ old('section', $content->section) == 'home' ? 'selected' : '' }}>Home</option>
                  <option value="about" {{ old('section', $content->section) == 'about' ? 'selected' : '' }}>About</option>
                  <option value="contact" {{ old('section', $content->section) == 'contact' ? 'selected' : '' }}>Contact</option>
                  <option value="footer" {{ old('section', $content->section) == 'footer' ? 'selected' : '' }}>Footer</option>
                  <option value="general" {{ old('section', $content->section) == 'general' ? 'selected' : '' }}>General</option>
                </select>
                @error('section')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="order">Urutan</label>
                <input type="number" class="form-control @error('order') is-invalid @enderror"
                  id="order" name="order" value="{{ old('order', $content->order) }}" min="0">
                @error('order')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="content">Konten</label>
            <textarea class="form-control @error('content') is-invalid @enderror"
              id="content" name="content" rows="5"
              placeholder="Masukkan konten di sini...">{{ old('content', $content->content) }}</textarea>
            @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group" id="image-group">
            <label for="image">Gambar</label>
            @if($content->image_path)
            <div class="mb-2">
              <img src="{{ asset('storage/' . $content->image_path) }}"
                alt="Current Image" class="img-thumbnail" style="max-width: 200px;">
              <p class="small text-muted mt-1">Gambar saat ini</p>
            </div>
            @endif
            <input type="file" class="form-control-file @error('image') is-invalid @enderror"
              id="image" name="image" accept="image/*">
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</small>
          </div>

          <div class="form-group">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                value="1" {{ old('is_active', $content->is_active) ? 'checked' : '' }}>
              <label class="form-check-label" for="is_active">
                Aktif
              </label>
            </div>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save"></i> Update
            </button>
            <a href="{{ route('admin.contents.index') }}" class="btn btn-secondary">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">Info Konten</h6>
      </div>
      <div class="card-body">
        <table class="table table-borderless table-sm">
          <tr>
            <td><strong>Key:</strong></td>
            <td>{{ $content->key }}</td>
          </tr>
          <tr>
            <td><strong>Tipe:</strong></td>
            <td><span class="badge badge-info">{{ ucfirst($content->type) }}</span></td>
          </tr>
          <tr>
            <td><strong>Section:</strong></td>
            <td><span class="badge badge-secondary">{{ ucfirst($content->section) }}</span></td>
          </tr>
          <tr>
            <td><strong>Status:</strong></td>
            <td>
              @if($content->is_active)
              <span class="badge badge-success">Aktif</span>
              @else
              <span class="badge badge-danger">Tidak Aktif</span>
              @endif
            </td>
          </tr>
          <tr>
            <td><strong>Dibuat:</strong></td>
            <td>{{ $content->created_at->format('d/m/Y H:i') }}</td>
          </tr>
          <tr>
            <td><strong>Diubah:</strong></td>
            <td>{{ $content->updated_at->format('d/m/Y H:i') }}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    // Toggle image field based on type
    $('#type').change(function() {
      if ($(this).val() === 'image') {
        $('#image-group').show();
      } else {
        $('#image-group').hide();
      }
    });

    // Initialize based on selected value
    if ($('#type').val() !== 'image') {
      $('#image-group').hide();
    }
  });
</script>
@endpush