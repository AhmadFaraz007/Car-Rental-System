<footer class="main-footer">
    <div class="footer-container">
        <!-- Company Info -->
        <div class="footer-section about">
            <h3>Car Rents</h3>
            <p>Your trusted car rental service. Reliable. Affordable. Everywhere.</p>
            <p><i class="fas fa-phone-alt"></i> +92 327 6336279</p>
            <p><i class="fas fa-envelope"></i> support@carrents.com</p>
        </div>

        <!-- Quick Links -->
        <div class="footer-section links">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/Rentalcars') }}">Cars</a></li>
                <li><a href="{{ url('/contact') }}">Contact</a></li>
                <li><a href="{{ url('/dashboard') }}">Admin Login</a></li>
            </ul>
        </div>

        <!-- Newsletter -->
        <div class="footer-section newsletter">
            <h4>Subscribe</h4>
            <form action="#" method="POST">
                <input type="email" name="email" placeholder="Your email address" required>
                <button type="submit"><i class="fas fa-paper-plane"></i></button>
            </form>
        </div>

        <!-- Social Media -->
        <div class="footer-section social">
            <h4>Follow Us</h4>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="https://www.linkedin.com/in/taaha-shahzad-211968252/" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} Car Rents. All rights reserved.</p>
    </div>
</footer>
