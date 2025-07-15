@extends('layouts.admin')

@section('title', 'Review Management - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h3">Review Management</h1>
  <div class="d-flex gap-2">
    <span class="badge bg-warning fs-6">{{ $reviews->where('is_approved', false)->count() }} Pending</span>
    <span class="badge bg-success fs-6">{{ $reviews->where('is_approved', true)->count() }} Approved</span>
  </div>
</div>

@if($reviews->count() > 0)
<div class="card">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead class="table-dark">
          <tr>
            <th>Customer</th>
            <th>Rating</th>
            <th>Comment</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($reviews as $review)
          <tr class="{{ !$review->is_approved ? 'table-warning' : '' }}">
            <td>
              <div>
                <strong>{{ $review->customer_name }}</strong>
                <br>
                <small class="text-muted">{{ $review->customer_email }}</small>
              </div>
            </td>
            <td>
              <div class="text-warning">
                @for($i = 1; $i <= 5; $i++)
                  <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                  @endfor
              </div>
              <small class="text-muted">({{ $review->rating }}/5)</small>
            </td>
            <td>
              <div class="text-break" style="max-width: 300px;">
                {{ Str::limit($review->comment, 100) }}
              </div>
            </td>
            <td>
              <span class="badge bg-{{ $review->is_approved ? 'success' : 'warning' }}">
                {{ $review->is_approved ? 'Approved' : 'Pending' }}
              </span>
            </td>
            <td>
              <small class="text-muted">
                {{ $review->created_at->format('M d, Y') }}
                <br>
                {{ $review->created_at->format('H:i') }}
              </small>
            </td>
            <td>
              <div class="btn-group gap-2" role="group">
                <button type="button" class="btn btn-sm btn-outline-info view-details-btn"
                  data-customer="{{ $review->customer_name }}"
                  data-email="{{ $review->customer_email }}"
                  data-rating="{{ $review->rating }}"
                  data-comment="{{ $review->comment }}"
                  data-date="{{ $review->created_at->format('M d, Y H:i') }}"
                  data-status="{{ $review->is_approved ? 'Approved' : 'Pending' }}"
                  title="View Details">
                  <i class="fas fa-eye"></i>
                </button>
                <form action="{{ route('admin.reviews.approve', $review) }}" method="POST" class="d-inline">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="btn btn-sm btn-outline-{{ $review->is_approved ? 'warning' : 'success' }}"
                    title="{{ $review->is_approved ? 'Unapprove' : 'Approve' }}">
                    <i class="fas fa-{{ $review->is_approved ? 'times' : 'check' }}"></i>
                  </button>
                </form>
                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger"
                    onclick="return confirm('Are you sure you want to delete this review?')"
                    title="Delete">
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
  </div>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
  <div class="pagination-wrapper">
    {{ $reviews->links('pagination.admin') }}
  </div>
</div>
@else
<div class="card">
  <div class="card-body text-center py-5">
    <i class="fas fa-star fa-5x text-muted mb-4"></i>
    <h4 class="text-muted">No Reviews Found</h4>
    <p class="text-muted mb-4">Customer reviews will appear here once they start submitting feedback.</p>
    <a href="{{ route('reviews') }}" class="btn btn-primary" target="_blank">
      <i class="fas fa-external-link-alt me-2"></i>View Review Page
    </a>
  </div>
</div>
@endif

<!-- Review Details Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Review Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="review-details">
          <div class="row">
            <div class="col-md-6">
              <h6>Customer Information</h6>
              <table class="table table-borderless table-sm">
                <tr>
                  <td class="fw-bold">Name:</td>
                  <td id="modal-customer-name"></td>
                </tr>
                <tr>
                  <td class="fw-bold">Email:</td>
                  <td id="modal-customer-email"></td>
                </tr>
                <tr>
                  <td class="fw-bold">Date:</td>
                  <td id="modal-date"></td>
                </tr>
              </table>
            </div>
            <div class="col-md-6">
              <h6>Review Information</h6>
              <table class="table table-borderless table-sm">
                <tr>
                  <td class="fw-bold">Rating:</td>
                  <td>
                    <div id="modal-rating" class="text-warning"></div>
                  </td>
                </tr>
                <tr>
                  <td class="fw-bold">Status:</td>
                  <td>
                    <span id="modal-status" class="badge"></span>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="mt-3">
            <h6>Full Comment</h6>
            <div class="border p-3 rounded bg-light">
              <p id="modal-comment" class="mb-0"></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  // Add click event to show full review content
  document.addEventListener('DOMContentLoaded', function() {
    // Handle view details button clicks
    const viewDetailsButtons = document.querySelectorAll('.view-details-btn');
    viewDetailsButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();

        // Get data from button attributes
        const customerName = this.getAttribute('data-customer');
        const customerEmail = this.getAttribute('data-email');
        const rating = this.getAttribute('data-rating');
        const comment = this.getAttribute('data-comment');
        const date = this.getAttribute('data-date');
        const status = this.getAttribute('data-status');

        // Populate modal with data
        document.getElementById('modal-customer-name').textContent = customerName;
        document.getElementById('modal-customer-email').textContent = customerEmail;
        document.getElementById('modal-date').textContent = date;
        document.getElementById('modal-comment').textContent = comment;

        // Set rating stars
        const ratingContainer = document.getElementById('modal-rating');
        let starsHtml = '';
        for (let i = 1; i <= 5; i++) {
          starsHtml += `<i class="fas fa-star${i <= rating ? '' : '-o'}"></i> `;
        }
        starsHtml += `<small class="text-muted">(${rating}/5)</small>`;
        ratingContainer.innerHTML = starsHtml;

        // Set status badge
        const statusBadge = document.getElementById('modal-status');
        statusBadge.textContent = status;
        statusBadge.className = `badge bg-${status === 'Approved' ? 'success' : 'warning'}`;

        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('reviewModal'));
        modal.show();
      });
    });

    // Remove old row click event since we now have specific buttons
    const rows = document.querySelectorAll('tbody tr');
    rows.forEach(row => {
      // Remove click handler to prevent conflicts with new button
      row.style.cursor = 'default';
    });
  });
</script>
@endpush