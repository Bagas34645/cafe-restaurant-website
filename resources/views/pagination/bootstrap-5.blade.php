@if ($paginator->hasPages())
{{-- Results Summary --}}
<div class="pagination-info text-center mb-3">
  <p class="text-muted mb-0">
    <small>
      Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
    </small>
  </p>
</div>

<nav class="pagination-nav" aria-label="Pagination Navigation">
  <ul class="pagination pagination-lg justify-content-center mb-0">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <li class="page-item disabled" aria-disabled="true">
      <span class="page-link">
        <i class="fas fa-chevron-left"></i>
        <span class="d-none d-md-inline ms-1">Previous</span>
      </span>
    </li>
    @else
    <li class="page-item">
      <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
        <i class="fas fa-chevron-left"></i>
        <span class="d-none d-md-inline ms-1">Previous</span>
      </a>
    </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
    {{-- "Three Dots" Separator --}}
    @if (is_string($element))
    <li class="page-item disabled" aria-disabled="true">
      <span class="page-link">{{ $element }}</span>
    </li>
    @endif

    {{-- Array Of Links --}}
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li class="page-item active" aria-current="page">
      <span class="page-link bg-primary border-primary">{{ $page }}</span>
    </li>
    @else
    <li class="page-item">
      <a class="page-link" href="{{ $url }}">{{ $page }}</a>
    </li>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <li class="page-item">
      <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
        <span class="d-none d-md-inline me-1">Next</span>
        <i class="fas fa-chevron-right"></i>
      </a>
    </li>
    @else
    <li class="page-item disabled" aria-disabled="true">
      <span class="page-link">
        <span class="d-none d-md-inline me-1">Next</span>
        <i class="fas fa-chevron-right"></i>
      </span>
    </li>
    @endif
  </ul>
</nav>
@endif