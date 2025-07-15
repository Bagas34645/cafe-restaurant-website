@if ($paginator->hasPages())
{{-- Results Summary --}}
<div class="pagination-info text-center mb-3">
  <small class="text-muted bg-light px-3 py-2 rounded-pill">
    Showing <strong>{{ $paginator->firstItem() }}</strong> to <strong>{{ $paginator->lastItem() }}</strong>
    of <strong>{{ $paginator->total() }}</strong> results
  </small>
</div>

<nav class="pagination-nav" aria-label="Pagination Navigation">
  <ul class="pagination justify-content-center mb-0">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <li class="page-item disabled" aria-disabled="true">
      <span class="page-link border-0">
        <i class="fas fa-chevron-left"></i>
        <span class="d-none d-md-inline ms-1">Previous</span>
      </span>
    </li>
    @else
    <li class="page-item">
      <a class="page-link border-0" href="{{ $paginator->previousPageUrl() }}" rel="prev">
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
      <span class="page-link border-0">{{ $element }}</span>
    </li>
    @endif

    {{-- Array Of Links --}}
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li class="page-item active" aria-current="page">
      <span class="page-link border-0 bg-dark border-dark">{{ $page }}</span>
    </li>
    @else
    <li class="page-item">
      <a class="page-link border-0" href="{{ $url }}">{{ $page }}</a>
    </li>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <li class="page-item">
      <a class="page-link border-0" href="{{ $paginator->nextPageUrl() }}" rel="next">
        <span class="d-none d-md-inline me-1">Next</span>
        <i class="fas fa-chevron-right"></i>
      </a>
    </li>
    @else
    <li class="page-item disabled" aria-disabled="true">
      <span class="page-link border-0">
        <span class="d-none d-md-inline me-1">Next</span>
        <i class="fas fa-chevron-right"></i>
      </span>
    </li>
    @endif
  </ul>
</nav>
@endif