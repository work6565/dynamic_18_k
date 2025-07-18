<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title" id="bookingModalLabel">
                    <i class="bi bi-calendar-check me-2"></i>Book Appointment
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div class="booking-options">
                    <!-- Option Tabs -->
                    <ul class="nav nav-pills nav-justified m-3 mb-0" id="bookingTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="inquiry-tab" data-bs-toggle="pill" data-bs-target="#inquiry" type="button" role="tab">
                                <i class="bi bi-chat-dots me-2"></i>General Inquiry
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="booking-tab" data-bs-toggle="pill" data-bs-target="#booking" type="button" role="tab">
                                <i class="bi bi-credit-card me-2"></i>Book & Pay Online
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="whatsapp-tab" data-bs-toggle="pill" data-bs-target="#whatsapp" type="button" role="tab">
                                <i class="bi bi-whatsapp me-2"></i>WhatsApp Contact
                            </button>
                        </li>
                    </ul>
                    
                    <div class="tab-content p-4" id="bookingTabContent">
                        <!-- General Inquiry Tab -->
                        <div class="tab-pane fade show active" id="inquiry" role="tabpanel">
                            <div class="inquiry-header mb-4">
                                <h6 class="fw-bold text-primary">Send us your inquiry</h6>
                                <p class="text-muted mb-0">No login required. We'll get back to you within 24 hours.</p>
                            </div>
                            
                            <form id="inquiryForm" class="needs-validation" novalidate>
                                <input type="hidden" name="type" value="inquiry">
                                <input type="hidden" name="therapist_id" id="inquiryTherapistId">
                                <!-- Honeypot field for spam protection -->
                                <input type="text" name="website" style="display: none;" tabindex="-1" autocomplete="off">
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Full Name *</label>
                                        <input type="text" class="form-control" name="full_name" required>
                                        <div class="invalid-feedback">Please provide your name.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Phone *</label>
                                        <input type="tel" class="form-control" name="phone" pattern="[0-9]{10}" required>
                                        <div class="invalid-feedback">Please provide a valid phone number.</div>
                                        <!--<small class="form-text text-muted">Required - primary contact method</small>-->
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email </label>
                                        <input type="email" class="form-control" name="email">
                                        <!--<small class="form-text text-muted">Optional - for booking confirmations</small>-->
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Preferred Date</label>
                                        <input type="date" class="form-control" name="preferred_date" min="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Message</label>
                                        <textarea class="form-control" name="message" rows="3" placeholder="Tell us about your requirements..."></textarea>
                                    </div>
                                </div>
                                
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-send me-2"></i>Send Inquiry
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Online Booking Tab -->
                        <div class="tab-pane fade" id="booking" role="tabpanel">
                            <?php if (isUserLoggedIn()): ?>
                                <div class="booking-header mb-4">
                                    <h6 class="fw-bold text-success">Book & Pay Online</h6>
                                    <p class="text-muted mb-0">Secure online booking with instant confirmation.</p>
                                </div>
                                
                                <form id="bookingForm" class="needs-validation" novalidate>
                                    <input type="hidden" name="type" value="booking">
                                    <input type="hidden" name="therapist_id" id="bookingTherapistId">
                                    <input type="hidden" name="total_amount" id="bookingAmount">
                                    <input type="hidden" name="region" id="bookingRegion">
                                    <input type="hidden" name="is_night" id="bookingIsNight">
                                    <input type="hidden" name="night_charge" id="bookingNightCharge">
                                    <!-- Honeypot field for spam protection -->
                                    <input type="text" name="website" style="display: none;" tabindex="-1" autocomplete="off">
                                    
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Full Name *</label>
                                            <input type="text" class="form-control" name="full_name" 
                                                   value="<?php echo htmlspecialchars($_SESSION['user_name'] ?? ''); ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Phone *</label>
                                            <input type="tel" class="form-control" name="phone" 
                                                   value="<?php echo htmlspecialchars($_SESSION['user_phone'] ?? ''); ?>" required>
                                            <!--<small class="form-text text-muted">Required - primary contact method</small>-->
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" 
                                                   value="<?php echo htmlspecialchars($_SESSION['user_email'] ?? ''); ?>">
                                            <!--<small class="form-text text-muted">Optional - for booking confirmations</small>-->
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Address *</label>
                                            <textarea class="form-control" name="address" rows="1" 
                                                      placeholder="Enter complete address for the therapist visit" required></textarea>
                                            <small class="form-text text-muted">Complete address where the therapist should visit</small>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Booking Date *</label>
                                            <input type="date" class="form-control" name="booking_date" min="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Preferred Time *</label>
                                            <select class="form-control" name="booking_time" id="bookingTimeSelect" required>
                                                <option value="">Select time</option>
                                                <optgroup label="Regular Hours (8 AM - 8 PM)">
                                                    <option value="08:00">8:00 AM</option>
                                                    <option value="09:00">9:00 AM</option>
                                                    <option value="10:00">10:00 AM</option>
                                                    <option value="11:00">11:00 AM</option>
                                                    <option value="12:00">12:00 PM</option>
                                                    <option value="13:00">1:00 PM</option>
                                                    <option value="14:00">2:00 PM</option>
                                                    <option value="15:00">3:00 PM</option>
                                                    <option value="16:00">4:00 PM</option>
                                                    <option value="17:00">5:00 PM</option>
                                                    <option value="18:00">6:00 PM</option>
                                                    <option value="19:00">7:00 PM</option>
                                                    <option value="20:00">8:00 PM</option>
                                                </optgroup>
                                                <optgroup label="Night Hours (+₹1,500)">
                                                    <option value="21:00" data-night="true">9:00 PM (+₹1,500)</option>
                                                    <option value="22:00" data-night="true">10:00 PM (+₹1,500)</option>
                                                    <option value="23:00" data-night="true">11:00 PM (+₹1,500)</option>
                                                    <option value="00:00" data-night="true">12:00 AM (+₹1,500)</option>
                                                    <option value="01:00" data-night="true">1:00 AM (+₹1,500)</option>
                                                    <option value="02:00" data-night="true">2:00 AM (+₹1,500)</option>
                                                    <option value="03:00" data-night="true">3:00 AM (+₹1,500)</option>
                                                    <option value="04:00" data-night="true">4:00 AM (+₹1,500)</option>
                                                    <option value="05:00" data-night="true">5:00 AM (+₹1,500)</option>
                                                    <option value="06:00" data-night="true">6:00 AM (+₹1,500)</option>
                                                    <option value="07:00" data-night="true">7:00 AM (+₹1,500)</option>
                                                </optgroup>
                                            </select>
                                            <small class="form-text text-muted">Night hours include additional ₹1,500 charge</small>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Special Requests</label>
                                            <textarea class="form-control" name="message" rows="2"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="payment-section mt-4">
                                        <h6 class="fw-bold mb-3">
                                            <i class="bi bi-credit-card me-2"></i>Payment Information
                                        </h6>
                                        <div class="payment-amount-display mb-3">
                                            <!-- Price Breakdown -->
                                            <div id="priceBreakdown" class="mb-3"></div>
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                                                <span>Final Amount to Pay:</span>
                                                <span class="fw-bold text-success" id="displayAmount">₹0</span>
                                            </div>
                                        </div>
                                        
                                        <?php if (RAZORPAY_ENABLED): ?>
                                            <div class="alert alert-info">
                                                <i class="bi bi-info-circle me-2"></i>
                                                <strong>Secure Payment:</strong> Your payment is processed securely through Razorpay.
                                            </div>
                                        <?php else: ?>
                                            <!--<div class="alert alert-warning">-->
                                            <!--    <i class="bi bi-exclamation-triangle me-2"></i>-->
                                            <!--    <strong>Payment Gateway Disabled:</strong> You can book now and pay Later.-->
                                            <!--</div>-->
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="d-grid mt-4">
                                        <?php if (RAZORPAY_ENABLED): ?>
                                            <button type="submit" class="btn btn-success btn-lg">
                                                <i class="bi bi-credit-card me-2"></i>Pay Now & Book
                                            </button>
                                        <?php else: ?>
                                            <button type="submit" class="btn btn-primary btn-lg">
                                                <i class="bi bi-calendar-check me-2"></i>Book Now (Pay Later)
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            <?php else: ?>
                                <div class="text-center py-5">
                                    <i class="bi bi-lock display-4 text-muted mb-3"></i>
                                    <h5>Login Required</h5>
                                    <p class="text-muted mb-4">Please login to book appointments and make online payments.</p>
                                    <a href="login.php" class="btn btn-primary">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>Login Now
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- WhatsApp Contact Tab -->
                        <div class="tab-pane fade" id="whatsapp" role="tabpanel">
                            <div class="text-center py-4">
                                <div class="whatsapp-icon mb-3">
                                    <i class="bi bi-whatsapp display-1 text-success"></i>
                                </div>
                                <h5>Contact via WhatsApp</h5>
                                <p class="text-muted mb-4">Get instant responses and personalized assistance through WhatsApp.</p>
                                
                                <div class="whatsapp-options">
                                    <button class="btn btn-success btn-lg mb-3 w-100" id="whatsappGeneralBtn">
                                        <i class="bi bi-whatsapp me-2"></i>General Inquiry
                                    </button>
                                    <button class="btn btn-outline-success btn-lg w-100" id="whatsappBookingBtn">
                                        <i class="bi bi-calendar-check me-2"></i>Booking Inquiry
                                    </button>
                                </div>
                                
                                <div class="mt-4">
                                    <small class="text-muted">
                                        <i class="bi bi-clock me-1"></i>
                                        Usually responds within minutes • Available 9 AM - 8 PM
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Razorpay Script -->
<?php if (RAZORPAY_ENABLED): ?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<?php endif; ?>