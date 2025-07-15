@if ($paginator->hasPages())
<nav class="pagination-nav" aria-label="Pagination Navigation">
  <ul class="pagination justify-content-center mb-0 flex-wrap">
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
      <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" title="Previous Page">
        <i class="fas fa-chevron-left"></i>
        <span class="d-none d-md-inline ms-1">Previous</span>
      </a>
    </li>
    @endif

    {{-- First Page Link --}}
    @if($paginator->currentPage() > 3)
    <li class="page-item">
      <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
    </li>
    @if($paginator->currentPage() > 4)
    <li class="page-item disabled">
      <span class="page-link">...</span>
    </li>
    @endif
    @endif

    {{-- Page Number Links --}}
    @for($i = max(1, $paginator->currentPage() - 2); $i <= min($paginator->lastPage(), $paginator->currentPage() + 2); $i++)
      @if($i == $paginator->currentPage())
      <li class="page-item active" aria-current="page">
        <span class="page-link">{{ $i }}</span>
      </li>
      @else
      <li class="page-item">
        <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
      </li>
      @endif
      @endfor

      {{-- Last Page Link --}}
      @if($paginator->currentPage() < $paginator->lastPage() - 2)
        @if($paginator->currentPage() < $paginator->lastPage() - 3)
          <li class="page-item disabled">
            <span class="page-link">...</span>
          </li>
          @endif
          <li class="page-item">
            <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
          </li>
          @endif

          {{-- Next Page Link --}}
          @if ($paginator->hasMorePages())
          <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" title="Next Page">
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