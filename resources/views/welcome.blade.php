<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trinadh Rentals</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- logo -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    <style>
    .hero-bg {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/frontpage.jpg') }}') center/cover no-repeat;
    }
</style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a class="logo" href="/">Rental<span>Hub</span></a>
            <div class="nav-links">
                <a href="/" class="active">Home</a>
                <a href="#about">About Us</a>
                <a href="#contact">Contact</a>
                <div class="auth-links">
                    <a href="/login" class="btn-login">Login</a>
                    <a href="/register" class="btn-register">Register</a>
                </div>
                <a href="/dashboard" class="btn-dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </div>
            <div class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero hero-bg">
        <div class="hero-content">
            <h1>Find Your Perfect <span class="typewriter"></span></h1>
            <p class="tagline">Experience seamless rentals with our trusted platform</p>
            <div class="hero-buttons">
                <a href="/register" class="cta-button">Get Started</a>
                <a href="#featured-cars" class="cta-button secondary">Explore</a>
            </div>
        </div>
    </header>

    <section class="featured-cars" id="featured-cars">
    <div class="section-header">
        <h2>Featured Cars</h2>
        <p>Explore our premium selection of vehicles</p>
    </div>

    <div class="carousel-container">
        <div class="carousel-track cars-track" id="cars-track">

            <div class="carousel-card">
                <div class="card-image">
                <img src="https://img.autocarpro.in/autocarpro/efa04578-f6f3-403d-a19c-1d0cd97685e6_20210818103638_XUV700_front_tracking.jpg" alt="SUV">
                    <div class="card-badge">Popular</div>
                </div>
                <div class="card-content">
                    <h3>Mahindra Suv</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                        <span>4.5</span>
                    </div>
                    <p>Drive with confidence and unmatched style on every journey.</p>
                    <div class="card-footer">
                        <span class="price">₹2500/day</span>
                        <a href="/cars" class="browse-button">Book Now</a>
                    </div>
                </div>
            </div>

            <div class="carousel-card">
                <div class="card-image">
                <img src="https://www.xdrivecars.com/assets/images/products/Used-cars-in-trivandrum--170120258088.webp" alt="SUV">
                    <div class="card-badge">New</div>
                </div>
                <div class="card-content">
                    <h3>Sporty Convertible</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <span>5.0</span>
                    </div>
                    <p>Feel the thrill of the open road with our high-performance convertibles.</p>
                    <div class="card-footer">
                        <span class="price">₹2000/day</span>
                        <a href="/cars" class="browse-button">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-card">
                <div class="card-image">
                <img src="https://imgin.waa2.com/car/170923/mitsubishi-pajero-sfx-28-af59c9db478db7ce1a2793a775df986c_thumb.jpg" alt="SUV">
                    <div class="card-badge">Trending</div>
                </div>
                <div class="card-content">
                    <h3>Pajeero cant Old</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                        <span>4.0</span>
                    </div>
                    <p>Perfect for trips and adventures with ample space.</p>
                    <div class="card-footer">
                        <span class="price">₹2800/day</span>
                        <a href="/cars" class="browse-button">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-card">
                <div class="card-image">
                    <img src="https://img.autocarindia.com/ExtraImages/20200916040623_2020-Mahindra-Thar-front-static.jpg" alt="SUV">
                    <div class="card-badge">Trending</div>
                </div>
                <div class="card-content">
                    <h3>Thar</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                        <span>4.0</span>
                    </div>
                    <p>Feel the power and precision of our high-performance vehicles.</p>
                    <div class="card-footer">
                        <span class="price">₹3000/day</span>
                        <a href="/cars" class="browse-button">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-card">
                <div class="card-image">
                <img src="https://images.topgear.com.ph/topgear/images/2023/11/27/2-1701080735.jpg" alt="SUV">
                    <div class="card-badge">Trending</div>
                </div>
                <div class="card-content">
                    <h3>Spacious SUV</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                        <span>4.0</span>
                    </div>
                    <p>Cruise through the city streets with ultimate luxury and ease.</p>
                    <div class="card-footer">
                        <span class="price">₹2100/day</span>
                        <a href="/cars" class="browse-button">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="featured-rooms" id="featured-rooms">
    <div class="section-header">
        <h2>Featured Accommodations</h2>
        <p>Discover our premium selection of rooms and properties</p>
    </div>

    <div class="carousel-container">
        <div class="carousel-track rooms-track" id="rooms-track">
            <div class="carousel-card">
                <div class="card-image">
                <img src="https://www.houzlook.com/assets/images/upload/Rooms/Bed%20Rooms/View_01-20200822103638797.jpg" alt="SUV">
                    <div class="card-badge">Trending</div>
                </div>
                <div class="card-content">
                    <h3>City Apartment</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                        <span>4.0</span>
                    </div>
                    <p>Modern living in the heart of the city with all amenities included.</p>
                    <div class="card-footer">
                        <span class="price">₹1000/night</span>
                        <a href="/rooms" class="browse-button">Book Now</a>
                    </div>
                </div>
            </div>

            <div class="carousel-card">
                <div class="card-image">
                <img src="https://fariyas.com/wp-content/uploads/2023/10/Deluxe-king-room-B-1.jpg" alt="SUV">
                    <div class="card-badge">Exclusive</div>
                </div>
                <div class="card-content">
                    <h3>Cozy Cottage</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <span>5.0</span>
                    </div>
                    <p>Escape to nature with our charming countryside cottages.</p>
                    <div class="card-footer">
                        <span class="price">₹1100/night</span>
                        <a href="/rooms" class="browse-button">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-card">
                <div class="card-image">
                <img src="https://chokhidhani.com/palace-hotel-jaisalmer/wp-content/uploads/2022/12/Royal-Room_img.jpeg" alt="SUV">
                    <div class="card-badge">Premium</div>
                </div>
                <div class="card-content">
                    <h3>Luxury Villa</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                        <span>4.8</span>
                    </div>
                    <p>Indulge in a luxurious stay with private amenities and scenic views.</p>
                    <div class="card-footer">
                        <span class="price">₹1200/night</span>
                        <a href="/rooms" class="browse-button">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- about section --}}
{{-- <section class="about-section" id="about">
    <div class="about-container">
        <h2>About Trinadh Rentals</h2>
        <p>At Trinadh Rentals, we make it easy for you to rent your favorite cars and rooms at the best prices. Whether you're traveling for business or leisure, we have the perfect options for you. Enjoy a seamless booking experience with secure payments and trusted service!</p>
    </div>
</section>
 --}}

        <!-- Contact Us Section -->
        <section class="contact" id="contact">
        <div class="section-header">
            <h2>Get in Touch</h2>
            <p>Have questions? Reach out to us anytime</p>
        </div>
        <div class="contact-container">
            <div class="contact-info">
                <h3>Contact Information</h3>
                <p><i class="fas fa-map-marker-alt"></i> jones Rental Street,Jalandar</p>
                <p><i class="fas fa-phone-alt"></i> +91 9618913627</p>
                <p><i class="fas fa-envelope"></i> trinadhgeti@gmail.com</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f" target="_blank"></i></a>
                    <a href="https://x.com/GetiTrinadh" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/getitrinadh" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/in/trinadh-geti-368081252/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <form class="contact-form">
                <input type="text" placeholder="Your Name" required>
                <input type="email" placeholder="Your Email" required>
                <textarea placeholder="Your Message" rows="5" required></textarea>
                <button type="submit" class="send-button">Send Message</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-about">
                <h3>RentalHub</h3>
                <p>Your trusted partner for car and room rentals. Offering quality service, unbeatable rates, and unmatched customer satisfaction.</p>
            </div>
            <div class="footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/cars">Browse Cars</a></li>
                    <li><a href="/rooms">Browse Rooms</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-newsletter">
                <h4>Subscribe</h4>
                <p>Get the latest updates and offers</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Enter your email" required>
                    <button type="submit" class="subscribe-button">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 RentalHub. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/welcome.js') }}"></script>
</body>
</html>
