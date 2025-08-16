<!DOCTYPE html>
<html lang="en">
    
<head>
    @stack('meta')

    {{-- CSS assets --}}
    <x-css-assets :paths="[
        'web-assets/css/bootstrap.min.css',
        'web-assets/css/font/bootstrap-icons.css',
        'web-assets/css/all.min.css',
        'web-assets/css/brands.min.css',
        'web-assets/css/fontawesome.min.css',
        'web-assets/css/regular.min.css',
        'web-assets/css/solid.min.css',
        'web-assets/css/svg-with-js.min.css',
        'web-assets/css/v4-font-face.min.css',
        'web-assets/css/v4-shims.min.css',
        'web-assets/css/v5-font-face.min.css',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
        'web-assets/flatpickr/flatpickr.min.css',
        'web-assets/flatpickr/flatpickr.css',
        'web-assets/css/styles.css',
        'assets/plugins/notifications/css/lobibox.min.css',
        
    ]" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('css')

    <!-- Theme Script js -->
    {{-- JS assets --}}
</head>
<body>
    
    {{-- Header --}}
    <x-web.header/>

    <main>
        <div id="preloader" style="display: none; position: fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(255,255,255,0.85); z-index:9999; display:flex; align-items:center; justify-content:center;">
            <div class="spinner-border text-primary" role="status" style="width:3rem; height:3rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        {{ $slot }}
        
    </main>

    {{-- Footer --}}
    <x-web.footer />


    <div class="toast-container position-fixed top-0 end-0 p-3"></div>
    <!-- Theme Script js -->
    <!-- jQuery -->
    <!-- popper js -->
     <!-- bootstrap -->
    
    {{-- JS assets --}}
      <!-- Google reCaptcha -->
     <!-- Bootstrap JS -->
     <x-js-assets :paths="[
        'https://code.jquery.com/jquery-3.6.0.min.js',
        'web-assets/js/all.min.js',
        'web-assets/js/bootstrap.bundle.min.js',
        'web-assets/js/brands.min.js',
        'web-assets/js/conflict-detection.min.js',
        'web-assets/js/fontawesome.min.js',
        'web-assets/js/regular.min.js',
        'web-assets/js/solid.min.js',
        'web-assets/js/v4-shims.min.js',
        'web-assets/js/script.js',
        'web-assets/flatpickr/flatpickr.js',
        'https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js',
        'assets/plugins/notifications/js/lobibox.min.js',
        'assets/plugins/notifications/js/notifications.min.js',
    ]" />
    <!--  -->
    @stack('js')
    <script type="text/javascript">

        // Function to show the preloader
        function showLoader() {
            const preloader = document.getElementById("preloader");
            if (!preloader) {
                return new Error('Preloader element with id "preloader" not found.');
            }
            preloader.style.display = "flex";
            preloader.classList.remove("hide-preloader");
        }

        // Ensure preloader is hidden when page is fully loaded and provide a single hideLoader function
        function hideLoader(response) {
            const preloader = document.getElementById("preloader");
            if (!preloader) {
                return new Error('Preloader element with id "preloader" not found.');
            }
            preloader.classList.add("hide-preloader");
            setTimeout(function() {
                preloader.style.display = "none";
            }, 500);
        }

        document.addEventListener("DOMContentLoaded", function() {
            hideLoader();
        });

        function axiosToast(status, message) {
            let icon;
            switch(status) {
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
                default:
                    icon = '';
            }

            Lobibox.notify(status, {
                msg: message,
                size: 'mini',
                icon: icon,
                rounded: true,
                position: 'top right',
                delayIndicator: true,
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
            });
        }

        /**
         * Makes an HTTP request using Axios with standardized configuration.
         * @param {Object} options - The request options.
         * @param {string} options.url - The endpoint URL.
         * @param {string} [options.method="post"] - The HTTP method.
         * @param {Object} [options.data={}] - The request payload.
         * @param {string} [options.contentType="application/json"] - The Content-Type header.
         * @param {number} [options.timeout=8000] - The request timeout in milliseconds.
         * @returns {Promise<Object>} - The Axios response or error object.
         */
        async function axiosRequest({
            url,
            method = "post",
            data = {},
            contentType = "application/json",
            timeout = 8000,
            headers = {
                'Content-Type': contentType,
            },
        }) {
            try {
                const response = await axios({
                    url,
                    method,
                    data,
                    headers,
                    timeout,
                });
                console.log(response.status);
                return response;
            } catch (error) {
                console.error("Axios request failed:", error);
                return error;
            }
        }
        // Add a request interceptor
        axios.interceptors.request.use(function (config)
        {
            document.getElementById("preloader").style.display = "flex";
            return config;
        },
        function (error)
        {
            hideLoader();
            return Promise.reject(error);
        });

        // Add a response interceptor
        axios.interceptors.response.use(function (response)
        {
            hideLoader();
            return response;
        },
        function (error)
        {
            hideLoader();
            return Promise.reject(error);
        });

        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        

        /**
         * Handles errors from Axios requests, including network and server errors.
         * Displays a professional error notification to the user.
         * @param {Object} error - The error object returned by Axios.
         */
        function handleAxiosRequestError(error) {
            hideLoader();
            let errorMessage = "An unexpected error occurred. Please try again later.";

            if (error.response) {
                var responseData = error.response && error.response.data;
                if (responseData && responseData.errors && typeof responseData.errors === 'object') {
                    Object.values(responseData.errors).forEach(function(msg) { axiosToast('error', msg); });
                } else {
                    errorMessage = (responseData && responseData.message) || "A server error occurred. Please try again.";
                    axiosToast('error', errorMessage);
                }
            } else if (error.request) {
                errorMessage = "Network error. Please check your internet connection and try again.";
                axiosToast('error', errorMessage);
            } else {
                errorMessage = error.message || "An unexpected error occurred.";
                axiosToast('error', errorMessage);
            }
        }

        /**
         * Handles error responses from the server and displays appropriate notifications.
         * @param {Object} response - The Axios response object containing error details.
         */
        function handleAxiosResponseError(response) {
            hideLoader();
            var errors = response && response.response && response.response.data && response.response.data.errors;
            if (errors && typeof errors === 'object') {
                Object.values(errors).forEach(function(msg) { axiosToast('error', msg); });
            } else {
                var errorMessage = (response && response.response && response.response.data && response.response.data.message) || "An unknown error occurred.";
                axiosToast('error', errorMessage);
            }
        }

        // Try logging to see if this runs at all:
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

        
    </script>
</body>
</html>