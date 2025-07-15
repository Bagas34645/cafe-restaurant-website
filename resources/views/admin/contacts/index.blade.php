@extends('layouts.admin')

@section('title', 'Contact Messages - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h3">Contact Messages</h1>
  <div class="d-flex gap-2">
    <span class="badge bg-danger fs-6">{{ $contacts->where('is_read', false)->count() }} Unread</span>
    <span class="badge bg-success fs-6">{{ $contacts->where('is_read', true)->count() }} Read</span>
  </div>
</div>

@if($contacts->count() > 0)
<div class="card">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead class="table-dark">
          <tr>
            <th>Contact Info</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($contacts as $contact)
          <tr class="{{ !$contact->is_read ? 'table-info' : '' }}">
            <td>
              <div>
                <strong>{{ $contact->name }}</strong>
                @if(!$contact->is_read)
                <span class="badge bg-danger ms-1">New</span>
                @endif
                <br>
                <small class="text-muted">
                  <i class="fas fa-envelope me-1"></i>{{ $contact->email }}
                </small>
                @if($contact->phone)
                <br>
                <small class="text-muted">
                  <i class="fas fa-phone me-1"></i>{{ $contact->phone }}
                </small>
                @endif
              </div>
            </td>
            <td>
              <span class="badge bg-primary">{{ $contact->subject }}</span>
            </td>
            <td>
              <div class="text-break" style="max-width: 300px;">
                {{ Str::limit($contact->message, 100) }}
              </div>
            </td>
            <td>
              <span class="badge bg-{{ $contact->is_read ? 'success' : 'danger' }}">
                {{ $contact->is_read ? 'Read' : 'Unread' }}
              </span>
            </td>
            <td>
              <small class="text-muted">
                {{ $contact->created_at->format('M d, Y') }}
                <br>
                {{ $contact->created_at->format('H:i') }}
              </small>
            </td>
            <td>
              <div class="btn-group gap-2" role="group">
                <button type="button" class="btn btn-sm btn-outline-primary"
                  data-bs-toggle="modal"
                  data-bs-target="#contactModal"
                  data-contact-id="{{ $contact->id }}"
                  data-contact-name="{{ $contact->name }}"
                  data-contact-email="{{ $contact->email }}"
                  data-contact-phone="{{ $contact->phone }}"
                  data-contact-subject="{{ $contact->subject }}"
                  data-contact-message="{{ $contact->message }}"
                  data-contact-date="{{ $contact->created_at->format('M d, Y H:i') }}"
                  title="View Details">
                  <i class="fas fa-eye"></i>
                </button>
                <form action="{{ route('admin.contacts.mark-read', $contact) }}" method="POST" class="d-inline">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="btn btn-sm btn-outline-{{ $contact->is_read ? 'warning' : 'success' }}"
                    title="{{ $contact->is_read ? 'Mark as Unread' : 'Mark as Read' }}">
                    <i class="fas fa-{{ $contact->is_read ? 'envelope' : 'envelope-open' }}"></i>
                  </button>
                </form>
                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger"
                    onclick="return confirm('Are you sure you want to delete this message?')"
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
    {{ $contacts->links('pagination.admin') }}
  </div>
</div>
@else
<div class="card">
  <div class="card-body text-center py-5">
    <i class="fas fa-envelope fa-5x text-muted mb-4"></i>
    <h4 class="text-muted">No Messages Found</h4>
    <p class="text-muted mb-4">Customer messages will appear here when they contact you through the website.</p>
    <a href="{{ route('contact') }}" class="btn btn-primary" target="_blank">
      <i class="fas fa-external-link-alt me-2"></i>View Contact Page
    </a>
  </div>
</div>
@endif

<!-- Contact Details Modal -->
<div class="modal fade" id="contactModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Contact Message Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <h6>Contact Information</h6>
            <p><strong>Name:</strong> <span id="modal-name"></span></p>
            <p><strong>Email:</strong> <span id="modal-email"></span></p>
            <p><strong>Phone:</strong> <span id="modal-phone"></span></p>
            <p><strong>Subject:</strong> <span id="modal-subject" class="badge bg-primary"></span></p>
            <p><strong>Date:</strong> <span id="modal-date"></span></p>
          </div>
          <div class="col-md-6">
            <h6>Quick Actions</h6>
            <div class="d-grid gap-2">
              <a href="#" id="modal-email-link" class="btn btn-outline-primary">
                <i class="fas fa-reply me-2"></i>Reply via Email
              </a>
              <a href="#" id="modal-phone-link" class="btn btn-outline-success">
                <i class="fas fa-phone me-2"></i>Call Customer
              </a>
            </div>
          </div>
        </div>
        <hr>
        <h6>Message</h6>
        <div class="bg-light p-3 rounded">
          <p id="modal-message" class="mb-0"></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="mark-read-btn">Mark as Read</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  // Handle contact modal
  document.addEventListener('DOMContentLoaded', function() {
    const contactModal = document.getElementById('contactModal');

    contactModal.addEventListener('show.bs.modal', function(event) {
      const button = event.relatedTarget;

      // Extract data from button attributes
      const name = button.getAttribute('data-contact-name');
      const email = button.getAttribute('data-contact-email');
      const phone = button.getAttribute('data-contact-phone');
      const subject = button.getAttribute('data-contact-subject');
      const message = button.getAttribute('data-contact-message');
      const date = button.getAttribute('data-contact-date');

      // Update modal content
      document.getElementById('modal-name').textContent = name;
      document.getElementById('modal-email').textContent = email;
      document.getElementById('modal-phone').textContent = phone || 'Not provided';
      document.getElementById('modal-subject').textContent = subject;
      document.getElementById('modal-message').textContent = message;
      document.getElementById('modal-date').textContent = date;

      // Update action links
      document.getElementById('modal-email-link').href = `mailto:${email}?subject=Re: ${subject}`;
      if (phone) {
        document.getElementById('modal-phone-link').href = `tel:${phone}`;
        document.getElementById('modal-phone-link').style.display = 'block';
      } else {
        document.getElementById('modal-phone-link').style.display = 'none';
      }
    });
  });
</script>
@endpush