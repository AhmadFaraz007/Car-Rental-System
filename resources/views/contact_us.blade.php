@extends('layouts.master')

@section('title', 'Contact Us')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --accent-color: #4cc9f0;
        --light-color: #f8f9fa;
        --dark-color: #212529;
    }
    
    .contact-hero {
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.9), rgba(63, 55, 201, 0.9)), 
                    url('https://images.unsplash.com/photo-1483721310020-03333e577078?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: white;
        padding: 120px 0;
        margin-bottom: 80px;
        position: relative;
        overflow: hidden;
    }
    
    .contact-hero::before {
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
    
    .contact-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        margin-bottom: 30px;
        overflow: hidden;
        background: white;
        position: relative;
        z-index: 2;
    }
    
    .contact-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: var(--primary-color);
        transition: all 0.3s ease;
    }
    
    .contact-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }
    
    .contact-card:hover::before {
        height: 10px;
        background: var(--accent-color);
    }
    
    .contact-icon {
        font-size: 3rem;
        color: var(--primary-color);
        margin-bottom: 25px;
        transition: all 0.3s ease;
    }
    
    .contact-card:hover .contact-icon {
        transform: scale(1.1);
        color: var(--accent-color);
    }
    
    .contact-form-wrapper {
        background: white;
        padding: 50px;
        border-radius: 15px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }
    
    .contact-form-wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 10px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    }
    
    .form-control {
        padding: 15px 20px;
        border-radius: 10px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
        font-size: 1rem;
    }
    
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
    }
    
    .btn-submit {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 15px 40px;
        border-radius: 50px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        border: none;
        transition: all 0.4s ease;
        box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4);
    }
    
    .btn-submit:hover {
        background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(67, 97, 238, 0.6);
    }
    
    .btn-submit:active {
        transform: translateY(1px);
    }
    
    .map-container {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        transform: translateY(50px);
        opacity: 0;
        transition: all 0.8s ease;
    }
    
    .map-container.animated {
        transform: translateY(0);
        opacity: 1;
    }
    
    .floating {
        animation: floating 3s ease-in-out infinite;
    }
    
    @keyframes floating {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }
    
    .pulse {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(67, 97, 238, 0.7); }
        70% { box-shadow: 0 0 0 15px rgba(67, 97, 238, 0); }
        100% { box-shadow: 0 0 0 0 rgba(67, 97, 238, 0); }
    }
    
    .social-links {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }
    
    .social-links a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--light-color);
        color: var(--primary-color);
        margin: 0 10px;
        font-size: 1.5rem;
        transition: all 0.3s ease;
    }
    
    .social-links a:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-5px);
    }
</style>
@endsection

@section('content')
<section class="contact-hero text-center">
    <div class="container">
        <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown">Connect With Us Today</h1>
        <p class="lead fs-4 animate__animated animate__fadeInUp animate__delay-1s">Have questions about renting or listing your car? Our team is ready to assist you.</p>
        <div class="animate__animated animate__fadeIn animate__delay-2s mt-5">
            <a href="#contact-form" class="btn btn-light btn-lg rounded-pill px-4 py-2 pulse">
                <i class="fas fa-paper-plane me-2"></i> Send Us a Message
            </a>
        </div>
    </div>
</section>

<div class="container mb-5 pt-4">
    <div class="row g-4 justify-content-center">
        <!-- Contact Information Cards -->
        <div class="col-md-4">
            <div class="contact-card h-100 animate__animated animate__fadeInLeft animate__delay-1s">
                <div class="card-body text-center p-5">
                    <div class="contact-icon floating">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h3 class="h4 mb-4 fw-bold">Call Us</h3>
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <i class="fas fa-headset me-3 text-primary"></i>
                        <div>
                            <p class="mb-1 small text-muted">Customer Service</p>
                            <h5 class="mb-0">+92 311 6146976</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-briefcase me-3 text-primary"></i>
                        <div>
                            <p class="mb-1 small text-muted">Business Inquiries</p>
                            <h5 class="mb-0">+92 327 6336279</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="contact-card h-100 animate__animated animate__fadeInUp animate__delay-2s">
                <div class="card-body text-center p-5">
                    <div class="contact-icon floating">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3 class="h4 mb-4 fw-bold">Email Us</h3>
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <i class="fas fa-envelope me-3 text-primary"></i>
                        <div>
                            <p class="mb-1 small text-muted">General Inquiries</p>
                            <h5 class="mb-0">info@carrentals.com</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-life-ring me-3 text-primary"></i>
                        <div>
                            <p class="mb-1 small text-muted">Support</p>
                            <h5 class="mb-0">support@carrentals.com</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="contact-card h-100 animate__animated animate__fadeInRight animate__delay-3s">
                <div class="card-body text-center p-5">
                    <div class="contact-icon floating">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3 class="h4 mb-4 fw-bold">Visit Us</h3>
                    <div class="d-flex align-items-start justify-content-center mb-4">
                        <i class="fas fa-building me-3 mt-1 text-primary"></i>
                        <div>
                            <p class="mb-1">Comsats University</p>
                            <p class="mb-1">Room No 05</p>
                            <p class="mb-0">Vehari, Pakistan</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-clock me-3 text-primary"></i>
                        <div>
                            <p class="mb-1 small text-muted">Working Hours</p>
                            <h5 class="mb-0">Mon-Fri, 9am-4pm</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5" id="contact-form">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="contact-form-wrapper animate__animated animate__fadeIn">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <h2 class="display-5 fw-bold mb-4">Get In Touch</h2>
                        <p class="lead mb-4">Have questions about our services or want to list your vehicle? Fill out the form and we'll get back to you within 24 hours.</p>
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                                <i class="fas fa-check text-primary"></i>
                            </div>
                            <p class="mb-0">24/7 Customer Support</p>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                                <i class="fas fa-check text-primary"></i>
                            </div>
                            <p class="mb-0">No spam guaranteed</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                                <i class="fas fa-check text-primary"></i>
                            </div>
                            <p class="mb-0">Quick response time</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        <form action="{{ route('message.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <label for="sender_name" class="form-label fw-bold">Your Name *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-primary"></i></span>
                                    <input type="text" class="form-control border-start-0" id="sender_name" name="sender_name" placeholder="John Doe" required>
                                </div>
                                @error('sender_name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="sender_contact" class="form-label fw-bold">Phone Number *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-phone text-primary"></i></span>
                                    <input type="tel" class="form-control border-start-0" id="sender_contact" name="sender_contact" placeholder="+92 123 4567890" required>
                                </div>
                                @error('sender_contact')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="sender_gmail" class="form-label fw-bold">Email Address *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-primary"></i></span>
                                    <input type="email" class="form-control border-start-0" id="sender_gmail" name="sender_gmail" placeholder="your@email.com" required>
                                </div>
                                @error('sender_gmail')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="message" class="form-label fw-bold">Your Message *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 align-items-start pt-2"><i class="fas fa-comment text-primary"></i></span>
                                    <textarea class="form-control border-start-0" id="message" name="message" rows="4" placeholder="How can we help you?" required></textarea>
                                </div>
                                @error('message')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-submit btn-lg w-100">
                                    <i class="fas fa-paper-plane me-2"></i> Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Map Section -->
<div class="container-fluid p-0 mb-5">
    <div class="ratio ratio-21x9" style="min-height: 500px;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3436.963547456316!2d72.67168231513195!3d30.5033269817069!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3922b3a7d61c9b6d%3A0x4c7a7d1b3e3b3b3e!2sCOMSATS%20University%20Vehari%20Campus!5e0!3m2!1sen!2s!4v1620000000000!5m2!1sen!2s" 
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</div>


<!-- Social Links -->
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <h3 class="h4 mb-4">Follow Us On Social Media</h3>
            <div class="social-links">
                <a href="#" class="animate__animated animate__fadeIn animate__delay-1s"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="animate__animated animate__fadeIn animate__delay-2s"><i class="fab fa-twitter"></i></a>
                <a href="#" class="animate__animated animate__fadeIn animate__delay-3s"><i class="fab fa-instagram"></i></a>
                <a href="https://www.linkedin.com/in/taaha-shahzad-211968252/" target="_blank" rel="noopener noreferrer" class="animate__animated animate__fadeIn animate__delay-4s"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="animate__animated animate__fadeIn animate__delay-5s"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Animate map container when in view
    function animateMap() {
        var mapPosition = $('#map-container').offset().top;
        var scrollPosition = $(window).scrollTop() + $(window).height();
        
        if (scrollPosition > mapPosition + 100) {
            $('#map-container').addClass('animated floating pulse');
        }
    }
    
    // Run on page load
    animateMap();
    
    // Run on scroll
    $(window).scroll(function() {
        animateMap();
    });
    
    // Form submission feedback
    $('form').submit(function() {
        $('.btn-submit').html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Sending...');
    });
    
    // Smooth scroll to contact form
    $('a[href^="#"]').on('click', function(event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $($(this).attr('href')).offset().top - 100
        }, 800);
    });
});

</script>
@endsection