@extends('layouts.master')

@section('title', 'Home - Car Rents')

@section('content')
<style>
    /* Full-width carousel with fixed height */
    #carCarousel {
        width: 100%;
        max-height: 600px;
        overflow: hidden;
    }
    #carCarousel .carousel-inner {
        height: 600px;
    }
    #carCarousel .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    
    /* Feature cards */
    .feature-card {
        transition: transform 0.3s;
        height: 100%;
    }
    .feature-card:hover {
        transform: translateY(-10px);
    }
    
    /* Testimonials */
    .testimonial-card {
        background-color: #f8f9fa;
        border-radius: 10px;
    }
    
    /* Popular cars section */
    .car-card {
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s;
    }
    .car-card:hover {
        transform: scale(1.03);
    }
    
    /* Call to action */
    .cta-section {
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset("carPic2.jpg") }}');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 80px 0;
        margin: 60px 0;
    }
</style>

<!-- Full-width carousel without controls -->
<div class="container-fluid px-0">
    <div id="carCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('carPic1.jpg') }}" class="d-block w-100" alt="Luxury Car">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('carPic2.jpg') }}" class="d-block w-100" alt="Family Car">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('pexels-junnoet-235226.jpg') }}" class="d-block w-100" alt="Sports Car">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('pexels-mikebirdy-120049.jpg') }}" class="d-block w-100" alt="City Car">
            </div>
        </div>
    </div>
</div>

<!-- Welcome section -->
<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <h2 class="display-4 mb-4">Welcome to <span class="text-primary">Car Rents</span></h2>
            <p class="lead mb-4">
                Your premier destination for hassle-free car rentals. We offer a wide range of vehicles to suit every need and budget.
            </p>
            <p>
                Whether you're looking for a compact car for city driving, a spacious SUV for family trips, or a luxury vehicle for special occasions, we have the perfect ride for you. Our fleet is meticulously maintained and regularly updated to ensure your safety and comfort.
            </p>
            <a href="/Rentalcars" class="btn btn-primary btn-lg mt-3">Explore Our Fleet</a>
        </div>
        <div class="col-lg-6">
            <img src="{{ asset('pexels-mikebirdy-120049.jpg') }}" class="img-fluid rounded shadow" alt="Happy customer">
        </div>
    </div>
</div>

<!-- Features section -->
<div class="container py-5 bg-light">
    <div class="text-center mb-5">
        <h2>Why Choose Us</h2>
        <p class="lead">We provide the best car rental experience</p>
    </div>
    
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card feature-card shadow-sm p-4 text-center">
                <i class="fas fa-tag fa-3x mb-3 text-primary"></i>
                <h4>Best Prices</h4>
                <p>Competitive rates with no hidden fees. Price match guarantee on all bookings.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card feature-card shadow-sm p-4 text-center">
                <i class="fas fa-car fa-3x mb-3 text-primary"></i>
                <h4>Wide Selection</h4>
                <p>Over 100 vehicles to choose from, ranging from economy to luxury class.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card feature-card shadow-sm p-4 text-center">
                <i class="fas fa-shield-alt fa-3x mb-3 text-primary"></i>
                <h4>Full Insurance</h4>
                <p>Comprehensive coverage included with every rental for your peace of mind.</p>
            </div>
        </div>
        <div class="row g-4 mt-2">
        <div class="col-md-4">
            <div class="card feature-card shadow-sm p-4 text-center">
                <i class="fas fa-clock fa-3x mb-3 text-primary"></i>
                <h4>24/7 Support</h4>
                <p>Round-the-clock assistance for all your rental needs and emergencies.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card feature-card shadow-sm p-4 text-center">
                <i class="fas fa-map-marker-alt fa-3x mb-3 text-primary"></i>
                <h4>Multiple Locations</h4>
                <p>Convenient pickup and drop-off points across major cities and airports.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card feature-card shadow-sm p-4 text-center">
                <i class="fas fa-bolt fa-3x mb-3 text-primary"></i>
                <h4>Quick Booking</h4>
                <p>Simple online reservation process with instant confirmation.</p>
            </div>
        </div>
    </div>
</div>


<!-- Testimonials section -->
<div class="container py-5 bg-light">
    <div class="text-center mb-5">
        <h2>What Our Customers Say</h2>
        <p class="lead">Hear from people who have experienced our service</p>
    </div>
    
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card testimonial-card p-4 h-100">
                <div class="d-flex align-items-center mb-3">
                    <img src="https://randomuser.me/api/portraits/women/32.jpg" class="rounded-circle me-3" width="60" alt="Customer">
                    <div>
                        <h5 class="mb-0">Abdullah Aftab</h5>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <p>"The booking process was incredibly easy and the car was in perfect condition when I picked it up. Will definitely use Car Rents again!"</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card testimonial-card p-4 h-100">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('shahid.jpg') }}" class="rounded-circle me-3" width="60" alt="Customer">
                    <div>
                        <h5 class="mb-0">Shahid Mehmood</h5>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <p>"Great selection of vehicles at competitive prices. The staff was very helpful when I needed to extend my rental period."</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card testimonial-card p-4 h-100">
                <div class="d-flex align-items-center mb-3">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" class="rounded-circle me-3" width="60" alt="Customer">
                    <div>
                        <h5 class="mb-0">Maryam Nawaz</h5>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <p>"Perfect experience from start to finish. The car was clean, fuel-efficient, and exactly what I needed for my road trip."</p>
            </div>
        </div>
    </div>
</div>

<!-- Call to action section -->
<div class="container-fluid cta-section">
    <div class="container text-center">
        <h2 class="display-5 mb-4">Ready for Your Next Adventure?</h2>
        <p class="lead mb-5">Book your perfect car today and enjoy special online discounts</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="/Rentalcars" class="btn btn-primary btn-lg px-4">Book Now</a>
            <a href="/contact" class="btn btn-outline-light btn-lg px-4">Contact Us</a>
        </div>
    </div>
</div>


@endsection