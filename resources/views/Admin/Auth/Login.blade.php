<!DOCTYPE html>
@php
    $siteName = "Admin";
@endphp
<html lang="zxx" class="js">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />

    {{-- CSS assets --}}
    <x-css-assets :paths="[
        'assets/plugins/simplebar/css/simplebar.css',
        'assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css',
        'assets/plugins/metismenu/css/metisMenu.min.css',
        'assets/css/pace.min.css',
        'assets/plugins/notifications/css/lobibox.min.css',
    ]" />
    <link rel="stylesheet" href="https://laravel-unisafe.test/assets/plugins/notifications/css/lobibox.min.css">
        

    <!-- Theme Script js -->
        {{-- JS assets --}}
        <x-js-assets :paths="[
            'assets/js/pace.min.js',
        ]" />

        {{-- CSS assets --}}
        <x-css-assets :paths="[
            'assets/css/bootstrap.min.css',
            'assets/css/bootstrap-extended.css',
            'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap',
            'assets/css/app.css',
            'assets/css/icons.css',
        ]" />

    <!-- Bootstrap CSS -->
    <title>{{$siteName}} : Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
</head>
<body class="">
    <!--wrapper-->
    <div class="wrapper">
        <div id="overlay"></div>
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="p-4">
                                    <div class="mb-3 text-center">
                                        <img src="{{ getDynamicImage($settings['Site_Logo'] ?? '', 'Uploads/Settings') }}" width="60" alt="" />
                                    </div>
                                    <div class="form-body">
                                        <form action="{{ route('login') }}" method="post" id="login-form" class="row g-3">
                                            @CSRF
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="inputEmailAddress" placeholder="jhon@example.com" name="email" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" name="password" class="form-control border-end-0" id="inputChoosePassword" autocomplete="off" placeholder="Enter Password" required>
                                                    <a href="javascript:;" class="input-group-text bg-transparent">
                                                        <i class='bx bx-hide'></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
        <x-js-assets :paths="[
            'assets/js/bootstrap.bundle.min.js',
            'assets/js/jquery.min.js',
            'assets/plugins/simplebar/js/simplebar.min.js',
            'assets/plugins/metismenu/js/metisMenu.min.js',
            'assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js',
        ]" />

    <!--Password show & hide js -->
    <script>
        $(document).ready(function ()
        {
            $("#show_hide_password a").on('click', function (event)
            {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text")
                {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                }
                else if ($('#show_hide_password input').attr("type") == "password")
                {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>

    <x-js-assets :paths="[
        'assets/js/app.js',
        'https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js',
        'assets/plugins/notifications/js/lobibox.min.js',
        'assets/plugins/notifications/js/notifications.min.js',
    ]" />

    <!-- end notification js -->
    <script type="text/javascript">
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

        $('#login-form').submit(function(e)
        {
            e.preventDefault()
            const formData = new FormData(this);

            const axios_request = sendAxiosRequest({
                url : "{{ route('login') }}",
                data : formData,
            });

            axios_request.then(function (response)
            {
                // console.log(response);
                if (response.status === 200)
                {
                    var message = response.data.message;
                    axiosToast('success', message);
                    window.location.replace(response.data.redirect);
                }
                else
                {
                    // console.error("Unexpected response status:", response.status);
                    // console.log("Response data:", response);
                    handleAxiosErrorResponse(response);
                }
            }).catch((error) => handleAxiosErrorRequest(error));
        });

        

        // Handle Error from Axios Request (Network or Server Errors)
        function handleAxiosErrorRequest(error)
        {
            console.error("Axios Request Error:", error);
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
                console.error("Axios Response Error:", response);
                console.error("Error Message:", errorMessage);
                axiosToast('error', errorMessage);
            }
        }
    </script>
</body>
</html>
