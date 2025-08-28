<!-- Mini Header (Hidden on Mobile) -->
<div class="mini-header d-none d-lg-block">
    <div class="container-fluid container-xxl">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="contact-info">
                    <div class="">
                        <i class="fas fa-phone"></i>
                        <a href="tel:+9414823126">+91 9414 823 126</a>
                    </div>
                    <div class="">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:info@aasthamultispecialityhospital.in">info@aasthamultispecialityhospital.in</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="social-links">
                    <a href="#facebook" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#instagram" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#youtube" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="#linkedin" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#twitter" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Bar (Initially Hidden) -->
<div class="search-bar-container" id="searchBarContainer">
    <div class="container-fluid container-xxl">
        <div class="search-bar-content">
            <div class="search-input-wrapper">
                <input type="text" class="search-input" placeholder="Search for services, doctors, treatments..." id="searchInput" />
                <button class="search-btn" type="button" id="searchBtn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <button class="search-close" id="searchClose">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</div>

<!-- Main Horizontal Navigation -->
<nav class="main-navbar">
    <div class="container-fluid container-xxl text-right">
        <div class="row align-items-center w-100">
            <div class="col-lg-2 col-6">
                <a class="navbar-brand" href="home">
                    <img src="img/logos/logo.png" alt="Aastha Hospital Logo" class="logo-img" />
                </a>
            </div>

            <div class="col-lg-7 d-none d-lg-block">
                <ul class="navbar-nav mx-auto">
                    <!-- About Us Dropdown -->
                    <li class="nav-item dropdown-container">
                        <a class="nav-link dropdown-toggle" href="javascript:0;" id="aboutDropdown" role="button">
                            About Us
                        </a>
                        <div class="dropdown-menu-custom" id="aboutDropdownMenu">
                            <div class="dropdown-content">
                                <a class="dropdown-item" href="{{ route('home','about-us') }}"> <i class="fas fa-info-circle me-2"></i>About Us </a>
                                <a class="dropdown-item" href="{{ route('home','vision') }}"> <i class="fas fa-eye me-2"></i>Mission & Vision </a>
                                <a class="dropdown-item" href="news-and-media"> <i class="fas fa-newspaper me-2"></i>News & Media </a>
                                <a class="dropdown-item" href="{{ route('web.doctors.our-teams') }}"> <i class="fas fa-users me-2"></i>Our Team </a>
                                <a class="dropdown-item" href="{{ route('web.doctors.index') }}"> <i class="fas fa-user-md me-2"></i>Our Doctors </a>
                            </div>
                        </div>
                    </li>

                    <!-- Services Megamenu -->
                    <li class="nav-item megamenu-container">
                        <a class="nav-link" href="our-services" id="servicesDropdown">
                            Our Services
                        </a>
                        <!-- Services Megamenu -->
                        <div class="megamenu-dropdown" id="servicesDropdownMenu">
                            <div class="megamenu-content">
                                <div class="container-fluid px-0">
                                    <div class="row g-0">
                                        <!-- Left Side - Main Categories -->
                                        <div class="col-lg-4">
                                            <div class="megamenu-sidebar">
                                                <div class="sidebar-header">
                                                    <h5><i class="fas fa-stethoscope me-2"></i>Our Services</h5>
                                                </div>
                                                <ul class="service-categories">
                                                    @php
                                                        $firstCategorySlug = isset($service_categories[0]) ? $service_categories[0]['Slug'] : '';
                                                    @endphp
                                                    @foreach($service_categories as $index => $category)
                                                        <li class="category-item {{ $index === 0 ? 'active' : '' }}" data-category="{{ $category['Slug'] }}">
                                                            <a href="#{{ $category['Slug'] }}">
                                                                <i class="{{ $category['Icon'] }} me-2"></i>
                                                                {{ $category['Title'] }}
                                                                <i class="fas fa-chevron-right ms-auto"></i>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Right Side - Subcategories -->
                                        <div class="col-lg-8">
                                            <div class="megamenu-subcategories">
                                                @foreach($service_categories as $index => $category)
                                                    <div class="subcategory-content {{ $index === 0 ? 'active' : '' }}" id="{{ $category['Slug'] }}-content">
                                                        <div class="subcategory-header">
                                                            <h6>
                                                                <i class="{{ $category['Icon'] }} me-2"></i>
                                                                {{ $category['Title'] }}
                                                            </h6>
                                                            @if(!empty($category['Subtitle']))
                                                                <p class="text-muted">{{ $category['Subtitle'] }}</p>
                                                            @endif
                                                        </div>
                                                        @if(!empty($category['service']) && count($category['service']) > 0)
                                                            @php
                                                                $children = $category['service'];
                                                                $half = ceil(count($children) / 2);
                                                                $chunks = array_chunk($children, $half);
                                                            @endphp
                                                            <div class="row g-3">
                                                                @foreach($chunks as $chunk)
                                                                    <div class="col-md-6">
                                                                        <ul class="subcategory-list">
                                                                            @foreach($chunk as $child)
                                                                                <li>
                                                                                    <a href="{{ route('web.services.detail', $child['slug']) }}">
                                                                                        {{-- No icon in child, so skip icon --}}
                                                                                        {{ $child['title'] }}
                                                                                    </a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <div class="row g-3">
                                                                <div class="col-12">
                                                                    <p class="text-muted">No subcategories available.</p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Patient Resources Dropdown -->
                    <li class="nav-item dropdown-container">
                        <a class="nav-link dropdown-toggle" href="javascript:0;" id="patientDropdown" role="button">
                            Patient Resources
                        </a>
                        <div class="dropdown-menu-custom" id="patientDropdownMenu">
                            <div class="dropdown-content">
                                <a class="dropdown-item" href="case-studies"> <i class="fas fa-file-medical me-2"></i>Case Studies </a>
                                <a class="dropdown-item" href="testimonials"> <i class="fas fa-quote-left me-2"></i>Testimonials </a>
                                <a class="dropdown-item" href="faqs"> <i class="fas fa-question-circle me-2"></i>FAQs </a>
                                <a class="dropdown-item" href="second-opinion"> <i class="fas fa-user-md me-2"></i>Second Opinion </a>
                                <a class="dropdown-item" href="contact-us"> <i class="fas fa-phone me-2"></i>Contact with Us </a>
                            </div>
                        </div>
                    </li>

                    <!-- Careers -->
                    <li class="nav-item">
                        <a class="nav-link" href="careers">
                            Careers
                        </a>
                    </li>

                    <!-- Blogs -->
                    <li class="nav-item">
                        <a class="nav-link" href="blogs">
                            Blogs
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3 col-6 text-end">
                <div class="header-actions">
                    <button class="search-toggle d-none d-lg-inline-flex" id="searchToggle">
                        <i class="fas fa-search"></i>
                    </button>
                    <a href="book-an-appointment" class="btn-demo d-none d-lg-inline-flex">
                        <i class="fas fa-calendar-alt"></i>
                        Book An Appointment
                    </a>
                    <div class="mobile-actions d-lg-none">
                        <button class="mobile-search-toggle float-right" id="mobileSearchToggle" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                        <button class="mobile-menu-toggle" type="button" id="mobileMenuToggle">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay d-lg-none" id="mobileMenuOverlay"></div>

<!-- Mobile Menu Container -->
<div class="mobile-menu-container d-lg-none" id="mobileMenuContainer">
    <!-- Mobile Menu Header -->
    <div class="mobile-menu-header">
        <a href="home" class="mobile-menu-logo">
            <img src="img/logos/logo.png" alt="Aastha Hospital Logo" class="mobile-logo-img" />
        </a>
        <button class="mobile-menu-close" id="mobileMenuClose">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Book Demo Section -->
    <div class="mobile-demo-section">
        <a href="book-an-appointment" class="btn-demo">
            <i class="fas fa-calendar-alt"></i>
            Book An Appointment
        </a>
    </div>

    <!-- Categories Section -->
    <div class="mobile-categories-section">
        <div class="mobile-category-item">
            <a href="#" class="mobile-category-link" id="mobileAboutToggle">
                <div class="d-flex align-items-center">
                    <div class="mobile-category-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    About Us
                </div>
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
        <div class="mobile-category-item">
            <a href="#" class="mobile-category-link" id="mobileServicesToggle">
                <div class="d-flex align-items-center">
                    <div class="mobile-category-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    Our Services
                </div>
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
        <div class="mobile-category-item">
            <a href="#" class="mobile-category-link" id="mobilePatientToggle">
                <div class="d-flex align-items-center">
                    <div class="mobile-category-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    Patient Resources
                </div>
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
        <div class="mobile-category-item">
            <a href="careers" class="mobile-category-link">
                <div class="d-flex align-items-center">
                    <div class="mobile-category-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    Career
                </div>
            </a>
        </div>
        <div class="mobile-category-item">
            <a href="blogs" class="mobile-category-link">
                <div class="d-flex align-items-center">
                    <div class="mobile-category-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    Blogs
                </div>
            </a>
        </div>
    </div>

    <!-- Enhanced Contact Section -->
    <div class="mobile-contact-section">
        <h6 class="mobile-contact-title">Get In Touch</h6>
        <div class="mobile-contact-grid">
            <div class="mobile-contact-item">
                <div class="mobile-contact-icon phone">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div class="mobile-contact-info">
                    <h6>Emergency Helpline</h6>
                    <p>+91 9414 823 126</p>
                    <small>Available 24/7</small>
                </div>
            </div>
            <div class="mobile-contact-item">
                <div class="mobile-contact-icon email">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="mobile-contact-info">
                    <h6>Email Support</h6>
                    <p>info@aasthamultispecialityhospital.in</p>
                    <small>Quick Response</small>
                </div>
            </div>
            <div class="mobile-contact-item">
                <div class="mobile-contact-icon location">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="mobile-contact-info">
                    <h6>Pratap Nagar, Sector 19, Sanganer</h6>
                    <p>Jaipur, Rajasthan</p>
                    <small>Visit Us Today</small>
                </div>
            </div>
            <div class="mobile-contact-item">
                <div class="mobile-contact-icon whatsapp">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <div class="mobile-contact-info">
                    <h6>WhatsApp Chat</h6>
                    <p>+91 9414 823 126</p>
                    <small>Instant Support</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Social Media Section -->
    <div class="mobile-social-section">
        <h6 class="mobile-social-title">Follow Us</h6>
        <div class="mobile-social-links">
            <a href="#facebook" class="mobile-social-link facebook" title="Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#instagram" class="mobile-social-link instagram" title="Instagram">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="#youtube" class="mobile-social-link youtube" title="YouTube">
                <i class="fab fa-youtube"></i>
            </a>
            <a href="#linkedin" class="mobile-social-link linkedin" title="LinkedIn">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="#twitter" class="mobile-social-link twitter" title="Twitter">
                <i class="fab fa-twitter"></i>
            </a>
        </div>
    </div>
</div>

<!-- Mobile About Screen -->
<div class="mobile-solutions-screen d-lg-none" id="mobileAboutScreen">
    <div class="mobile-solutions-header">
        <button class="mobile-solutions-back" id="mobileAboutBack">
            <i class="fas fa-arrow-left"></i>
        </button>
        <h5 class="mobile-solutions-title"><i class="fas fa-info-circle"></i>About Us</h5>
    </div>
    <div class="mobile-solutions-content">
        <div class="mobile-submenu-section">
            <ul class="mobile-submenu-links">
                <li>
                    <a href="about-us"><i class="fas fa-info-circle me-2"></i>About Us</a>
                </li>
                <li>
                    <a href="mission-and-vision"><i class="fas fa-eye me-2"></i>Mission & Vision</a>
                </li>
                <li>
                    <a href="news-and-media"><i class="fas fa-newspaper me-2"></i>News & Media</a>
                </li>
                <li>
                    <a href="our-teams"><i class="fas fa-users me-2"></i>Our Team</a>
                </li>
                <li>
                    <a href="our-doctors"><i class="fas fa-user-md me-2"></i>Our Doctors</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Mobile Services Screen -->
<div class="mobile-solutions-screen d-lg-none" id="mobileServicesScreen">
    <div class="mobile-solutions-header">
        <button class="mobile-solutions-back" id="mobileServicesBack">
            <i class="fas fa-arrow-left"></i>
        </button>
        <h5 class="mobile-solutions-title"><i class="fas fa-stethoscope"></i>Our Services</h5>
    </div>
    <div class="mobile-solutions-content">
        <div class="mobile-submenu-section">
            <div class="mobile-submenu-header" data-category="pediatrics">
                <div class="d-flex align-items-center">
                    <i class="fas fa-baby me-2"></i>
                    Pediatrics & Child Care
                </div>
                <div class="mobile-submenu-icon">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
            <div class="mobile-subcategory-content" id="mobile-pediatrics-content">
                <ul class="mobile-submenu-links">
                    <li>
                        <a href="#general-pediatrics"><i class="fas fa-child me-2"></i>General Pediatrics</a>
                    </li>
                    <li>
                        <a href="#neonatology"><i class="fas fa-baby-carriage me-2"></i>Neonatology</a>
                    </li>
                    <li>
                        <a href="#pediatric-icu"><i class="fas fa-procedures me-2"></i>Pediatric ICU</a>
                    </li>
                    <li>
                        <a href="#child-vaccination"><i class="fas fa-syringe me-2"></i>Child Vaccination</a>
                    </li>
                    <li>
                        <a href="#pediatric-surgery"><i class="fas fa-cut me-2"></i>Pediatric Surgery</a>
                    </li>
                    <li>
                        <a href="#child-nutrition"><i class="fas fa-apple-alt me-2"></i>Child Nutrition</a>
                    </li>
                    <li>
                        <a href="#developmental-care"><i class="fas fa-brain me-2"></i>Developmental Care</a>
                    </li>
                    <li>
                        <a href="#pediatric-emergency"><i class="fas fa-first-aid me-2"></i>Pediatric Emergency</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mobile-submenu-section">
            <div class="mobile-submenu-header" data-category="womens-health">
                <div class="d-flex align-items-center">
                    <i class="fas fa-female me-2"></i>
                    Women's Health
                </div>
                <div class="mobile-submenu-icon">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
            <div class="mobile-subcategory-content" id="mobile-womens-health-content">
                <ul class="mobile-submenu-links">
                    <li>
                        <a href="#obstetrics"><i class="fas fa-baby me-2"></i>Obstetrics</a>
                    </li>
                    <li>
                        <a href="#gynecology"><i class="fas fa-female me-2"></i>Gynecology</a>
                    </li>
                    <li>
                        <a href="#fertility-treatment"><i class="fas fa-heart me-2"></i>Fertility Treatment</a>
                    </li>
                    <li>
                        <a href="#prenatal-care"><i class="fas fa-baby-carriage me-2"></i>Prenatal Care</a>
                    </li>
                    <li>
                        <a href="#maternity-care"><i class="fas fa-home me-2"></i>Maternity Care</a>
                    </li>
                    <li>
                        <a href="#womens-surgery"><i class="fas fa-cut me-2"></i>Women's Surgery</a>
                    </li>
                    <li>
                        <a href="#breast-care"><i class="fas fa-ribbon me-2"></i>Breast Care</a>
                    </li>
                    <li>
                        <a href="#menopause-care"><i class="fas fa-leaf me-2"></i>Menopause Care</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mobile-submenu-section">
            <div class="mobile-submenu-header" data-category="surgery">
                <div class="d-flex align-items-center">
                    <i class="fas fa-cut me-2"></i>
                    Surgical Services
                </div>
                <div class="mobile-submenu-icon">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
            <div class="mobile-subcategory-content" id="mobile-surgery-content">
                <ul class="mobile-submenu-links">
                    <li>
                        <a href="#general-surgery"><i class="fas fa-cut me-2"></i>General Surgery</a>
                    </li>
                    <li>
                        <a href="#laparoscopic-surgery"><i class="fas fa-microscope me-2"></i>Laparoscopic Surgery</a>
                    </li>
                    <li>
                        <a href="#orthopedic-surgery"><i class="fas fa-bone me-2"></i>Orthopedic Surgery</a>
                    </li>
                    <li>
                        <a href="#cardiac-surgery"><i class="fas fa-heartbeat me-2"></i>Cardiac Surgery</a>
                    </li>
                    <li>
                        <a href="#neurosurgery"><i class="fas fa-brain me-2"></i>Neurosurgery</a>
                    </li>
                    <li>
                        <a href="#plastic-surgery"><i class="fas fa-magic me-2"></i>Plastic Surgery</a>
                    </li>
                    <li>
                        <a href="#ent-surgery"><i class="fas fa-head-side-mask me-2"></i>ENT Surgery</a>
                    </li>
                    <li>
                        <a href="#eye-surgery"><i class="fas fa-eye me-2"></i>Eye Surgery</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mobile-submenu-section">
            <div class="mobile-submenu-header" data-category="diagnostics">
                <div class="d-flex align-items-center">
                    <i class="fas fa-microscope me-2"></i>
                    Diagnostics & Imaging
                </div>
                <div class="mobile-submenu-icon">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
            <div class="mobile-subcategory-content" id="mobile-diagnostics-content">
                <ul class="mobile-submenu-links">
                    <li>
                        <a href="#pathology"><i class="fas fa-vial me-2"></i>Pathology Lab</a>
                    </li>
                    <li>
                        <a href="#radiology"><i class="fas fa-x-ray me-2"></i>Radiology</a>
                    </li>
                    <li>
                        <a href="#ct-scan"><i class="fas fa-circle me-2"></i>CT Scan</a>
                    </li>
                    <li>
                        <a href="#mri"><i class="fas fa-magnet me-2"></i>MRI</a>
                    </li>
                    <li>
                        <a href="#ultrasound"><i class="fas fa-wave-square me-2"></i>Ultrasound</a>
                    </li>
                    <li>
                        <a href="#ecg"><i class="fas fa-heartbeat me-2"></i>ECG</a>
                    </li>
                    <li>
                        <a href="#blood-tests"><i class="fas fa-tint me-2"></i>Blood Tests</a>
                    </li>
                    <li>
                        <a href="#health-checkup"><i class="fas fa-clipboard-check me-2"></i>Health Checkup</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mobile-submenu-section">
            <div class="mobile-submenu-header" data-category="emergency">
                <div class="d-flex align-items-center">
                    <i class="fas fa-ambulance me-2"></i>
                    Emergency Care
                </div>
                <div class="mobile-submenu-icon">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
            <div class="mobile-subcategory-content" id="mobile-emergency-content">
                <ul class="mobile-submenu-links">
                    <li>
                        <a href="#emergency-room"><i class="fas fa-hospital me-2"></i>Emergency Room</a>
                    </li>
                    <li>
                        <a href="#trauma-care"><i class="fas fa-first-aid me-2"></i>Trauma Care</a>
                    </li>
                    <li>
                        <a href="#critical-care"><i class="fas fa-procedures me-2"></i>Critical Care ICU</a>
                    </li>
                    <li>
                        <a href="#ambulance"><i class="fas fa-ambulance me-2"></i>Ambulance Service</a>
                    </li>
                    <li>
                        <a href="#cardiac-emergency"><i class="fas fa-heartbeat me-2"></i>Cardiac Emergency</a>
                    </li>
                    <li>
                        <a href="#stroke-care"><i class="fas fa-brain me-2"></i>Stroke Care</a>
                    </li>
                    <li>
                        <a href="#poison-control"><i class="fas fa-shield-alt me-2"></i>Poison Control</a>
                    </li>
                    <li>
                        <a href="#burn-care"><i class="fas fa-fire me-2"></i>Burn Care</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mobile-submenu-section">
            <div class="mobile-submenu-header" data-category="specialties">
                <div class="d-flex align-items-center">
                    <i class="fas fa-heart me-2"></i>
                    Medical Specialties
                </div>
                <div class="mobile-submenu-icon">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
            <div class="mobile-subcategory-content" id="mobile-specialties-content">
                <ul class="mobile-submenu-links">
                    <li>
                        <a href="#cardiology"><i class="fas fa-heartbeat me-2"></i>Cardiology</a>
                    </li>
                    <li>
                        <a href="#neurology"><i class="fas fa-brain me-2"></i>Neurology</a>
                    </li>
                    <li>
                        <a href="#orthopedics"><i class="fas fa-bone me-2"></i>Orthopedics</a>
                    </li>
                    <li>
                        <a href="#dermatology"><i class="fas fa-hand-paper me-2"></i>Dermatology</a>
                    </li>
                    <li>
                        <a href="#gastroenterology"><i class="fas fa-stomach me-2"></i>Gastroenterology</a>
                    </li>
                    <li>
                        <a href="#pulmonology"><i class="fas fa-lungs me-2"></i>Pulmonology</a>
                    </li>
                    <li>
                        <a href="#endocrinology"><i class="fas fa-dna me-2"></i>Endocrinology</a>
                    </li>
                    <li>
                        <a href="#psychiatry"><i class="fas fa-head-side-brain me-2"></i>Psychiatry</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Patient Resources Screen -->
<div class="mobile-solutions-screen d-lg-none" id="mobilePatientScreen">
    <div class="mobile-solutions-header">
        <button class="mobile-solutions-back" id="mobilePatientBack">
            <i class="fas fa-arrow-left"></i>
        </button>
        <h5 class="mobile-solutions-title"><i class="fas fa-users"></i>Patient Resources</h5>
    </div>
    <div class="mobile-solutions-content">
        <div class="mobile-submenu-section">
            <ul class="mobile-submenu-links">
                <li>
                    <a href="case-studies"><i class="fas fa-file-medical me-2"></i>Case Studies</a>
                </li>
                <li>
                    <a href="testimonials"><i class="fas fa-quote-left me-2"></i>Testimonials</a>
                </li>
                <li>
                    <a href="faqs"><i class="fas fa-question-circle me-2"></i>FAQs</a>
                </li>
                <li>
                    <a href="second-opinion"><i class="fas fa-user-md me-2"></i>Second Opinion</a>
                </li>
                <li>
                    <a href="contact-us"><i class="fas fa-phone me-2"></i>Contact with Us</a>
                </li>
            </ul>
        </div>
    </div>
</div>
