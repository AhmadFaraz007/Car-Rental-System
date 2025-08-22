@extends('layouts.master')

@section('title', 'About Us - Car Rents')

@section('styles')
<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --accent-color: #4cc9f0;
        --light-color: #f8f9fa;
        --dark-color: #212529;
    }
    
    .about-hero {
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.9), rgba(63, 55, 201, 0.9)), 
                    url('https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: white;
        padding: 120px 0;
        margin-bottom: 80px;
        position: relative;
        overflow: hidden;
    }
    
    .about-hero::before {
        content: '';
        position: absolute;
        bottom: -50px;
        left: 0;
        width: 100%;
        height: 100px;
        background: white;
        transform: skewY(-3deg);
        z-index: 1;
    }
    
    .section-title {
        position: relative;
        margin-bottom: 40px;
        padding-bottom: 15px;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: var(--primary-color);
        border-radius: 2px;
    }
    
    .service-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        margin-bottom: 30px;
        overflow: hidden;
        background: white;
        height: 100%;
    }
    
    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }
    
    .service-icon {
        font-size: 3rem;
        color: var(--primary-color);
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    
    .service-card:hover .service-icon {
        transform: scale(1.1);
        color: var(--accent-color);
    }
    
    .story-section {
        background-color: #f8f9fa;
        padding: 80px 0;
        position: relative;
    }
    
    .story-img {
        border-radius: 15px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    
    .story-img:hover {
        transform: scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }
    
    .team-member {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .team-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    
    .team-img:hover {
        transform: scale(1.05);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }
    
    .floating {
        animation: floating 3s ease-in-out infinite;
    }
    
    @keyframes floating {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }
    
    .feature-icon {
        width: 60px;
        height: 60px;
        background: var(--primary-color);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')
<section class="about-hero text-center">
    <div class="container">
        <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown">About Car Rents</h1>
        <p class="lead fs-4 animate__animated animate__fadeInUp animate__delay-1s">Your trusted partner for all vehicle rental needs</p>
    </div>
</section>

<!-- Services Section -->
<section class="container mb-5 py-5">
    <div class="text-center mb-5">
        <h2 class="section-title animate__animated animate__fadeIn">Our Services</h2>
        <p class="lead animate__animated animate__fadeIn animate__delay-1s">Discover the range of services we offer to make your journey easier</p>
    </div>
    
    <div class="row g-4">
        <div class="col-md-4 animate__animated animate__fadeInUp">
            <div class="service-card">
                <div class="card-body text-center p-4">
                    <div class="service-icon floating">
                        <i class="fas fa-car"></i>
                    </div>
                    <h3 class="h4 mb-3">Car Rentals</h3>
                    <p>We offer a wide selection of vehicles for all your rental needs. From economy cars to luxury vehicles, we have options for every budget and preference.</p>
                    <ul class="text-start mt-3">
                        <li>Daily, weekly, and monthly rentals</li>
                        <li>24/7 roadside assistance</li>
                        <li>Flexible pickup/drop-off locations</li>
                        <li>Competitive pricing</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-1s">
            <div class="service-card">
                <div class="card-body text-center p-4">
                    <div class="service-icon floating">
                        <i class="fas fa-blog"></i>
                    </div>
                    <h3 class="h4 mb-3">Car Blog</h3>
                    <p>Our expert team provides valuable insights through our car blog, covering maintenance tips, industry news, and vehicle reviews.</p>
                    <ul class="text-start mt-3">
                        <li>Latest automotive trends</li>
                        <li>Maintenance guides</li>
                        <li>Vehicle comparisons</li>
                        <li>Driving tips</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-2s">
            <div class="service-card">
                <div class="card-body text-center p-4">
                    <div class="service-icon floating">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <h3 class="h4 mb-3">Coming Soon</h3>
                    <p>We're constantly innovating to bring you new services that enhance your car rental experience.</p>
                    <ul class="text-start mt-3">
                        <li>Subscription-based rentals</li>
                        <li>Car sharing platform</li>
                        <li>Premium concierge service</li>
                        <li>Electric vehicle fleet</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Story Section -->
<section class="story-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title animate__animated animate__fadeIn">Our Story</h2>
            <p class="lead animate__animated animate__fadeIn animate__delay-1s">How Car Rents came to be</p>
        </div>
        
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0 animate__animated animate__fadeInLeft">
                <img src="{{ asset('ChatGPT Image Jun 7, 2025, 02_46_34 PM.png') }}" 
                     alt="Founder working on Car Rents" 
                     class="img-fluid story-img">
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <div class="ps-lg-5">
                    <h3 class="mb-4">From Idea to Reality</h3>
                    <p>Hello, I'm <strong>Taha Shahzad</strong>, the founder of Car Rents. The idea for this business came to me during my university days when I struggled to find affordable and reliable car rental options for weekend trips with friends.</p>
                    <p>Frustrated with the existing options that were either too expensive or had hidden fees, I envisioned a platform that would offer transparent pricing, quality vehicles, and exceptional customer service.</p>
                    <p>What started as a small project with just two cars has now grown into a trusted rental service with a diverse fleet. Our mission is to make car rental simple, affordable, and stress-free for everyone.</p>
                    <div class="d-flex align-items-center mt-4">
                        <div class="feature-icon me-4">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <p class="mb-0 fst-italic">"Innovation is at our core - we're constantly looking for ways to improve the car rental experience for our customers."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="container my-5 py-5">
    <div class="text-center mb-5">
        <h2 class="section-title animate__animated animate__fadeIn">Meet Our Team</h2>
        <p class="lead animate__animated animate__fadeIn animate__delay-1s">The people behind Car Rents</p>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-4 animate__animated animate__fadeInUp">
            <div class="team-member">
                <img src="{{ asset('WhatsApp Image 2025-01-17 at 1.38.08 AM.jpeg') }}" alt="Taha Shahzad" class="team-img">
                <h3>Taha Shahzad</h3>
                <p class="text-muted">Founder & CEO</p>
                <p>The visionary behind Car Rents, Taha oversees all operations and strategic direction.</p>
            </div>
        </div>
        
        <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-1s">
            <div class="team-member">
                <img src="{{ asset('umair.jpg') }}" alt="umair" class="team-img">
                <h3>Umair Farooq</h3>
                <p class="text-muted">Operations Manager</p>
                <p>Ensures our fleet is well-maintained and our customers receive top-notch service.</p>
            </div>
        </div>
        
        <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-2s">
            <div class="team-member">
                <img src="{{ asset('masier.jpg') }}" alt="shahryar" class="team-img">
                <h3>Shahryar Altaf</h3>
                <p class="text-muted">Customer Experience</p>
                <p>Dedicated to making every rental experience smooth and enjoyable for our customers.</p>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title animate__animated animate__fadeIn">Our Values</h2>
            <p class="lead animate__animated animate__fadeIn animate__delay-1s">What drives us every day</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4 animate__animated animate__fadeInUp">
                <div class="text-center p-4">
                    <div class="feature-icon mx-auto">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <h3 class="h4 mb-3">Customer First</h3>
                    <p>We prioritize our customers' needs above all else, ensuring every interaction is positive and every rental experience is seamless.</p>
                </div>
            </div>
            
            <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-1s">
                <div class="text-center p-4">
                    <div class="feature-icon mx-auto">
                        <i class="fas fa-car-side"></i>
                    </div>
                    <h3 class="h4 mb-3">Quality Fleet</h3>
                    <p>We maintain our vehicles to the highest standards, so you can drive with confidence knowing your rental is reliable and safe.</p>
                </div>
            </div>
            
            <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-2s">
                <div class="text-center p-4">
                    <div class="feature-icon mx-auto">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="h4 mb-3">Innovation</h3>
                    <p>We're constantly exploring new ways to improve our services and incorporate the latest technologies to enhance your experience.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Animate elements when they come into view
    function animateOnScroll() {
        $('.animate__animated').each(function() {
            var position = $(this).offset().top;
            var scroll = $(window).scrollTop() + $(window).height();
            
            if (scroll > position + 100) {
                $(this).addClass($(this).attr('class').split(' ')[1]);
            }
        });
    }
    
    // Run on page load
    animateOnScroll();
    
    // Run on scroll
    $(window).scroll(function() {
        animateOnScroll();
    });
});
</script>
@endsection