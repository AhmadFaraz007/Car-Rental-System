<header class="main-header">
    <div class="header-content">
        <!-- Logo & Site Title -->
        <div class="logo-container">
            <img src="{{ asset('OIP (9).jpeg') }}" alt="Car Rents Logo" class="logo">
            <h1 class="site-title">Car Rents</h1>
        </div>

        <!-- Hamburger Icon -->
        <div class="hamburger" onclick="toggleMenu()">&#9776;</div>

        <!-- Navigation Menu -->
        <nav class="main-nav" id="mainNav">
            <ul class="nav-links">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/Rentalcars') }}">Cars</a></li>
                <li><a href="{{ url('/blogsPage') }}">Blogs</a></li>
                <li><a href="{{ url('/FAQs') }}">FAQs</a></li>
                <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                <li><a href="{{ url('/about') }}">About Us</a></li>
            </ul>
        </nav>

        <!-- Admin Button -->
        <div class="header-right">
            <a href="{{ route('dashboard') }}" class="admin-login-btn">Admin Login</a>
        </div>
    </div>
</header>
