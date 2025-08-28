<x-web.layout>
   
    <!-- Page Header -->
    <section class="appointment-header">
        <div class="container">
            <h1 class="header-title">
                <i class="fas fa-calendar-plus me-3"></i>Book Your Appointment
            </h1>
            <p class="header-subtitle">Schedule your consultation with our expert medical professionals</p>
        </div>
    </section>

    <!-- Appointment Form -->
    <section class="py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-xl-10">
                    <div class="appointment-form-wrapper">
                        <!-- Success Message -->
                        <div class="alert alert-success success-notification" id="successNotification">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>Appointment Booked Successfully!</strong> We will contact you shortly to confirm your appointment.
                        </div>

                        <!-- Error Message -->
                        <div class="alert alert-danger error-notification" id="errorNotification">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Error:</strong> <span id="errorNotificationText">Please fill in all required fields correctly.</span>
                        </div>

                        <form id="hospitalAppointmentForm" novalidate>
                            <div class="form-main-container" id="formMainContainer">
                                <div class="row">
                                    <!-- Form Fields Section -->
                                    <div class="col-lg-12 form-fields-section" id="formFieldsSection">
                                        <!-- Appointment Details Section -->
                                        <div class="mb-4">
                                            <h3 class="form-section-header">
                                                <i class="fas fa-calendar-alt"></i>Appointment Details
                                            </h3>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-field-container">
                                                        <label for="hospitalLocation" class="form-label fw-semibold text-dark">Select Location <span class="text-danger">*</span></label>
                                                        <select class="form-select form-control" id="hospitalLocation" name="location" required>
                                                            <option value="">Choose Location</option>
                                                            <option value="jaipur">Jaipur</option>
                                                        </select>
                                                        <div class="validation-error-message" id="hospitalLocationError">
                                                            <i class="fas fa-exclamation-circle"></i>Please select a location.
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-field-container">
                                                        <label for="medicalSpecialitySearchInput" class="form-label fw-semibold text-dark">Select Speciality <span class="text-danger">*</span></label>
                                                        <div class="medical-search-dropdown-wrapper">
                                                            <input type="text" class="form-control medical-search-input-field" id="medicalSpecialitySearchInput" placeholder="Search speciality..." autocomplete="off">
                                                            <div class="medical-dropdown-options-list" id="specialityDropdownList">
                                                                <!-- Options will be populated by JavaScript -->
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id="selectedSpecialityValue" name="speciality" required>
                                                        <div class="validation-error-message" id="selectedSpecialityValueError">
                                                            <i class="fas fa-exclamation-circle"></i>Please select a speciality.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-field-container">
                                                        <label for="consultingDoctorSearchInput" class="form-label fw-semibold text-dark">Select Doctor <span class="text-danger">*</span></label>
                                                        <div class="medical-search-dropdown-wrapper">
                                                            <input type="text" class="form-control medical-search-input-field" id="consultingDoctorSearchInput" placeholder="First select a speciality..." disabled autocomplete="off">
                                                            <div class="medical-dropdown-options-list" id="doctorDropdownList">
                                                                <!-- Options will be populated by JavaScript -->
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id="selectedDoctorValue" name="doctor" required>
                                                        <div class="validation-error-message" id="selectedDoctorValueError">
                                                            <i class="fas fa-exclamation-circle"></i>Please select a doctor.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-field-container">
                                                        <label for="consultationDate" class="form-label fw-semibold text-dark">Appointment Date <span class="text-danger">*</span></label>
                                                        <input type="date" class="form-control" id="consultationDate" name="date" required>
                                                        <div class="validation-error-message" id="consultationDateError">
                                                            <i class="fas fa-exclamation-circle"></i>Please select an appointment date.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-field-container">
                                                        <label for="appointmentTime" class="form-label fw-semibold text-dark">Appointment Time <span class="text-danger">*</span></label>
                                                        <select class="form-select form-control" id="appointmentTime" name="timeSlot" required>
                                                            <option value="">Select Time</option>
                                                            <option value="11:00">11:00 AM</option>
                                                            <option value="11:30">11:30 AM</option>
                                                            <option value="12:00">12:00 PM</option>
                                                            <option value="12:30">12:30 PM</option>
                                                            <option value="14:00">02:00 PM</option>
                                                            <option value="14:30">02:30 PM</option>
                                                            <option value="15:00">03:00 PM</option>
                                                            <option value="15:30">03:30 PM</option>
                                                            <option value="16:00">04:00 PM</option>
                                                            <option value="16:30">04:30 PM</option>
                                                            <option value="17:00">05:00 PM</option>
                                                            <option value="17:30">05:30 PM</option>
                                                        </select>
                                                        <div class="validation-error-message" id="appointmentTimeError">
                                                            <i class="fas fa-exclamation-circle"></i>Please select an appointment time.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Personal Information Section -->
                                        <div class="mb-4">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-field-container">
                                                        <label for="patientFirstName" class="form-label fw-semibold text-dark">First Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="patientFirstName" name="firstName" required>
                                                        <div class="validation-error-message" id="patientFirstNameError">
                                                            <i class="fas fa-exclamation-circle"></i>Please enter your first name.
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-field-container">
                                                        <label for="patientLastName" class="form-label fw-semibold text-dark">Last Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="patientLastName" name="lastName" required>
                                                        <div class="validation-error-message" id="patientLastNameError">
                                                            <i class="fas fa-exclamation-circle"></i>Please enter your last name.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-field-container">
                                                        <label for="patientEmailAddress" class="form-label fw-semibold text-dark">Email Address <span class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" id="patientEmailAddress" name="email" required>
                                                        <div class="validation-error-message" id="patientEmailAddressError">
                                                            <i class="fas fa-exclamation-circle"></i>Please enter a valid email address.
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-field-container">
                                                        <label for="patientMobileNumber" class="form-label fw-semibold text-dark">Mobile Number <span class="text-danger">*</span></label>
                                                        <input type="tel" class="form-control" id="patientMobileNumber" name="mobile" required pattern="[0-9]{10}">
                                                        <div class="validation-error-message" id="patientMobileNumberError">
                                                            <i class="fas fa-exclamation-circle"></i>Please enter a valid 10-digit mobile number.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-field-container">
                                                <label for="consultationReason" class="form-label fw-semibold text-dark">Reason for Appointment <span class="text-danger">*</span></label>
                                                <textarea class="form-control" id="consultationReason" name="reason" rows="4" required placeholder="Please describe your symptoms or reason for consultation..."></textarea>
                                                <div class="validation-error-message" id="consultationReasonError">
                                                    <i class="fas fa-exclamation-circle"></i>Please provide a reason for your appointment.
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Terms and Conditions -->
                                        <div class="mb-4">
                                            <div class="terms-agreement-section">
                                                <div class="form-field-container">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="termsAgreement" name="terms" required>
                                                        <label class="form-check-label" for="termsAgreement">
                                                            I agree to the <a href="https://example.com/terms" class="terms-policy-link" target="_blank">Terms and Conditions</a> and <a href="https://example.com/privacy" class="terms-policy-link" target="_blank">Privacy Policy</a>. I understand that this appointment request is subject to availability and confirmation from the hospital.
                                                        </label>
                                                    </div>
                                                    <div class="validation-error-message" id="termsAgreementError">
                                                        <i class="fas fa-exclamation-circle"></i>You must agree to the terms and conditions.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- reCAPTCHA -->
                                        <div class="d-flex mb-4">
                                            <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="text-left vh-100">
                                            <button type="submit" class="btn btn-demo btn-lg" id="appointmentSubmitButton">
                                                <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                                                <i class="fas fa-calendar-check me-2"></i>Book Appointment
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Doctor Profile Section -->
                                    <div class="col-lg-4 doctor-profile-section" id="doctorProfileSection">
                                        <div class="doctor-profile-details-card">
                                            <div class="text-center mb-3">
                                                <img src="/placeholder.svg" alt="Doctor Image" class="doctor-profile-image" id="doctorProfileImage">
                                            </div>
                                            <div class="text-center">
                                                <div class="doctor-profile-name" id="doctorProfileName"></div>
                                                <div class="doctor-profile-department" id="doctorProfileDepartment"></div>
                                                <div class="text-center mb-3">
                                                    <span class="doctor-profile-experience-text" id="doctorProfileExperience">
                                                        <i class="fas fa-user-md"></i>
                                                        <span></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <hr class="my-3">
                                            <div class="text-center">
                                                <div class="text-primary fw-bold">Available</div>
                                                <small class="text-muted">Mon-Sat (9:00 AM - 6:00 PM)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Scripts -->
     @push('js')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script>
            // Professional Hospital Appointment Booking System
            const ProfessionalHospitalAppointmentBookingSystem = {
                // Medical speciality database
                medicalSpecialityDatabase: [
                    { value: 'cardiology', text: 'Cardiology' },
                    { value: 'dermatology', text: 'Dermatology' },
                    { value: 'endocrinology', text: 'Endocrinology' },
                    { value: 'gastroenterology', text: 'Gastroenterology' },
                    { value: 'general-medicine', text: 'General Medicine' },
                    { value: 'gynecology', text: 'Gynecology & Obstetrics' },
                    { value: 'neurology', text: 'Neurology' },
                    { value: 'oncology', text: 'Oncology' },
                    { value: 'orthopedics', text: 'Orthopedics' },
                    { value: 'pediatrics', text: 'Pediatrics' },
                    { value: 'psychiatry', text: 'Psychiatry' },
                    { value: 'pulmonology', text: 'Pulmonology' },
                    { value: 'radiology', text: 'Radiology' },
                    { value: 'surgery', text: 'General Surgery' },
                    { value: 'urology', text: 'Urology' }
                ],

                // Medical doctor database with professional details
                medicalDoctorDatabase: {
                    'cardiology': [
                        { 
                            value: 'dr-rajesh-sharma-cardio', 
                            text: 'Dr. Rajesh Sharma - Cardiologist',
                            name: 'Dr. Rajesh Sharma',
                            department: 'Cardiology',
                            experience: '15+ Years Experience',
                            image: 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
                        },
                        { 
                            value: 'dr-priya-patel-cardio', 
                            text: 'Dr. Priya Patel - Interventional Cardiologist',
                            name: 'Dr. Priya Patel',
                            department: 'Interventional Cardiology',
                            experience: '12+ Years Experience',
                            image: 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
                        },
                        { 
                            value: 'dr-amit-gupta-cardio', 
                            text: 'Dr. Amit Gupta - Cardiac Surgeon',
                            name: 'Dr. Amit Gupta',
                            department: 'Cardiac Surgery',
                            experience: '20+ Years Experience',
                            image: 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
                        }
                    ],
                    'dermatology': [
                        { 
                            value: 'dr-sunita-gupta-derma', 
                            text: 'Dr. Sunita Gupta - Dermatologist',
                            name: 'Dr. Sunita Gupta',
                            department: 'Dermatology',
                            experience: '10+ Years Experience',
                            image: 'https://images.unsplash.com/photo-1594824475317-d3e2b7b3e3e3?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
                        },
                        { 
                            value: 'dr-amit-singh-derma', 
                            text: 'Dr. Amit Singh - Cosmetic Dermatologist',
                            name: 'Dr. Amit Singh',
                            department: 'Cosmetic Dermatology',
                            experience: '8+ Years Experience',
                            image: 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
                        }
                    ],
                    'pediatrics': [
                        { 
                            value: 'dr-nandkishor-kabra-pedia', 
                            text: 'Dr. Nandkishor Kabra - Pediatrician',
                            name: 'Dr. Nandkishor Kabra',
                            department: 'Pediatrics & Neonatology',
                            experience: '25+ Years Experience',
                            image: 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
                        },
                        { 
                            value: 'dr-pooja-saxena-pedia', 
                            text: 'Dr. Pooja Saxena - Child Specialist',
                            name: 'Dr. Pooja Saxena',
                            department: 'Pediatrics',
                            experience: '12+ Years Experience',
                            image: 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
                        }
                    ],
                    'general-medicine': [
                        { 
                            value: 'dr-ravi-agarwal-gm', 
                            text: 'Dr. Ravi Agarwal - General Physician',
                            name: 'Dr. Ravi Agarwal',
                            department: 'General Medicine',
                            experience: '18+ Years Experience',
                            image: 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
                        }
                    ],
                    'gynecology': [
                        { 
                            value: 'dr-sushma-verma-gyno', 
                            text: 'Dr. Sushma Verma - Gynecologist',
                            name: 'Dr. Sushma Verma',
                            department: 'Gynecology & Obstetrics',
                            experience: '16+ Years Experience',
                            image: 'https://images.unsplash.com/photo-1594824475317-d3e2b7b3e3e3?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
                        }
                    ],
                    'orthopedics': [
                        { 
                            value: 'dr-deepak-bansal-ortho', 
                            text: 'Dr. Deepak Bansal - Orthopedic Surgeon',
                            name: 'Dr. Deepak Bansal',
                            department: 'Orthopedics',
                            experience: '14+ Years Experience',
                            image: 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
                        }
                    ]
                },

                // Initialize the professional appointment booking system
                initializeProfessionalAppointmentBookingSystem: function() {
                    this.setMinimumAppointmentDate();
                    this.initializeMedicalSearchDropdowns();
                    this.bindProfessionalFormEventListeners();
                    this.setupRealTimeValidation();
                },

                // Set minimum date to today
                setMinimumAppointmentDate: function() {
                    const todayDate = new Date().toISOString().split('T')[0];
                    const dateInput = document.getElementById('consultationDate');
                    if (dateInput) {
                        dateInput.setAttribute('min', todayDate);
                    }
                },

                // Setup real-time validation
                setupRealTimeValidation: function() {
                    const fields = [
                        'hospitalLocation',
                        'patientFirstName', 
                        'patientLastName',
                        'patientEmailAddress',
                        'patientMobileNumber',
                        'consultationDate',
                        'appointmentTime',
                        'consultationReason',
                        'termsAgreement'
                    ];

                    fields.forEach(fieldId => {
                        const element = document.getElementById(fieldId);
                        if (element) {
                            element.addEventListener('blur', () => this.validateSingleField(fieldId));
                            element.addEventListener('change', () => this.validateSingleField(fieldId));
                            if (element.type === 'text' || element.type === 'email' || element.type === 'tel' || element.tagName === 'TEXTAREA') {
                                element.addEventListener('input', () => this.clearFieldError(fieldId));
                            }
                        }
                    });
                },

                // Validate single field
                validateSingleField: function(fieldId) {
                    const element = document.getElementById(fieldId);
                    const errorElement = document.getElementById(fieldId + 'Error');
                    
                    if (!element || !errorElement) return;

                    let isValid = true;
                    let errorMessage = '';

                    // Check if field is empty
                    if (!element.value || (element.type === 'checkbox' && !element.checked)) {
                        isValid = false;
                        errorMessage = this.getFieldErrorMessage(fieldId, 'required');
                    } else {
                        // Additional validation based on field type
                        switch (fieldId) {
                            case 'patientEmailAddress':
                                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                if (!emailPattern.test(element.value)) {
                                    isValid = false;
                                    errorMessage = 'Please enter a valid email address.';
                                }
                                break;
                            case 'patientMobileNumber':
                                const phonePattern = /^[0-9]{10}$/;
                                if (!phonePattern.test(element.value.replace(/\s/g, ''))) {
                                    isValid = false;
                                    errorMessage = 'Please enter a valid 10-digit mobile number.';
                                }
                                break;
                            case 'consultationDate':
                                const selectedDate = new Date(element.value);
                                const today = new Date();
                                today.setHours(0, 0, 0, 0);
                                if (selectedDate < today) {
                                    isValid = false;
                                    errorMessage = 'Please select a future date.';
                                }
                                break;
                        }
                    }

                    if (isValid) {
                        this.clearFieldError(fieldId);
                    } else {
                        this.showFieldError(fieldId, errorMessage);
                    }

                    return isValid;
                },

                // Get field error message
                getFieldErrorMessage: function(fieldId, type) {
                    const messages = {
                        'hospitalLocation': 'Please select a location.',
                        'patientFirstName': 'Please enter your first name.',
                        'patientLastName': 'Please enter your last name.',
                        'patientEmailAddress': 'Please enter a valid email address.',
                        'patientMobileNumber': 'Please enter a valid 10-digit mobile number.',
                        'consultationDate': 'Please select an appointment date.',
                        'appointmentTime': 'Please select an appointment time.',
                        'consultationReason': 'Please provide a reason for your appointment.',
                        'termsAgreement': 'You must agree to the terms and conditions.',
                        'selectedSpecialityValue': 'Please select a speciality.',
                        'selectedDoctorValue': 'Please select a doctor.'
                    };
                    return messages[fieldId] || 'This field is required.';
                },

                // Show field error
                showFieldError: function(fieldId, message) {
                    const element = document.getElementById(fieldId);
                    const errorElement = document.getElementById(fieldId + 'Error');
                    
                    if (element && errorElement) {
                        element.classList.add('form-field-invalid');
                        if (message) {
                            errorElement.innerHTML = '<i class="fas fa-exclamation-circle"></i>' + message;
                        }
                        errorElement.classList.add('show');
                    }
                },

                // Clear field error
                clearFieldError: function(fieldId) {
                    const element = document.getElementById(fieldId);
                    const errorElement = document.getElementById(fieldId + 'Error');
                    
                    if (element && errorElement) {
                        element.classList.remove('form-field-invalid');
                        errorElement.classList.remove('show');
                    }
                },

                // Initialize medical search dropdowns
                initializeMedicalSearchDropdowns: function() {
                    this.populateMedicalSpecialityDropdown();
                    this.setupMedicalSpecialitySearch();
                    this.setupMedicalDoctorSearch();
                },

                // Populate medical speciality dropdown
                populateMedicalSpecialityDropdown: function() {
                    const dropdown = document.getElementById('specialityDropdownList');
                    if (!dropdown) return;

                    dropdown.innerHTML = '';
                    this.medicalSpecialityDatabase.forEach(speciality => {
                        const option = document.createElement('div');
                        option.className = 'medical-dropdown-option-item';
                        option.textContent = speciality.text;
                        option.setAttribute('data-value', speciality.value);
                        option.addEventListener('click', () => this.selectMedicalSpeciality(speciality));
                        dropdown.appendChild(option);
                    });
                },

                // Setup medical speciality search
                setupMedicalSpecialitySearch: function() {
                    const searchInput = document.getElementById('medicalSpecialitySearchInput');
                    const dropdown = document.getElementById('specialityDropdownList');

                    if (!searchInput || !dropdown) return;

                    searchInput.addEventListener('focus', () => {
                        dropdown.style.display = 'block';
                    });

                    searchInput.addEventListener('input', (e) => {
                        const searchTerm = e.target.value.toLowerCase();
                        const options = dropdown.querySelectorAll('.medical-dropdown-option-item');
                        
                        options.forEach(option => {
                            const text = option.textContent.toLowerCase();
                            if (text.includes(searchTerm)) {
                                option.style.display = 'block';
                            } else {
                                option.style.display = 'none';
                            }
                        });
                        
                        dropdown.style.display = 'block';
                        this.clearFieldError('selectedSpecialityValue');
                    });

                    // Close dropdown when clicking outside
                    document.addEventListener('click', (e) => {
                        if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
                            dropdown.style.display = 'none';
                        }
                    });
                },

                // Setup medical doctor search
                setupMedicalDoctorSearch: function() {
                    const searchInput = document.getElementById('consultingDoctorSearchInput');
                    const dropdown = document.getElementById('doctorDropdownList');

                    if (!searchInput || !dropdown) return;

                    searchInput.addEventListener('focus', () => {
                        if (!searchInput.disabled) {
                            dropdown.style.display = 'block';
                        }
                    });

                    searchInput.addEventListener('input', (e) => {
                        const searchTerm = e.target.value.toLowerCase();
                        const options = dropdown.querySelectorAll('.medical-dropdown-option-item');
                        
                        options.forEach(option => {
                            const text = option.textContent.toLowerCase();
                            if (text.includes(searchTerm)) {
                                option.style.display = 'block';
                            } else {
                                option.style.display = 'none';
                            }
                        });
                        
                        if (!searchInput.disabled) {
                            dropdown.style.display = 'block';
                        }
                        this.clearFieldError('selectedDoctorValue');
                    });

                    // Close dropdown when clicking outside
                    document.addEventListener('click', (e) => {
                        if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
                            dropdown.style.display = 'none';
                        }
                    });
                },

                // Select medical speciality
                selectMedicalSpeciality: function(speciality) {
                    const searchInput = document.getElementById('medicalSpecialitySearchInput');
                    const dropdown = document.getElementById('specialityDropdownList');
                    const hiddenInput = document.getElementById('selectedSpecialityValue');

                    if (searchInput) searchInput.value = speciality.text;
                    if (hiddenInput) hiddenInput.value = speciality.value;
                    if (dropdown) dropdown.style.display = 'none';

                    this.clearFieldError('selectedSpecialityValue');
                    this.updateMedicalDoctorDropdown(speciality.value);
                    this.hideDoctorProfileDetails();
                },

                // Update medical doctor dropdown
                updateMedicalDoctorDropdown: function(selectedSpeciality) {
                    const searchInput = document.getElementById('consultingDoctorSearchInput');
                    const dropdown = document.getElementById('doctorDropdownList');

                    if (!searchInput || !dropdown) return;

                    dropdown.innerHTML = '';

                    if (selectedSpeciality && this.medicalDoctorDatabase[selectedSpeciality]) {
                        this.medicalDoctorDatabase[selectedSpeciality].forEach(doctor => {
                            const option = document.createElement('div');
                            option.className = 'medical-dropdown-option-item';
                            option.textContent = doctor.text;
                            option.setAttribute('data-value', doctor.value);
                            option.addEventListener('click', () => this.selectMedicalDoctor(doctor));
                            dropdown.appendChild(option);
                        });
                        
                        searchInput.disabled = false;
                        searchInput.placeholder = 'Search doctor...';
                        searchInput.value = '';
                        document.getElementById('selectedDoctorValue').value = '';
                    } else {
                        searchInput.disabled = true;
                        searchInput.placeholder = 'First select a speciality...';
                        searchInput.value = '';
                        document.getElementById('selectedDoctorValue').value = '';
                    }
                },

                // Select medical doctor
                selectMedicalDoctor: function(doctor) {
                    const searchInput = document.getElementById('consultingDoctorSearchInput');
                    const dropdown = document.getElementById('doctorDropdownList');
                    const hiddenInput = document.getElementById('selectedDoctorValue');

                    if (searchInput) searchInput.value = doctor.text;
                    if (hiddenInput) hiddenInput.value = doctor.value;
                    if (dropdown) dropdown.style.display = 'none';

                    this.clearFieldError('selectedDoctorValue');
                    this.showDoctorProfileDetails(doctor);
                    this.adjustLayoutForDoctorSelection();
                },

                // Adjust layout when doctor is selected
                adjustLayoutForDoctorSelection: function() {
                    const formMainContainer = document.getElementById('formMainContainer');
                    const formFieldsSection = document.getElementById('formFieldsSection');
                    const doctorProfileSection = document.getElementById('doctorProfileSection');

                    if (formMainContainer && formFieldsSection && doctorProfileSection) {
                        // Add class to indicate doctor is selected
                        formMainContainer.classList.add('doctor-selected');
                        
                        // Change form fields to col-lg-8
                        formFieldsSection.className = 'col-lg-8 form-fields-section';
                        
                        // Show doctor profile section
                        doctorProfileSection.style.display = 'block';
                    }
                },

                // Show doctor profile details
                showDoctorProfileDetails: function(doctor) {
                    const doctorImage = document.getElementById('doctorProfileImage');
                    const doctorName = document.getElementById('doctorProfileName');
                    const doctorDepartment = document.getElementById('doctorProfileDepartment');
                    const doctorExperience = document.getElementById('doctorProfileExperience');

                    if (doctorImage) doctorImage.src = doctor.image;
                    if (doctorName) doctorName.textContent = doctor.name;
                    if (doctorDepartment) doctorDepartment.textContent = doctor.department;
                    if (doctorExperience) {
                        doctorExperience.querySelector('span').textContent = doctor.experience;
                    }
                },

                // Hide doctor profile details
                hideDoctorProfileDetails: function() {
                    const formMainContainer = document.getElementById('formMainContainer');
                    const formFieldsSection = document.getElementById('formFieldsSection');
                    const doctorProfileSection = document.getElementById('doctorProfileSection');

                    if (formMainContainer && formFieldsSection && doctorProfileSection) {
                        // Remove class to indicate no doctor selected
                        formMainContainer.classList.remove('doctor-selected');
                        
                        // Change form fields back to col-lg-12
                        formFieldsSection.className = 'col-lg-12 form-fields-section';
                        
                        // Hide doctor profile section
                        doctorProfileSection.style.display = 'none';
                    }
                },

                // Bind professional form event listeners
                bindProfessionalFormEventListeners: function() {
                    const appointmentForm = document.getElementById('hospitalAppointmentForm');
                    if (appointmentForm) {
                        appointmentForm.addEventListener('submit', (event) => {
                            event.preventDefault();
                            this.submitProfessionalAppointmentForm();
                        });
                    }
                },

                // Validate professional appointment form
                validateProfessionalAppointmentForm: function() {
                    let isFormValid = true;

                    // Get all required fields
                    const requiredFields = [
                        'hospitalLocation',
                        'selectedSpecialityValue',
                        'selectedDoctorValue',
                        'consultationDate',
                        'appointmentTime',
                        'patientFirstName',
                        'patientLastName',
                        'patientEmailAddress',
                        'patientMobileNumber',
                        'consultationReason',
                        'termsAgreement'
                    ];

                    requiredFields.forEach(fieldId => {
                        const fieldValid = this.validateSingleField(fieldId);
                        if (!fieldValid) {
                            isFormValid = false;
                        }
                    });

                    return isFormValid;
                },

                // Submit professional appointment form
                submitProfessionalAppointmentForm: function() {
                    if (!this.validateProfessionalAppointmentForm()) {
                        this.displayProfessionalErrorMessage('Please correct the errors below and try again.');
                        // Scroll to first error
                        const firstError = document.querySelector('.validation-error-message.show');
                        if (firstError) {
                            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                        return;
                    }

                    // Check reCAPTCHA
                    if (typeof grecaptcha !== 'undefined') {
                        const recaptchaResponse = grecaptcha.getResponse();
                        if (!recaptchaResponse) {
                            this.displayProfessionalErrorMessage('Please complete the reCAPTCHA verification.');
                            return;
                        }
                    }

                    // Show loading state
                    this.setProfessionalFormLoadingState(true);

                    // Simulate API call
                    setTimeout(() => {
                        this.processProfessionalAppointmentBooking();
                    }, 2000);
                },

                // Process professional appointment booking
                processProfessionalAppointmentBooking: function() {
                    const formData = new FormData(document.getElementById('hospitalAppointmentForm'));
                    const appointmentDetails = {};

                    // Convert FormData to object
                    for (let [key, value] of formData.entries()) {
                        appointmentDetails[key] = value;
                    }

                    // Add selected values
                    appointmentDetails.speciality = document.getElementById('selectedSpecialityValue').value;
                    appointmentDetails.doctor = document.getElementById('selectedDoctorValue').value;
                    appointmentDetails.timeSlot = document.getElementById('appointmentTime').value;

                    console.log('Professional Appointment Details:', appointmentDetails);

                    // Simulate successful booking
                    this.setProfessionalFormLoadingState(false);
                    this.displayProfessionalSuccessMessage();
                    this.resetProfessionalAppointmentForm();
                },

                // Display professional success message
                displayProfessionalSuccessMessage: function() {
                    const successElement = document.getElementById('successNotification');
                    const errorElement = document.getElementById('errorNotification');
                    
                    if (successElement) successElement.style.display = 'block';
                    if (errorElement) errorElement.style.display = 'none';
                    
                    // Scroll to top
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                },

                // Display professional error message
                displayProfessionalErrorMessage: function(message) {
                    const errorTextElement = document.getElementById('errorNotificationText');
                    const errorElement = document.getElementById('errorNotification');
                    const successElement = document.getElementById('successNotification');
                    
                    if (errorTextElement) errorTextElement.textContent = message;
                    if (errorElement) errorElement.style.display = 'block';
                    if (successElement) successElement.style.display = 'none';
                    
                    // Scroll to top
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                },

                // Set professional form loading state
                setProfessionalFormLoadingState: function(isLoading) {
                    const submitButton = document.getElementById('appointmentSubmitButton');
                    const spinner = submitButton.querySelector('.spinner-border');

                    if (isLoading) {
                        submitButton.disabled = true;
                        if (spinner) {
                            spinner.classList.remove('d-none');
                        }
                        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';
                    } else {
                        submitButton.disabled = false;
                        if (spinner) {
                            spinner.classList.add('d-none');
                        }
                        submitButton.innerHTML = '<i class="fas fa-calendar-check me-2"></i>Book Appointment';
                    }
                },

                // Reset professional appointment form
                resetProfessionalAppointmentForm: function() {
                    const formElement = document.getElementById('hospitalAppointmentForm');
                    if (formElement) {
                        formElement.reset();
                    }

                    // Reset search inputs
                    document.getElementById('medicalSpecialitySearchInput').value = '';
                    document.getElementById('consultingDoctorSearchInput').value = '';
                    document.getElementById('consultingDoctorSearchInput').disabled = true;
                    document.getElementById('consultingDoctorSearchInput').placeholder = 'First select a speciality...';

                    // Reset hidden inputs
                    document.getElementById('selectedSpecialityValue').value = '';
                    document.getElementById('selectedDoctorValue').value = '';

                    // Reset dropdowns
                    document.getElementById('specialityDropdownList').style.display = 'none';
                    document.getElementById('doctorDropdownList').style.display = 'none';

                    // Hide doctor details and reset layout
                    this.hideDoctorProfileDetails();

                    // Reset validation classes and errors
                    document.querySelectorAll('.form-field-invalid').forEach(element => {
                        element.classList.remove('form-field-invalid');
                    });
                    document.querySelectorAll('.validation-error-message.show').forEach(element => {
                        element.classList.remove('show');
                    });

                    // Reset reCAPTCHA
                    if (typeof grecaptcha !== 'undefined') {
                        grecaptcha.reset();
                    }
                }
            };

            // Initialize when DOM is loaded
            document.addEventListener('DOMContentLoaded', function() {
                ProfessionalHospitalAppointmentBookingSystem.initializeProfessionalAppointmentBookingSystem();
            });

            // reCAPTCHA callback function
            function onRecaptchaCallback(response) {
                console.log('reCAPTCHA verification completed');
            }
        </script>
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