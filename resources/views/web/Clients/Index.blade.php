<x-web.layout>
    @push('meta')
    @php
        $metaTitle = 'Clients - Unisafe Securities';
        $metaDescription = 'Discover our esteemed clients who trust Unisafe Securities for their financial needs.';
        $metaKeywords = 'clients, unisafe securities, trusted clients, financial services';
        $ogImage = asset('Uploads/home/clients.png');
        $twitterImage = $ogImage;
        $currentUrl = url()->current();
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
    <title>{{ $metaTitle ?? '' }}</title>
    <!-- metas -->
    <meta name="title" content="{{ Str::limit($metaTitle ?? '', 60) }}">
    <meta name="keywords" content="{{ Str::limit($metaKeywords ?? '', 255, '') }}">
    <meta name="description" content="{{ Str::limit($metaDescription ?? '', 160, '') }}">
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
    <meta property="og:title" content="{{ $metaTitle ?? '' }}"/>
    <meta property="og:url" content="{{ $currentUrl }}"/>
    <meta property="og:image" content="{{ $ogImage }}"/>
    <meta property="og:description" content="{{ $metaDescription ?? '' }}"/>
    <meta property="og:site_name" content="{{ $siteName }}"/>
    <meta property="og:image:alt" content="{{ $metaTitle ?? '' }}"/>
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="@UnisafeSecurities"/>
    <meta name="twitter:creator" content="@kkchoudharyIN"/>
    <meta name="twitter:url" content="{{ $currentUrl }}"/>
    <meta name="twitter:title" content="{{ $metaTitle ?? '' }}"/>
    <meta name="twitter:description" content="{{ $metaDescription ?? '' }}"/>
    <meta name="twitter:image" content="{{ $twitterImage }}"/>
    <meta name="twitter:image:alt" content="{{ $metaTitle ?? '' }}"/>
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
        "name" => $metaTitle ?? '',
        "url" => $currentUrl,
        "description" => $metaDescription ?? '',
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
            "@type" => "WebSite",
            "@id" => $currentUrl
        ],
        "geo" => [
            "@type" => "GeoCoordinates",
            "latitude" => $settings['Business_Latitude'] ?? '',
            "longitude" => $settings['Business_Longitude'] ?? ''
        ],
        "openingHoursSpecification" => [
            [
                "@type" => "OpeningHoursSpecification",
                "dayOfWeek" => ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                "opens" => "10:00",
                "closes" => "19:00"
            ],
            [
                "@type" => "OpeningHoursSpecification",
                "dayOfWeek" => "Sunday",
                "opens" => "10:00",
                "closes" => "14:00"
            ]
        ],
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
    <section class="unisafe-jobs-wrapper">
        <div class="unisafe-floating-bg">
            <div class="unisafe-shape-element"></div>
            <div class="unisafe-shape-element"></div>
            <div class="unisafe-shape-element"></div>
        </div>

        <div class="container">
            <div class="row">
                <div class="unisafe-content-container">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="unisafe-brand-content">
                                <h1 class="unisafe-main-heading">
                                    Our Clients
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($entities->isNotEmpty())

    <!-- OUR PARTENERS
            ================================================== -->
        <section>
            <div class="container">
                <div class="row g-0 wow fadeIn" data-wow-delay="200ms">
                    <div class="section-heading wow fadeIn" data-wow-delay="200ms">
                        <span>Our Clients</span>
                        <h2 class="h1">Organizations That Trust Us</h2>
                    </div>
                    @foreach($entities as $entityKey => $entity)
                        <div class="col-sm-6 col-lg-3">
                            <div class="partner-image text-center border-color-extra-light-gray py-4 border-lg-end border-bottom">
                                <img src="{{ getDynamicImage($entity->File_Name ,'Uploads/Clients') }}" alt="..." />
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- COUNTER
            ================================================== -->
    <section class="bg-secondary rounded-lg py-7 mb-5 bg-img text-center rounded-xl mx-xl-11" data-background="img/bg/bg-06.png">
        <div class="container">
            <div class="row mt-n1-6">
                <div class="col-sm-6 col-md-3 mt-1-6 text-center wow fadeInUp" data-wow-delay="100ms">
                    <div class="display-4 mb-1 text-white font-weight-800">
                        <div class="odometer odometer-auto-theme" data-count="{{ $settings['Project_Complete'] }}">{{ $settings['Project_Complete'] }}</div>
                        +
                    </div>
                    <p class="mb-0 text-white opacity9">Project Complete</p>
                </div>
                <div class="col-sm-6 col-md-3 mt-1-6 text-center wow fadeInUp" data-wow-delay="200ms">
                    <div class="display-4 mb-1 text-white font-weight-800">
                        <div class="odometer odometer-auto-theme" data-count="{{ $settings['Happy_Client'] }}">{{ $settings['Happy_Client'] }}</div>
                        +
                    </div>
                    <p class="mb-0 text-white opacity9">Happy Client</p>
                </div>
                <div class="col-sm-6 col-md-3 mt-1-6 text-center wow fadeInUp" data-wow-delay="350ms">
                    <div class="display-4 mb-1 text-white font-weight-800">
                        <div class="odometer odometer-auto-theme" data-count="{{ $settings['Products'] }}">{{ $settings['Products'] }}</div>
                        +
                    </div>
                    <p class="mb-0 text-white opacity9">Products</p>
                </div>
                <div class="col-sm-6 col-md-3 mt-1-6 text-center wow fadeInUp" data-wow-delay="400ms">
                    <div class="display-4 mb-1 text-white font-weight-800">
                        <div class="odometer odometer-auto-theme" data-count="{{ $settings['Brands'] }}">{{ $settings['Brands'] }}</div>
                        +
                    </div>
                    <p class="mb-0 text-white opacity9">Brands</p>
                </div>
            </div>
        </div>
    </section>
</x-layout>