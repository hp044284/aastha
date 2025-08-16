<x-web.layout>
    @push('meta')
    @php
       $metaTitle = $seo_pages->meta_title ?? 'Security & Networking Services | CCTV, Biometric, Fire Alarm, EPABX – Unisafe Securities';
       $metaDescription = $seo_pages->meta_description ?? 'Explore a wide range of professional security and networking services by Unisafe Securities. We offer CCTV camera installation, biometric attendance systems, fire alarms, EPABX, access control, and more. Trusted solutions for homes, offices, and businesses.';
       $metaKeywords = $seo_pages->meta_keywords ?? 'CCTV installation services, biometric attendance, fire alarm systems, EPABX solutions, video door phone, access control, computer networking, security systems Jaipur, Unisafe Securities services';
       $ogImage = !empty($seo_pages->og_image) ? asset('Uploads/Page/' . $seo_pages->og_image) : (!empty($settings['Site_Logo']) ? asset('Uploads/Logo/' . $settings['Site_Logo']) : asset('Uploads/Logo/logo.png'));
       $twitterImage = $ogImage;
       $currentUrl = $seo_pages->canonical_url ?? url()->current();
       $siteName = $settings['Site_Name'] ?? 'Unisafe Securities';
       $sameAs = array_filter([
        $settings['Facebook_Link'] ?? null,
        $settings['Twitter_Link'] ?? null,
        $settings['Linkedin_Link'] ?? null,
        $settings['Instagram_Link'] ?? null,
        $settings['Pinterest_Link'] ?? null,
        $settings['Youtube_Link'] ?? null,
        ]);
    @endphp
    <!-- Character Set -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Viewport and Compatibility -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Title -->
    <title>{{ $seo_pages->metaTitle ?? 'Security & Networking Services | CCTV, Biometric, Fire Alarm, EPABX – Unisafe Securities' }}</title>
    <!-- metas -->
    <meta name="title" content="{{ Str::limit($metaTitle ?? 'Security & Networking Services | CCTV, Biometric, Fire Alarm, EPABX – Unisafe Securities', 60) }}">
    <meta name="keywords" content="{{ Str::limit($metaKeywords ?? 'CCTV installation services, biometric attendance, fire alarm systems, EPABX solutions, video door phone, access control, computer networking, security systems Jaipur, Unisafe Securities services', 255, '') }}">
    <meta name="description" content="{{ Str::limit($metaDescription ?? 'Explore a wide range of professional security and networking services by Unisafe Securities. We offer CCTV camera installation, biometric attendance systems, fire alarms, EPABX, access control, and more. Trusted solutions for homes, offices, and businesses.', 160, '') }}">
    <!-- Google Site Verification -->
    <meta name="google-site-verification" content="{{ $settings['Google_Site_Verification'] ?? '' }}" />
    <!-- Bing Site Verification -->
    <meta name="msvalidate.01" content="{{ $settings['Ms_Validate'] ?? '' }}" />
    <!-- Yandex Site Verification -->
    <meta name="yandex-verification" content="{{ $settings['Yandex_Site_Verification'] ?? '' }}" />
    <!-- Baidu Site Verification -->
    <meta name="baidu-site-verification" content="{{ $settings['Baidu_Site_Verification'] ?? '' }}" />
    <!-- Publisher -->
    <meta name="publisher" content="{{ $settings['Publisher'] ?? $siteName }}" />
    <!-- Copyright -->
    <meta name="copyright" content="{{ $settings['Copy_Right'] ?? $siteName }}" />
    <!-- Document State -->
    <meta name="document-state" content="{{ $settings['Document_State'] ?? 'Dynamic' }}">
    <!--  Canonical -->
    <link rel="canonical" href="{{ $currentUrl }}" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ !empty($settings['Shortcut_Icon']) ? asset('Uploads/Logo/' . $settings['Shortcut_Icon']) : asset('Uploads/Logo/favicon.png') }}">
    <!-- apple touch icon -->
    <!-- apple touch icon 57x57 -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ !empty($settings['Apple_Touch_Icon_57']) ? asset('Uploads/Logo/' . $settings['Apple_Touch_Icon_57']) : asset('Uploads/Logo/apple-touch-icon-57x57.png') }}" />
    <!-- apple touch icon 72x72 -->
    <link rel="apple-touch-icon" sizes="72x72" href="{{ !empty($settings['Apple_Touch_Icon_72']) ? asset('Uploads/Logo/' . $settings['Apple_Touch_Icon_72']) : asset('Uploads/Logo/apple-touch-icon-72x72.png') }}" />
    <!-- apple touch icon 114x114 -->
    <link rel="apple-touch-icon" sizes="114x114" href="{{ !empty($settings['Apple_Touch_Icon_114']) ? asset('Uploads/Logo/' . $settings['Apple_Touch_Icon_114']) : asset('Uploads/Logo/apple-touch-icon-114x114.png') }}" />
    <!-- apple touch icon 144x144 -->
    <link rel="apple-touch-icon" sizes="144x144" href="{{ !empty($settings['Apple_Touch_Icon_144']) ? asset('Uploads/Logo/' . $settings['Apple_Touch_Icon_144']) : asset('Uploads/Logo/apple-touch-icon-144x144.png') }}" />
    <!-- apple touch icon 180x180 -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ !empty($settings['Apple_Touch_Icon_180']) ? asset('Uploads/Logo/' . $settings['Apple_Touch_Icon_180']) : asset('Uploads/Logo/apple-touch-icon-180x180.png') }}" />
    <!-- Robots -->
    <meta name="robots" content="{{($settings['Robots_First'] ?? '') . ',' . ($settings['Robots_Second'] ?? 'index, follow')}}">
    <meta name="googlebot" content="{{ $seo_pages['robots_index'] ?? $settings['Google_Bot'] ?? 'index, follow' }}" />
    <meta name="yahooseeker" content="{{ $seo_pages['robots_index'] ?? $settings['Yahoo_Seeker'] ?? 'index, follow' }}" />
    <meta name="msnbot" content="{{ $seo_pages['robots_index'] ?? $settings['Msn_Bot'] ?? 'index, follow' }}" />
    <!-- Distribution -->
    <meta name="distribution" content="Global" />
    <!-- Revisit After -->
    <meta name="revisit-after" content="{{ $settings['Revisit_After'] ?? '7 days' }}" />
    <!-- Author -->
    <meta name="author" content="{{ $settings['Author'] ?? $siteName }}">
    <!-- Rating -->
    <meta name="rating" content="general" />
    <!-- Language -->
    <meta name="language" content="{{ $settings['Language'] ?? 'en' }}" />
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings['Google_Analytics_ID'] ?? '' }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $settings['Google_Analytics_ID'] ?? '' }}');
    </script>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','{{ $settings['Google_Tag_Manager_ID'] ?? '' }}');</script>
    <!-- Google Tag Manager No Script -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $settings['Google_Tag_Manager_ID'] ?? '' }}"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- Open Graph data -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $metaTitle ?? 'Security & Networking Services | CCTV, Biometric, Fire Alarm, EPABX – Unisafe Securities' }}"/>
    <meta property="og:url" content="{{ $currentUrl }}"/>
    <meta property="og:image" content="{{ $ogImage }}"/>
    <meta property="og:description" content="{{ $metaDescription ?? 'Explore a wide range of professional security and networking services by Unisafe Securities. We offer CCTV camera installation, biometric attendance systems, fire alarms, EPABX, access control, and more. Trusted solutions for homes, offices, and businesses.' }}"/>
    <meta property="og:site_name" content="{{ $siteName }}"/>
    <meta property="og:image:alt" content="{{ $metaTitle ?? 'Security & Networking Services | CCTV, Biometric, Fire Alarm, EPABX – Unisafe Securities' }}"/>
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="@UnisafeSecurities"/>
    <meta name="twitter:creator" content="@kkchoudharyIN"/>
    <meta name="twitter:url" content="{{ $currentUrl }}"/>
    <meta name="twitter:title" content="{{ $metaTitle ?? 'Security & Networking Services | CCTV, Biometric, Fire Alarm, EPABX – Unisafe Securities' }}"/>
    <meta name="twitter:description" content="{{ $metaDescription ?? 'Explore a wide range of professional security and networking services by Unisafe Securities. We offer CCTV camera installation, biometric attendance systems, fire alarms, EPABX, access control, and more. Trusted solutions for homes, offices, and businesses.' }}"/>
    <meta name="twitter:image" content="{{ $twitterImage }}"/>
    <meta name="twitter:image:alt" content="{{ $metaTitle ?? 'Security & Networking Services | CCTV, Biometric, Fire Alarm, EPABX – Unisafe Securities' }}"/>
    <!--  Business Meta-->
    <meta property="business:contact_data:street_address" content="{{ $settings['Business_Street_Address'] ?? '38, Nand Vihar Colony, Tonk Road, Jaipur 302033' }}">
    <meta property="business:contact_data:locality" content="{{ $settings['Business_Locality'] ?? 'Sanganer' }}">
    <meta property="business:contact_data:address_locality" content="{{ $settings['Business_City'] ?? 'Jaipur' }}">
    <meta property="business:contact_data:region" content="{{ $settings['Business_Region'] ?? 'Rajasthan' }}">
    <meta property="business:contact_data:postal_code" content="{{ $settings['Business_Postal_Code'] ?? '302033' }}">
    <meta property="business:contact_data:country_name" content="{{ $settings['Business_Country_Name'] ?? 'India' }}">
    <meta name="email" content="{{ $settings['Support_Email'] ?? $settings['Support_Email'] ?? 'info@unisafesecurities.com' }}"/>
    <meta name="version" content="{{ $settings['App_Version'] ?? '1.0' }}" />

<script type="application/ld+json">
{!! json_encode([
    "@context" => "https://schema.org",
    "@type" => "WebSite",
    "name" => $metaTitle ?? 'Security & Networking Services | CCTV, Biometric, Fire Alarm, EPABX – Unisafe Securities',
    "url" => $currentUrl,
    "description" => $metaDescription ?? 'Explore a wide range of professional security and networking services by Unisafe Securities. We offer CCTV camera installation, biometric attendance systems, fire alarms, EPABX, access control, and more. Trusted solutions for homes, offices, and businesses.',
    "inLanguage" => "en",
    "publisher" => [
        "@type" => $settings['Organization_Type'] ?? 'Organization',
        "name" => $settings['Alternate_Name'] ?? $siteName,
        "logo" => [
            "@type" => "ImageObject",
            "url" => !empty($settings['Shortcut_Icon']) ? asset('Uploads/Logo/' . $settings['Shortcut_Icon']) : asset('Uploads/Logo/favicon.png'),
            "width" => 60,
            "height" => 60
        ]
    ],
    "image" => $ogImage,
    "foundingDate" => $settings['Founding_Date'] ?? '2018-10-10',
    "founder" => [
        "@type" => $settings['Founder_Type'] ?? 'Person',
        "name" => $settings['Founder_Name'] ?? 'Kamlesh Choudhary'
    ],
    "mainEntityOfPage" => [
        "@type" => "WebPage",
        "@id" => $currentUrl
    ],
    "geo" => [
        "@type" => "GeoCoordinates",
        "latitude" => $settings['Business_Latitude'] ?? '',
        "longitude" => $settings['Business_Longitude'] ?? ''
    ],
    "openingHoursSpecification" => [[
        "@type" => "OpeningHoursSpecification",
        "dayOfWeek" => ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        "opens" => "10:00",
        "closes" => "19:00"
    ]],
    "hasMap" => $settings['Google_Map_Link'] ?? '',
    "contactPoint" => [[
        "@type" => $settings['Contact_Point'] ?? 'ContactPoint',
        "telephone" => $settings['Support_Number'] ?? '',
        "email" => $settings['Support_Email'] ?? ($settings['Email'] ?? 'info@unisafesecurities.com'),
        "contactType" => "customer support",
        "areaServed" => "IN",
        "availableLanguage" => [$settings['Available_Languages'] ?? 'en']
    ]],
    "address" => [
        "@type" => $settings['Business_Address_Type'] ?? 'PostalAddress',
        "name" => $settings['Business_Name'] ?? 'Unisafe Securities',
        "streetAddress" => ($settings['Business_Street_Address'] ?? '') . ', ' . ($settings['Business_Landmark'] ?? '38, Nand Vihar Colony, Tonk Road, Near Pinjarapol Gausala'),
        "addressLocality" => ($settings['Business_Locality'] ?? '') . ', ' . ($settings['Business_City'] ?? 'Sanganer, Jaipur'),
        "addressRegion" => $settings['Business_Region'] ?? 'Rajasthan',
        "postalCode" => $settings['Business_Postal_Code'] ?? '302033',
        "addressCountry" => $settings['Business_Country_Name'] ?? 'India'
    ],
    "sameAs" => array_values($sameAs)
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>             
    @endpush
    <!-- Page Title ================================================== -->
    <section class="unisafe-hero-wrapper">
        <div class="unisafe-floating-bg">
            <div class="unisafe-shape-element"></div>
            <div class="unisafe-shape-element"></div>
            <div class="unisafe-shape-element"></div>
        </div>

        <div class="container">
            <div class="row">
                <div class="unisafe-content-container">
                    <div class="row align-items-center">
                        <div class="col-lg-7">
                            <div class="unisafe-brand-content">
                                <h1 class="unisafe-main-heading">
                                    {{ $entity->Title ?? 'Service Title' }}
                                </h1>

                                <p class="unisafe-brand-tagline">
                                    {{ $entity->Short_Description ?? 'Service Description' }}
                                </p>

                                <div class="unisafe-action-buttons">
                                    <a href="tel:+919610100127" class="unisafe-btn-primary">
                                        <i class="fas fa-phone unisafe-icon-space"></i>
                                        Contact Us
                                    </a>
                                    <a href="javascript:void(0)" class="unisafe-btn-secondary">
                                        <i class="fas fa-briefcase unisafe-icon-space"></i>
                                        View Portfolio
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="unisafe-inquiry-form">
                                <h4 class="enquiry-form-title">
                                    Get a Free Quote!
                                </h4>
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
                                            <input type="text" class="form-control-custom" id="enquiry-subject" name="subject" value="{{ $entity->Title ?? '' }}" readonly required />
                                            <input type="hidden" name="id" value="{{ $entity->id ?? 0 }}">
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
                                        {!! html()->button('Request Your Free Quote')
                                            ->type('submit')
                                            ->class('enquiry-submit-btn') !!}
                                    </div>
                                    <input type="hidden" name="type" value="service">
                                {!! html()->form()->close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CIRCUIT CAMERAS
            ================================================== -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 order-2 order-lg-1">
                    <div class="service-details-sidebar pe-lg-1-6 pe-xl-1-9">
                        @if($services->isNotEmpty())
                            <aside class="widget widget-nav-menu wow fadeIn mb-1-6" data-wow-delay="100ms">
                                <div class="widget-title">
                                    <h4 class="title h6 mb-0">Our Services</h4>
                                </div>
                                <div class="widget-body">
                                    <ul class="list-style4">
                                        @foreach($services as $service)
                                            <li class="{{ $service->id == $entity->id ? 'active' : '' }}">
                                                <a href="{{route('services.detail',$service->Slug)}}">{{ $service->Title ?? 'Service Title' }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </aside>
                        @endif
                        <aside class="widget widget-address mb-0 wow fadeIn p-0" data-wow-delay="200ms">
                            <div class="cover-background bg-img p-1-9 rounded word-break dark-overlay" data-overlay-dark="6" data-background="img/content/sidebar-image.jpg">
                                <div class="d-table-cell vertical-align-middle z-index-2 position-relative">
                                    <div class="d-flex mb-4">
                                        <div class="flex-shrink-0">
                                            <div class="contact-icons"><i class="ti-mobile"></i></div>
                                        </div>
                                        <div class="flex-grow-1 ms-3 ms-lg-4">
                                            <h4 class="h5 mb-1 text-white">Call Us</h4>
                                            <p class="mb-0 text-white">(+91) {{ $settings['Sales_Mobile_Number'] ?? '9610100127' }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-4">
                                        <div class="flex-shrink-0">
                                            <div class="contact-icons"><i class="ti-email"></i></div>
                                        </div>
                                        <div class="flex-grow-1 ms-3 ms-lg-4">
                                            <h4 class="h5 mb-1 text-white">Email</h4>
                                            <p class="mb-0 text-white">{{ $settings['Sales_Email'] ?? 'info@unisafesecurities.com' }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="contact-icons"><i class="fas fa-map-marker-alt"></i></div>
                                        </div>
                                        <div class="flex-grow-1 ms-3 ms-lg-4">
                                            <h4 class="h5 mb-1 text-white">Location</h4>
                                            <p class="mb-0 text-white">{!! $settings['Address'] ?? '38, Nand Vihar Colony, Tonk Road, Sanganer, Jaipur (Raj.) India - 302033' !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>

                <div class="col-lg-8 order-1 order-lg-2 mb-2-6 mb-lg-0">
                    <div class="detail-services">
                        <div class="mb-1-6 position-relative wow fadeIn" data-wow-delay="100ms">
                            <img src="{{ asset('Uploads/Services/'.$entity->File_Name) }}" class="border-radius-5" alt="{{ $entity->Title ?? 'Service Image' }}"
                                 onerror="this.onerror=null;this.src='{{ asset('/images/default-service.jpg') }}';" />
                        </div>
                        <div class="mb-1-6 wow fadeIn" data-wow-delay="200ms">
                            {!! $entity->Description ?? 'No Description Found' !!}
                        </div>
                        
                    </div>
                </div>
                <!-- end service right -->
            </div>
        </div>
    </section>
</x-web.layout>