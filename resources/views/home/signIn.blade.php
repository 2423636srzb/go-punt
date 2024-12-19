<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $websiteSettings->name }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}" sizes="16x16">
    <!-- remix icon font css  -->
    <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">
    <!-- BootStrap css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/bootstrap.min.css') }}">
    <!-- Apex Chart css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/apexcharts.css') }}">
    <!-- Data Table css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/dataTables.min.css') }}">
    <!-- Text Editor css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/editor-katex.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lib/editor.atom-one-dark.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lib/editor.quill.snow.css') }}">
    <!-- Date picker css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/flatpickr.min.css') }}">
    <!-- Calendar css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/full-calendar.css') }}">
    <!-- Vector Map css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/jquery-jvectormap-2.0.5.css') }}">
    <!-- Popup css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/magnific-popup.css') }}">
    <!-- Slick Slider css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/slick.css') }}">
    <!-- prism css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/prism.css') }}">
    <!-- file upload css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/file-upload.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/lib/audioplayer.css') }}">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        #otp-verification-popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    z-index: 1050;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

    </style>

</head>

<body>

    <section class="auth bg-base d-flex flex-wrap">
        <div class="auth-left d-lg-block d-none">
            <div class="d-flex align-items-center flex-column h-100 justify-content-center">
                <img src="{{ asset('assets/images/login-signup.svg') }}" alt="">
            </div>
        </div>
        <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
            <div class="max-w-464-px mx-auto w-100">
                <div>
                    <a href="{{  route('index') }}" class="mb-40 max-w-290-px">
                        <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" width="180">
                    </a>
                    <h4 class="mb-12">Sign In to your Account</h4>
                    <p class="mb-32 text-secondary-light text-lg">Welcome back! please enter your detail</p>
                </div>
                <form id="login-form">
                    @csrf <!-- CSRF token -->
                    <div class="icon-field mb-16">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="mage:email"></iconify-icon>
                        </span>
                        <input type="text" name="email" class="form-control h-56-px bg-neutral-50 radius-12"
                            placeholder="Email / Phone Number">
                    </div>
                    <div class="position-relative mb-20">
                        <div class="icon-field">
                            <span class="icon top-50 translate-middle-y">
                                <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                            </span>
                            <input type="password" name="password" class="form-control h-56-px bg-neutral-50 radius-12"
                                id="your-password" placeholder="Password">
                        </div>
                        <span
                            class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light"
                            data-toggle="#your-password"></span>
                    </div>
                    <div class="">
                        <div class="d-flex justify-content-between gap-2">
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input border border-neutral-300" type="checkbox" value=""
                                    id="remeber">
                                <label class="form-check-label" for="remeber">Remember me </label>
                            </div>
                            <a href="{{route('forgotpassword.view')}}" class="text-primary-600 fw-medium">Forgot
                                Password?</a>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32"> Sign
                        In</button>

                    <div class="mt-32 text-center text-sm">
                        <p class="mb-0">Don’t have an account? <a href="{{  route('signUp.view') }}"
                                class="text-primary-600 fw-semibold">Sign Up</a></p>
                    </div>

                </form>
            </div>
        </div>

        <div id="otp-verification-popup" style="display: none;">
            <h4>OTP Verification</h4>
            <p>An OTP has been sent to your email. Please enter it below to continue.</p>
            <form id="otp-form">
                @csrf
                <input type="text" name="otp" class="form-control" placeholder="Enter OTP">
                <button type="submit" class="btn btn-primary mt-3">Verify OTP</button>
            </form>
            <p class="text-danger mt-2" id="otp-error" style="display: none;"></p>
        </div>

    </section>
    <div id="toast"
        class="toast hidden fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-md shadow-lg z-50">
        <p id="toast-message">Signup successful!</p>
    </div>


    <!-- jQuery library js -->
    <script src="{{ asset('assets/js/lib/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('assets/js/lib/bootstrap.bundle.min.js') }}"></script>
    <!-- Apex Chart js -->
    <script src="{{ asset('assets/js/lib/apexcharts.min.js') }}"></script>
    <!-- Data Table js -->
    <script src="{{ asset('assets/js/lib/dataTables.min.js') }}"></script>
    <!-- Iconify Font js -->
    <script src="{{ asset('assets/js/lib/iconify-icon.min.js') }}"></script>
    <!-- jQuery UI js -->
    <script src="{{ asset('assets/js/lib/jquery-ui.min.js') }}"></script>
    <!-- Vector Map js -->
    <script src="{{ asset('assets/js/lib/jquery-jvectormap-2.0.5.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- Popup js -->
    <script src="{{ asset('assets/js/lib/magnifc-popup.min.js') }}"></script>
    <!-- Slick Slider js -->
    <script src="{{ asset('assets/js/lib/slick.min.js') }}"></script>
    <!-- prism js -->
    <script src="{{ asset('assets/js/lib/prism.js') }}"></script>
    <!-- file upload js -->
    <script src="{{ asset('assets/js/lib/file-upload.js') }}"></script>
    <!-- audioplayer -->
    <script src="{{ asset('assets/js/lib/audioplayer.js') }}"></script>

    <!-- main js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script>
        // ================== Password Show Hide Js Start ==========
        function initializePasswordToggle(toggleSelector) {
            $(toggleSelector).on('click', function () {
                $(this).toggleClass("ri-eye-off-line");
                var input = $($(this).attr("data-toggle"));
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        }
        // Call the function
        initializePasswordToggle('.toggle-password');
        // ========================= Password Show Hide Js End ===========================


        $('#login-form').on('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    var formData = $(this).serialize(); // Serialize the login form data, including the CSRF token

    $.ajax({
        url: '{{ route("login") }}', // Route for login action
        method: 'POST',
        data: formData,
        success: function (response) {
            if (response.status === 'otp_required') {
                $('#otp-verification-popup').show(); // Show OTP modal
            } else if (response.status === 'success') {
                // alert(response.message);
                window.location.href = '{{ route('users.dashboard') }}'; // Redirect after successful login
            } else {
                alert(response.message || 'An unexpected error occurred.');
            }
        },
        error: function (xhr) {
            alert(xhr.responseJSON.message || 'Login failed.');
        }
    });
});


// OTP verification
$('#otp-form').on('submit', function (e) {
    e.preventDefault();

    const otp = $('input[name="otp"]').val();

    $.ajax({
        url: '/admin-verify-otp', // Update to your OTP verification route
        method: 'POST',
        data: {
            otp: otp,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            // alert(response.message);
            window.location.href = '{{ route('admin.dashboard') }}'; // Redirect after OTP verification
        },
        error: function (xhr) {
            $('#otp-error').text(xhr.responseJSON.message).show(); // Display error
        }
    });
});




    
                // success: function (response) {
                //     if (response.status === 'success') {
                //         // Display success toast message
                //         showToast(response.message, 'success'); // Green toast for success
                //         setTimeout(function () {
                //             //closeLoginModal(); // Close the modal after a short delay
                //         }, 1000);
                //         if (response.is_admin == '1') {
                //             window.location.href = "{{ route('admin.dashboard') }}";
                //         } else {
                //             window.location.href = '{{ route("users.dashboard") }}';
                //         }
                //     }
                // },
                // error: function (xhr) {
                //     let errors = xhr.responseJSON.errors;
                //     let errorMessage = '';

                //     // Check if there are specific errors or a general message
                //     if (errors) {
                //         // Loop through each error and concatenate them
                //         $.each(errors, function (key, messages) {
                //             errorMessage += messages.join(' ') + '<br>';
                //         });
                //     } else {
                //         errorMessage = xhr.responseJSON.message || 'An unknown error occurred.';
                //     }

                //     // Display error message in the toast or any other notification element
                //     showToast(errorMessage, 'error');
                // }
    </script>



</body>

</html>