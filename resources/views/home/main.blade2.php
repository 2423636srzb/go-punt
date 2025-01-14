<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $websiteSettings->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('assets/app/dist/app.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/app/dist/magnific-popup.css')}}" />
    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <!-- End Style CSS -->

    <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.png')}}" />
    <link
      rel="apple-touch-icon-precomposed"
      href="{{asset('assets/images/logo/favicon.png')}}"
    />



    <style>
      @keyframes rotateText {
    0% {
        transform: translateX(100%);
    }

    25% {
        transform: translateX(0);
    }

    50% {
        transform: translateX(-100%);
    }

    75% {
        transform: translateX(-200%);
    }

    100% {
        transform: translateX(100%);
    }
}

.rotating-text {
    display: inline-block;
    animation: rotateText 30s infinite linear;
    white-space: nowrap; /* Prevents text wrapping */
}

        .game-item:hover img {
            transform: scale(1.05);
        }

        .game-item:hover button::after {
            content: "Check it Out!";
        }

        .toast {
            transition: opacity 0.5s ease-in-out;
            visibility: hidden;
            opacity: 0;
        }

        .toast.show {
            visibility: visible;
            opacity: 1;
        }

        /* Set a high z-index to the dropdown */
        #user-dropdown {
            z-index: 1050;
        }
    </style>
</head>

<body class="bg-white">
    @php
    $announcementText = str_replace('/', '<br>', $announcement->announcetext);
@endphp
    <!-- Announcement Bar -->
    <div class="bg-red-600 text-white text-center py-2">
        <div class="overflow-hidden h-6">
            <div class="rotating-text">
                <div>{!! $announcementText!!}</div>
            </div>
        </div>
    </div>

    <!-- Navigation Bar -->
    {{-- <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center"> --}}
                {{-- <?php $setting = DB::table('settings')->first(); ?> --}}
                {{-- <img src="{{ asset($setting->logo) }}" alt="Logo Dark" class="mr-3" width="180"> --}}
                
                {{-- <h3 class="text-center text-lg font-semibold text-black">{{$setting->name}}</h3> --}}
            {{-- </div>
            <ul class="hidden md:flex space-x-6">
                <li><a href="#" class="text-gray-700 hover:text-red-500">Home</a></li>
                <li><a href="#" class="text-gray-700 hover:text-red-500">About</a></li>
                <li><a href="#" class="text-gray-700 hover:text-red-500">Games</a></li>
                <li><a href="#" class="text-gray-700 hover:text-red-500">Contact</a></li>
            </ul> --}}

            <!-- User Dropdown (Visible only after login) -->
            {{-- <div id="user-profile" class="hidden flex items-center space-x-4" style="cursor: pointer;"
                onclick="toggleDropdown()"> --}}
                {{-- @php
$image = asset('assets/images/users/avatar-large-square.jpg');
if (Auth::check() && Auth::user()->profile_image) {
    $image = url(Auth::user()->profile_image);
}
@endphp --}}

{{-- <img src="{{ $image }}" alt="User Logo" width="40" class="rounded-full" id="user-logo">
                <span id="user-name" class="text-gray-700"></span>
                <div class="relative">
                    <button class="text-gray-700">
                        <i class="fas fa-caret-down"></i>
                    </button>
                    <div id="user-dropdown" class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-md hidden">
                        <a href="{{ route('users.user_profile') }}" class="block px-4 py-2 text-gray-700">Profile</a>
                        <button onclick="logout()"
                            class="block w-full text-left px-4 py-2 text-gray-700">Logout</button>
                    </div>
                </div>
            </div> --}}

            {{-- <div id="auth-buttons" class="@if(auth()->check()) hidden @else md:flex @endif ">
                <button class="bg-red-500 text-white px-4 py-2 rounded-full mr-2 flex items-center"
                    onclick="window.location.href='{{route('signUp.view')}}' ">
                    <i class="fas fa-user-plus mr-2"></i>Sign Up
                </button>
                <button class="bg-gray-500 text-white px-4 py-2 rounded-full flex items-center"
                    onclick="window.location.href='{{route('login.view')}}' ">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </button>
            </div>
        </div>
    </nav> --}}


    <header id="header_main" class="header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="header__body d-flex justify-content-between">
                <div class="header__left">
                  <div class="logo">
                    <?php $setting = DB::table('settings')->first(); ?>
                    <a class="light" href="#">
                      <img
                        id="site-logo"
                        src="{{ asset($setting->logo) }}"
                        alt=""
                        width="118"
                        height="32"
                        data-retina="{{asset('assets/images/logo/logo@2x.png')}}"
                        data-width="118"
                        data-height="32"
                      />
                    </a>
                    <a class="dark" href="index.html">
                      <img
                        src="{{ asset($setting->logo) }}"
                        alt=""
                        width="118"
                        height="32"
                        data-retina="{{asset('assets/images/logo/logo-dark@2x.png')}}"
                        data-width="118"
                        data-height="32"
                      />
                    </a>
                  </div>
                  <div class="left__main">
                    <nav id="main-nav" class="main-nav">
                      <ul id="menu-primary-menu" class="menu">
                        <li class="menu-item">
                            <a href="markets.html">Home </a>
                          </li>
                          <li class="menu-item">
                            <a href="markets.html">About </a>
                          </li>
                          <li class="menu-item">
                            <a href="markets.html">Games </a>
                          </li>
                          <li class="menu-item">
                            <a href="markets.html">Contact </a>
                          </li>
                      </ul>
                    </nav>
                    <!-- /#main-nav -->
                  </div>
                </div>
  
                <div class="header__right">

                  <div class="mode-switcher">
                    <a class="sun" href="#" onclick="switchTheme()">
                      <svg
                        width="16"
                        height="16"
                        viewBox="0 0 16 16"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M7.99993 11.182C9.7572 11.182 11.1818 9.75745 11.1818 8.00018C11.1818 6.24291 9.7572 4.81836 7.99993 4.81836C6.24266 4.81836 4.81812 6.24291 4.81812 8.00018C4.81812 9.75745 6.24266 11.182 7.99993 11.182Z"
                          stroke="#23262F"
                          stroke-width="1.5"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        />
                        <path
                          d="M8 1V2.27273"
                          stroke="#23262F"
                          stroke-width="1.5"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        />
                        <path
                          d="M8 13.7271V14.9998"
                          stroke="#23262F"
                          stroke-width="1.5"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        />
                        <path
                          d="M3.04956 3.04932L3.9532 3.95295"
                          stroke="#23262F"
                          stroke-width="1.5"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        />
                        <path
                          d="M12.0469 12.0469L12.9505 12.9505"
                          stroke="#23262F"
                          stroke-width="1.5"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        />
                        <path
                          d="M1 8H2.27273"
                          stroke="#23262F"
                          stroke-width="1.5"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        />
                        <path
                          d="M13.7273 8H15"
                          stroke="#23262F"
                          stroke-width="1.5"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        />
                        <path
                          d="M3.04956 12.9505L3.9532 12.0469"
                          stroke="#23262F"
                          stroke-width="1.5"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        />
                        <path
                          d="M12.0469 3.95295L12.9505 3.04932"
                          stroke="#23262F"
                          stroke-width="1.5"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        />
                      </svg>
                    </a>
                    <a href="#" class="moon" onclick="switchTheme()">
                      <svg
                        width="14"
                        height="14"
                        viewBox="0 0 14 14"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M13.0089 8.97241C12.7855 9.64616 12.4491 10.2807 12.0107 10.8477C11.277 11.7966 10.2883 12.5169 9.1602 12.9244C8.03209 13.3319 6.81126 13.4097 5.64056 13.1486C4.46987 12.8876 3.39772 12.2986 2.54959 11.4504C1.70145 10.6023 1.1124 9.53013 0.851363 8.35944C0.590325 7.18874 0.668097 5.96791 1.07558 4.8398C1.48306 3.71169 2.2034 2.72296 3.1523 1.9893C3.71928 1.55094 4.35384 1.21447 5.02759 0.991088C4.69163 1.84583 4.54862 2.77147 4.61793 3.7009C4.72758 5.17128 5.36134 6.55346 6.40394 7.59606C7.44654 8.63866 8.82873 9.27242 10.2991 9.38207C11.2285 9.45138 12.1542 9.30837 13.0089 8.97241Z"
                          stroke="white"
                          stroke-width="1.4"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        />
                      </svg>
                    </a>
                  </div>
                  
                  <div class="mobile-button"><span></span></div>
                  <div class="wallet">
                    <a href="wallet.html"> Wallet </a>
                  </div>
                  <div class="dropdown user">
                    <button
                      class="btn dropdown-toggle"
                      type="button"
                      id="dropdownMenuButton5"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <img src="assets/images/avt/avt-01.jpg" alt="" />
                    </button>
                    <div
                      class="dropdown-menu"
                      aria-labelledby="dropdownMenuButton5"
                    >
                      <a class="dropdown-item" href="#"
                        ><i class="bx bx-user font-size-16 align-middle me-1"></i>
                        <span>Profile</span></a
                      >
                      <a class="dropdown-item" href="#"
                        ><i
                          class="bx bx-wallet font-size-16 align-middle me-1"
                        ></i>
                        <span>My Wallet</span></a
                      >
                      <a class="dropdown-item d-block" href="#"
                        ><span class="badge bg-success float-end">11</span
                        ><i
                          class="bx bx-wrench font-size-16 align-middle me-1"
                        ></i>
                        <span>Settings</span></a
                      >
                      <a class="dropdown-item" href="#"
                        ><i
                          class="bx bx-lock-open font-size-16 align-middle me-1"
                        ></i>
                        <span>Lock screen</span></a
                      >
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item text-danger" href="user-login.html"
                        ><i
                          class="bx bx-power-off font-size-16 align-middle me-1 text-danger"
                        ></i>
                        <span>Logout</span></a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>



    <!-- Slider Section -->
    {{-- <div class="container mx-auto mt-4 overflow-hidden relative">
        <div class="relative">
            <!-- Slider Images -->
            <div id="slider" class="flex transition-transform duration-500 ease-in-out" style="width: 300%; transform: translateX(0);">
                <img src="{{ url('assets/images/BD/banner.jpg') }}" alt="Game Slider Image" class="w-full h-64 object-cover">
                <img src="{{ url('assets/images/BD/banner1.jpg') }}" alt="Game Slider Image" class="w-full h-64 object-cover">
                <img src="{{ url('assets/images/BD/banner2.jpg') }}" alt="Game Slider Image" class="w-full h-64 object-cover">
            </div>
        </div>
    </div> --}}

    <section class="banner">
        <div class="container">
          <div class="row">
            <div class="col-xl-6 col-md-12">
              <div class="banner__content">
                <h2 class="title">
                  A trusted and secure cryptocurrency exchange.
                </h2>
                <p class="fs-20 desc">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                  eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <a href="#" class="btn-action"><span>Trading Now</span></a>
              </div>
            </div>
            <div class="col-xl-6 col-md-12">
              <div class="banner__image">
                <img src="{{asset('assets/images/layout/banner-02.png')}}" alt="" />
              </div>
            </div>
          </div>
        </div>
      </section>
    <script>
        // JavaScript for automatic sliding
        const slider = document.getElementById('slider');
        const slideCount = slider.children.length;
        const slideWidth = slider.clientWidth / slideCount;
        let currentIndex = 0;
    
        function slide() {
            // Calculate the next index
            currentIndex = (currentIndex + 1) % slideCount;
    
            // Move the slider
            slider.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
        }
    
        // Slide every 10 seconds
        setInterval(slide, 70000);
    </script>
    

    <!-- Slider Section -->
    <div class="container mx-auto mt-4 overflow-hidden relative">
        <div class="flex transition-transform duration-500 ease-in-out">
            <h1 class="text-center text-lg font-semibold text-black" style="font-size:30px; text-align:center;">Our
                Featured Games</h1>
        </div>
    </div>

    <!-- Games Grid Section -->
    <div class="container mx-auto mt-8 grid grid-cols-2 md:grid-cols-4 gap-4">
        <!-- Game Item 1 -->
        @foreach ($games as $game)
        
        <div class="bg-white p-4 shadow-md rounded game-item transition-transform duration-300">
            <img src="{{ url($game->logo) }}" alt="Game 1 Logo"
               width="125" class="mx-auto mb-2 rounded-lg transition-transform duration-300">
            <h3 class="text-center text-lg font-semibold text-black">{{$game->name}}</h3>
            @if (!Auth::check())
          
            <button  onclick="window.location.href='{{route('login.view')}}' "
            class="mt-2 bg-red-500 text-white px-4 py-2 rounded-full block mx-auto transition-all duration-300">View
            Login</button>
            @endif
        
        </div>
        @endforeach
    </div>


    <!-- Login Modal -->
    <div id="login-modal" class="modal hidden fixed inset-0 flex items-center justify-center bg-gray-600 bg-opacity-50">
        <div class="modal-content bg-white p-6 rounded-lg w-96 relative">
            <!-- Modal Header -->
            <div class="absolute top-4 right-4">
                <button onclick="closeLoginModal()" class="text-gray-500 text-2xl">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-6">
                    <img src="https://placehold.co/50x50" alt="Company Logo" class="w-16 mx-auto mb-4">
                    <!-- Replace with your company logo -->
                    <h2 class="text-2xl font-bold mb-2 text-red-500">Login</h2>
                    <p class="text-sm text-gray-600">Create an account to get started with our service.</p>
                </div>
                <!-- Login Form -->
                <form id="login-form">
                    @csrf <!-- CSRF token -->
                    <div class="mb-4">
                        <label for="login-email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="login-email" name="email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="login-password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="login-password" name="password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" class="w-full bg-red-500 text-white py-2 rounded-md">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Signup Modal -->
    <div id="signup-modal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center hidden">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full relative">
            <!-- Modal Header -->
            <div class="absolute top-4 right-4">
                <button onclick="closeSignupModal()" class="text-gray-500 text-2xl">&times;</button>
            </div>
            <!-- Modal Content -->
            <div class="text-center mb-6">
                <img src="https://placehold.co/50x50" alt="Company Logo" class="w-16 mx-auto mb-4">
                <!-- Replace with your company logo -->
                <h2 class="text-2xl font-bold mb-2 text-red-500">Sign Up</h2>
                <p class="text-sm text-gray-600">Create an account to get started with our service.</p>
            </div>
            <form id="signup-form" method="POST">
                @csrf <!-- CSRF token -->
                <div class="mb-4">
                    <label for="signup-name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="signup-name" name="name" class="w-full p-2 border border-gray-300 rounded-md"
                        placeholder="Your Name" required>
                </div>
                <div class="mb-4">
                    <label for="signup-email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="signup-email" name="email"
                        class="w-full p-2 border border-gray-300 rounded-md" placeholder="Email" required>
                </div>
                <div class="mb-4">
                    <label for="signup-phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="text" id="signup-phone" name="phone_number"
                        class="w-full p-2 border border-gray-300 rounded-md" placeholder="Phone Number" required>
                </div>
                <div class="mb-4">
                    <label for="signup-password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="signup-password" name="password"
                        class="w-full p-2 border border-gray-300 rounded-md" placeholder="Password" required>
                </div>
                <div class="mb-4">
                    <label for="signup-confirm-password" class="block text-sm font-medium text-gray-700">Confirm
                        Password</label>
                    <input type="password" id="signup-confirm-password" name="password_confirmation"
                        class="w-full p-2 border border-gray-300 rounded-md" placeholder="Confirm Password" required>
                </div>
                <div class="flex justify-between items-center mb-4">
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">Sign Up</button>
                    <button type="button" onclick="closeSignupModal()" class="text-gray-500">Close</button>
                </div>
            </form>


        </div>
    </div>
    <div id="toast"
        class="toast hidden fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-md shadow-lg z-50">
        <p id="toast-message">Signup successful!</p>
    </div>


    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-8">
        &copy; 2024 {{ $websiteSettings->name }}. All Rights Reserved.
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

        // Check if the user is logged in
        $(document).ready(function () {
            var user = @json(auth() -> user()); // Passing user info from Laravel to JS
            if (user) {
                $('#user-profile').removeClass('hidden');
                $('#auth-buttons').addClass('hidden');
                $('#auth-buttons').removeClass('md:flex');

                $('#user-name').text(user.name); // Set user name in the profile dropdown
            } else {
                $('#user-profile').addClass('hidden');
                $('#auth-buttons').removeClass('hidden');
                $('#auth-buttons').addClass('md:flex');
            }
        });

        // Show login modal
        function showLoginModal() {
            document.getElementById("login-modal").classList.remove("hidden");
        }

        // Show signup modal
        function showSignupModal() {
            document.getElementById("signup-modal").classList.remove("hidden");
        }

        // Close login modal
        function closeLoginModal() {
            document.getElementById("login-modal").classList.add("hidden");
        }

        // Close signup modal
        function closeSignupModal() {
            document.getElementById("signup-modal").classList.add("hidden");
        }


        $('#signup-form').on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            var formData = $(this).serialize(); // Serialize the form data, including phone_number

            $.ajax({
                url: '{{ route("signup.store") }}', // Your Laravel route
                method: 'POST',
                data: formData,
                success: function (response) {
                    if (response.status === 'success') {
                        // Display success toast message
                        showToast(response.message, 'bg-green-500'); // Green toast for success
                        $('#signup-form')[0].reset(); // Reset the form after success
                        setTimeout(function () {
                            closeSignupModal(); // Close the modal after a short delay
                        }, 2000);
                    }
                },
                error: function (response) {
                    var errorMessage = response.responseJSON.message || 'An unexpected error occurred.';
                    // Display error toast message
                    showToast(errorMessage, 'bg-red-500'); // Red toast for error
                }
            });
        });

        // Function to show toast message
        function showToast(message, bgColor) {
            var toast = document.getElementById('toast');
            var toastMessage = document.getElementById('toast-message');
            toastMessage.innerText = message;
            toast.classList.add('show');
            toast.classList.remove('hidden');
            toast.classList.add(bgColor); // Apply success or error background color

            // Hide the toast after 4 seconds
            setTimeout(function () {
                toast.classList.remove('show');
                toast.classList.add('hidden');
            }, 4000);
        }




        // Toggle the user dropdown
        function toggleDropdown() {
            document.getElementById("user-dropdown").classList.toggle("hidden");
        }

        // Logout function
        function logout() {
            $.ajax({
                url: '{{ route("logout") }}', // Laravel logout route
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    window.location.href = "{{route('home')}}"; // Redirect to home page after logout
                },
                error: function (error) {
                    alert("Logout failed");
                }
            });
        }

    </script>



<script src="{{asset('assets/app/js/aos.js')}}"></script>
<script src="{{asset('assets/app/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/app/js/jquery.easing.js')}}"></script>
<script src="{{asset('assets/app/js/popper.min.js')}}"></script>
<script src="{{asset('assets/app/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/app/js/app.js')}}"></script>
<script src="{{asset('assets/app/js/jquery.peity.min.js')}}"></script>
<script src="{{asset('assets/app/js/Chart.bundle.min.js')}}"></script>
<script src="{{asset('assets/app/js/apexcharts.js')}}"></script>
<script src="{{asset('assets/app/js/switchmode.js')}}"></script>
<script src="{{asset('assets/app/js/jquery.magnific-popup.min.js')}}"></script>

<script src="{{asset('assets/app/js/chart.js')}}"></script>

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".mySwiper", {
    spaceBetween: 10,
    slidesPerView: 3,
    freeMode: true,
    watchSlidesProgress: true,
  });
  var swiper2 = new Swiper(".mySwiper2", {
    spaceBetween: 10,

    thumbs: {
      swiper: swiper,
    },
  });

  var swiper3 = new Swiper(".swiper-partner", {
    breakpoints: {
      0: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 4,
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: 4,
        spaceBetween: 60,
      },
    },
    slidesPerView: 4,
  });
</script>
</body>

</html>