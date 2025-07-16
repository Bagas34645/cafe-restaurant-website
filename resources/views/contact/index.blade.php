@extends('layouts.app')

@section('title', 'Kontak - Rajane Duren')

@section('content')
<!-- Contact Header -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center">
      <h1 class="display-4 fw-bold">Hubungi Kami</h1>
      <p class="lead text-muted">Silakan hubungi kami untuk pemesanan, informasi, atau konsultasi durian</p>
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
            <h5 class="mb-0"><i class="fas fa-envelope me-2"></i>Kirim Pesan</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('contact.store') }}" method="POST">
              @csrf
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="name" class="form-label">Nama</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name" name="name" value="{{ old('name') }}" required>
                  @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror"
                    id="email" name="email" value="{{ old('email') }}" required>
                  @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="phone" class="form-label">Nomor telepon (Opsional)</label>
                  <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                    id="phone" name="phone" value="{{ old('phone') }}">
                  @error('phone')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label for="subject" class="form-label">Subjek</label>
                  <select class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" required>
                    <option value="">Pilih subjek</option>
                    <option value="Reservation" {{ old('subject') == 'Reservation' ? 'selected' : '' }}>Reservasi</option>
                    <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>Pertanyaan Umum</option>
                    <option value="Feedback" {{ old('subject') == 'Feedback' ? 'selected' : '' }}>Masukan</option>
                    <option value="Complaint" {{ old('subject') == 'Complaint' ? 'selected' : '' }}>Keluhan</option>
                    <option value="Catering" {{ old('subject') == 'Catering' ? 'selected' : '' }}>Katering</option>
                    <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Lainnya</option>
                  </select>
                  @error('subject')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="mb-3">
                <label for="message" class="form-label">Pesan</label>
                <textarea class="form-control @error('message') is-invalid @enderror"
                  id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
                @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <button type="submit" class="btn btn-primary btn-lg">Kirim Pesan</button>
            </form>
          </div>
        </div>
      </div>

      <!-- Contact Information -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Kontak</h5>
          </div>
          <div class="card-body">
            <div class="mb-4">
              <h6><i class="fas fa-map-marker-alt text-primary me-2"></i>Alamat</h6>
              <p class="text-muted">Kalikangkung Kulon, Kalikangkung, Pangkah,<br>Kabupaten Tegal, Jawa Tengah 52471</p>
            </div>

            <div class="mb-4">
              <h6><i class="fas fa-phone text-primary me-2"></i>Telepon</h6>
              <p class="text-muted">+62 812-3456-7890</p>
            </div>

            <div class="mb-4">
              <h6><i class="fas fa-envelope text-primary me-2"></i>Email</h6>
              <p class="text-muted">javatani00@gmail.com</p>
            </div>

            <div class="mb-4">
              <h6><i class="fab fa-instagram text-primary me-2"></i>Instagram</h6>
              <p class="text-muted">instagram.com/rajaneduren_/</p>
            </div>

            <div class="mb-4">
              <h6><i class="fas fa-clock text-primary me-2"></i>Jam Buka</h6>
              <p class="text-muted mb-1"><strong>Setiap Hari:</strong><br>08:00 - 22:00 WIB</p>
            </div>
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
      <h2 class="display-5 fw-bold">Lokasi Kami</h2>
      <p class="lead text-muted">Temukan lokasi kami dan rasakan langsung kelezatan durian</p>
      <a href="https://maps.google.com/?q=Sentra+Durian+Tegal,+Kalikangkung+Kulon,+Kalikangkung,+Pangkah,+Kabupaten+Tegal,+Jawa+Tengah+52471"
        target="_blank"
        class="btn btn-primary btn-lg">
        <i class="fas fa-map-marker-alt me-2"></i>Buka di Google Maps
      </a>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card">
          <div class="card-body p-0">
            <!-- Google Maps Integration -->
            <div class="ratio ratio-16x9" style="min-height: 400px;">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.5108766511858!2d109.1642667!3d-6.9489029!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fbf953faa2dcd%3A0x6956291070d3eec8!2sSentra%20Durian%20Tegal!5e0!3m2!1sen!2sid!4v1752595061543!5m2!1sen!2sid"
                width="100%"
                height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Lokasi Sentra Durian Tegal">
              </iframe>
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
      <h2 class="display-5 fw-bold">Pertanyaan yang Sering Diajukan</h2>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="accordion" id="faqAccordion">
          <div class="accordion-item">
            <h2 class="accordion-header" id="faq1">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                Apakah saya perlu membuat reservasi?
              </button>
            </h2>
            <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Meskipun pengunjung tanpa reservasi dapat diterima, kami sangat merekomendasikan untuk membuat reservasi terlebih dahulu, terutama pada jam sibuk dan akhir pekan, untuk memastikan Anda mendapatkan tempat.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="faq2">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                Apakah tersedia pilihan makanan vegetarian/vegan?
              </button>
            </h2>
            <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Ya! Kami menyediakan berbagai pilihan makanan vegetarian dan vegan di menu kami. Silakan beri tahu staf kami tentang pantangan makanan atau alergi ketika memesan.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="faq3">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                Apakah menyediakan layanan katering?
              </button>
            </h2>
            <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Ya, kami menyediakan layanan katering untuk acara khusus, pertemuan perusahaan, dan pesta. Silakan hubungi kami untuk informasi lebih lanjut dan harga.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="faq4">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
                Apakah tersedia tempat parkir?
              </button>
            </h2>
            <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Ya, kami memiliki area parkir khusus dengan parkir gratis untuk pelanggan kami. Parkir di pinggir jalan juga tersedia di sekitar lokasi.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="faq5">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5">
                Jenis durian apa saja yang tersedia?
              </button>
            </h2>
            <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Kami menyediakan berbagai jenis durian berkualitas tinggi seperti Monthong, Musang King, Bawor, dan durian lokal Tegal. Ketersediaan tergantung pada musim dan stok yang ada.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="faq6">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6">
                Bagaimana cara memilih durian yang baik?
              </button>
            </h2>
            <div id="collapse6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Tim ahli kami akan membantu Anda memilih durian terbaik berdasarkan tingkat kematangan, aroma, dan kualitas daging buah. Kami juga menyediakan layanan cek durian sebelum pembelian.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection