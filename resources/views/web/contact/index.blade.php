<x-web.layout>
    @push('meta')
    @php
       $metaTitle = $seo_pages->meta_title ?? ($seo_pages->title ?? 'Contact Us | Unisafe Securities – Expert Support & Security Solutions');
       $metaDescription = $seo_pages->meta_description ?? 'Need help with CCTV cameras, biometric systems, EPABX, or networking solutions? Contact Unisafe Securities today — we are here to assist you with expert guidance and reliable security technology.';
       $metaKeywords = $seo_pages->meta_keywords ?? 'contact Unisafe, get in touch, CCTV support, biometric system help, EPABX service, security system contact, networking support, Unisafe phone, Unisafe email';
       $ogImage = !empty($seo_pages->og_image) ? asset('Uploads/Page/' . $seo_pages->og_image) : (!empty($settings['Site_Logo']) ? asset('Uploads/' . 'contact.webp') : asset('Uploads/Logo/logo.png'));
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
        "@type": "ContactPage",
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
    <!-- CONTACT INFO
        ================================================== -->
    <section class="contact-form">
        <div class="container">
            <div class="section-heading wow fadeIn pb-2-9" data-wow-delay="100ms">
                <span>Get In Touch</span>
                <h2 class="h1">Need Assistance? Reach Out – We’re Just a Message Away</h2>
            </div>
            <div class="row g-xxl-5 mt-n1-9">
                <div class="col-md-6 col-lg-4 mt-1-9 wow fadeIn" data-wow-delay="100ms">
                    <div class="contact-wrapper">
                        <div class="contact-icon">
                            <i class="ti-mobile fs-1 text-white"></i>
                        </div>
                        <div class="contact-content">
                            <h4 class="h3 mb-3">Call Us</h4>
                            <h2 class="title-hover">Call Us</h2>
                            Support : <a href="tel:{{ $settings['Support_Number'] }}" class="d-block font-weight-500 mb-1 display-md-28">{{ $settings['Support_Number'] }}</a>
                            Sales : <a href="tel:{{ $settings['Sales_Mobile_Number'] }}" class="font-weight-500 display-md-28"> {{ $settings['Sales_Mobile_Number'] }}</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mt-8 mt-md-1-9 wow fadeIn" data-wow-delay="150ms">
                    <div class="contact-wrapper">
                        <div class="contact-icon">
                            <i class="ti-email fs-1 text-white"></i>
                        </div>
                        <div class="contact-content">
                            <h4 class="h3 mb-3">Email Address</h4>
                            <h2 class="title-hover">Email</h2>
                            <a href="mailto:{{ $settings['Support_Email'] }}" class="d-block font-weight-500 mb-1 display-md-28">{{ $settings['Support_Email'] }}</a>
                            <a href="mailto:{{ $settings['Sales_Email'] }}" class="font-weight-500 display-md-28">{{ $settings['Sales_Email'] }}</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mt-8 mt-lg-1-9 wow fadeIn" data-wow-delay="200ms">
                    <div class="contact-wrapper">
                        <div class="contact-icon">
                            <i class="ti-location-pin fs-1 text-white"></i>
                        </div>
                        <div class="contact-content">
                            <h4 class="h3 mb-3">Address</h4>
                            <h2 class="title-hover">Address</h2>
                            <span class="d-block font-weight-500 w-xxl-55 mx-auto display-md-28">{!! $settings['Address'] !!}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT FORM
            ================================================== -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))  
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <section class="pt-0">
        <div class="container">
            <div class="row gx-lg-0 justify-content-center">
                <div class="col-lg-6 wow fadeIn d-none d-lg-block" data-wow-delay="100ms">
                    <div class="bg-img h-100 cover-background" data-overlay-dark="0" data-background="img/bg/bg-03.jpg"></div>
                </div>
                <div class="col-lg-6">
                    <div class="wow fadeIn position-relative z-index-9" data-wow-delay="200ms">
                        <div class="border p-1-6 p-sm-1-9 p-lg-2-2 form-background">
                            <div class="modal-header">
                                <h6 class="modal-title" id="enquiryModalLabel">Call us or fill the form</h6>
                            </div>
                            <form class="quform-1" id="contactForm" action="{{ route('web.contact.store') }}" method="post" enctype="multipart/form-data" onclick="">
                                @csrf
                                <div class="quform-elements">
                                    <div class="row">
                                        <!-- Begin Text input element -->
                                        <div class="col-md-6">
                                            <div class="quform-element">
                                                <div class="form-group">
                                                    <label for="name">Your Name: <span class="text-danger">*</span></label>
                                                    <div class="quform-input">
                                                        <input class="form-control-custom" id="name" type="text" name="name" placeholder="Rahul" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Text input element -->

                                        <!-- Begin Text input element -->
                                        <div class="col-md-6">
                                            <div class="quform-element">
                                                <div class="form-group">
                                                    <label for="email">Your Email: <span class="text-danger">*</span></label>
                                                    <div class="quform-input">
                                                        <input class="form-control-custom" id="email" type="text" name="email" placeholder="yourname@gmail.com" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Text input element -->

                                        <!-- Begin Text input element -->
                                        <div class="col-md-6">
                                            <div class="quform-element quform-select-replaced">
                                                <div class="form-group">
                                                    <label for="subject">Your Subject: <span class="text-danger">*</span></label>
                                                    <div class="quform-input">
                                                        <input class="form-control-custom" id="subject" type="text" name="subject" placeholder="subject" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Text input element -->

                                        <!-- Begin Text input element -->
                                        <div class="col-md-6">
                                            <div class="quform-element">
                                                <div class="form-group">
                                                    <label for="phone">Mobile Number: <span class="text-danger">*</span></label>
                                                    <div class="quform-input">
                                                        <input class="form-control-custom" id="phone" type="text" name="mobile" placeholder="9876543210" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Text input element -->

                                        <!-- Begin Textarea element -->
                                        <div class="col-md-12">
                                            <div class="quform-element">
                                                <div class="form-group">
                                                    <label for="message">Message <span class="text-danger">*</span></label>
                                                    <div class="quform-input">
                                                        <textarea class="form-control-custom" id="message" name="message" rows="3" placeholder="Message / Comment" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Textarea element -->

                                        <div class="mb-4">
                                            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_SITE_KEY') }}" id="contact-recaptcha"></div>
                                            <span id="contact-recaptcha-error" class="text-danger" style="display:none;">Please verify that you are not a robot.</span>
                                        </div> 
                                        <!-- Begin Submit button -->
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <button type="submit" class="enquiry-submit-btn"><i class="fas fa-paper-plane me-2"></i>Send Message</button>
                                            </div>
                                            <div class="quform-loading-wrap text-start"><span class="quform-loading"></span></div>
                                        </div>
                                        <!-- End Submit button -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MAP
            ================================================== -->
    <div>
        <iframe
            class="map-h500 position-relative map-navigation"
            id="gmap_canvas"
            src="{{ $settings['Google_Map_Link'] }}"
        ></iframe>
    </div>
    @push('js')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('contactForm');
            if(form) {
                form.addEventListener('submit', function(e) {
                    var response = grecaptcha.getResponse();
                    var errorSpan = document.getElementById('contact-recaptcha-error');
                    if(response.length === 0) {
                        e.preventDefault();
                        if(errorSpan) errorSpan.style.display = 'block';
                        return false;
                    } else {
                        if(errorSpan) errorSpan.style.display = 'none';
                    }

                    e.preventDefault();

                    const formData = new FormData(form);
                    var loadingWrap = form.querySelector('.quform-loading-wrap');
                    if (loadingWrap) loadingWrap.style.display = 'inline-block';

                    alert(form.action);

                    const axios_request = sendAxiosRequest({
                        url: form.action,
                        data: formData,
                        headers: "multipart/form-data",
                    });

                    axios_request.then(function(response) {
                        if (response.status == 200) {
                            axiosToast('success', 'Your contact details have been submitted successfully. We will contact you shortly.');
                            form.reset();
                            grecaptcha.reset();
                        } else {
                            if (typeof handleAxiosErrorResponse === 'function') {
                                handleAxiosErrorResponse(response);
                            } else {
                                alert('An error occurred. Please try again.');
                            }
                        }
                        if (loadingWrap) loadingWrap.style.display = 'none';
                    }).catch(function(error) {
                        if (typeof handleAxiosErrorRequest === 'function') {
                            handleAxiosErrorRequest(error);
                        } else {
                            alert('An error occurred. Please try again.');
                        }
                        if (loadingWrap) loadingWrap.style.display = 'none';
                    });
                });
            }
        });
    </script>
    @endpush
</x-web.layout>