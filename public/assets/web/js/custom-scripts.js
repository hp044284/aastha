    /*--Auto Open Modal After 5 Seconds--*/
    setTimeout(function () {
        const myModal = new bootstrap.Modal(document.getElementById('enquiryModal'));
        myModal.show();
    }, 5000); // 5 seconds

        // Unisafe Securities Form Handler
        function unisafeFormSubmitHandler(event) {
            event.preventDefault();
            
            // Get Unisafe form data
            const securitiesForm = document.getElementById('securitiesInquiryForm');
            const formData = new FormData(securitiesForm);
            const clientData = Object.fromEntries(formData);
            
            // Validate Unisafe form
            if (!unisafeFormValidator(clientData)) {
                return;
            }
            
            // Process Unisafe submission
            unisafeSubmissionProcessor(clientData);
        }
        
        // Unisafe Form Validation
        function unisafeFormValidator(clientData) {
            // Check required fields
            if (!clientData.clientFullName || !clientData.clientEmailAddress || !clientData.clientPhoneNumber || !clientData.QueryFor || !clientData.requirement) {
                unisafeAlertHandler('Please fill in all required fields for your investment consultation.');
                return false;
            }
            
            // Email validation
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(clientData.clientEmailAddress)) {
                unisafeAlertHandler('Please enter a valid email address.');
                return false;
            }
            
            // Phone validation
            const phonePattern = /^[0-9]{10,15}$/;
            if (!phonePattern.test(clientData.clientPhoneNumber.replace(/\D/g, ''))) {
                unisafeAlertHandler('Please enter a valid mobile number.');
                return false;
            }
            
            return true;
        }
        
        // Unisafe Submission Processor
        function unisafeSubmissionProcessor(clientData) {
            const submitButton = document.getElementById('securitiesSubmitButton');
            const originalButtonText = submitButton.innerHTML;
            
            // Show loading state
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin unisafe-icon-space"></i>Processing...';
            submitButton.disabled = true;
            
            // Simulate Unisafe form processing
            setTimeout(() => {
                unisafeAlertHandler('Thank you for your interest in Unisafe Securities! Our investment advisor will contact you within 24 hours to discuss your financial goals.');
                document.getElementById('securitiesInquiryForm').reset();
                submitButton.innerHTML = originalButtonText;
                submitButton.disabled = false;
            }, 2000);
        }
        
        // Unisafe Phone Number Formatter
        function unisafePhoneFormatter(phoneInput) {
            let phoneValue = phoneInput.value.replace(/\D/g, '');
            if (phoneValue.length > 10) {
                phoneValue = phoneValue.substring(0, 10);
            }
            phoneInput.value = phoneValue;
        }
        
        // Unisafe Alert Handler
        function unisafeAlertHandler(message) {
            alert(message);
        }

        // Unisafe Enquiry Form //
                let enquiryCountdownTimer;
        let enquiryPopupShown = false;
        let enquiryModalInstance;
        
        // Auto popup after 5 seconds
        function startEnquiryCountdown() {
            let seconds = 5;
            const countdownElement = document.getElementById('enquiry-countdown');
            
            enquiryCountdownTimer = setInterval(() => {
                seconds--;
                if (countdownElement) {
                    countdownElement.textContent = seconds;
                }
                
                if (seconds <= 0) {
                    clearInterval(enquiryCountdownTimer);
                    if (!enquiryPopupShown) {
                        showEnquiryPopup();
                    }
                }
            }, 1000);
        }
        
        // Show enquiry modal
        function showEnquiryPopup() {
            if (!enquiryPopupShown) {
                enquiryPopupShown = true;
                const modalElement = document.getElementById('enquiryPopupModal');
                enquiryModalInstance = new bootstrap.Modal(modalElement);
                enquiryModalInstance.show();
                
                // Hide countdown text
                const countdownContainer = document.querySelector('.mt-4');
                if (countdownContainer) {
                    countdownContainer.style.display = 'none';
                }
            }
        }
        
        // Close enquiry popup
        function closeEnquiryPopup() {
            if (enquiryModalInstance) {
                enquiryModalInstance.hide();
            }
        }
        
        // Handle form submission
        function handleEnquirySubmit(event) {
            event.preventDefault();
            
            // Get form data
            const formData = new FormData(event.target);
            const data = Object.fromEntries(formData);
            
            // Validate reCAPTCHA (in real implementation)
            const recaptchaResponse = grecaptcha.getResponse();
            if (!recaptchaResponse) {
                alert('Please complete the reCAPTCHA verification.');
                return;
            }
            
            // Show loading state
            const submitBtn = event.target.querySelector('.enquiry-submit-btn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
            submitBtn.disabled = true;
            
            // Simulate form submission
            setTimeout(() => {
                alert('Thank you for your enquiry! We will get back to you soon.');
                event.target.reset();
                grecaptcha.reset();
                
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                
                // Close modal
                closeEnquiryPopup();
            }, 2000);
        }
        
        // Phone number formatting
        document.getElementById('enquiry-mobile').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 10) {
                value = value.slice(0, 10);
            }
            e.target.value = value;
        });
        
        // Form validation feedback
        document.querySelectorAll('.form-control-custom').forEach(input => {
            input.addEventListener('blur', function() {
                if (this.checkValidity()) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                }
            });
        });
        
        // Reset popup state when modal is closed
        document.getElementById('enquiryPopupModal').addEventListener('hidden.bs.modal', function () {
            // Reset for demo purposes - remove this line in production
            // enquiryPopupShown = false;
        });
        
        // Start countdown when page loads
        document.addEventListener('DOMContentLoaded', function() {
            startEnquiryCountdown();
        });
        
        // Prevent popup if user interacts with page early
        document.addEventListener('click', function(e) {
            // Don't cancel countdown if clicking the trigger button
            if (!e.target.classList.contains('demo-trigger-btn')) {
                if (enquiryCountdownTimer && !enquiryPopupShown) {
                    clearInterval(enquiryCountdownTimer);
                    const countdownContainer = document.querySelector('.mt-4');
                    if (countdownContainer) {
                        countdownContainer.innerHTML = '<small class="text-muted">Click the button above to show the enquiry form.</small>';
                    }
                }
            }
        });