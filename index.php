<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Initialize database and default data
initializeDatabase();

$pageTitle = 'Home';
$therapists = getAllTherapists();
$services = getAllServices();

// // Get filter parameters for price block
// $priceFilter = $_GET['price_filter'] ?? 'monthly';

// // Calculate filtered stats
// $db = getDB();
// $dateCondition = '';
// switch ($priceFilter) {
//     case 'daily':
//         $dateCondition = "DATE(created_at) = CURDATE()";
//         break;
//     case 'monthly':
//         $dateCondition = "MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())";
//         break;
//     case 'yearly':
//         $dateCondition = "YEAR(created_at) = YEAR(CURRENT_DATE())";
//         break;
// }

// $stmt = $db->prepare("
//     SELECT SUM(total_amount) as revenue, COUNT(*) as bookings 
//     FROM bookings 
//     WHERE $dateCondition 
//     AND status IN ('confirmed', 'completed')
// ");
// $stmt->execute();
// $priceStats = $stmt->fetch();
// $filteredRevenue = $priceStats['revenue'] ?? 0;
// $filteredBookings = $priceStats['bookings'] ?? 0;
// ?>

<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <!-- Service Banner -->
        <!--<div class="row mb-4">-->
        <!--    <div class="col-12">-->
        <!--        <div class="service-banner">-->
        <!--            <div class="banner-content">-->
        <!--                <div class="banner-icon">-->
        <!--                    <i class="bi bi-geo-alt-fill"></i>-->
        <!--                </div>-->
        <!--                <div class="banner-text">-->
        <!--                    <h6 class="mb-1">Professional Spa Services at Your Doorstep</h6>-->
        <!--                    <p class="mb-0">Book certified therapists across Delhi-NCR & all major cities in India</p>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        
        <div class="row align-items-center">
            <div class="col-lg-6 hero-content">
                <div class="hero-badge mb-3">
                    <span class="badge bg-light text-primary px-3 py-2">
                        <i class="bi bi-award me-2"></i>India's Premier Spa Platform
                    </span>
                </div>
                <h1 class="display-4 fw-bold mb-4 fade-in">
                    Professional Spa Services 
                    <span class="text-warning">At Your Location</span>
                </h1>
                <p class="lead mb-4 fade-in">
                    Book certified therapists for premium spa treatments delivered to your doorstep. 
                    Experience ultimate relaxation and wellness in the comfort of your own space.
                </p>
                
                <!-- How It Works -->
                <!--<div class="how-it-works mb-4 fade-in">-->
                <!--    <div class="row g-3">-->
                <!--        <div class="col-md-4">-->
                <!--            <div class="step-item">-->
                <!--                <div class="step-number">1</div>-->
                <!--                <small>Choose Therapist</small>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <div class="col-md-4">-->
                <!--            <div class="step-item">-->
                <!--                <div class="step-number">2</div>-->
                <!--                <small>Book & Pay</small>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <div class="col-md-4">-->
                <!--            <div class="step-item">-->
                <!--                <div class="step-number">3</div>-->
                <!--                <small>Relax at Home</small>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                
                <div class="d-flex gap-3 fade-in">
                    <a href="models.php" class="btn btn-light btn-lg">
                        <i class="bi bi-people me-2"></i>View Therapists
                    </a>
                    <a href="services.php" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-spa me-2"></i>Our Services
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-center fade-in">
                    <div class="hero-image-container">
                        <img src="https://images.pexels.com/photos/3757942/pexels-photo-3757942.jpeg?auto=compress&cs=tinysrgb&w=600" 
                             class="img-fluid rounded-xl shadow-lg hero-main-image" alt="Spa Experience">
                        
                        <!-- Floating Elements -->
                        <!--<div class="floating-element floating-1">-->
                        <!--    <i class="bi bi-heart-pulse"></i>-->
                        <!--    <span>Wellness</span>-->
                        <!--</div>-->
                        <!--<div class="floating-element floating-2">-->
                        <!--    <i class="bi bi-house"></i>-->
                        <!--    <span>At Home</span>-->
                        <!--</div>-->
                        <!--<div class="floating-element floating-3">-->
                        <!--    <i class="bi bi-clock"></i>-->
                        <!--    <span>24/7 Available</span>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section with Price Filter -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="stats-card scale-in">
                    <span class="stats-number"><?php echo count($therapists); ?>+</span>
                    <span class="stats-label">Expert Therapists</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-card scale-in">
                    <span class="stats-number">500+</span>
                    <span class="stats-label">Happy Clients</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-card scale-in">
                    <span class="stats-number"><?php echo count($services); ?>+</span>
                    <span class="stats-label">Spa Services</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-card scale-in">
                    <span class="stats-number">15+</span>
                    <span class="stats-label">Years Experience</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="services-section">
    <div class="container">
        <h2 class="section-title display-5 fw-bold">Our Premium Services</h2>
        <div class="row g-4">
            <?php 
            $serviceIcons = [
                'Swedish Massage' => 'bi-heart-pulse',
                'Deep Tissue Massage' => 'bi-activity',
                'Hot Stone Therapy' => 'bi-fire',
                'Aromatherapy' => 'bi-flower1',
                'Reflexology' => 'bi-hand-thumbs-up',
                'Thai Massage' => 'bi-person-arms-up'
            ];
            
            foreach (array_slice($services, 0, 6) as $service): 
                $icon = $serviceIcons[$service['name']] ?? 'bi-spa';
                
                // Use service icon if available
                if ($service['icon_type'] === 'bootstrap' && $service['icon_value']) {
                    $icon = $service['icon_value'];
                }
            ?>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card slide-up">
                        <div class="service-icon">
                            <?php if ($service['icon_type'] === 'upload' && $service['icon_image']): ?>
                                <img src="<?php echo UPLOAD_URL . $service['icon_image']; ?>" 
                                     alt="<?php echo htmlspecialchars($service['name']); ?>" 
                                     style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                            <?php else: ?>
                                <i class="bi <?php echo $icon; ?>"></i>
                            <?php endif; ?>
                        </div>
                        <h5 class="fw-bold mb-3"><?php echo htmlspecialchars($service['name']); ?></h5>
                        <p class="text-muted"><?php echo htmlspecialchars($service['description']); ?></p>
                        <a href="services.php" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-arrow-right me-1"></i>Learn More
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-5">
            <a href="services.php" class="btn btn-primary btn-lg">
                <i class="bi bi-grid me-2"></i>View All Services
            </a>
        </div>
    </div>
</section>

<!-- Featured Therapists Section -->
<section id="therapists" class="py-5 bg-white">
    <div class="container">
        <h2 class="section-title display-5 fw-bold">Meet Our Expert Therapists</h2>
        
        <?php if (empty($therapists)): ?>
            <div class="text-center py-5">
                <i class="bi bi-person-exclamation display-1 text-muted"></i>
                <h4 class="text-muted mt-3">No therapists available at the moment</h4>
                <p class="text-muted">Please check back later for available therapists.</p>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach (array_slice($therapists, 0, 3) as $therapist): 
                    $images = getTherapistImages($therapist['id']);
                    $therapistServices = getTherapistServices($therapist['id']);
                ?>
                    <div class="col-lg-4" 
                         data-therapist-id="<?php echo $therapist['id']; ?>"
                         data-price-ncr="<?php echo $therapist['price_ncr'] ?? $therapist['price_per_session']; ?>"
                         data-price-other="<?php echo $therapist['price_other'] ?? $therapist['price_per_session']; ?>">
                        <div class="therapist-card-modern">
                            <!-- Image Slider -->
                            <div class="therapist-slider" id="slider-<?php echo $therapist['id']; ?>">
                                <div class="slider-container">
                                    <?php if (!empty($images)): ?>
                                        <?php foreach ($images as $index => $image): ?>
                                            <div class="slide <?php echo $index === 0 ? 'active' : ''; ?>">
                                                <img src="<?php echo UPLOAD_URL . $image['image_path']; ?>" 
                                                     alt="<?php echo htmlspecialchars($therapist['name']); ?>" 
                                                     class="therapist-image">
                                            </div>
                                        <?php endforeach; ?>
                                        
                                        <?php if (count($images) > 1): ?>
                                            <div class="slider-nav">
                                                <button class="slider-btn prev" onclick="changeSlide(<?php echo $therapist['id']; ?>, -1)">
                                                    <i class="bi bi-chevron-left"></i>
                                                </button>
                                                <button class="slider-btn next" onclick="changeSlide(<?php echo $therapist['id']; ?>, 1)">
                                                    <i class="bi bi-chevron-right"></i>
                                                </button>
                                            </div>
                                            
                                            <div class="slider-dots">
                                                <?php foreach ($images as $index => $image): ?>
                                                    <span class="dot <?php echo $index === 0 ? 'active' : ''; ?>" 
                                                          onclick="currentSlide(<?php echo $therapist['id']; ?>, <?php echo $index + 1; ?>)"></span>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="slide active">
                                            <img src="https://images.pexels.com/photos/3757942/pexels-photo-3757942.jpeg?auto=compress&cs=tinysrgb&w=400" 
                                                 alt="<?php echo htmlspecialchars($therapist['name']); ?>" 
                                                 class="therapist-image">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Card Content -->
                            <div class="card-content">
                                <h5 class="therapist-name"><?php echo htmlspecialchars($therapist['name']); ?></h5>
                                
                                <div class="price-display">
                                    <?php echo formatPrice($therapist['price_per_session']); ?>/session
                                </div>
                                
                                <div class="services-tags">
                                    <?php foreach (array_slice($therapistServices, 0, 3) as $service): ?>
                                        <span class="service-tag"><?php echo htmlspecialchars($service['name']); ?></span>
                                    <?php endforeach; ?>
                                    <?php if (count($therapistServices) > 3): ?>
                                        <span class="service-tag">+<?php echo count($therapistServices) - 3; ?> more</span>
                                    <?php endif; ?>
                                </div>
                                
                                <p class="therapist-description">
                                    <?php echo htmlspecialchars(substr($therapist['description'] ?? 'Professional therapist specializing in wellness and relaxation treatments.', 0, 100)); ?>
                                    <?php if (strlen($therapist['description'] ?? '') > 100) echo '...'; ?>
                                </p>
                                
                                <div class="card-actions">
                                    <a href="therapist-details.php?id=<?php echo $therapist['id']; ?>" class="btn btn-primary">
                                        <i class="bi bi-eye me-2"></i>View Details
                                    </a>
                                    <button class="btn btn-outline-primary" onclick="openBookingModal(<?php echo $therapist['id']; ?>)">
                                        <i class="bi bi-calendar-check me-2"></i>Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="text-center mt-5">
                <a href="models.php" class="btn btn-primary btn-lg">
                    <i class="bi bi-people me-2"></i>View All Therapists
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Testimonials Section -->
<!--<section class="py-5 services-section">-->
<!--    <div class="container">-->
<!--        <h2 class="section-title display-5 fw-bold">What Our Clients Say</h2>-->
<!--        <div class="row g-4">-->
<!--            <div class="col-lg-4">-->
<!--                <div class="testimonial-card slide-up">-->
<!--                    <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=150" -->
<!--                         class="testimonial-avatar" alt="Client">-->
<!--                    <p class="mb-3">"Amazing experience! The therapists are highly skilled and the atmosphere is so relaxing. I feel completely rejuvenated after every session."</p>-->
<!--                    <h6 class="fw-bold">Sarah Johnson</h6>-->
<!--                    <small class="text-muted">Regular Client</small>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-4">-->
<!--                <div class="testimonial-card slide-up">-->
<!--                    <img src="https://images.pexels.com/photos/1239291/pexels-photo-1239291.jpeg?auto=compress&cs=tinysrgb&w=150" -->
<!--                         class="testimonial-avatar" alt="Client">-->
<!--                    <p class="mb-3">"Professional service and excellent facilities. The deep tissue massage helped me recover from my sports injury. Highly recommended!"</p>-->
<!--                    <h6 class="fw-bold">Michael Chen</h6>-->
<!--                    <small class="text-muted">Athlete</small>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-4">-->
<!--                <div class="testimonial-card slide-up">-->
<!--                    <img src="https://images.pexels.com/photos/1181686/pexels-photo-1181686.jpeg?auto=compress&cs=tinysrgb&w=150" -->
<!--                         class="testimonial-avatar" alt="Client">-->
<!--                    <p class="mb-3">"The aromatherapy sessions are divine! Perfect place to unwind and escape from daily stress. The staff is incredibly caring and professional."</p>-->
<!--                    <h6 class="fw-bold">Emma Davis</h6>-->
<!--                    <small class="text-muted">Business Executive</small>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->

<!-- Contact Section -->
<section id="contact" class="py-5 services-section">
    <div class="container">
        <h2 class="section-title display-5 fw-bold">Get In Touch</h2>
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="contact-card scale-in">
                    <div class="contact-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <h5 class="fw-bold">Visit Our Spa</h5>
                    <p class="text-muted"> A-35 Block A2, Rajouri Garden New Delhi, 110027</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-card scale-in">
                    <div class="contact-icon">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <h5 class="fw-bold">Call Us</h5>
                    <p class="text-muted">+91 9560656913<br>Available 9 AM - 8 PM<br>7 Days a Week</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-card scale-in">
                    <div class="contact-icon">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <h5 class="fw-bold">Email Us</h5>
                    <p class="text-muted"> info@hammammensspa.com<br>We'll respond within 24 hours<br>Professional support</p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <a href="contact.php" class="btn btn-primary btn-lg">
                <i class="bi bi-envelope me-2"></i>Contact Us
            </a>
        </div>
    </div>
</section>

<?php include 'includes/booking_modal.php'; ?>

<?php 
$extraScripts = '<script>
    // Price filter functionality
    document.querySelectorAll("input[name=\"priceFilter\"]").forEach(radio => {
        radio.addEventListener("change", function() {
            const filter = this.value;
            
            // Update URL with filter parameter
            const url = new URL(window.location);
            url.searchParams.set("price_filter", filter);
            window.history.pushState({}, "", url);
            
            // Update labels
            document.getElementById("bookingsLabel").textContent = filter.charAt(0).toUpperCase() + filter.slice(1) + " Bookings";
            document.getElementById("revenueLabel").textContent = filter.charAt(0).toUpperCase() + filter.slice(1) + " Revenue";
            
            // Fetch updated data
            fetch(`get_filtered_stats.php?filter=${filter}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById("filteredBookings").textContent = data.bookings;
                        document.getElementById("filteredRevenue").textContent = "₹" + new Intl.NumberFormat("en-IN").format(data.revenue);
                    }
                })
                .catch(error => console.error("Error:", error));
        });
    });
</script>';

include 'includes/footer.php'; 
?>