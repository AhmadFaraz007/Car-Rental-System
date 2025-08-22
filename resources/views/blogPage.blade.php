@extends('layouts.master')

@section('title', 'Our Blogs')

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
    
        .blog-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        margin-bottom: 30px;
        overflow: hidden;
        background: white;
        height: 100%;
        display: flex;
        flex-direction: column;
        /* Improved internal spacing */
        padding: 20px; /* Reset padding for container */
    }

    .blog-img-container {
        overflow: hidden;
        padding: 0; /* Image container has no padding */
    }

    .blog-content {
        padding: 1.5rem; /* 24px padding on all sides */
        flex: 1;
        display: flex;
        flex-direction: column;
        /* Add these for better text spacing */
        gap: 0.75rem; /* 12px gap between child elements */
    }

    .blog-title {
        margin-bottom: 0.5rem; /* 8px below title */
    }

    .blog-excerpt {
        margin-bottom: 1rem; /* 16px below excerpt */
    }

    .blog-meta {
        margin-bottom: 1rem; /* 16px below meta */
        padding: 0.5rem 0; /* 8px vertical padding */
    }

    .btn-read-more {
        margin-top: 0.75rem; /* 12px above button */
        align-self: flex-start; /* Keep button left-aligned */
    }
    
    .blog-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }
    
    .blog-img-container {
        overflow: hidden;
    }
    
    .blog-img {
        height: 220px;
        width: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .blog-card:hover .blog-img {
        transform: scale(1.03);
    }
    
    .blog-content {
        padding: 25px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .blog-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 12px;
        color: var(--dark-color);
        line-height: 1.4;
    }
    
    .blog-excerpt {
        color: #555;
        margin-bottom: 20px;
        line-height: 1.6;
        flex-grow: 1;
    }
    
    .blog-meta {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        font-size: 0.85rem;
    }
    
    .blog-author {
        display: flex;
        align-items: center;
        margin-right: 15px;
        color: var(--secondary-color);
    }
    
    .blog-date {
        display: flex;
        align-items: center;
        color: #777;
    }
    
    .blog-meta i {
        margin-right: 6px;
        font-size: 0.9rem;
    }
    
    .btn-read-more {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        border: none;
        transition: all 0.3s ease;
        align-self: flex-start;
        margin-top: auto;
    }
    
    .btn-read-more:hover {
        background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
    }
    
    .section-title {
        position: relative;
        margin-bottom: 40px;
        padding-bottom: 15px;
        text-align: center;
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
</style>
@endsection

@section('content')
<section class="blog-hero text-center">
    <div class="container">
        <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown">Our Blog</h1>
        <p class="lead fs-4 animate__animated animate__fadeInUp animate__delay-1s">Discover the latest insights and stories</p>
    </div>
</section>

<div class="container py-5">
    <h2 class="section-title animate__animated animate__fadeIn">Latest Articles</h2>
    
    <div class="row">
        @foreach($blogs as $blog)
        <div class="col-md-4 mb-4 animate__animated animate__fadeInUp" style="animation-delay: {{ $loop->index * 0.1 }}s">
            <div class="blog-card h-100">
                @if($blog->main_pic)
                <img src="{{ asset('storage/' . $blog->main_pic) }}" class="blog-img" alt="{{ $blog->title }}">
                @endif
                <br>
                <div class="card-body">
                    <h3 class="h4 mb-3">{{ $blog->title }}</h3>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-2">
                            <i class="fas fa-user text-primary"></i>
                        </div>
                        <span class="text-muted">{{ $blog->written_by }}</span>
                        <div class="bg-primary bg-opacity-10 p-2 rounded-circle mx-2">
                            <i class="fas fa-calendar text-primary"></i>
                        </div>
                        <span class="text-muted">{{ $blog->created_at->format('M d, Y') }}</span>
                    </div>
                    <p class="card-text">{{ Str::limit(strip_tags($blog->content), 100) }}</p>
                    <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-read-more">
                        <i class="fas fa-book-open me-2"></i> Read More
                    </a>
                </div>
            </div>
        </div>
        @endforeach
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