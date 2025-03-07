<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $websiteSettings->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/app/dist/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/app/dist/magnific-popup.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- End Style CSS -->

    <link rel="shortcut icon" href="{{ asset('assets/images/BD/All-Panel-Pro-Logo-Favicon.png') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/images/BD/All-Panel-Pro-Logo-Favicon.png') }}" />

    <style>
        .match-container {
            border-radius: 8px;
            padding: 3px;
            width: 100%;
        }

        .team-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .team p {
            font-size: 10px;
            font-weight: bold;
        }

        .stats p {
            font-size: 8px;
            color: #555;
            text-align: right;
        }

        .batting {
            color: #000000;
        }

        hr {
            border: 0;
            border-top: 1px solid #a7a1a1;
            margin: 20px 0;
        }

        .balls-container {
            display: flex;
            justify-content: center;
            margin-top: 5px;
            gap: 10px;
        }

        .ball {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #616366;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: bold;
            font-size: 12px;
        }

        .live-button-container {
            margin-top: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .circular-button {
            margin-top: -10px;
            margin-bottom: 10px;
            width: 100px;
            color: white;
            font-size: 9px;
            font-weight: bold;
            border: none;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        @keyframes pulseGlow {
            0% {
                transform: scale(1);
                box-shadow: 0 0 5px rgba(255, 0, 0, 0.8);
            }

            50% {
                transform: scale(1.1);
                box-shadow: 0 0 20px rgba(255, 0, 0, 1);
            }

            100% {
                transform: scale(1);
                box-shadow: 0 0 5px rgba(255, 0, 0, 0.8);
            }
        }

        .btn-live {
            padding: 5px 20px;
            margin-bottom: 10px;
            margin-top: -10px;
            background-color: #ff002b;

            transition: all 0.3s ease-in-out;
            animation: pulseGlow 1.5s infinite;
        }

        .circular-button .button-image {
            margin-top: 5px;
            width: 90px;
            object-fit: contain;
        }

        .circular-button {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        .overs {
            font-size: 10px;
            font-weight: light;
        }

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
            white-space: nowrap;
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

        #user-dropdown {
            z-index: 1050;
        }

        .crypto-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
            background-color: #1e4871;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .crypto-box img {
            max-width: 100%;
        }

        .crypto-box h6 {
            margin-top: 10px;
            font-size: 1.1rem;
        }

        .crypto-box button {
            margin-top: 10px;
        }

        .game-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 180px;
            height: 110px;
            color: rgb(89, 116, 206);
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: bold;
            padding: 10px;
            margin-left: 6px;
            text-align: center;
            border: #616366 1px solid;
        }

        .game-button:hover {
            border: #96f55fe1 1px solid;
        }

        .game-button.active {
            border: #f10d0d98 1px solid;
        }

        .game-button .icon {
            width: 40px;
            height: 40px;
            margin-bottom: 10px;
            object-fit: contain;
        }

        .game-button .game-text {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Reduce margin and padding on smaller screens */
        @media (max-width: 768px) {
            .game-button {
                width: 120px;
                /* Reduce button width */
                height: 80px;
                /* Reduce button height */
                padding: 3px;
                /* Reduce padding */
                margin-right: 3px;
                /* Reduce margin */
            }

            .game-button .icon {
                width: 25px;
                /* Reduce icon size */
                height: 25px;
                margin-bottom: 5px;
            }

            .game-button .game-text {
                font-size: 10px;
                /* Reduce text size */
            }
        }

        @media (max-width: 480px) {
            .game-button {
                width: 100px;
                height: 75px;
                padding: 2px;
                margin-right: 2px;
            }

            .game-button .icon {
                width: 20px;
                height: 20px;
                margin-bottom: 4px;
            }

            .game-button .game-text {
                font-size: 9px;
            }
        }

        .container-cricket,
        .container-tennis,
        .container-football {
            margin-left: 50px;
            margin-right: 50px;
            display: none;
        }

        .container-cricket.active,
        .container-tennis.active,
        .container-football.active {
            display: block;
        }

        html {
            scroll-behavior: smooth;
        }

        #main-nav .menu-item:hover {
            background-color: rgb(220, 38, 38);
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {

            .container-cricket,
            .container-tennis,
            .container-football {
                margin-left: 10px;
                margin-right: 10px;
                width: 100%;
            }

            .services__main {
                flex-direction: column;
                align-items: center;
                padding: 10px;
            }

            .services-box {
                width: 100% !important;
                /* Force it to take full width */
                margin-bottom: 15px;
                box-sizing: border-box;
                /* Ensure padding and margin don't affect width */
            }

            .team-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .team-container .team p,
            .stats p {
                font-size: 12px;
            }

            .balls-container {
                flex-wrap: wrap;
                justify-content: flex-start;
                gap: 5px;
            }

            .ball {
                width: 25px;
                height: 25px;
                font-size: 10px;
            }

            .circular-button {
                width: 80px;
                font-size: 8px;
            }

            .circular-button .button-image {
                width: 70px;
            }

            .match-container {
                padding: 10px;
            }

            .rotating-text {
                font-size: 12px;
            }

            .team-container .team p {
                font-size: 12px;
            }

            .stats p {
                font-size: 12px;
                text-align: left;
            }

            .balls-container {
                margin-top: 10px;
            }

            .ball {
                width: 25px;
                height: 25px;
                font-size: 10px;
            }
        }



        /* General styles for services-box */
        .services .services__main .services-box {
            flex: 1 1 calc(25% - 20px);
            /* Default for desktop and larger devices */
            height: auto;
            max-width: 300px !important;
            /* max-width: calc(100% - 20px) !important; */
            box-sizing: border-box;
            border-radius: 12px;
            backdrop-filter: blur(4px);
            background: var(--surface);
            text-align: center;
            padding: 5px;
            margin-bottom: 30px;
        }

        /* Adjustments for medium screens (max-width 1200px) */
        @media only screen and (max-width: 1200px) {
            .services .services__main .services-box {
                width: 100% !important;
            }
        }

        /* Adjustments for small screens (max-width 767px) */
        @media only screen and (max-width: 767px) {
            .services .services__main .services-box {
                width: 100% !important;
                /* Force 100% width */
                margin-bottom: 15px !important;
                /* Adjust margin for mobile */
                box-sizing: border-box;
            }
        }

        /* Padding classes */
        .p-3 {
            padding: 1rem !important;
            /* Padding for different sections */
        }

        /* Border styles */
        .border {
            border: 1px solid #dee2e6 !important;
            /* Apply consistent border */
        }
    </style>
</head>

<body class="body header-fixed home-2">
    @php
        $announcementText = str_replace('/', '<br>', $announcement->announcetext);
    @endphp
    <!-- Announcement Bar -->
    <div class="bg-red-600 text-white text-center py-2">
        <div class="overflow-hidden h-6">
            <div class="rotating-text">
                <div>{!! $announcementText !!}</div>
            </div>
        </div>
    </div>
    <!-- Header -->
    <header id="header_main" class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="header__body d-flex justify-content-between">
                        <div class="header__left">
                            <?php $setting = DB::table('settings')->first(); ?>
                            <div class="logo">
                                <a class="light" href="{{ url('/') }}">
                                    <img id="site-logo" src="{{ asset($setting->logo) }}" alt="" width="118"
                                        height="32" data-retina="assets/images/logo/logo@2x.png" data-width="118"
                                        data-height="32" />
                                </a>
                                <a class="dark" href="{{ url('/') }}">
                                    <img src="{{ asset($setting->logo) }}" alt="" width="118" height="32"
                                        data-retina="assets/images/logo/logo-dark@2x.png" data-width="118"
                                        data-height="32" />
                                </a>
                            </div>
                            <div class="left__main">
                                <nav id="main-nav" class="main-nav">
                                    <ul id="menu-primary-menu" class="menu">
                                        <li class="menu-item">
                                            <a href="#" onclick="refreshPage()">Home</a>
                                        </li>
                                        {{-- <li class="menu-item">
                                            <a href="#about">About</a>
                                        </li> --}}
                                        <!-- <li class="menu-item">
                            <a href="#games">Games</a>
                        </li> -->
                                        <li class="menu-item">
                                            <a href="#markets">Markets</a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="#live">Live</a>
                                        </li>
                                    </ul>
                                </nav>
                                <!-- /#main-nav -->
                            </div>
                        </div>

                        <div class="header__right">

                            {{-- <div class="mode-switcher">
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
                </div> --}}
                            <div id="user-profile" class="hidden flex items-center space-x-4" style="cursor: pointer;"
                                onclick="toggleDropdown()">
                                @php
                                    $image = asset('assets/images/users/avatar-large-square.jpg');
                                    if (Auth::check() && Auth::user()->profile_image) {
                                        $image = url(Auth::user()->profile_image);
                                    }
                                @endphp

                                <img src="{{ $image }}" alt="User Logo" width="40" class="rounded-full mx-4"
                                    id="user-logo">
                                <span id="user-name" class="text-gray-700"></span>
                                <div class="relative">
                                    <button class="text-gray-700">
                                        <i class="fas fa-caret-down"></i>
                                    </button>
                                    <div id="user-dropdown"
                                        class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-md hidden">
                                        <a href="{{ route('users.user_profile') }}"
                                            class="block px-4 py-2 text-gray-700">Profile</a>
                                        <button onclick="logout()"
                                            class="block w-full text-left px-4 py-2 text-gray-700">Logout</button>
                                    </div>
                                </div>
                            </div>

                            <div id="guest-buttons" @guest class="flex flex-row justify-center space-x-2 w-full" @else class="hidden" @endguest>
                                <div class="wallet">
                                    <a href="{{ route('signUp.view') }}" class="flex items-center space-x-1 text-center px-2 py-1 text-lg sm:text-sm md:text-base">
                                        <iconify-icon icon="mdi:account-plus-outline" style="font-size: 24px;"></iconify-icon>
                                        <span>SignUp</span>
                                    </a>
                                </div>
                                <div class="wallet">
                                    <a href="{{ route('login.view') }}" class="flex items-center space-x-1 text-center px-2 py-1 text-lg sm:text-sm md:text-base">
                                        <iconify-icon icon="mdi:login-variant" style="font-size: 24px;"></iconify-icon>
                                        <span>SignIn</span>
                                    </a>
                                </div>
                            </div>







                            <script>
                                // Function to toggle the dropdown visibility
                                function toggleDropdown() {
                                    var dropdown = document.getElementById('user-dropdown');
                                    dropdown.classList.toggle('hidden'); // Toggle the 'hidden' class to show/hide the dropdown
                                }

                                // Optional: Close the dropdown if user clicks anywhere outside the dropdown
                                window.onclick = function(event) {
                                    var dropdown = document.getElementById('user-dropdown');
                                    var userProfile = document.getElementById('user-profile');

                                    if (!userProfile.contains(event.target)) {
                                        dropdown.classList.add('hidden'); // Close dropdown if click is outside the profile
                                    }
                                }
                            </script>


                            <script>
                                // Function to toggle the dropdown visibility
                                function toggleDropdown() {
                                    var dropdown = document.getElementById('user-dropdown');
                                    dropdown.classList.toggle('hidden'); // Toggle the 'hidden' class to show/hide the dropdown
                                }

                                // Optional: Close the dropdown if user clicks anywhere outside the dropdown
                                window.onclick = function(event) {
                                    var dropdown = document.getElementById('user-dropdown');
                                    var userProfile = document.getElementById('user-profile');

                                    if (!userProfile.contains(event.target)) {
                                        dropdown.classList.add('hidden'); // Close dropdown if click is outside the profile
                                    }
                                }
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- end Header -->
    <div class="banner" style="padding:0;">
        <div id="carouselExampleInterval" class="carousel slide position-relative" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="assets/images/BD/All-Panel-Pro-1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="assets/images/BD/All-Panel-Pro-2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="assets/images/BD/All-Panel-Pro-3.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="assets/images/BD/All-Panel-Pro-4.jpg" class="d-block w-100" alt="...">
                </div>
            </div>

            <!-- Previous Button (Left Side) -->
            <button class="carousel-control-prev position-absolute start-0 top-50 translate-middle-y" type="button"
                data-bs-target="#carouselExampleInterval" data-bs-slide="prev" style="width: 5%;">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <!-- Next Button (Right Side) -->
            <button class="carousel-control-next position-absolute end-0 top-50 translate-middle-y" type="button"
                data-bs-target="#carouselExampleInterval" data-bs-slide="next" style="width: 5%;">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>


    <section class="services" id="live">
        <div class="container mx-auto mb-4 overflow-hidden relative">
            <div class="flex justify-center items-center transition-transform duration-500 ease-in-out">
                <h1 class="text-lg font-semibold text-black" style="font-size:30px; text-align:center;">Our Live
                    Matches</h1>
            </div>
        </div>

        <!-- Buttons for Cricket, Tennis, and Football -->
        <div class="button-container">
            <button class="game-button active" data-game="cricket" onclick="toggleGames('cricket', this)">
                <img src="assets/images/BD/icons/cricket.gif" alt="Cricket Icon" class="icon" />
                <span class="game-text">Cricket</span>
            </button>
            <button class="game-button" data-game="tennis" onclick="toggleGames('tennis', this)">
                <img src="assets/images/BD/icons/tennis.gif" alt="Tennis Icon" class="icon" />
                <span class="game-text">Tennis</span>
            </button>
            <button class="game-button" data-game="football" onclick="toggleGames('football', this)">
                <img src="assets/images/BD/icons/football.gif" alt="Football Icon" class="icon" />
                <span class="game-text">Football</span>
            </button>
        </div>

        <!-- Cricket Container (default) -->
        <div class="container-cricket active mt-4">
            <div class="services__main d-flex flex-wrap justify-content-start" id="cricket-container">
                @if(count($liveCricket) > 0)
                    @foreach ($liveCricket as $index => $cricket)
                        <div class="services-box border p-3 cricket-item"
                            style="box-shadow: rgba(100, 100, 111, 0.2) 0px 4px 15px 0px; display: {{ $index < 4 ? 'block' : 'none' }};">
                            <a href="" class=" text-black mb-2 w-full block text-center"
                                style="font-size: 12px; line-height: 20px;">{{ $cricket['Name'] }}</a>
                            <hr class="mb-1">
                            <div class="match-container">
                                <iframe src="https://live.oldd247.com/sr.php?eventid={{ $cricket['MatchID'] }}"
                                    width="250" height="200" style="border: 1px solid #ccc;"
                                    allowfullscreen></iframe>
                                <div class="live-button-container">
                                    <a href="{{ Auth::check() ? route('match.live', ['eventId' => $cricket['MatchID'], 'name' => $cricket['Name'], 'channelId' => $cricket['Channel']]) : '#' }}"
                                        onclick="checkLogin(event)">
                                        <button type="submit" class="btn-action btn-live">Live Match</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="w-100 text-center">
                        <p class="text-black">No match is live</p>
                    </div>
                @endif
            </div>


            @if (count($liveCricket) > 4)
                <div class="text-center mt-3">
                    <button class="btn btn-primary seeMoreBtn" data-container="cricket">See More</button>
                </div>
            @endif
        </div>

        <!-- Tennis Container -->
        <div class="container-tennis mt-4">
            <div class="services__main d-flex flex-wrap justify-content-start" id="tennis-container">
                @if(count($liveTennis) > 0)
                @foreach ($liveTennis as $index => $tennis)
                    <div class="services-box border p-3 tennis-item"
                        style="box-shadow: rgba(100, 100, 111, 0.2) 0px 4px 15px 0px; display: {{ $index < 4 ? 'block' : 'none' }};">
                        <a href="" class=" text-black mb-2 w-full block text-center"
                            style="font-size: 12px; line-height: 20px;">{{ $tennis['Name'] }}</a>
                        <hr class="mb-1">
                        <div class="match-container">
                            <iframe src="https://live.oldd247.com/sr.php?eventid={{ $tennis['MatchID'] }}"
                                width="250" height="200" style="border: 1px solid #ccc;"
                                allowfullscreen></iframe>
                            <div class="live-button-container">
                                <a href="{{ Auth::check() ? route('match.live', ['eventId' => $tennis['MatchID'], 'name' => $tennis['Name'], 'channelId' => $tennis['Channel']]) : '#' }}"
                                    onclick="checkLogin(event)">
                                    <button type="submit" class="btn-action btn-live">Live Match</button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                    <div class="w-100 text-center">
                        <p class="text-black">No match is live</p>
                    </div>
                @endif
            </div>

            @if (count($liveTennis) > 4)
                <div class="text-center mt-3">
                    <button class="btn btn-primary seeMoreBtn" data-container="tennis">See More</button>
                </div>
            @endif
        </div>

        <!-- Football Container -->
        <div class="container-football mt-4">
            <div class="services__main d-flex flex-wrap justify-content-start" id="football-container">
                @if(count($liveFootball) > 0)
                @foreach ($liveFootball as $index => $football)
                    <div class="services-box border p-3 football-item"
                        style="box-shadow: rgba(100, 100, 111, 0.2) 0px 4px 15px 0px; display: {{ $index < 4 ? 'block' : 'none' }};">
                        <a href="" class=" text-black mb-2 w-full block text-center"
                            style="font-size: 12px; line-height: 20px;">{{ $football['Name'] }}</a>
                        <hr class="mb-1">
                        <div class="match-container">
                            <iframe src="https://live.oldd247.com/sr.php?eventid={{ $football['MatchID'] }}"
                                width="250" height="200" style="border: 1px solid #ccc;"
                                allowfullscreen></iframe>
                            <div class="live-button-container">
                                <a href="{{ Auth::check() ? route('match.live', ['eventId' => $football['MatchID'], 'name' => $football['Name'], 'channelId' => $football['Channel']]) : '#' }}"
                                    onclick="checkLogin(event)">
                                    <button type="submit" class="btn-action btn-live">Live Match</button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                <div class="w-100 text-center">
                    <p class="text-black">No match is live</p>
                </div>
            @endif
            </div>

            @if (count($liveFootball) > 4)
                <div class="text-center mt-3">
                    <button class="btn btn-primary seeMoreBtn" data-container="football">See More</button>
                </div>
            @endif
        </div>

        <!-- JavaScript -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let seeMoreButtons = document.querySelectorAll(".seeMoreBtn");

                seeMoreButtons.forEach(button => {
                    button.addEventListener("click", function() {
                        let sport = this.getAttribute("data-container");
                        let items = document.querySelectorAll(`.${sport}-item`);
                        let hiddenItems = Array.from(items).filter(item => item.style.display ===
                            "none");

                        hiddenItems.slice(0, 4).forEach(item => item.style.display = "block");

                        // Hide button when all items are visible
                        if (Array.from(items).every(item => item.style.display === "block")) {
                            this.style.display = "none";
                        }
                    });
                });
            });
        </script>


    </section>

    <section class="crypto" data-aos="fade-up" data-aos-duration="1000" id="markets" style="margin-top: 5px;">
        <div class="container mx-auto  mb-4 overflow-hidden relative">
            <div class="flex justify-center items-center transition-transform duration-500 ease-in-out">
                <h1 class="text-lg font-semibold text-black" style="font-size:30px; text-align:center;">Our Featured
                    Markets</h1>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="crypto__main">
                        <div class="row">
                            @foreach ($games as $game)
                                <div class="col-md-3"> <!-- Ensure each game takes up 3 columns (4 games per row) -->
                                    <div
                                        class="crypto-box mt-4 d-flex flex-column align-items-center justify-content-center">
                                        <div class="center text-center">
                                            <span class="icon-btc">
                                                <img src="{{ url($game->logo) }}" alt="Game 1 Logo" width="125"
                                                    class="mx-auto mb-2 rounded-lg transition-transform duration-300">
                                            </span>
                                            <h6 class="price">{{ $game->name }}</h6>

                                            @if (!Auth::check())
                                                <button onclick="window.location.href='{{ route('login.view') }}'"
                                                    class="mt-2 bg-red-500 text-white px-4 py-2 rounded-full block mx-auto transition-all duration-300">
                                                    View Login
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section class="about-2 mb-7" id="about">
      <div class="container">
        <div class="row">
          <div class="col-xl-6 col-md-12">
            <div class="about_image">
              <img
                class="img-main"
                src="/assets/images/BD/bettingillustration.jpg"
                alt=""
              />
            </div>
          </div>
          <div class="col-xl-6 col-md-12">
            <div
              class="about__content"
              data-aos="fade-up"
              data-aos-duration="1000"
            >
              <h3 class="heading">
                We are the most trusted cryptocurrency platform.
              </h3>
              <p class="fs-20 desc">
                We believe Cryptolly is here to stay — and that a future worth
                building is one which opens its doors and invites everyone in.
              </p>
              <ul class="list">
                <li>
                  <div class="icon">
                    <svg
                      width="29"
                      height="23"
                      viewBox="0 0 29 23"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M19.1987 11.4737C19.1987 14.0115 17.1406 16.0681 14.6029 16.0681C12.0651 16.0681 10.0085 14.0115 10.0085 11.4737C10.0085 8.93457 12.0651 6.87793 14.6029 6.87793C17.1406 6.87793 19.1987 8.93457 19.1987 11.4737Z"
                        stroke="#D33535"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M14.6007 22.0866C20.1354 22.0866 25.1978 18.107 28.048 11.4735C25.1978 4.83991 20.1354 0.860352 14.6007 0.860352H14.6065C9.07172 0.860352 4.00934 4.83991 1.15912 11.4735C4.00934 18.107 9.07172 22.0866 14.6065 22.0866H14.6007Z"
                        stroke="#D33535"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                  </div>
                  <div class="content">
                    <h6 class="title">Clarity</h6>
                    <p>
                      We help you make sense of the coins, the terms, the dense
                      charts and market changes.
                    </p>
                  </div>
                </li>
                <li>
                  <div class="icon green">
                    <svg
                      width="25"
                      height="30"
                      viewBox="0 0 25 30"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M22.5815 4.4024C23.2167 4.62478 23.6411 5.2236 23.6411 5.89655V15.7408C23.6411 18.4922 22.6411 21.1186 20.8752 23.1534C19.9871 24.1781 18.8636 24.976 17.6703 25.6214L12.4989 28.4149L7.3188 25.6199C6.12406 24.9746 4.99909 24.1781 4.10958 23.1519C2.34218 21.1171 1.33929 18.4893 1.33929 15.735V5.89655C1.33929 5.2236 1.7637 4.62478 2.39886 4.4024L11.9655 1.04056C12.3056 0.921376 12.6762 0.921376 13.0149 1.04056L22.5815 4.4024Z"
                        stroke="#58BD7D"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M8.71194 14.2775L11.4619 17.0288L17.1274 11.3633"
                        stroke="#58BD7D"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                  </div>
                  <div class="content">
                    <h6 class="title">Confidence</h6>
                    <p>
                      Our markets are always up to date, sparking curiosity with
                      real-world relevance.
                    </p>
                  </div>
                </li>
                <li>
                  <div class="icon blue">
                    <svg
                      width="33"
                      height="25"
                      viewBox="0 0 33 25"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M24.7354 10.8438C27.0644 10.8438 28.9536 8.9559 28.9536 6.62699C28.9536 4.29807 27.0644 2.41016 24.7354 2.41016"
                        stroke="#3772FF"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M26.6747 15.4258C27.3701 15.4737 28.0616 15.5723 28.7424 15.7256C29.6884 15.9108 30.8262 16.2985 31.2312 17.1472C31.4897 17.6907 31.4897 18.3236 31.2312 18.8685C30.8275 19.7172 29.6884 20.1036 28.7424 20.2981"
                        stroke="#3772FF"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M8.30432 10.8438C5.9754 10.8438 4.08615 8.9559 4.08615 6.62699C4.08615 4.29807 5.9754 2.41016 8.30432 2.41016"
                        stroke="#3772FF"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M6.36512 15.4258C5.66964 15.4737 4.97816 15.5723 4.29734 15.7256C3.35138 15.9108 2.21357 16.2985 1.80987 17.1472C1.55007 17.6907 1.55007 18.3236 1.80987 18.8685C2.21224 19.7172 3.35138 20.1036 4.29734 20.2981"
                        stroke="#3772FF"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M16.5131 16.334C21.2322 16.334 25.2638 17.0481 25.2638 19.906C25.2638 22.7625 21.2589 23.5033 16.5131 23.5033C11.7926 23.5033 7.76233 22.7891 7.76233 19.9313C7.76233 17.0734 11.7673 16.334 16.5131 16.334Z"
                        stroke="#3772FF"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M16.5131 12.2579C13.4008 12.2579 10.9053 9.76246 10.9053 6.6488C10.9053 3.53647 13.4008 1.04102 16.5131 1.04102C19.6254 1.04102 22.1209 3.53647 22.1209 6.6488C22.1209 9.76246 19.6254 12.2579 16.5131 12.2579Z"
                        stroke="#3772FF"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                  </div>
                  <div class="content">
                    <h6 class="title">Community</h6>
                    <p>
                      We supports the crypto community, putting data in the
                      hands which need it most.
                    </p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section> -->

    <footer class="footer style-2 mt-10">
        <div class="container">
            <div class="footer__main">
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <div class="info">
                            <a href="#">
                                <img src="{{ asset($setting->logo) }}" alt="" />
                            </a>
                            <h6>Let's talk! 🤙</h6>
                            <ul class="list">
                                <li>
                                    <p>+12 345 678 9101</p>
                                </li>
                                <li>
                                    <p>Info.Avitex@Gmail.Com</p>
                                </li>
                                <li>
                                    <p>
                                        Cecilia Chapman 711-2880 Nulla St. Mankato Mississippi
                                        96522
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="widget">
                            <div class="widget-link">
                                <h6 class="title">Quick Links</h6>
                                <ul>
                                    <li><a href="#about">About</a></li>
                                    <li><a href="#markets">Markets</a></li>
                                    <li><a href="#live">Live Matches</a></li>
                                    <li><a href="{{ route('login.view') }}">Login</a></li>
                                    <li><a href="{{ route('signUp.view') }}">Sign Up</a></li>
                                </ul>
                            </div>
                            <div class="widget-link s2">
                                <h6 class="title">Markets</h6>
                                <ul>
                                    <li><a href="https://allpanelexch.com/">ALLPANELEXCHANGE</a></li>
                                    <li><a href="https://my99exch.com/login">MY99EXCH</a></li>
                                    <li><a href="https://www.lcplay247.win/login">LCPLAY247</a></li>
                                    <li><a href="https://betbhai9.red/login">BETBHAI9</a></li>
                                    <li><a href="https://diamondexch99.com/">DIAMOND EXCH99</a></li>
                                    <li><a href="https://mylaser247.com/#/home">MYLASER247</a></li>
                                    <li><a href="https://mytiger247.win/home">MYTIGER247</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12">
                        <div class="footer-contact">
                            <h5>Newletters</h5>
                            <p>
                                Subscribe our newsletter to get more free design course and
                                resource.
                            </p>
                            <form action="#">
                                <input type="email" placeholder="Enter your email" required="" />
                                <button type="submit" class="btn-action">Submit</button>
                            </form>
                            <ul class="list-social">
                                <li>
                                    <a href="#"><span class="icon-facebook-f"></span></a>
                                </li>
                                <li>
                                    <a href="#"><span class="icon-instagram"></span></a>
                                </li>
                                <li>
                                    <a href="#"><span class="icon-youtube"></span></a>
                                </li>
                                <li>
                                    <a href="#"><span class="icon-twitter"></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="footer__bottom">
                <p>
                    ©2024 {{ $websiteSettings->name }}. All rights reserved. Terms of Service | Privacy
                    Terms
                </p>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="{{ asset('assets/app/js/aos.js') }}"></script>
    <script src="{{ asset('assets/app/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/app/js/jquery.easing.js') }}"></script>
    <script src="{{ asset('assets/app/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/app/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/app/js/app.js') }}"></script>
    <script src="{{ asset('assets/app/js/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('assets/app/js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/app/js/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/app/js/switchmode.js') }}"></script>
    <script src="{{ asset('assets/app/js/jquery.magnific-popup.min.js') }}"></script>

    <script src="{{ asset('assets/app/js/chart.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


    <script>
        $(document).ready(function() {
            var user = @json(auth()->user()); // Passing user info from Laravel to JS
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
    </script>
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

        function logout() {
            $.ajax({
                url: '{{ route('logout') }}', // Laravel logout route
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    window.location.href = "{{ route('home') }}"; // Redirect to home page after logout
                },
                error: function(error) {
                    alert("Logout failed");
                }
            });
        }

        function toggleGames(gameType, clickedButton) {
            // Select all game buttons and remove the 'active' class from them
            const buttons = document.querySelectorAll('.game-button');
            buttons.forEach(button => button.classList.remove('active'));

            // Add 'active' class to the clicked button
            clickedButton.classList.add('active');

            // Hide all game containers
            document.querySelector('.container-cricket').classList.remove('active');
            document.querySelector('.container-tennis').classList.remove('active');
            document.querySelector('.container-football').classList.remove('active');

            // Show the selected game container
            if (gameType === 'cricket') {
                document.querySelector('.container-cricket').classList.add('active');
            } else if (gameType === 'tennis') {
                document.querySelector('.container-tennis').classList.add('active');
            } else if (gameType === 'football') {
                document.querySelector('.container-football').classList.add('active');
            }
        }

        // Set the default active button (Cricket) on page load
        document.addEventListener('DOMContentLoaded', () => {
            const cricketButton = document.querySelector('.game-button[data-game="cricket"]');
            toggleGames('cricket', cricketButton);
        });


        document.querySelectorAll('.menu-item a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });



        function refreshPage() {
            location.reload(); // This will reload the current page
        }
    </script>

    <script>
        let isNavigating = false;
        let isRefreshing = false;

        // Detect link clicks inside the application
        document.addEventListener("click", function(event) {
            let target = event.target.closest("a");
            if (target && target.href) {
                isNavigating = true; // User is navigating inside the app
            }
        });

        // Detect form submissions inside the application
        document.addEventListener("submit", function() {
            isNavigating = true; // User is navigating inside the app
        });

        // Detect page refresh and set the flag
        window.onbeforeunload = function() {
            isRefreshing = true; // Page is refreshing
        };

        // Detect actual tab close or browser exit
        window.addEventListener("beforeunload", function(event) {
            if (!isNavigating && !isRefreshing) {
                navigator.sendBeacon("{{ route('logout') }}");
            }
        });

        // Reset flags after navigation or refresh
        window.addEventListener("load", function() {
            isNavigating = false;
            isRefreshing = false;
        });
    </script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script> -->
</body>

</html>
