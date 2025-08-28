<x-web.layout>
   
    <!-- Hero Section -->
    <section id="home" class="bg-gray py-5">
        <div class="container-fluid px-4">
            <!-- Page Title and Description -->
            <div class="row wrapper">
                <div class="col-lg-9">
                    <h1 class="display-4 fw-bold mb-3 fs-2 text-primary">Second Opinion</h1>
                    <p class="lead text-muted mb-4">Our Second Opinion services offer more than just advice; they provide a human touch to guide you through choices, ensuring your journey to wellness is both informed and supported.</p>
                </div>
                <div class="col-lg-3 text-lg-end text-md-start mt-4 mb-lg-0">
                    <a href="book-an-appointment" class="view-all-btn">
                        <i class="fas fa-calendar-days"></i> Book An Appointment
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Flat Services Section -->
    <section class="wrapper py-5">
        <div class="container-fluid">
            <div class="row g-0 wrapper">
                <!-- Get a Second Opinion -->
                <div class="col-lg-4 px-4">
                    <div class="service-flat-item">
                        <div class="service-flat-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="service-flat-content">
                            <h4 class="service-flat-title">Request a Callback</h4>
                            <p class="service-flat-description">Get a quick callback at your convenience.</p>
                        </div>
                        <div class="service-flat-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>

                <!-- Book an Appointment -->
                <div class="col-lg-4 px-4">
                    <div class="service-flat-item">
                        <div class="service-flat-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="service-flat-content">
                            <h4 class="service-flat-title">Book an Appointment</h4>
                            <p class="service-flat-description">For world-class assistance</p>
                        </div>
                        <div class="service-flat-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>

                <!-- Find a Doctor -->
                <div class="col-lg-4 px-4">
                    <div class="service-flat-item">
                        <div class="service-flat-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div class="service-flat-content">
                            <h4 class="service-flat-title">Find a Doctor</h4>
                            <p class="service-flat-description">For exceptional care & expertise</p>
                        </div>
                        <div class="service-flat-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10 mb-5">
                    <!-- Enquiry Form Section -->
                    <div class="form-section">
                        <div class="text-center mb-4">
                            <h2 class="section-title text-center">
                                <i class="fas fa-paper-plane me-2"></i>Send us an Enquiry
                            </h2>
                            <p class="section-subtitle">We'd love to hear from you. Fill out the form below and we'll get back to you as soon as possible.</p>
                        </div>

                        <form id="contactForm" class="row g-3">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="fullName" class="form-label fw-semibold">Your Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-custom" id="fullName" name="fullName" required>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="phoneNumber" class="form-label fw-semibold">Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control form-control-custom" id="phoneNumber" name="phoneNumber" required>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="emailAddress" class="form-label fw-semibold">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control form-control-custom" id="emailAddress" name="emailAddress" required>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="subject" class="form-label fw-semibold">Subject <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-custom" id="subject" name="subject" required>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="message" class="form-label fw-semibold">Message <span class="text-danger">*</span></label>
                                <textarea class="form-control form-control-custom" id="message" name="message" rows="5" required placeholder="Please describe your enquiry in detail..."></textarea>
                            </div>

                            <!-- reCAPTCHA Section -->
                            <div class="d-flex mb-4">
                                <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
                            </div>

                            <div class="col-12 text-left">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-paper-plane me-2"></i>Submit Now
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
    </section> 
    <!-- Scripts -->
     @push('js')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endpush
    @push('css')
        
        <style>
            .quick-links {
                background: #f8f9fa;
                padding: 40px 0;
                margin-bottom: 40px;
                border-radius: 15px;
            }
            
            .quick-link-item {
                text-align: center;
                padding: 20px;
                background: white;
                border-radius: 10px;
                margin-bottom: 20px;
                transition: transform 0.3s ease;
                text-decoration: none;
                color: #333;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
            
            .quick-link-item:hover {
                transform: translateY(-5px);
                color: var(--primary-brown);
            }
            
            .quick-link-icon {
                font-size: 2rem;
                color: var(--primary-brown);
                margin-bottom: 15px;
            }
        </style>
    @endpush
</x-web.layout>