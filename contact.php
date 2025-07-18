<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/email_functions.php';

$pageTitle = 'Contact Us';
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Honeypot spam protection
    if (!validateHoneypot()) {
        $message = 'Spam detected. Please try again.';
        $messageType = 'danger';
    } else {
        // Rate limiting
        $clientIP = getUserIP();
        if (!checkRateLimit($clientIP, 3, 300)) { // 3 attempts per 5 minutes
            $message = 'Too many requests. Please try again later.';
            $messageType = 'danger';
        } else {
    $name = sanitizeInput($_POST['name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $phone = sanitizeInput($_POST['phone'] ?? '');
    $subject = sanitizeInput($_POST['subject'] ?? '');
    $messageText = sanitizeInput($_POST['message'] ?? '');
    
    if (empty($name) || empty($email) || empty($messageText)) {
        $message = 'Name, phone, and message are required.';
        $messageType = 'danger';
    } elseif (empty($phone)) {
        $message = 'Phone number is required.';
        $messageType = 'danger';
    } elseif (!validatePhone($phone)) {
        $message = 'Please enter a valid 10-digit phone number.';
        $messageType = 'danger';
    } elseif (!empty($email) && !validateEmail($email)) {
        $message = 'Please enter a valid email address.';
        $messageType = 'danger';
    } else {
        // Save contact inquiry to database
        $db = getDB();
        try {
            $stmt = $db->prepare("
                INSERT INTO contact_inquiries (name, email, phone, subject, message, status) 
                VALUES (?, ?, ?, ?, ?, 'new')
            ");
            if ($stmt->execute([$name, $email, $phone, $subject, $messageText])) {
                // Send notification email
                $emailData = [
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'subject' => $subject,
                    'message' => $messageText
                ];
                
                $emailSent = sendContactNotification($emailData);
            
                $message = 'Thank you for your message! We will get back to you soon.' . ($emailSent ? ' Notification sent.' : '');
            $messageType = 'success';
            
            // Clear form data
            $name = $email = $phone = $subject = $messageText = '';
            } else {
                $message = 'Sorry, there was an error sending your message. Please try again.';
                $messageType = 'danger';
            }
        } catch (Exception $e) {
            $message = 'Sorry, there was an error sending your message. Please try again.';
            $messageType = 'danger';
        }
        }
    }
    }
}
?>

<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<section class="hero-section-inner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-4">Contact Us</h1>
                <p class="lead mb-4">Get in touch with us for bookings, inquiries, or any questions about our services. We're here to help you on your wellness journey.</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-5">
            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="contact-form-container">
                    <h3 class="mb-4">Send us a Message</h3>
                    
                    <?php if ($message): ?>
                        <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show">
                            <i class="bi bi-<?php echo $messageType === 'success' ? 'check-circle' : 'exclamation-triangle'; ?> me-2"></i>
                            <?php echo $message; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" class="needs-validation" novalidate>
                        <!-- Honeypot field for spam protection -->
                        <input type="text" name="website" style="display: none;" tabindex="-1" autocomplete="off">
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name *</label>
                                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($name ?? ''); ?>" required>
                                <div class="invalid-feedback">Please provide your name.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                                <small class="form-text text-muted">Optional - for our response</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number *</label>
                                <input type="tel" class="form-control" name="phone" value="<?php echo htmlspecialchars($phone ?? ''); ?>" pattern="[0-9]{10}" required>
                                <div class="invalid-feedback">Please provide a valid 10-digit phone number.</div>
                                <small class="form-text text-muted">Required - primary contact method</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Subject</label>
                                <select class="form-control" name="subject">
                                    <option value="">Select a subject</option>
                                    <option value="General Inquiry" <?php echo ($subject ?? '') === 'General Inquiry' ? 'selected' : ''; ?>>General Inquiry</option>
                                    <option value="Booking Question" <?php echo ($subject ?? '') === 'Booking Question' ? 'selected' : ''; ?>>Booking Question</option>
                                    <option value="Service Information" <?php echo ($subject ?? '') === 'Service Information' ? 'selected' : ''; ?>>Service Information</option>
                                    <option value="Feedback" <?php echo ($subject ?? '') === 'Feedback' ? 'selected' : ''; ?>>Feedback</option>
                                    <option value="Other" <?php echo ($subject ?? '') === 'Other' ? 'selected' : ''; ?>>Other</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Message *</label>
                                <textarea class="form-control" name="message" rows="5" required><?php echo htmlspecialchars($messageText ?? ''); ?></textarea>
                                <div class="invalid-feedback">Please provide your message.</div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-send me-2"></i>Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Contact Information -->
            <div class="col-lg-4">
                <div class="contact-info">
                    <h3 class="mb-4">Get in Touch</h3>
                    
                    <div class="contact-item">
                        <div class="contact-icon ml-0">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div class="contact-details">
                            <h5>Visit Our Spa</h5>
                            <p>A-35 Block A2, Rajouri Garden New Delhi, 110027</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon" style="margin-left:0px;">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <div class="contact-details">
                            <h5>Call Us</h5>
                            <p><a href="tel:+919876543210">+91 9560656913</a><br>Available 9 AM - 8 PM<br>7 Days a Week</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon" style="margin-left:0px;">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div class="contact-details">
                            <h5>Email Us</h5>
                            <p><a href="mailto:info@serenityspa.com">info@hammammensspa.com</a><br>We'll respond within 24 hours</p>
                        </div>
                    </div>
                    
                    <!--<div class="contact-item">-->
                    <!--    <div class="contact-icon" style="margin-left:0px;">-->
                    <!--        <i class="bi bi-whatsapp"></i>-->
                    <!--    </div>-->
                    <!--    <div class="contact-details">-->
                    <!--        <h5>WhatsApp</h5>-->
                    <!--        <p><a href="https://wa.me/919876543210" target="_blank">+91 9560656913</a><br>Quick responses<br>Available 24/7</p>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
                
                <!-- Business Hours -->
                <div class="business-hours mt-4">
                    <h4 class="mb-3">Business Hours</h4>
                    <div class="hours-list">
                        <div class="hours-item">
                            <span class="day">Monday - Friday</span>
                            <span class="time">9:00 AM - 8:00 PM</span>
                        </div>
                        <div class="hours-item">
                            <span class="day">Saturday</span>
                            <span class="time">10:00 AM - 6:00 PM</span>
                        </div>
                        <div class="hours-item">
                            <span class="day">Sunday</span>
                            <span class="time">11:00 AM - 5:00 PM</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-5 services-section">
    <div class="container">
        <h3 class="text-center mb-4">Find Us on Map</h3>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d896950.8557408227!2d76.08547210693362!3d28.578341281413785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce2536f271a49%3A0x78a11fefbcdfe3cb!2sHammam%20Mens%20Spa%20-%20Male%20To%20Male%20Spa%20Center%20In%20Lajpat%20Nagar!5e0!3m2!1sen!2sin!4v1751393134808!5m2!1sen!2sin" width="100%" height="400" style="border:0; border-radius: 12px;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>