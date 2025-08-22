@extends('layouts.master')

@section('title', $blog->title)

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
    
    .blog-hero {
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
    
    .blog-hero::before {
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
    
    .blog-content {
    font-family: 'Merriweather', 'Georgia', serif; /* Elegant and highly readable for blogs */
    line-height: 1.8; /* Good spacing for readability */
    font-size: 1.125rem; /* Slightly larger for easier reading (~18px) */
    color: #333; /* Dark gray is easier on the eyes than pure black */
}

    
    .blog-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 20px 0;
    }
    
    .featured-img {
        border-radius: 15px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        margin-bottom: 30px;
    }
    
    .featured-img:hover {
        transform: scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }
    
    .btn-back {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 600;
        letter-spacing: 1px;
        border: none;
        transition: all 0.4s ease;
        box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4);
    }
    
    .btn-back:hover {
        background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(67, 97, 238, 0.6);
    }
    
    .meta-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        margin-bottom: 30px;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
    }
    
    .meta-item i {
        margin-right: 10px;
        color: var(--primary-color);
    }

    .blog-content pre {
    white-space: pre-wrap;      
    word-wrap: break-word;      
    overflow-wrap: break-word;  
    width: 100%;               
    max-width: 100%;          
    overflow-x: hidden;        
}

iframe {
    width: 100%;
    height: 450px;  /* You can adjust this height */
    border: none;
    border-radius: 8px; /* Rounded corners for modern look */
    box-shadow: 0 4px 12px rgba(0,0,0,0.1); /* Soft shadow for depth */
}
</style>
@endsection

@section('content')
<section class="blog-hero text-center">
    <div class="container">
        <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown">{{ $blog->title }}</h1>
        <p class="lead fs-4 animate__animated animate__fadeInUp animate__delay-1s">Written by {{ $blog->written_by }}</p>
    </div>
</section>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            @if($blog->main_pic)
            <img src="{{ asset('storage/' . $blog->main_pic) }}" class="img-fluid featured-img animate__animated animate__fadeIn" alt="{{ $blog->title }}">
            @endif
            
            <div class="meta-info animate__animated animate__fadeIn animate__delay-1s">
                <div class="meta-item">
                    <i class="fas fa-calendar"></i>
                    <span>Published: {{ $blog->created_at->format('F j, Y') }}</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-clock"></i>
                    <span>Updated: {{ $blog->updated_at->diffForHumans() }}</span>
                </div>
            </div>
            
            <div class="blog-content animate__animated animate__fadeIn animate__delay-2s">
                <pre>{!! $blog->content !!}</pre>
            </div>
            
            <div class="text-center mt-5 animate__animated animate__fadeIn animate__delay-3s">
                <a href="{{ route('blogPage.index_2') }}" class="btn btn-back">
                    <i class="fas fa-arrow-left me-2"></i> Back to Blogs
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Smooth scroll animations
    $('a[href^="#"]').on('click', function(event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $($(this).attr('href')).offset().top - 100
        }, 800);
    });
});
</script>
@endsection