<x-web.layout>
    @push('meta')
    @php
       $metaTitle = $entity->Meta_Title ?? $entity->Product_Name ?? 'Products | Unisafe Securities – CCTV, Biometric, EPABX & Networking';
       $metaDescription = $entity->Meta_Description ?? 'Explore our wide range of security and IT products including CCTV cameras, biometric attendance systems, video door phones, EPABX, intercoms, and computer networking solutions in Jaipur. Unisafe Securities offers expert installation and reliable support.';
       $metaKeywords = $entity->Meta_Keyword ?? 'CCTV, biometric, EPABX, intercom, networking, security products, Jaipur, Unisafe Securities, video door phone, access control, surveillance, IT solutions';
       $ogImage = !empty($entity->File_Name) ? asset('Uploads/Products/' . $entity->File_Name) : (!empty($settings['Site_Logo']) ? asset('Uploads/Logo/' . $settings['Site_Logo']) : asset('Uploads/Logo/logo.png'));
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
        "@type" => "Product",
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
            "@type" => "Product",
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
    @endpush

    @push('css')
    <style type="text/css">
        .rating {
            direction: rtl;
            display: inline-flex;
            gap: 0.3rem;
        }
        .rating input {
            display: none;
        }
        .rating label {
            color: #ddd;
            font-size: 1.4rem;
            cursor: pointer;
        }
        .rating input:checked ~ label,
        .rating label:hover,
        .rating label:hover ~ label {
            color: #f5b301;
        }
        .review-box {
            border: 1px solid #ddd;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .reply-box {
            margin-top: 1rem;
            padding-left: 1rem;
            border-left: 2px solid #ccc;
        }
        .reply {
            background-color: #fff;
            padding: 0.5rem;
            border: 1px solid #ddd;
            margin-top: 0.5rem;
            border-radius: 4px;
        }
        .thumb {
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .thumb:hover {
            transform: scale(1.1);
        }

        .thumb.active {
            border: 2px solid #007bff;
        }
        .text-justify {
            text-align: justify;
        }
    </style>
    @endpush
    <section class="product-padding">
        <div class="container py-5">
            <div class="row">
                <!-- Left Column: Images -->
                <div class="col-lg-6 pb-5">
                    @php
                        // Merge main image and additional images into one array for display
                        $mainImage = [
                            [
                                'File_Name' => $entity->File_Name,
                                'Title' => $entity->Product_Name ?? 'Main Image',
                                'is_main' => true
                            ]
                        ];
                        $additionalImages = [];
                        if (!empty($entity->ProductFile)) {
                            foreach ($entity->ProductFile as $file) {
                                // Avoid duplicate if main image is also in ProductFile
                                if ($file->File_Name !== $entity->File_Name) {
                                    $additionalImages[] = [
                                        'File_Name' => $file->File_Name,
                                        'Title' => $file->Title ?? 'Thumbnail',
                                        'is_main' => false
                                    ];
                                }
                            }
                        }
                        $allImages = array_merge($mainImage, $additionalImages);
                    @endphp

                    <div class="border rounded p-3 mb-3 bg-white">
                        <img id="mainProductImage" src="{{ asset('Uploads/Products/'.$entity->File_Name) }}" class="img-fluid w-100 rounded" alt="Main Product Image" />
                    </div>
                    @if(count($allImages) > 0)
                        <div class="d-flex gap-2 justify-content-start">
                            @foreach($allImages as $img)
                                <img 
                                    src="{{ asset('Uploads/Products/'.$img['File_Name']) }}" 
                                    alt="{{ $img['Title'] }}" 
                                    class="thumb img-thumbnail rounded{{ $img['is_main'] ? ' active' : '' }}" 
                                    style="width: 80px;" 
                                    onclick="changeMainImage(this)" 
                                />
                            @endforeach
                        </div>
                    @endif
                </div>
    
                <!-- Right Column: Product Info -->
                <div class="col-lg-6">
                    <h1 class="fw-bold mb-2">{{$entity->Product_Name ?? 'Product Name'}}</h1>
                    <div class="mb-3">
                        <div>
                            <span class="text-warning text-decoration-line-through fw-bold">₹{{$entity->Old_Price ?? '0'}}</span>
                            <span class="text-primary h4">₹{{$entity->Price ?? '0'}}</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <a href="javascript:void(0);"><i class="fas fa-star text-warning"></i></a>
                            <a href="javascript:void(0);"><i class="fas fa-star text-warning"></i></a>
                            <a href="javascript:void(0);"><i class="fas fa-star text-warning"></i></a>
                            <a href="javascript:void(0);"><i class="fas fa-star text-warning"></i></a>
                            <a href="javascript:void(0);"><i class="fas fa-star-half-alt text-warning"></i></a>
                            <span class="small text-muted">({{$entity->Review_Count ?? '0'}} reviews)</span>
                        </div>
                    </div>
    
                    <p class="text-muted text-justify">{{$entity->Short_Description ?? 'Product Description'}}</p>
                    <table class="table table-bordered">
                        <tbody>
                            @if(!empty($entity->ProductCategory))
                            <tr>
                                <td><b>Category</b></td>
                                <td>
                                    <div class="product-tag">
                                        <a href="{{route('web.product.index',['slug'=>$entity->ProductCategory->Slug])}}" class="badge bg-light text-dark me-2">{{$entity->ProductCategory->Title ?? 'N/A'}}</a>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @if(!empty($entity->Brand))
                            <tr>
                                <td><b>Brand</b></td>
                                <td>
                                    <div class="product-tag">
                                        <span class="badge bg-light text-dark me-2">Hikvision</span>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @if(!empty($entity->SKU))
                                <tr>
                                    <td><b>SKU</b></td>
                                    <td>
                                        <div class="product-tag">
                                            <span class="badge bg-light text-dark me-2">{{$entity->SKU ?? 'N/A'}}</span>
                                        </div>
                                    </td>
                                </tr>  
                            @endif
                            @if(!empty($entity->Tags))
                                <tr>
                                    <td><b>Tags:</b></td>
                                    @php
                                        $tags = explode(',', $entity->Tags);
                                    @endphp
                                    @if(!empty($tags))
                                        <td>
                                            <div class="product-tag">
                                                @foreach($tags as $tag)
                                                    <a href="/products/{{$tag}}" class="badge bg-light text-dark me-2">{{ ucwords($tag) }}</a>
                                                @endforeach
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                                
                            @endif
                        </tbody>
                    </table>
                    <div class="d-flex gap-2 pt-4 pb-4">
                        <input type="number" id="productQuantity" class="form-control" min="1" value="1" style="width: 80px;" />
                        <a href="{{route('web.enquiry.index',['type'=>'product','slug'=>$entity->Slug])}}" class="btn btn-primary w-100" role="button">Enquiry Now</a>
                        <a href="https://wa.me/919001600127" target="_blank" class="btn btn-success w-100" role="button">WhatsApp Now</a>
                    </div>
                    <div class="product-details-share d-flex align-items-center gap-3 fs-6">
                        <span class="fw-semibold">Share:</span>
                        @php
                            $shareUrl = urlencode(request()->fullUrl());
                            $shareTitle = urlencode($entity->Product_Name ?? 'Check out this product!');
                        @endphp
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" class="text-primary" title="Share on Facebook" target="_blank" rel="noopener">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" class="text-dark" title="Share on Twitter" target="_blank" rel="noopener">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://wa.me/?text={{ $shareTitle }}%20{{ $shareUrl }}" class="text-success" title="Share on WhatsApp" target="_blank" rel="noopener">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $shareUrl }}&title={{ $shareTitle }}" class="text-primary" title="Share on LinkedIn" target="_blank" rel="noopener">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <!-- YouTube does not support direct sharing of arbitrary URLs, so we omit it -->
                    </div>
                </div>
            </div>
        </div>
    
        <div class="container pb-5">
            <!-- Tabs Section -->
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-tabs" id="productTabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#desc">Description</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#specs">Specifications</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reviews">Reviews</button>
                        </li>
                    </ul>
                    <div class="tab-content border border-top-0 p-4 bg-white">
                        <div class="tab-pane fade show active" id="desc">
                            {!! $entity->Description ?? 'N/A' !!}
                        </div>
                        <div class="tab-pane fade" id="specs">
                            <div class="table-responsive">
                                {!! $entity->Aditional_Description ?? 'N/A' !!}
                            </div>
                        </div>
    
                        <div class="tab-pane fade" id="reviews">
                            <h4>Customer Reviews</h4>
                            <div id="reviewList"></div>
    
                            <hr />
                            <div id="reviews">
                                <h5>Leave a Review</h5>
                                <form id="enquiryForm" class="row g-3 mt-3">
                                    <div class="col-12">
                                        <label class="form-label d-block">Your Rating <span class="text-danger">*</span></label>
                                        <div class="rating">
                                            <input type="radio" name="rating" id="star5" value="5" required /><label for="star5"><i class="fas fa-star"></i></label> <input type="radio" name="rating" id="star4" value="4" />
                                            <label for="star4"><i class="fas fa-star"></i></label> <input type="radio" name="rating" id="star3" value="3" /><label for="star3"><i class="fas fa-star"></i></label>
                                            <input type="radio" name="rating" id="star2" value="2" /> <label for="star2"><i class="fas fa-star"></i></label> <input type="radio" name="rating" id="star1" value="1" />
                                            <label for="star1"><i class="fas fa-star"></i></label>
                                        </div>
                                    </div>
    
                                    <div class="col-md-4">
                                        <label for="reviewName" class="form-label">Your Name: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-custom" id="reviewName" placeholder="Rahul Choudhary" required />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="reviewEmail" class="form-label">Your Email: <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control form-control-custom" id="reviewEmail" placeholder="yourname@gmail.com" required />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="reviewPhone" class="form-label">Your Mobile: <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control form-control-custom" id="reviewPhone" placeholder="+919876543210" required />
                                    </div>
                                    <div class="col-12">
                                        <label for="reviewMessage" class="form-label">Your Review: <span class="text-danger">*</span></label>
                                        <textarea class="form-control-custom" id="reviewMessage" rows="4" placeholder="Review" required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-custom primary-hover text-white w-40">Submit Review</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('js')
    <script type="text/javascript">
        document.getElementById("enquiryForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const name = document.getElementById("reviewName").value;
            const email = document.getElementById("reviewEmail").value;
            const phone = document.getElementById("reviewPhone").value;
            const message = document.getElementById("reviewMessage").value;
            const rating = document.querySelector('input[name="rating"]:checked')?.value;

            if (!rating) {
                alert("Please select a rating.");
                return;
            }

            const reviewId = "review-" + Date.now();

            const reviewHTML = `
        <div class="review-box" id="${reviewId}">
            <strong>${name}</strong> <span class="text-muted">(${email})</span><br/>
            <div>${getStars(rating)}</div>
            <p>${message}</p>

            <button class="btn btn-sm btn-link reply-toggle-btn" data-target="${reviewId}-reply-form">Reply</button>

            <div class="reply-box" id="${reviewId}-replies"></div>

            <form class="reply-form d-none mt-2" id="${reviewId}-reply-form">
            <div class="mb-2">
                <input type="text" class="form-control" placeholder="Write a reply..." required />
            </div>
            <button type="submit" class="btn btn-sm btn-secondary">Submit Reply</button>
            </form>
        </div>
        `;

            document.getElementById("reviewList").insertAdjacentHTML("afterbegin", reviewHTML);
            this.reset();
        });

        function getStars(rating) {
            let stars = "";
            for (let i = 1; i <= 5; i++) {
                stars += `<i class="fa${i <= rating ? "s" : "r"} fa-star text-warning"></i>`;
            }
            return stars;
        }

        // Reply toggle and submit handler (delegated event listener)
        document.getElementById("reviewList").addEventListener("click", function (e) {
            if (e.target.classList.contains("reply-toggle-btn")) {
                const formId = e.target.dataset.target;
                document.getElementById(formId).classList.toggle("d-none");
            }
        });

        document.getElementById("reviewList").addEventListener("submit", function (e) {
            if (e.target.classList.contains("reply-form")) {
                e.preventDefault();
                const input = e.target.querySelector("input");
                const replyText = input.value.trim();
                if (replyText) {
                    const repliesContainerId = e.target.id.replace("-reply-form", "-replies");
                    const repliesContainer = document.getElementById(repliesContainerId);
                    const replyHTML = `<div class="reply">${replyText}</div>`;
                    repliesContainer.insertAdjacentHTML("beforeend", replyHTML);
                    input.value = "";
                    e.target.classList.add("d-none");
                }
            }
        });

        //product image
        function changeMainImage(el) {
            const mainImage = document.getElementById("mainProductImage");
            mainImage.src = el.src;
            // Optional: Add active class to the clicked thumbnail
            document.querySelectorAll(".thumb").forEach((img) => img.classList.remove("active"));
            el.classList.add("active");
        }
    </script>
    @endpush
</x-web.layout>

