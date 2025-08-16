<!doctype html>
@php
    $siteName = "Admin";
@endphp
<html lang="en" class="dark-theme">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--favicon-->
        <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
        <!--plugins-->
        <script>
            // Immediately apply theme before render
            (function() {
                const savedTheme = localStorage.getItem("theme") || "light";
                document.documentElement.className = savedTheme + "-theme";
            })();
        </script>

        {{-- CSS assets --}}
        <x-css-assets :paths="[
            'assets/plugins/notifications/css/lobibox.min.css',
            'assets/plugins/vectormap/jquery-jvectormap-2.0.2.css',
            'assets/plugins/simplebar/css/simplebar.css',
            'assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css',
            'assets/plugins/metismenu/css/metisMenu.min.css',
            'assets/css/pace.min.css',
            
        ]" />

        <!-- Theme Script js -->
        {{-- JS assets --}}
        <x-js-assets :paths="[
            'assets/js/pace.min.js',
        ]" />

        {{-- CSS assets --}}
        <x-css-assets :paths="[
            'assets/css/bootstrap.min.css',
            'assets/css/bootstrap-extended.css',
            'assets/plugins/simplebar/css/simplebar.css',
            'assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css',
            'assets/plugins/metismenu/css/metisMenu.min.css',
            'assets/css/pace.min.css',
            'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap',
            'assets/css/app.css',
            'assets/css/icons.css',
            'assets/css/dark-theme.css',
            'assets/css/semi-dark.css',
            'assets/css/header-colors.css',
            'assets/flatpickr/flatpickr.min.css',
            'select2@4.1.0/dist/css/select2.min.css',
            'Select2-Bootstrap-5-Theme/dist/select2-bootstrap-5-theme.min.css',
        ]" />

        <!-- Bootstrap CSS -->

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{$siteName}} : @yield('title')</title>
        <style type="text/css">
            #overlay {
                position: fixed; /* Sit on top of the page content */
                display: none; /* Hidden by default */
                width: 100%; /* Full width (cover the whole page) */
                height: 100%; /* Full height (cover the whole page) */
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0,0,0,0.5); /* Black background with opacity */
                z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
                cursor: pointer; /* Add a pointer on hover */
            }
        </style>
        @stack('css')
    </head>

    <body>
        <!--wrapper-->
        <div class="wrapper">
            <div id="overlay"></div>
            <!--sidebar wrapper -->
            @include('Admin.Include.sidebar')
            <!--end sidebar wrapper -->

            <!--start header -->
            @include('Admin.Include.header')
            <!--end header -->

            <!--start page wrapper -->
                @yield('content')
            <!--end page wrapper -->

            <!--start overlay-->
            <div class="overlay toggle-icon"></div>
            <!--end overlay-->

            <!--Start Back To Top Button-->
            <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
            <!--End Back To Top Button-->

            <footer class="page-footer">
                <div class="nk-footer-copyright">&copy; 2025 Unisafe Securities. Developed by
                    <a href="https://freedekhosoftware.com">FreeDekho Software</a>
                </div>
            </footer>
        </div>
        <!--end wrapper-->
        <x-js-assets :paths="[
            'assets/js/bootstrap.bundle.min.js',
            'assets/js/jquery.min.js',
            'assets/plugins/simplebar/js/simplebar.min.js',
            'assets/plugins/metismenu/js/metisMenu.min.js',
            'assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js',
            'assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js',
            'assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js',
            'assets/plugins/chartjs/js/chart.js',
            'assets/plugins/sparkline-charts/jquery.sparkline.min.js',
            'assets/plugins/notifications/js/lobibox.min.js',
            'assets/plugins/notifications/js/notifications.min.js',
            'assets/js/pace.min.js',
            'assets/flatpickr/flatpickr-1'
        ]" />

        <script type="text/javascript">
            var chart5 = document.getElementById('chart5');
            if (chart5 !== null)
            {
                var script = document.createElement('script');
                script.src = "{{ asset('assets/js/index3.js') }}";
                script.type = "text/javascript";
                document.body.appendChild(script);  // Or document.head.appendChild(script);
            }
        </script>

        <x-js-assets :paths="[
            'assets/plugins/validation/jquery.validate.min.js',
            'assets/plugins/validation/validation-script.js',
            'assets/js/app.js',
            'https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js',
            'select2@4.1.0/dist/js/select2.min.js',
            'assets/plugins/select2/js/select2-custom.js',
            'assets/js/image-uploader.js',
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
                $("#overlay").show();
                return config;
            },
            function (error)
            {
                // Hide loader and handle request error
                $("#overlay").hide();
                return Promise.reject(error);
            });

            // Add a response interceptor
            axios.interceptors.response.use(function (response)
            {
                // Hide loader on response
                $("#overlay").hide();
                return response;
            },
            function (error)
            {
                // Hide loader and handle response error
                $("#overlay").hide();
                return Promise.reject(error);
            });

            axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            window.axiosToast = function(status, message)
            {
                let icon;
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
                $("#overlay").hide();
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
                $("#overlay").hide();
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

            const handleFileAction = (action, { fileInputId, previewImageId, buttonsId, placeholder }) =>
            {
                const buttons = document.getElementById(buttonsId);
                const fileInput = document.getElementById(fileInputId);
                const previewImage = document.getElementById(previewImageId);

                switch (action)
                {
                    case "change":
                        fileInput.click(); // Trigger file input click
                    break;

                    case "remove":
                        previewImage.src = placeholder; // Reset to placeholder image
                        fileInput.value = ""; // Clear the file input
                        buttons.style.display = "none"; // Hide buttons
                    break;

                    case "preview":
                        const file = fileInput.files[0];
                        if (file)
                        {
                            const reader = new FileReader();
                            reader.onload = (e) =>
                            {
                                previewImage.src = e.target.result; // Set preview image
                                buttons.style.display = "block"; // Show buttons
                            };
                            reader.readAsDataURL(file);
                        }
                    break;

                    default:
                        axiosToast('warning', `Unknown action: ${action}`);
                }
            };

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

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        axiosToast('error', "{{ $error }}");
                    @endforeach
                @endif
            });


            const showDynamicComponent = (componentId, contentId, fetchUrl, type = 'modal') => 
            {
                // Show loading spinner
                document.getElementById(contentId).innerHTML = `
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                `;

                // Show the component (modal or offcanvas)
                if (type === 'offcanvas') 
                {
                    const comp = new bootstrap.Offcanvas(document.getElementById(componentId));
                    comp.show();
                } 
                else 
                {
                    const comp = new bootstrap.Modal(document.getElementById(componentId));
                    comp.show();
                }

                // Fetch the content
                fetch(fetchUrl)
                .then(response => 
                {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.text();
                })
                .then(html => 
                {
                    document.getElementById(contentId).innerHTML = html;
                })
                .catch(() => 
                {
                    document.getElementById(contentId).innerHTML = `
                        <div class="alert alert-danger">Failed to load content.</div>
                    `;
                });
            };

        </script>
        <script src="{{ asset('assets/js/status.js') }}"></script>
        @stack('js')
    </body>
</html>