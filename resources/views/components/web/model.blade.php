<div class="modal fade enquiry-popup-modal enquiry-popup-container" id="enquiryPopupModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <!-- Close Button -->
            <button type="button" class="enquiry-close-btn" data-bs-dismiss="modal" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
            <div class="modal-body">
                <div class="row g-0">
                    <!-- Left Side - Enquiry Form -->
                    <div class="col-lg-7">
                        <div class="enquiry-form-section">
                            <h2 class="enquiry-form-title">Send us an Enquiry</h2>
                            <form id="enquiryPopupForm" action="{{ route('web.enquiry.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="enquiry-name" class="form-label">Full Name <span class="enquiry-required">*</span></label>
                                        <input type="text" class="form-control-custom" id="enquiry-name" name="Name" placeholder="Your Full Name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="enquiry-email" class="form-label">Email Address <span class="enquiry-required">*</span></label>
                                        <input type="email" class="form-control-custom" id="enquiry-email" name="Email" placeholder="Your Email Address" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="enquiry-mobile" class="form-label">Mobile Number <span class="enquiry-required">*</span></label>
                                        <input type="tel" class="form-control-custom" id="enquiry-mobile" name="Mobile" pattern="[0-9]{10}" placeholder="Your Phone Number" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="enquiry-subject" class="form-label">Subject <span class="enquiry-required">*</span></label>
                                        <select class="form-control-custom" id="enquiry-subject" name="Subject" required>
                                            <option value="">Select an option</option>
                                            <option value="CCTV Cameras">CCTV Cameras</option>
                                            <option value="Biometric Systems">Biometric Systems</option>
                                            <option value="Video Door Phone">Video Door Phone</option>
                                            <option value="Intercom Systems">Intercom Systems</option>
                                            <option value="Computer Networking">Computer Networking</option>
                                            <option value="Ncomputing">Ncomputing</option>
                                            <option value="Fire Alarms">Fire Alarms</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="enquiry-requirement" class="form-label">Requirement <span class="enquiry-required">*</span></label>
                                    <textarea class="form-control-custom" id="enquiry-requirement" name="Message" rows="4" placeholder="Please describe your Message or Requirement..." required></textarea>
                                </div>
                                <div class="mb-4">
                                    <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_SITE_KEY') }}"></div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="enquiry-submit-btn">
                                        <i class="fas fa-paper-plane me-2"></i>Submit Enquiry
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Right Side - Company Details -->
                    <div class="col-lg-5">
                        <div class="enquiry-info-section h-100 d-flex flex-column justify-content-center">
                            <h3 class="enquiry-info-title">We Love To Support You</h3>
                            <div class="enquiry-contact-item">
                                <div class="enquiry-contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="enquiry-contact-text">
                                    <h6>Our Address</h6>
                                    <p>
                                        <span class="enquiry-india-flag"></span>{!! $settings['Business_Street_Address'] ?? '' !!}
                                    </p>
                                </div>
                            </div>
                            <div class="enquiry-contact-item">
                                <div class="enquiry-contact-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="enquiry-contact-text">
                                    <h6>Call Us</h6>
                                    <p>{!! $settings['Sales_Mobile_Number'] ?? '' !!}</p>
                                </div>
                            </div>
                            <div class="enquiry-contact-item">
                                <div class="enquiry-contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="enquiry-contact-text">
                                    <h6>Email Us</h6>
                                    <p>{{ $settings['Sales_Email'] ?? '' }}</p>
                                </div>
                            </div>
                            <div class="enquiry-contact-item">
                                <div class="enquiry-contact-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="enquiry-contact-text">
                                    <h6>Business Hours</h6>
                                    <p>{{ $settings['Time'] ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal backdrop for proper page overlay -->
<div class="modal-backdrop fade" id="enquiryModalBackdrop" style="display:none;"></div>
<script>
    // Ensure modal closes properly and backdrop is handled
    document.addEventListener('DOMContentLoaded', function () {
        var modal = document.getElementById('enquiryPopupModal');
        var backdrop = document.getElementById('enquiryModalBackdrop');
        if (modal) {
            modal.addEventListener('show.bs.modal', function () {
                if (backdrop) {
                    backdrop.classList.add('show');
                    backdrop.style.display = 'block';
                }
            });
            modal.addEventListener('hide.bs.modal', function () {
                if (backdrop) {
                    backdrop.classList.remove('show');
                    backdrop.style.display = 'none';
                }
            });
        }
    });
</script>