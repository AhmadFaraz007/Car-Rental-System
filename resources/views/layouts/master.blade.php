<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Car Rents')</title>
    <!-- Bootstrap 5 CSS ONLY -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Your custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    @yield('styles')
</head>
<body>
    <div class="layout-container">
        @include('partials.header')
        
        <div class="main-wrapper">
            
            
            <!-- Main Content Area -->
            <main class="main-content" id="main-content">
                @yield('content')
            </main>
        </div>

        @include('partials.footer')
    </div>

    <!-- Move Modals outside the layout container -->
    @hasSection('modals')
        @yield('modals')
    @endif

    <!-- jQuery 3.6.0 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function toggleMenu() {
        const nav = document.getElementById('mainNav');
        nav.classList.toggle('active');
    }
    </script>

    
    @yield('scripts')
</body>
</html>