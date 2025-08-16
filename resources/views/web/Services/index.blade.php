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
        <title>{{ $seo_pages->Title ?? 'Security & Networking Services | CCTV, Biometric, Fire Alarm, EPABX – Unisafe Securities' }}</title>
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
    <!-- SERVICES
        ================================================== -->
    <section>
        <div class="container">
            <!-- Header -->
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <h2 class="fw-bold mb-1">{{ $service_category->Title ?? 'Our services' }}</h2>
                    <p class="text-muted mb-0">
                        {!! $service_category->Description ?? 'Advanced protection with 24/7 monitoring, real-time alerts, and remote access — for your safety and peace of mind.' !!}
                    </p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{route('web.enquiry.index')}}" target="_blank" class="butn primary mt-1-9">Quick Enquiry</a>
                </div>
            </div>
            @if($entities->isNotEmpty())
            
                <div class="row g-xxl-5 mt-n2-9">
                    @foreach($entities as $entity)
                        <div class="col-md-6 col-lg-4 mt-2-9 wow fadeInUp" data-wow-delay="200ms">
                            <div class="card card-style1 m-0 border-0">
                                <div class="overflow-hidden img-card">
                                    <img src="{{ asset('Uploads/Services/'.$entity->File_Name) }}" alt="{{$entity->Title ?? 'Service Image'}}"
                                         onerror="this.onerror=null;this.src='{{ asset('/images/default-service.jpg') }}';" />
                                </div>
                                <div class="card-body rounded-bottom-md-5px">
                                    <h3 class="mb-3 h4">
                                        <a href="{{route('services.detail',$entity->Slug)}}">
                                            {{ Str::words(strip_tags($entity->Title), 5, '...') }}
                                        </a>
                                    </h3>
                                    <p class="mb-3">
                                        {!! Str::words(strip_tags($entity->Description), 15, '...') !!}
                                    </p>
                                    <a href="{{route('services.detail',$entity->Slug)}}">Read More &#10230;</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
            <div class="row">
                <div class="col-12">
                    <p>No services found</p>
                </div>
            </div>
            @endif
        </div>
    </section>    
</x-web.layout>