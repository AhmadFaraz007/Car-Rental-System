@extends('layouts.master')

@section('title', 'Frequently Asked Questions')

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
    
    .faq-hero {
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.9), rgba(63, 55, 201, 0.9));
        color: white;
        padding: 100px 0;
        margin-bottom: 60px;
        position: relative;
        overflow: hidden;
    }
    
    .faq-hero::before {
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
    
    .faq-container {
        max-width: 900px;
        margin: 0 auto;
    }
    
    .faq-item {
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
        overflow: hidden;
        background: white;
        transition: all 0.3s ease;
        border-left: 4px solid var(--primary-color);
    }
    
    .faq-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .faq-question {
        padding: 20px 25px;
        background-color: white;
        cursor: pointer;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: var(--dark-color);
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }
    
    .faq-question:hover {
        background-color: #f8f9fa;
        color: var(--primary-color);
    }
    
    .faq-question:after {
        content: '+';
        font-size: 24px;
        color: var(--primary-color);
        transition: all 0.3s ease;
    }
    
    .faq-question.active {
        background-color: #f8f9fa;
        color: var(--primary-color);
    }
    
    .faq-question.active:after {
        content: '-';
        color: var(--accent-color);
    }
    
    .faq-answer {
        padding: 0 25px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease-out;
        background-color: #f8f9fa;
    }
    
    .faq-answer.show {
        padding: 0 25px 25px 25px;
        max-height: 1000px;
    }
    
    .faq-answer p, .faq-answer ul, .faq-answer ol {
        margin-bottom: 15px;
        line-height: 1.6;
    }
    
    .faq-answer ul, .faq-answer ol {
        padding-left: 20px;
    }
    
    .faq-answer li {
        margin-bottom: 8px;
    }
    
    .search-container {
        max-width: 600px;
        margin: 0 auto 40px auto;
    }
    
    .search-box {
        position: relative;
    }
    
    .search-box input {
        padding: 15px 20px 15px 50px;
        border-radius: 50px;
        border: 2px solid #e9ecef;
        font-size: 1rem;
        width: 100%;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .search-box input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 5px 20px rgba(67, 97, 238, 0.1);
    }
    
    .search-box i {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--primary-color);
        font-size: 1.2rem;
    }
    
    .category-filter {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 40px;
    }
    
    .category-btn {
        padding: 8px 20px;
        border-radius: 50px;
        background: white;
        border: 2px solid #e9ecef;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .category-btn:hover, .category-btn.active {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease forwards;
    }
</style>
@endsection

@section('content')
<section class="faq-hero text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInDown">FAQs</h1>
        <p class="lead fs-4 animate__animated animate__fadeInUp animate__delay-1s">Find answers to common questions about our car rental services</p>
    </div>
</section>

<div class="container mb-5 pt-4">
    <div class="search-container animate__animated animate__fadeIn animate__delay-2s">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search FAQs...">
        </div>
    </div>
    
    <div class="category-filter animate__animated animate__fadeIn animate__delay-2s">
        <div class="category-btn active">All Questions</div>
        <div class="category-btn">Booking</div>
        <div class="category-btn">Payments</div>
        <div class="category-btn">Requirements</div>
        <div class="category-btn">Insurance</div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="faq-container">
                <div class="faq-item animate__animated animate__fadeInUp animate__delay-3s">
                    <div class="faq-question">1. What documents do I need to rent a car?</div>
                    <div class="faq-answer">
                        <p>To rent a car, you'll need:</p>
                        <ul>
                            <li>A valid driver's license (must be held for at least 1 year)</li>
                            <li>A credit card in the main driver's name</li>
                            <li>Proof of identity (passport or national ID)</li>
                            <li>For international renters, an International Driving Permit may be required</li>
                        </ul>
                    </div>
                </div>

                <div class="faq-item animate__animated animate__fadeInUp animate__delay-3s">
                    <div class="faq-question">2. What is the minimum age to rent a car?</div>
                    <div class="faq-answer">
                        <p>The minimum age to rent a car is 21 years. Drivers under 25 may be subject to a young driver surcharge. Some vehicle categories may have higher minimum age requirements.</p>
                    </div>
                </div>

                <div class="faq-item animate__animated animate__fadeInUp animate__delay-4s">
                    <div class="faq-question">3. Can I rent a car with a debit card?</div>
                    <div class="faq-answer">
                        <p>We generally require a credit card for rentals. Some locations may accept debit cards with additional verification and restrictions. Please contact us for specific details about your rental location.</p>
                    </div>
                </div>

                <div class="faq-item animate__animated animate__fadeInUp animate__delay-4s">
                    <div class="faq-question">4. What is included in the rental price?</div>
                    <div class="faq-answer">
                        <p>Our standard rental price includes:</p>
                        <ul>
                            <li>Unlimited mileage (unless otherwise specified)</li>
                            <li>Basic insurance coverage</li>
                            <li>24/7 roadside assistance</li>
                            <li>Vehicle registration fees</li>
                        </ul>
                        <p>Additional options like GPS, child seats, or additional insurance may incur extra charges.</p>
                    </div>
                </div>

                <div class="faq-item animate__animated animate__fadeInUp animate__delay-5s">
                    <div class="faq-question">5. Can I add an additional driver?</div>
                    <div class="faq-answer">
                        <p>Yes, you can add additional drivers for a small daily fee. All additional drivers must meet the same requirements as the main driver and present their documents at the time of rental.</p>
                    </div>
                </div>

                <div class="faq-item animate__animated animate__fadeInUp animate__delay-5s">
                    <div class="faq-question">6. What happens if I return the car late?</div>
                    <div class="faq-answer">
                        <p>We provide a 29-minute grace period. After that, late returns will be charged an additional day's rental fee. If you know you'll be late, please contact us as soon as possible to discuss options.</p>
                    </div>
                </div>

                <div class="faq-item animate__animated animate__fadeInUp">
                    <div class="faq-question">7. Can I take the rental car to another country?</div>
                    <div class="faq-answer">
                        <p>Cross-border travel may be permitted depending on the vehicle and destination country. Additional fees and documentation may apply. Please inform us at the time of booking if you plan to travel internationally.</p>
                    </div>
                </div>

                <div class="faq-item animate__animated animate__fadeInUp">
                    <div class="faq-question">8. What should I do if I have an accident?</div>
                    <div class="faq-answer">
                        <p>In case of an accident:</p>
                        <ol>
                            <li>Ensure everyone's safety and call emergency services if needed</li>
                            <li>Contact our 24/7 emergency line immediately</li>
                            <li>Exchange information with other parties involved</li>
                            <li>Take photos of the scene and damage</li>
                            <li>Obtain a police report if required by local law</li>
                        </ol>
                    </div>
                </div>

                <div class="faq-item animate__animated animate__fadeInUp">
                    <div class="faq-question">9. What is your fuel policy?</div>
                    <div class="faq-answer">
                        <p>Our standard fuel policy is "full-to-full":</p>
                        <ul>
                            <li>You receive the car with a full tank</li>
                            <li>You must return it with a full tank</li>
                            <li>If returned less than full, we'll refuel at a higher rate plus a service fee</li>
                        </ul>
                        <p>Other options may be available at certain locations.</p>
                    </div>
                </div>

                <div class="faq-item animate__animated animate__fadeInUp">
                    <div class="faq-question">10. Can I cancel or modify my reservation?</div>
                    <div class="faq-answer">
                        <p>Yes, you can cancel or modify your reservation free of charge up to 24 hours before your scheduled pickup time. Late cancellations may incur a fee depending on the rate plan you selected.</p>
                    </div>
                </div>

                <div class="faq-item animate__animated animate__fadeInUp">
                    <div class="faq-question">11. What types of insurance are available?</div>
                    <div class="faq-answer">
                        <p>We offer several insurance options:</p>
                        <ul>
                            <li>Basic Collision Damage Waiver (included)</li>
                            <li>Full Coverage (reduces liability to zero)</li>
                            <li>Personal Accident Insurance</li>
                            <li>Personal Effects Coverage</li>
                            <li>Roadside Protection Plan</li>
                        </ul>
                    </div>
                </div>

                <div class="faq-item animate__animated animate__fadeInUp">
                    <div class="faq-question">12. Can I rent a car one-way?</div>
                    <div class="faq-answer">
                        <p>Yes, one-way rentals are available between most locations. Additional one-way fees may apply depending on the distance between pickup and drop-off locations. Please check availability when making your reservation.</p>
                    </div>
                </div>

                <div class="faq-item animate__animated animate__fadeInUp">
                    <div class="faq-question">13. What happens if the car breaks down?</div>
                    <div class="faq-answer">
                        <p>All our vehicles come with 24/7 roadside assistance. If you experience mechanical issues:</p>
                        <ol>
                            <li>Pull over safely</li>
                            <li>Call our emergency assistance number</li>
                            <li>We'll arrange for repairs or a replacement vehicle if needed</li>
                        </ol>
                    </div>
                </div>

                <div class="faq-item animate__animated animate__fadeInUp">
                    <div class="faq-question">14. Are there any mileage restrictions?</div>
                    <div class="faq-answer">
                        <p>Most rentals include unlimited mileage. Some special offers or vehicle categories may have mileage restrictions, which will be clearly stated in your rental agreement.</p>
                    </div>
                </div>

                <div class="faq-item animate__animated animate__fadeInUp">
                    <div class="faq-question">15. How do I extend my rental period?</div>
                    <div class="faq-answer">
                        <p>To extend your rental:</p>
                        <ol>
                            <li>Contact us at least 24 hours before your scheduled return time</li>
                            <li>We'll check vehicle availability</li>
                            <li>If approved, we'll adjust your rental agreement</li>
                            <li>Payment for the additional time will be processed</li>
                        </ol>
                        <p>Extensions are subject to vehicle availability and cannot be guaranteed.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // FAQ accordion functionality
    $('.faq-question').click(function() {
        // Close all other answers
        $('.faq-question').not(this).removeClass('active');
        $('.faq-answer').not($(this).next()).removeClass('show');
        
        // Toggle current answer
        $(this).toggleClass('active');
        $(this).next('.faq-answer').toggleClass('show');
    });
    
    // Search functionality
    $('.search-box input').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('.faq-item').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    
    // Category filter
    $('.category-btn').click(function() {
        $('.category-btn').removeClass('active');
        $(this).addClass('active');
        // You would add actual filtering logic here
    });
    
    // Animate items on scroll
    function animateOnScroll() {
        $('.faq-item').each(function() {
            var position = $(this).offset().top;
            var scroll = $(window).scrollTop() + $(window).height();
            
            if (scroll > position + 100 && !$(this).hasClass('animate-fadeInUp')) {
                $(this).addClass('animate-fadeInUp');
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