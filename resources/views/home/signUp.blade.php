<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $websiteSettings->name }}</title>
    <link rel="icon" type="image/png" href="{{asset('assets/images/BD/All-Panel-Pro-Logo-Favicon.png')}}" sizes="16x16">
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
</head>

<body>
    <div id="toast"
        class="toast fixed bottom-4 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-md shadow-lg z-50">
        <p id="toast-message">Signup successful!</p>
    </div>
    <section class="auth bg-base d-flex flex-wrap">
        <div class="auth-left d-lg-block d-none">
            <div class="d-flex align-items-center flex-column h-100 justify-content-center">
                <img src="{{ asset('assets/images/login-signup.svg') }}" alt="">
            </div>
        </div>
        <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
            <div class="max-w-464-px mx-auto w-100">
                <div>
                    <a href="{{ route('index') }}" class="mb-40 max-w-290-px">
                        <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" width="180">
                    </a>
                    <h4 class="mb-12">Sign Up to your Account</h4>
                    <p class="mb-32 text-secondary-light text-lg">Welcome back! please enter your detail</p>
                </div>
                <form id="signupForm" autocomplete="off">
                    @csrf
                    <!-- Phone Number -->
                    <div class="icon-field mb-16">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="mage:phone"></iconify-icon>
                        </span>
                        <input type="text" autocomplete="off" class="form-control h-56-px bg-neutral-50 radius-12" name="phone_number"
                               placeholder="Phone">
                    </div>

                    <!-- Password -->
                    <div class="mb-16">
                        <div class="position-relative">
                            <div class="icon-field">
                                <span class="icon top-50 translate-middle-y">
                                    <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                                </span>
                                <input type="password" autocomplete="new-password" name="password" class="form-control h-56-px bg-neutral-50 radius-12"
                                       id="your-password" placeholder="Password">
                            </div>
                            <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light"
                                  data-toggle="#your-password"></span>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-16">
                        <div class="position-relative">
                            <div class="icon-field">
                                <span class="icon top-50 translate-middle-y">
                                    <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                                </span>
                                <input type="password" autocomplete="new-password" name="password_confirmation" class="form-control h-56-px bg-neutral-50 radius-12"
                                       id="confirm-password" placeholder="Confirm Password">
                            </div>
                            <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light"
                                  data-toggle="#confirm-password"></span>
                        </div>
                        <span class="mt-12 text-sm text-secondary-light">Your password must have at least 8 characters</span>
                    </div>

                    <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12">Sign Up</button>

                    <div class="mt-32 text-center text-sm">
                        <p class="mb-0">Already have an account? <a href="{{ route('login.view') }}" class="text-primary-600 fw-semibold">Sign In</a></p>
                    </div>
                </form>


            </div>
        </div>
    </section>



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

        $(document).ready(function () {
            $('#signupForm').on('submit', function (e) {
                e.preventDefault(); // Prevent the form from submitting normally

                // Clear any previous messages
                $('#alert-success').hide();
                $('#alert-error').hide();

                $.ajax({
                    url: "{{route('signup.store')}}",
                    type: 'POST',
                    data: $(this).serialize(), // Serialize form data
                    success: function (response) {
                        // Show success message
                        showToast(response.message, 'success'); // Green toast for success
                        $('#signupForm')[0].reset(); // Reset the form
                        setTimeout(function () {
                            window.location.href = "{{ route('users.dashboard') }}";
                        }, 1000);

                    },
                    error: function (xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';

                        // Check if there are specific errors or a general message
                        if (errors) {
                            // Loop through each error and concatenate them
                            $.each(errors, function (key, messages) {
                                errorMessage += messages.join(' ') + '<br>';
                            });
                        } else {
                            errorMessage = xhr.responseJSON.message || 'An unknown error occurred.';
                        }

                        // Display error message in the toast or any other notification element
                        showToast(errorMessage, 'error');
                    }
                });
            });
        });
    </script>

</body>

</html>
