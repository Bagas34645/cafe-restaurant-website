@extends('layouts.app')

@section('title', 'About Us - Cafe Restaurant')

@section('content')
<!-- About Hero Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h1 class="display-4 fw-bold">About Us</h1>
      <p class="lead text-muted">Discover our story, passion, and commitment to exceptional dining</p>
    </div>
  </div>
</section>

<!-- Our Story Section -->
<section class="py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h2 class="display-5 fw-bold mb-4">Our Story</h2>
        <p class="lead mb-4">Founded in 2010, Cafe Restaurant has been serving the community with passion, dedication, and exceptional culinary experiences for over a decade.</p>
        <p>What started as a small family business has grown into a beloved dining destination, known for our commitment to quality ingredients, innovative recipes, and warm hospitality. We believe that great food brings people together, and every dish we serve is crafted with love and attention to detail.</p>
        <p>Our team of experienced chefs combines traditional cooking techniques with modern creativity to create dishes that satisfy both the palate and the soul.</p>
      </div>
      <div class="col-lg-6">
        <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
          alt="Restaurant Interior" class="img-fluid rounded shadow">
      </div>
    </div>
  </div>
</section>

<!-- Our Mission Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto text-center">
        <h2 class="display-5 fw-bold mb-5">Our Mission</h2>
        <div class="row">
          <div class="col-md-4 mb-4">
            <div class="card border-0 h-100">
              <div class="card-body text-center">
                <i class="fas fa-heart fa-3x text-primary mb-3"></i>
                <h5 class="card-title">Quality</h5>
                <p class="card-text">We source only the finest ingredients and prepare every dish with meticulous attention to detail.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="card border-0 h-100">
              <div class="card-body text-center">
                <i class="fas fa-users fa-3x text-primary mb-3"></i>
                <h5 class="card-title">Service</h5>
                <p class="card-text">Our friendly staff is dedicated to providing exceptional service and creating memorable experiences.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="card border-0 h-100">
              <div class="card-body text-center">
                <i class="fas fa-leaf fa-3x text-primary mb-3"></i>
                <h5 class="card-title">Sustainability</h5>
                <p class="card-text">We're committed to sustainable practices and supporting local farmers and suppliers.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Chef's Section -->
<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="display-5 fw-bold">Meet Our Team</h2>
      <p class="lead text-muted">The talented professionals behind your dining experience</p>
    </div>

    <div class="row">
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-0 text-center">
          <img src="https://images.unsplash.com/photo-1577219491135-ce391730fb2c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
            alt="Head Chef" class="card-img-top rounded-circle mx-auto mt-3" style="width: 150px; height: 150px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">Chef Maria Rodriguez</h5>
            <p class="text-muted">Head Chef</p>
            <p class="card-text">With over 15 years of culinary experience, Chef Maria brings creativity and passion to every dish.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-0 text-center">
          <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
            alt="Sous Chef" class="card-img-top rounded-circle mx-auto mt-3" style="width: 150px; height: 150px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">Chef David Kim</h5>
            <p class="text-muted">Sous Chef</p>
            <p class="card-text">Specializing in fusion cuisine, Chef David combines traditional techniques with modern innovation.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-0 text-center">
          <img src="https://images.unsplash.com/photo-1594736797933-d0401ba49d81?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
            alt="Restaurant Manager" class="card-img-top rounded-circle mx-auto mt-3" style="width: 150px; height: 150px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">Sarah Johnson</h5>
            <p class="text-muted">Restaurant Manager</p>
            <p class="card-text">Sarah ensures every guest has an exceptional dining experience with her attention to detail and warm hospitality.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-primary text-white">
  <div class="container text-center">
    <h2 class="display-5 fw-bold mb-4">Experience Our Passion</h2>
    <p class="lead mb-4">Come and taste the difference that passion and quality make in every dish we serve.</p>
    <a href="{{ route('contact') }}" class="btn btn-light btn-lg me-3">Make a Reservation</a>
    <a href="{{ route('products') }}" class="btn btn-outline-light btn-lg">View Our Menu</a>
  </div>
</section>
@endsection