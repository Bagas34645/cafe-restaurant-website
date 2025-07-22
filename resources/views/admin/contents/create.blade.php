@extends('layouts.admin')

@section('title', 'Tambah Konten')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h3">Tambah Konten</h1>
  <a href="{{ route('admin.contents.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left me-1"></i> Kembali
  </a>
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="card shadow-sm border-0 mb-4">
      <div class="card-header bg-primary text-white">
        <h6 class="mb-0"><i class="fas fa-plus me-2"></i>Form Tambah Konten</h6>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.contents.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="key">Key Konten <span class="text-danger">*</span></label>
                <select class="form-control @error('key') is-invalid @enderror" id="key" name="key">
                  <option value="">Pilih atau ketik Key Konten</option>
                  <option value="home_hero_title">home_hero_title</option>
                  <option value="home_hero_subtitle">home_hero_subtitle</option>
                  <option value="home_hero_description">home_hero_description</option>
                  <option value="home_hero_image">home_hero_image</option>
                  <option value="about_title">about_title</option>
                  <option value="about_story_content">about_story_content</option>
                  <option value="about_image">about_image</option>
                  <option value="contact_address">contact_address</option>
                  <option value="contact_phone">contact_phone</option>
                  <option value="contact_email">contact_email</option>
                  <option value="footer_description">footer_description</option>
                  <option value="footer_logo">footer_logo</option>
                  <option value="footer_social_facebook">footer_social_facebook</option>
                  <option value="footer_social_instagram">footer_social_instagram</option>
                  <option value="footer_social_twitter">footer_social_twitter</option>
                  <option value="menu_section_title">menu_section_title</option>
                  <option value="menu_section_description">menu_section_description</option>
                  <option value="feature_1_title">feature_1_title</option>
                  <option value="feature_1_description">feature_1_description</option>
                  <option value="feature_1_icon">feature_1_icon</option>
                  <option value="feature_2_title">feature_2_title</option>
                  <option value="feature_2_description">feature_2_description</option>
                  <option value="feature_2_icon">feature_2_icon</option>
                  <option value="feature_3_title">feature_3_title</option>
                  <option value="feature_3_description">feature_3_description</option>
                  <option value="feature_3_icon">feature_3_icon</option>
                  <option value="general_site_title">general_site_title</option>
                  <option value="general_site_description">general_site_description</option>
                  <option value="general_logo">general_logo</option>
                  <option value="general_favicon">general_favicon</option>
                  <option value="general_meta_keywords">general_meta_keywords</option>
                  <option value="general_meta_description">general_meta_description</option>
                </select>
                @error('key')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Pilih dari daftar atau ketik key baru untuk mengidentifikasi konten (gunakan underscore, tanpa spasi)</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror"
                  id="title" name="title" value="{{ old('title') }}"
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
                  <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Text</option>
                  <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Image</option>
                  <option value="section" {{ old('type') == 'section' ? 'selected' : '' }}>Section</option>
                  <option value="hero" {{ old('type') == 'hero' ? 'selected' : '' }}>Hero</option>
                  <option value="feature" {{ old('type') == 'feature' ? 'selected' : '' }}>Feature</option>
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
                  <option value="home" {{ old('section') == 'home' ? 'selected' : '' }}>Home</option>
                  <option value="about" {{ old('section') == 'about' ? 'selected' : '' }}>About</option>
                  <option value="contact" {{ old('section') == 'contact' ? 'selected' : '' }}>Contact</option>
                  <option value="footer" {{ old('section') == 'footer' ? 'selected' : '' }}>Footer</option>
                  <option value="general" {{ old('section') == 'general' ? 'selected' : '' }}>General</option>
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
                  id="order" name="order" value="{{ old('order', 0) }}" min="0">
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
              placeholder="Masukkan konten di sini...">{{ old('content') }}</textarea>
            @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group" id="image-group">
            <label for="image">Gambar</label>
            <input type="file" class="form-control-file @error('image') is-invalid @enderror"
              id="image" name="image" accept="image/*">
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB.</small>
          </div>

          <div class="form-group">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                value="1" {{ old('is_active', true) ? 'checked' : '' }}>
              <label class="form-check-label" for="is_active">
                Aktif
              </label>
            </div>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('admin.contents.index') }}" class="btn btn-secondary">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card shadow-sm border-0 mb-4">
      <div class="card-header bg-info text-white">
        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Panduan</h6>
      </div>
      <div class="card-body">
        <h6>Tipe Konten:</h6>
        <ul class="small">
          <li><strong>Text:</strong> Untuk teks biasa seperti judul, deskripsi</li>
          <li><strong>Image:</strong> Untuk gambar dengan path relatif</li>
          <li><strong>Section:</strong> Untuk bagian khusus halaman</li>
          <li><strong>Hero:</strong> Untuk bagian hero/banner</li>
          <li><strong>Feature:</strong> Untuk fitur/kartu khusus</li>
        </ul>

        <h6 class="mt-3">Contoh Key:</h6>
        <ul class="small">
          <li>home_hero_title</li>
          <li>about_story_content</li>
          <li>contact_address</li>
          <li>footer_description</li>
        </ul>
      </div>
    </div>
  </div>
</div>
</div>
@endsection

@push('scripts')
<!-- Select2 CDN -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

    // Select2 for key input
    $('#key').select2({
      tags: true,
      placeholder: 'Pilih atau ketik Key Konten',
      allowClear: true,
      width: '100%'
    });
  });
</script>
@endpush