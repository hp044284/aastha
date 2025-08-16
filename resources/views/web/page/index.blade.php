<x-web.layout>
    @push('meta')
        @php
            $metaTitle = $seo_pages->meta_title ?? $seo_pages->title ?? $page->Title ?? $page->Meta_Title ?? '';
            $metaDescription = $seo_pages->meta_description ?? $page->Meta_Description ?? '';
            $metaKeywords = $seo_pages->meta_keywords ?? $page->Meta_Keyword ?? '';
            $ogImage = !empty($seo_pages->File_Name) ? asset('Uploads/Page/' . $seo_pages->File_Name) : (!empty($settings['Site_Logo']) ? asset('Uploads/Logo/' . $settings['Site_Logo']) : asset('Uploads/Logo/logo.png'));
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

    @if($page->Description)
        <!-- About Us ================================================== -->
        <section>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        
                        <div class="p-1-6 p-md-2-2 border border border-color-extra-light-gray border-radius-5">
                            <h1 class="">
                                {{ $page->Title ?? 'Unisafe Securities' }}
                            </h1>
                            {!! $page->Description ?? '' !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
</x-web.layout>