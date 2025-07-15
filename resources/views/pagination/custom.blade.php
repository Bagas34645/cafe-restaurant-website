@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="pagination-navigation">
  {{-- Mobile Version --}}
  <div class="d-flex justify-content-between d-sm-none mb-3">
    @if ($paginator->onFirstPage())
    <span class="btn btn-outline-secondary disabled">
      <i class="fas fa-chevron-left me-1"></i>Previous
    </span>
    @else
    <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-outline-primary">
      <i class="fas fa-chevron-left me-1"></i>Previous
    </a>
    @endif

    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-outline-primary">
      Next<i class="fas fa-chevron-right ms-1"></i>
    </a>
    @else
    <span class="btn btn-outline-secondary disabled">
      Next<i class="fas fa-chevron-right ms-1"></i>
    </span>
    @endif
  </div>

  {{-- Desktop Version --}}
  <div class="d-none d-sm-block">
    {{-- Results Info --}}
    <div class="text-center mb-3">
      <small class="text-muted">
        Showing <strong>{{ $paginator->firstItem() }}</strong> to <strong>{{ $paginator->lastItem() }}</strong>
        of <strong>{{ $paginator->total() }}</strong> results
      </small>
    </div>

    {{-- Pagination Links --}}
    <ul class="pagination justify-content-center">
      {{-- Previous Page Link --}}
      @if ($paginator->onFirstPage())
      <li class="page-item disabled">
        <span class="page-link">
          <i class="fas fa-chevron-left"></i>
        </span>
      </li>
      @else
      <li class="page-item">
        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
          <i class="fas fa-chevron-left"></i>
        </a>
      </li>
      @endif

      {{-- Pagination Elements --}}
      @foreach ($elements as $element)
      {{-- "Three Dots" Separator --}}
      @if (is_string($element))
      <li class="page-item disabled">
        <span class="page-link">{{ $element }}</span>
      </li>
      @endif

      {{-- Array Of Links --}}
      @if (is_array($element))
      @foreach ($element as $page => $url)
      @if ($page == $paginator->currentPage())
      <li class="page-item active">
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
          <i class="fas fa-chevron-right"></i>
        </a>
      </li>
      @else
      <li class="page-item disabled">
        <span class="page-link">
          <i class="fas fa-chevron-right"></i>
        </span>
      </li>
      @endif
    </ul>
  </div>
</nav>
@endif