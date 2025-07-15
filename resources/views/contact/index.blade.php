@extends('layouts.app')

@section('title', 'Contact Us - Cafe Restaurant')

@section('content')
<!-- Contact Header -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center">
      <h1 class="display-4 fw-bold">Contact Us</h1>
      <p class="lead text-muted">Get in touch with us for reservations, inquiries, or feedback</p>
    </div>
  </div>
</section>

<!-- Contact Form & Info -->
<section class="py-5">
  <div class="container">
    <div class="row">
      <!-- Contact Form -->
      <div class="col-lg-8 mb-5">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-envelope me-2"></i>Send us a Message</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('contact.store') }}" method="POST">
              @csrf
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="name" class="form-label">Your Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name" name="name" value="{{ old('name') }}" required>
                  @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label for="email" class="form-label">Your Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror"
                    id="email" name="email" value="{{ old('email') }}" required>
                  @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="phone" class="form-label">Phone Number (Optional)</label>
                  <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                    id="phone" name="phone" value="{{ old('phone') }}">
                  @error('phone')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label for="subject" class="form-label">Subject</label>
                  <select class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" required>
                    <option value="">Select a subject</option>
                    <option value="Reservation" {{ old('subject') == 'Reservation' ? 'selected' : '' }}>Reservation</option>
                    <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                    <option value="Feedback" {{ old('subject') == 'Feedback' ? 'selected' : '' }}>Feedback</option>
                    <option value="Complaint" {{ old('subject') == 'Complaint' ? 'selected' : '' }}>Complaint</option>
                    <option value="Catering" {{ old('subject') == 'Catering' ? 'selected' : '' }}>Catering</option>
                    <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                  </select>
                  @error('subject')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control @error('message') is-invalid @enderror"
                  id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
                @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
            </form>
          </div>
        </div>
      </div>

      <!-- Contact Information -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Contact Information</h5>
          </div>
          <div class="card-body">
            <div class="mb-4">
              <h6><i class="fas fa-map-marker-alt text-primary me-2"></i>Address</h6>
              <p class="text-muted">123 Restaurant Street<br>Downtown District<br>City, State 12345</p>
            </div>

            <div class="mb-4">
              <h6><i class="fas fa-phone text-primary me-2"></i>Phone</h6>
              <p class="text-muted">+1 (234) 567-8900</p>
            </div>

            <div class="mb-4">
              <h6><i class="fas fa-envelope text-primary me-2"></i>Email</h6>
              <p class="text-muted">info@caferestaurant.com</p>
            </div>

            <div class="mb-4">
              <h6><i class="fas fa-clock text-primary me-2"></i>Opening Hours</h6>
              <p class="text-muted mb-1"><strong>Monday - Friday:</strong><br>8:00 AM - 10:00 PM</p>
              <p class="text-muted"><strong>Saturday - Sunday:</strong><br>9:00 AM - 11:00 PM</p>
            </div>
          </div>
        </div>

        <!-- Social Media -->
        <div class="card mt-4">
          <div class="card-header bg-secondary text-white">
            <h5 class="mb-0"><i class="fas fa-share-alt me-2"></i>Follow Us</h5>
          </div>
          <div class="card-body text-center">
            <a href="#" class="btn btn-outline-primary me-2 mb-2">
              <i class="fab fa-facebook-f"></i> Facebook
            </a>
            <a href="#" class="btn btn-outline-info me-2 mb-2">
              <i class="fab fa-twitter"></i> Twitter
            </a>
            <a href="#" class="btn btn-outline-danger me-2 mb-2">
              <i class="fab fa-instagram"></i> Instagram
            </a>
            <a href="#" class="btn btn-outline-dark mb-2">
              <i class="fab fa-tiktok"></i> TikTok
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Map Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="display-5 fw-bold">Find Us</h2>
      <p class="lead text-muted">Visit our restaurant for an unforgettable dining experience</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card">
          <div class="card-body p-0">
            <!-- Placeholder for Google Maps -->
            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 400px;">
              <div class="text-center">
                <i class="fas fa-map-marked-alt fa-5x text-muted mb-3"></i>
                <h5 class="text-muted">Interactive Map</h5>
                <p class="text-muted">Google Maps integration would go here</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ Section -->
<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="display-5 fw-bold">Frequently Asked Questions</h2>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="accordion" id="faqAccordion">
          <div class="accordion-item">
            <h2 class="accordion-header" id="faq1">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                Do I need a reservation?
              </button>
            </h2>
            <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                While walk-ins are welcome, we highly recommend making a reservation, especially during peak hours and weekends, to ensure you get a table.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="faq2">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                Do you offer vegetarian/vegan options?
              </button>
            </h2>
            <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Yes! We have a variety of vegetarian and vegan options on our menu. Please let our staff know about any dietary restrictions when ordering.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="faq3">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                Do you provide catering services?
              </button>
            </h2>
            <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Yes, we offer catering services for special events, corporate meetings, and parties. Please contact us for more information and pricing.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="faq4">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
                Is parking available?
              </button>
            </h2>
            <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Yes, we have a dedicated parking lot with complimentary parking for our customers. Street parking is also available nearby.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection