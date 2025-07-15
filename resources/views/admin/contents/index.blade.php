@extends('layouts.admin')

@section('title', 'Manajemen Konten')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h3">Manajemen Konten</h1>
  <a href="{{ route('admin.contents.create') }}" class="btn btn-primary">
    <i class="fas fa-plus me-1"></i> Tambah Konten
  </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Content Table -->
<div class="card shadow-sm border-0 mb-4">
  <div class="card-header bg-primary text-white">
    <div class="d-flex justify-content-between align-items-center">
      <h6 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Konten</h6>

      <!-- Per Page Selector -->
      <div class="d-flex align-items-center">
        <label for="perPage" class="text-white me-2 mb-0" style="font-size: 0.875rem;">
          <i class="fas fa-th-list me-1"></i>Per halaman:
        </label>
        <select id="perPage" class="form-select form-select-sm" style="width: auto;" onchange="changePerPage(this.value)">
          <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
          <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15</option>
          <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
          <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
          <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
        </select>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Key</th>
            <th>Judul</th>
            <th>Tipe</th>
            <th>Section</th>
            <th>Order</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($contents as $content)
          <tr>
            <td>{{ $content->key }}</td>
            <td>{{ $content->title ?? '-' }}</td>
            <td>
              @php
              $typeColors = [
              'text' => 'bg-primary',
              'image' => 'bg-success',
              'section' => 'bg-info',
              'hero' => 'bg-warning text-dark',
              'feature' => 'bg-secondary'
              ];
              $typeColor = $typeColors[$content->type] ?? 'bg-secondary';
              @endphp
              <span class="badge {{ $typeColor }}">
                <i class="fas fa-{{ $content->type === 'text' ? 'font' : ($content->type === 'image' ? 'image' : ($content->type === 'hero' ? 'star' : ($content->type === 'feature' ? 'th-large' : 'folder'))) }} me-1"></i>
                {{ ucfirst($content->type) }}
              </span>
            </td>
            <td>
              @php
              $sectionColors = [
              'home' => 'bg-success',
              'about' => 'bg-info',
              'contact' => 'bg-warning text-dark',
              'footer' => 'bg-dark',
              'general' => 'bg-secondary'
              ];
              $sectionColor = $sectionColors[$content->section] ?? 'bg-secondary';
              @endphp
              <span class="badge {{ $sectionColor }}">
                <i class="fas fa-{{ $content->section === 'home' ? 'home' : ($content->section === 'about' ? 'info-circle' : ($content->section === 'contact' ? 'envelope' : ($content->section === 'footer' ? 'anchor' : 'cog'))) }} me-1"></i>
                {{ ucfirst($content->section) }}
              </span>
            </td>
            <td>{{ $content->order }}</td>
            <td>
              @if($content->is_active)
              <span class="badge bg-success">
                <i class="fas fa-check-circle me-1"></i>Aktif
              </span>
              @else
              <span class="badge bg-danger">
                <i class="fas fa-times-circle me-1"></i>Tidak Aktif
              </span>
              @endif
            </td>
            <td>
              <div class="btn-group gap-2" role="group">
                <a href="{{ route('admin.contents.show', $content) }}" class="btn btn-outline-info btn-sm" title="Lihat">
                  <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('admin.contents.edit', $content) }}" class="btn btn-outline-warning btn-sm" title="Edit">
                  <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.contents.destroy', $content) }}" method="POST" style="display: inline-block;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus konten ini?')">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Pagination with Info -->
    @if($contents->hasPages())
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center mt-4 pt-3 border-top">
      <!-- Results Info -->
      <div class="mb-3 mb-lg-0">
        <small class="text-muted">
          <i class="fas fa-info-circle me-1"></i>
          Menampilkan <strong>{{ $contents->firstItem() }}</strong> sampai <strong>{{ $contents->lastItem() }}</strong>
          dari <strong>{{ $contents->total() }}</strong> konten
        </small>
      </div>

      <!-- Pagination Links -->
      <div class="pagination-wrapper">
        {{ $contents->appends(request()->query())->links('pagination.admin') }}
      </div>
    </div>
    @endif
  </div>
</div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable({
      "pageLength": 25,
      "ordering": true,
      "searching": true,
      "paging": false, // Disable DataTable pagination since we're using Laravel pagination
      "info": false // Hide DataTable info since we have custom info
    });
  });

  function changePerPage(value) {
    const url = new URL(window.location);
    url.searchParams.set('per_page', value);
    url.searchParams.delete('page'); // Reset to first page when changing per_page
    window.location.href = url.toString();
  }

  // Smooth scroll to top when pagination is clicked
  $(document).on('click', '.pagination a', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');

    $('html, body').animate({
      scrollTop: 0
    }, 300, function() {
      window.location.href = href;
    });
  });
</script>
@endpush

@push('styles')
<style>
  .pagination-wrapper .pagination {
    margin-bottom: 0;
  }

  .pagination-wrapper .page-link {
    padding: 0.5rem 0.75rem;
    margin: 0 2px;
    color: #6c757d;
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    transition: all 0.15s ease-in-out;
  }

  .pagination-wrapper .page-link:hover {
    color: #495057;
    background-color: #e9ecef;
    border-color: #adb5bd;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .pagination-wrapper .page-item.active .page-link {
    color: #fff;
    background-color: #0d6efd;
    border-color: #0d6efd;
    box-shadow: 0 2px 4px rgba(13, 110, 253, 0.25);
  }

  .pagination-wrapper .page-item.disabled .page-link {
    color: #6c757d;
    background-color: #fff;
    border-color: #dee2e6;
    opacity: 0.5;
  }

  .pagination-info {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
    border: 1px solid #dee2e6;
  }

  @media (max-width: 768px) {
    .pagination-wrapper .page-link span.d-none.d-md-inline {
      display: none !important;
    }
  }
</style>
@endpush