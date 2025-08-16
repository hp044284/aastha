<x-web.layout>
    @push('meta')
    @php
       $metaTitle = $seo_pages->meta_title ?? ($seo_pages->title ?? 'Request a Quote | Enquiry for Security Solutions - Unisafe Securities');
       $metaDescription = $seo_pages->meta_description ?? 'Get a free quote from Unisafe Securities for CCTV cameras, biometric access control, fire alarm systems, and customized security solutions for your needs.';
       $metaKeywords = $seo_pages->meta_keywords ?? 'Unisafe enquiry, request security quote, CCTV quotation, biometric quote, fire alarm system estimate, access control pricing, security solution enquiry';
       $ogImage = !empty($seo_pages->og_image) ? asset('Uploads/Page/' . $seo_pages->og_image) : (!empty($settings['Site_Logo']) ? asset('Uploads/' . 'enquiry.webp') : asset('Uploads/Logo/logo.png'));
       $twitterImage = $ogImage;
       $currentUrl = $seo_pages->canonical_url ?? url()->current();
       $siteName = $settings['Site_Name'] ?? 'Unisafe Securities';
    @endphp
    <!-- Character Set -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Viewport and Compatibility -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Title -->
    <title>{{ $metaTitle ?? '' }}</title>
    <!-- metas -->
    <meta name="title" content="{{ $metaTitle ?? '' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? '' }}">
    <meta name="description" content="{{ $metaDescription ?? '' }}">
    <!--  Msvalidate Meta-->
    <meta name="msvalidate.01" content="{{ $settings['Ms_Validate'] ?? 'C1A1B2C3D4E5F6G7H8I9J0' }}" />
    <meta name="publisher" content="{{ $siteName }}" />
    <meta name="copyright" content="{{ $siteName }}" />
    <meta name="document-state" content="{{ request()->ajax() ? 'Dynamic-Ajax' : 'Dynamic' }}">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <!--  Canonical -->
    <link rel="canonical" href="{{ $currentUrl }}" />
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ !empty($settings['Shortcut_Icon']) ? asset('Uploads/Logo/' . $settings['Shortcut_Icon']) : asset('Uploads/Logo/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ !empty($settings['Apple_Touch_Icon_57']) ? asset('Uploads/Logo/' . $settings['Apple_Touch_Icon_57']) : asset('Uploads/Logo/apple-touch-icon-57x57.png') }}" />
    <link rel="apple-touch-icon" sizes="72x72" href="{{ !empty($settings['Apple_Touch_Icon_72']) ? asset('Uploads/Logo/' . $settings['Apple_Touch_Icon_72']) : asset('Uploads/Logo/apple-touch-icon-72x72.png') }}" />
    <link rel="apple-touch-icon" sizes="114x114" href="{{ !empty($settings['Apple_Touch_Icon_114']) ? asset('Uploads/Logo/' . $settings['Apple_Touch_Icon_114']) : asset('Uploads/Logo/apple-touch-icon-114x114.png') }}" />
    <meta name="robots" content="index, follow, noodp, noydir" />
    <meta name="googlebot" content="index, follow" />
    <meta name="yahooseeker" content="index, follow" />
    <meta name="msnbot" content="index, follow" />
    <meta name="allow-search" content="yes" />
    <meta name="distribution" content="global" />
    <meta name="revisit-after" content="7 days" />
    <meta name="author" content="{{ $siteName }}">
    <meta name="rating" content="general" />
    <meta name="language" content="en" />
    <meta name="date" content="{{ now()->toDateString() }}">
    <!-- Open Graph data -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $metaTitle ?? '' }}"/>
    <meta property="og:url" content="{{ $currentUrl }}"/>
    <meta property="og:image" content="{{ $ogImage }}"/>
    <meta property="og:description" content="{{ $metaDescription ?? '' }}"/>
    <meta property="og:site_name" content="{{ $siteName }}"/>
    <meta property="og:image:alt" content="{{ $metaTitle ?? 'Unisafe Securities' }}"/>
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="@UnisafeSecurities"/>
    <meta name="twitter:creator" content="@UnisafeSecurities"/>
    <meta name="twitter:url" content="{{ $currentUrl }}"/>
    <meta name="twitter:title" content="{{ $metaTitle ?? '' }}"/>
    <meta name="twitter:description" content="{{ $metaDescription ?? '' }}"/>
    <meta name="twitter:image" content="{{ $twitterImage }}"/>
    <meta name="twitter:image:alt" content="{{ $metaTitle ?? 'Unisafe Securities' }}"/>
    <!--  Business Meta-->
    <meta property="business:contact_data:street_address" content="{{ $settings['Address'] ?? '38, Nand Vihar Colony, Tonk Road, Jaipur 302033' }}">
    <meta property="business:contact_data:locality" content="{{ $settings['City'] ?? 'Jaipur' }}">
    <meta property="business:contact_data:region" content="{{ $settings['State'] ?? 'Rajasthan' }}">
    <meta property="business:contact_data:postal_code" content="{{ $settings['Pincode'] ?? '302033' }}">
    <meta property="business:contact_data:country_name" content="{{ $settings['Country'] ?? 'India' }}">
    <meta name="email" content="{{ $settings['Support_Email'] ?? $settings['Email'] ?? 'info@unisafesecurities.com' }}"/>
    <meta name="version" content="{{ $settings['App_Version'] ?? '1.0' }}" />

    {{-- Schema.org JSON-LD for Blog Category --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "EnquiryPage",
        "name": "{{ $metaTitle ?? '' }}",
        "description": "{{ $metaDescription ?? '' }}",
        "url": "{{ $currentUrl }}",
        "mainEntity": {
            "@type": "Organization",
            "name": "{{ $settings['Site_Name'] ?? 'Unisafe Securities' }}",
            "url": "{{ $currentUrl }}",
            "logo": {
                "@type": "ImageObject",
                "url": "{{ !empty($settings['Shortcut_Icon']) ? asset('Uploads/Logo/' . $settings['Shortcut_Icon']) : asset('Uploads/Logo/favicon.png') }}"
            },
            "contactPoint": [
                {
                    "@type": "ContactPoint",
                    "telephone": "{{ $settings['Support_Number'] ?? '+919610100127' }}",
                    "contactType": "customer support",
                    "areaServed": "IN",
                    "availableLanguage": ["en"]
                },
                {
                    "@type": "ContactPoint",
                    "telephone": "{{ $settings['Sales_Mobile_Number'] ?? '+919001600127' }}",
                    "contactType": "sales",
                    "areaServed": "IN",
                    "availableLanguage": ["en"]
                }
            ],
            "email": "{{ $settings['Support_Email'] ?? 'info@unisafesecurities.com' }}",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "{{ $settings['Address'] ?? '38, Nand Vihar Colony, Tonk Road' }}",
                "addressLocality": "{{ $settings['City'] ?? 'Jaipur' }}",
                "addressRegion": "{{ $settings['State'] ?? 'Rajasthan' }}",
                "postalCode": "{{ $settings['Pincode'] ?? '302033' }}",
                "addressCountry": "{{ $settings['Country'] ?? 'India' }}"
            }
        }
    }
    </script>
    @endpush
    <div class="container padding-top my-5">
        <div class="row gx-0 shadow rounded w-100" style="margin: auto;">
            <!-- Left Side - Enquiry Form -->
            <div class="col-lg-7">
                <div class="enquiry-form-section">
                    <h1 class="enquiry-form-title">Free Quote!</h1>
                    {!! html()->form('POST', route('web.enquiry.store'))
                        ->attribute('id', 'enquiryPopupForm')
                        ->class('row g-3 needs-validation')
                        ->open() !!}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="enquiry-name" class="form-label">Full Name <span class="enquiry-required">*</span></label>
                                <input type="text" class="form-control-custom" id="enquiry-name" name="Name" placeholder="Your Full Name" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="enquiry-email" class="form-label">Email Address <span class="enquiry-required">*</span></label>
                                <input type="email" class="form-control-custom" id="enquiry-email" name="Email" placeholder="Your Email Address" required />
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="enquiry-mobile" class="form-label">Mobile Number <span class="enquiry-required">*</span></label>
                                <input type="tel" class="form-control-custom" id="enquiry-mobile" name="Mobile" pattern="[0-9]{10}" placeholder="Your Phone Number" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="enquiry-subject" class="form-label">Query For <span class="enquiry-required">*</span></label>
                                @if($type == 'service')
                                    <input type="text" class="form-control-custom" id="enquiry-subject" name="subject" value="{{ $enquirable->Title }}" readonly />
                                    <input type="hidden" name="id" value="{{ $enquirable->id ?? 0 }}">
                                @elseif($type == 'product')
                                    <input type="text" class="form-control-custom" id="enquiry-subject" name="subject" value="{{ $enquirable->Product_Name }}" readonly />
                                    <input type="hidden" name="id" value="{{ $enquirable->id ?? 0 }}">
                                @else
                                    <select class="form-control-custom" id="enquiry-subject" name="subject" required>
                                        <option value="">Select an option</option>
                                        @foreach($enquirable as $subject)
                                            <option type="text" value="{{ $subject->id }}">{{ $subject->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>
    
                        <div class="mb-3">
                            <label for="enquiry-requirement" class="form-label">Requirement <span class="enquiry-required">*</span></label>
                            <textarea class="form-control-custom" id="enquiry-requirement" name="Message" rows="4" placeholder="Please describe your Message or Requirement..." required></textarea>
                        </div>
    
                        <div class="mb-4">
                            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_SITE_KEY') }}" id="enquiry-recaptcha"></div>
                            <span id="recaptcha-error" class="text-danger" style="display:none;">Please verify that you are not a robot.</span>
                        </div>
                        

                        <div class="text-center">
                            {!! html()->button('Request Your Free Quote')
                                ->type('submit')
                                ->class('enquiry-submit-btn') !!}
                        </div>
                        <input type="hidden" name="type" value="{{ $type ?? null }}">
                        
                    {!! html()->form()->close() !!}
                </div>
            </div>
    
            <!-- Right Side - Company Details -->
            <div class="col-lg-5">
                <div class="enquiry-info-section h-100 d-flex flex-column">
                    <h3 class="enquiry-info-title">We Love To Support You</h3>
    
                    <div class="enquiry-contact-item">
                        <div class="enquiry-contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="enquiry-contact-text">
                            <h6>Our Address</h6>
                            <p><span class="enquiry-india-flag"></span>{{ $settings['Address'] ?? '38, Nand Vihar Colony, Tonk Road, Sanganer, Jaipur, Rajasthan (India) - 302033' }}</p>
                        </div>
                    </div>
    
                    <div class="enquiry-contact-item">
                        <div class="enquiry-contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="enquiry-contact-text">
                            <h6>Call Us</h6>
                            <p>+91 {{ $settings['Sales_Mobile_Number'] ?? '9610100127' }}</p>
                        </div>
                    </div>
    
                    <div class="enquiry-contact-item">
                        <div class="enquiry-contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="enquiry-contact-text">
                            <h6>Email Us</h6>
                            <p>{{ $settings['Sales_Email'] ?? 'info@unisafesecurities.com' }}</p>
                        </div>
                    </div>
    
                    <div class="enquiry-contact-item">
                        <div class="enquiry-contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="enquiry-contact-text">
                            <h6>Business Hours</h6>
                            <p>
                                {{ $settings['Time'] ?? 'Monday - Saturday: 9:00 AM - 6:00 PM' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('enquiryPopupForm');
            if(form) {
                form.addEventListener('submit', function(e) {
                    var response = grecaptcha.getResponse();
                    var errorSpan = document.getElementById('recaptcha-error');
                    if(response.length === 0) {
                        e.preventDefault();
                        if(errorSpan) errorSpan.style.display = 'block';
                        return false;
                    } else {
                        if(errorSpan) errorSpan.style.display = 'none';
                    }
                });
            }
        });
    </script>
</x-web.layout>