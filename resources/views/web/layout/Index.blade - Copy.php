<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        @php
            $Twitter_Image = getDynamicImage($settings['Twitter_Image'], 'Uploads/Settings');
            $Logo_File_Name =  (!empty($settings['Site_Logo'])) ? public_path('Uploads/Settings/'.$settings['Site_Logo']) : '';
        @endphp
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <title>Home | @yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="description" content="aadhunikaavtaar offers cctv camera & services in Jaipur and Delhi, India." />
        <meta name="keywords" content="cctv, cctv camera, cctv camera installation" />
        <!--  Msvalidate Meta-->
        <meta name="msvalidate.01" content="{{ $settings['Ms_Validate'] }}" />
        <meta name="publisher" content="{{ $settings['Publisher'] }}" />
        <meta name="copyright" content="{{ $settings['Copy_Right'] }}" />
        <meta name="document-state" content="{{ $settings['Document_State'] }}" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="pragma" content="no-cache" />
        <!--  Canonical -->
        <link rel="canonical" href="{{ $settings['Canonical'] }}" />
        <!-- favicon -->
        <link rel="shortcut icon" href="{{ $settings['Shortcut_Icon'] }}" />
        <link rel="apple-touch-icon" href="{{ $settings['Apple_Touch_Icon'] }}" />
        <meta name="robots" content="{{ $settings['Robots_First'] }}" />
        <meta name="robots" content="{{ $settings['Robots_Second'] }}" />
        <meta name="googlebot" content="{{ $settings['Google_Bot'] }}" />
        <meta name="yahooSeeker" content="{{ $settings['Yahoo_Seeker'] }}" />
        <meta name="msnbot" content="{{ $settings['Msn_Bot'] }}" />
        <meta name="allow-search" content="yes" />
        <meta name="distribution" content="global" />
        <meta name="revisit-after" content="{{ $settings['Revisit_After'] }}" />
        <meta name="author" content="{{ $settings['Author'] }}" />
        <meta name="rating" content="{{ $settings['Rating'] }}" />
        <meta name="language" content="{{ $settings['Language'] }}" />
        <!-- Open Graph data -->
        <meta property="og:type" content="business.business" />
        <meta property="og:title" content="{{ $settings['Site_Name'] }} | @yield('title')" />
        <meta property="og:url" content="{{ $url ?? $settings['Site_Url'] }}" />
        <meta property="og:image" content="{{ $Image ?? $Logo_File_Name }}" />
        <meta property="og:description" content="{{ $Description ?? 'aadhunikaavtaar offers cctv camera services in Jaipur and Delhi, India.' }}" />
        <meta property="og:site_name" content="{{ $settings['Site_Name'] }}" />
        <meta property="og:image:alt" content="{{ $settings['Twitter_Image_Alt'] }}" />
        <meta property="fb:admins" content="1765250830386460" />
        <!-- Twitter Card data -->
        <meta name="twitter:card" content="Summary" />
        <meta name="twitter:site" content="{{ $settings['Twitter_Site'] }}" />
        <meta name="twitter:url" content="{{ $url ?? $settings['Site_Url'] }}" />
        <meta name="twitter:title" content="{{ $settings['Site_Name'] }} | @yield('title') " />
        <meta name="twitter:description" content="{{ $Description ?? 'aadhunikaavtaar offers cctv camera services in Jaipur and Delhi, India.' }}" />
        <meta name="twitter:image" content="{{ $Image ?? $Logo_File_Name }}" />
        <meta name="twitter:image:alt" content="{{ $settings['Twitter_Image_Alt'] }}" />
        <!-- Schema.org markup for Google+ -->
        <meta itemprop="name" content="@yield('title') - {{ $settings['Site_Name'] }}" />
        <meta itemprop="description" content="{{ $Description ?? 'aadhunikaavtaar offers cctv camera services in Jaipur and Delhi, India.' }}" />
        <meta itemprop="image" content="{{ $Image ?? $Logo_File_Name }}" />
        <meta itemprop="url" content="{{ $url ?? $settings['Site_Url'] }}" />
        <!--  Business Meta-->
        <meta property="business:contact_data:street_address" content="{{ $settings['Business_Street_Address'] }}" />
        <meta property="business:contact_data:locality" content="{{ $settings['Business_Locality'] }}" />
        <meta property="business:contact_data:region" content="{{ $settings['Business_Region'] }}" />
        <meta property="business:contact_data:postal_code" content="{{ $settings['Business_Postal_Code'] }}" />
        <meta property="business:contact_data:country_name" content="{{ $settings['Business_Country_Name'] }}" />
        <meta name="email" content="{{ $settings['Support_Email'] }}" />
        <meta name="Version" content="{{ $settings['App_Version'] }}" />
        <!-- Search String -->
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "WebSite",
                "@id": "#website",
                "url": "{{ $url ?? $settings['Site_Url'] }}",
                "name": "aadhunikaavtaar",
                "potentialAction": { "@type": "SearchAction", "target": "https://www.aadhunikaavtaar.com/?s={search_term_string}", "query-input": "required name=search_term_string" }
            }
        </script>
        <!-- Oraganization -->
        <script type="application/ld+json">
            {
              "@context": "https://schema.org",
              "@type": "Organization",
              "name": "Home - @yield('title')",
              "legalName" : "{{ $settings['Site_Name'] }}",
              "url": "{{ $url ?? $settings['Site_Url'] }}",
              "logo": "{{ $Logo_File_Name }}",
              "foundingDate": "{{ $settings['Founding_Date'] }}",
              "founders": [
              {
                  "@type": "{{ $settings['Founder_Type'] }}",
                  "name": "{{ $settings['Founder_Name'] }}"
              },
              "address": {
                  "@type": "PostalAddress",
                  "streetAddress": "{{ $settings['Business_Street_Address'] }}",
                  "addressLocality": "{{ $settings['Business_Locality'] }}",
                  "addressRegion": "IN",
                  "postalCode": "{{ $settings['Business_Postal_Code'] }}",
                  "addressCountry": "{{ $settings['Business_Country_Name'] }}"
              },
              "contactPoint": {
                  "@type": "{{ $settings['Contact_Point'] }}",
                  "contactType": "{{ $settings['Contact_Type'] }}",
                  "telephone": " {{ $settings['Support_Number'] }}",
                  "email": "{{ $settings['Support_Email'] }}"
              },
              "aggregateRating": {
                  "@type": "AggregateRating",
                  "bestRating": "{{ $settings['Best_Rating'] }}",
                  "ratingValue": "{{ $settings['Rating_Value'] }}",
                  "reviewCount": "{{ $settings['Review_Count'] }}"
              },
              "sameAs": [
                  "{{ $settings['Facebook_Link'] }}",
                  "{{ $settings['Twitter_Link'] }}",
                  "{{ $settings['Youtube_Link'] }}",
                  "{{ $settings['Linkedin_Link'] }}",
                  "{{ $settings['Instagram_Link'] }}",

            ]}
        </script>


        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/Web_Assets/img/favicon.png') }}" />

        {{-- CSS assets --}}
        <x-css-assets :paths="[
            'assets/css/plugins.css',
            'assets/css/search.css',
            'assets/css/base.css',
            'assets/css/styles.css',
            'assets/css/bootstrap-icons.css',
            'assets/css/custom-styles.css',
        ]" />

        @stack('css')
    </head>

    <body>

        <!-- PAGE LOADING
        ================================================== -->
        <div id="preloader"></div>

        <!-- MAIN WRAPPER
        ================================================== -->
        <div class="main-wrapper">

            <!-- header start -->
            @include('Web_Site.Include.Header')
            <!-- header end -->

            @yield('content')

            <!-- footer-area-start -->
            @include('Web_Site.Include.Footer')
            <!-- footer-area-end -->

        </div>

        <!-- Modal -->
        <div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 750px;">
                <div class="modal-content">
                    <div class="row g-0">
                        <!-- Image Side (Hidden on mobile) -->
                        <div class="col-md-5 d-none d-md-block">
                            <img src="img/content/about-11.jpg" class="img-fluid h-100 w-100" style="object-fit: cover;" alt="Enquiry Image" />
                        </div>

                        <!-- Form Side -->
                        <div class="col-12 col-md-7">
                            <div class="modal-header">
                                <h6 class="modal-title" id="enquiryModalLabel">Enquiry Form</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Your Name: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" placeholder="Rahul Choudhary" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Your Email: <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" placeholder="yourname@gmail.com" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Mobile Number: <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="phone" placeholder="+919876543210" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="queryFor" class="form-label">Query For: <span class="text-danger">*</span></label>
                                        <select class="form-select" id="queryFor" required>
                                            <option value="">Select an option</option>
                                            <option>CCTV Camera</option>
                                            <option>Biometric & Access Control</option>
                                            <option>Video Door Phone</option>
                                            <option>Intercom Systems</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="message" class="form-label">Your Requirement:</label>
                                        <textarea class="form-control" id="message" rows="3" placeholder="Tell us more about how we can help you."></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success w-100">Request your free quote</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- Side Button
        ================================================== -->
        <div class="side-buttons" aria-label="Contact options">
            <!-- Phone -->
            <a href="tel:+919610100127" class="phone-btn" title="Call Us" aria-label="Call Us">
                <i class="bi bi-telephone-fill"></i>
            </a>

            <!-- WhatsApp -->
            <a href="https://wa.me/919001600127?text=Hello..." target="_blank" rel="noopener" class="whatsapp-btn" title="Chat on WhatsApp" aria-label="Chat on WhatsApp">
                <i class="bi bi-whatsapp"></i>
            </a>
        </div>

        <!-- Theme Script js -->
        {{-- JS assets --}}
        <x-js-assets :paths="[
            'assets/js/front/jquery.min.js',
            'assets/js/front/popper.min.js',
            'assets/js/front/bootstrap.min.js',
            'assets/js/front/core.min.js',
            'assets/js/front/search.js',
            'assets/js/front/main.js',
            'assets/js/front/plugins.js',
            'assets/js/front/scripts.js',
            'assets/js/front/axios.min.js',
            'assets/js/front/custom-scripts.js',
            'assets/plugins/notifications/js/lobibox.min.js',
            'assets/plugins/notifications/js/notifications.min.js',
        ]" />

        <script type="text/javascript">
            async function sendAxiosRequest({ url, method = "post", data = {}, headers = "application/json", timeout = 8000000 })
            {
                try
                {
                    let res = await axios({
                        url : url,
                        data : data,
                        method : method,
                        headers : {
                            'Content-Type': headers,
                        },
                        timeout : timeout,
                    });
                    if (res.status === 200)
                    {
                        console.log(res.status)
                    }
                    return res;
                }
                catch (err)
                {
                    return err;
                }
            }

            // Add a request interceptor
            axios.interceptors.request.use(function (config)
            {
                // Show loader before request is sent
                $("#loader").show();
                return config;
            },
            function (error)
            {
                // Hide loader and handle request error
                $("#loader").hide();
                return Promise.reject(error);
            });

            // Add a response interceptor
            axios.interceptors.response.use(function (response)
            {
                // Hide loader on response
                $("#loader").hide();
                return response;
            },
            function (error)
            {
                // Hide loader and handle response error
                $("#loader").hide();
                return Promise.reject(error);
            });

            axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            function axiosToast(status , message)
            {
                switch(status)
                {
                    case 'warning':
                        icon = 'bx bx-error';
                    break;
                    case 'success':
                        icon = 'bx bx-check-circle';
                    break;
                    case 'error':
                        icon = 'bx bx-x-circle';
                    break;
                    case 'info':
                        icon = 'bx bx-info-circle';
                    break;
                }

                Lobibox.notify(status, {
                    msg : message,
                    size : 'mini',
                    icon : icon,
                    rounded : true,
                    position : 'top right',
                    delayIndicator : true,
                    pauseDelayOnHover : true,
                    continueDelayOnInactiveTab : false,
                });
            }

            // Handle Error from Axios Request (Network or Server Errors)
            function handleAxiosErrorRequest(error)
            {
                let errorMessage = "An unexpected error occurred. Please try again later.";
                if (error.response)
                {
                    const responseData = error.response?.data;
                    if (responseData?.errors && typeof responseData.errors === 'object')
                    {
                        Object.values(responseData.errors).forEach((errorMessage) => axiosToast('error', errorMessage));
                    }
                    else
                    {
                        errorMessage = responseData?.message || "Server error. Please try again.";
                        axiosToast('error', errorMessage);
                    }
                }
                else if (error.request)
                {
                    errorMessage = "Network error. Please check your internet connection.";
                    axiosToast('error', errorMessage);
                }
                else
                {
                    errorMessage = error.message || "An unexpected error occurred.";
                    axiosToast('error', errorMessage);
                }
            }

            // Handle Error Response from Server
            function handleAxiosErrorResponse(response)
            {
                const errors = response?.response?.data?.errors;
                if (errors && typeof errors === 'object')
                {
                    Object.values(errors).forEach((errorMessage) => axiosToast('error', errorMessage));
                }
                else
                {
                    const errorMessage = response?.response?.data?.message || "Unknown error occurred.";
                    axiosToast('error', errorMessage);
                }
            }

            $(document).ready(function(e)
            {
                @if(session('success'))
                    axiosToast('success', "{{session('success')}}");
                @endif

                @if(session('warning'))
                    axiosToast('warning', "{{session('warning')}}");
                @endif

                @if(session('error'))
                    axiosToast('error', "{{session('error')}}");
                @endif

                @if(session('info'))
                    axiosToast('info', "{{session('info')}}");
                @endif
            });


            $('#Search').on('keyup', function ()
            {
                const value = $(this).val();
                const Search_Type = $('#Search_Type').val();
                const url = "{{ url()->full() }}";
                // Prepare the AJAX request
                const sendAxiosRequest = (searchValue) =>
                {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: { Search: searchValue },
                        beforeSend: function () {
                            $('#product-container').addClass('loading'); // Optional loading state
                        },
                        success: function (data) {
                            $('#product-container').html(data);
                        },
                        complete: function () {
                            $('#product-container').removeClass('loading');
                        },
                        error: function () {
                            alert('Something went wrong, please try again.');
                        },
                    });
                };

                if(Search_Type == 'products')
                {
                    // Check the input length
                    if (value.length >= 3)
                    {
                        sendAxiosRequest(value); // Perform the search
                    }
                    else if (value.length === 0)
                    {
                        sendAxiosRequest(''); // Optionally clear results for empty input
                    }
                }
            });

            setTimeout(function () 
            {
                const myModal = new bootstrap.Modal(document.getElementById('enquiryModal'));
                myModal.show();
            }, 5000); // 5 seconds
        </script>
        @stack('js')
    </body>
</html>
