@extends('layouts.admin')

@section('title', 'Detail Konten')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h3">Detail Konten</h1>
  <div>
    <a href="{{ route('admin.contents.edit', $content) }}" class="btn btn-warning">
      <i class="fas fa-edit me-1"></i> Edit
    </a>
    <a href="{{ route('admin.contents.index') }}" class="btn btn-secondary">
      <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
  </div>
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Informasi Konten</h6>
      </div>
      <div class="card-body">
        <table class="table table-borderless">
          <tr>
            <td width="200"><strong>Key:</strong></td>
            <td>{{ $content->key }}</td>
          </tr>
          <tr>
            <td><strong>Judul:</strong></td>
            <td>{{ $content->title ?? '-' }}</td>
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
            <td><strong>Urutan:</strong></td>
            <td>{{ $content->order }}</td>
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
            <td>{{ $content->created_at->format('d/m/Y H:i:s') }}</td>
          </tr>
          <tr>
            <td><strong>Diubah:</strong></td>
            <td>{{ $content->updated_at->format('d/m/Y H:i:s') }}</td>
          </tr>
        </table>
      </div>
    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Konten</h6>
      </div>
      <div class="card-body">
        @if($content->type === 'image' && $content->image_path)
        <div class="mb-3">
          <img src="{{ asset('storage/' . $content->image_path) }}"
            alt="{{ $content->title }}"
            class="img-fluid border rounded"
            style="max-width: 100%; max-height: 400px;">
        </div>
        <p><strong>Path:</strong> {{ $content->image_path }}</p>
        @endif

        @if($content->content)
        <div class="border rounded p-3 bg-light">
          {!! nl2br(e($content->content)) !!}
        </div>
        @else
        <p class="text-muted">Tidak ada konten teks.</p>
        @endif
      </div>
    </div>

    @if($content->meta_data)
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Metadata</h6>
      </div>
      <div class="card-body">
        <pre><code>{{ json_encode($content->meta_data, JSON_PRETTY_PRINT) }}</code></pre>
      </div>
    </div>
    @endif
  </div>

  <div class="col-lg-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-warning">Aksi</h6>
      </div>
      <div class="card-body text-center">
        <a href="{{ route('admin.contents.edit', $content) }}" class="btn btn-warning btn-block mb-2">
          <i class="fas fa-edit"></i> Edit Konten
        </a>

        <form action="{{ route('admin.contents.destroy', $content) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-block"
            onclick="return confirm('Apakah Anda yakin ingin menghapus konten ini?')">
            <i class="fas fa-trash"></i> Hapus Konten
          </button>
        </form>
      </div>
    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">Cara Penggunaan</h6>
      </div>
      <div class="card-body">
        <p class="small"><strong>Untuk menggunakan konten ini di view:</strong></p>
        <div class="bg-light p-2 rounded">
          <code class="small">
            @php echo htmlentities("{{ Content::getByKey('{$content->key}') }}"); @endphp
          </code>
        </div>

        @if($content->type === 'image')
        <p class="small mt-3"><strong>Untuk gambar:</strong></p>
        <div class="bg-light p-2 rounded">
          <code class="small">
            @php echo htmlentities("<img src=\"{{ asset('storage/' . Content::getByKey('{$content->key}')) }}\" alt=\"...\">"); @endphp
          </code>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
</div>
@endsection