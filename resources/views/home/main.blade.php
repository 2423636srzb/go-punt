<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $websiteSettings->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    

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
.button-container {
  display: flex;
  justify-content: center;
  align-items: center;
}
.live-button-container {
  display: flex;
  justify-content: center;
  align-items: center;
  /* position: absolute;
  left: 100px;
  top: -18px */
}
.circular-button {
  margin-top: -10px;
  margin-bottom: 10px;
  width: 100px;  /* Button width */
   /* Button height */
  /* border-radius: 50%; Makes the button circular */
  /* background-color: #ff002b; Button background color */
  color: white; /* Text color */
  font-size: 9px; /* Increased text size */
  font-weight: bold; /* Text weight */
  border: none; /* Removes default button border */
  display: flex;
  justify-content: center; /* Center content horizontally */
  align-items: center; /* Center content vertically */
  cursor: pointer; /* Cursor changes to a pointer on hover */
  transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth color transition */
}

/* Ensure the image inside the button fits properly */
.circular-button .button-image {
  margin-top: 5px;
  width: 90px; /* Adjust image size */
 /* Adjust image size */
  object-fit: contain; /* Ensure the image maintains its aspect ratio */
  /* border-radius: 50%; Optional: You can add this if you want the image itself to be circular */
}

/* Pulse effect */
/* .circular-button:hover { */
  /* background-color: #d10025; Darker red on hover */
  /* transform: scale(1.1); Slightly increase button size on hover */
/* } */

/* Adding a smooth pulse effect when the button is in idle state */
.circular-button {
  animation: pulse 2s infinite; /* Animation duration and looping */
}

@keyframes pulse {
  0% {
    transform: scale(1); /* Normal size */
  }
  50% {
    transform: scale(1.1); /* Slightly enlarged */
  }
  100% {
    transform: scale(1); /* Back to normal size */
  }
}

/* Hover state styling */


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

        .crypto-box {
    display: flex;
    flex-direction: column;
    align-items: center; /* Horizontally centers the content */
    justify-content: center; /* Vertically centers the content */
    text-align: center; /* Ensures that text like the game name is centered */
    padding: 20px; /* Add some padding inside the box */
    background-color: #1e4871; /* Background color for the game box */
    border-radius: 10px; /* Optional, adds rounded corners */
    box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Optional, adds a subtle shadow */
}

.crypto-box img {
    max-width: 100%; /* Ensure the image is responsive */
}

.crypto-box h6 {
    margin-top: 10px;
    font-size: 1.1rem;
}

.crypto-box button {
    margin-top: 10px;
}


/* .button-container {
  display: flex;
  justify-content: center;
  gap: 20px;
  margin-bottom: 20px;
} */

/* Styling the rectangular buttons */
.game-button {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 180px; /* Button width */
  height: 110px; /* Button height */
  color: rgb(72, 93, 213);
  border-radius: 10px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  font-weight: bold;
  padding: 10px;
  margin-left: 6px;
  text-align: center;
  border: #616366 1px solid;
}

/* Hover effect */
.game-button:hover {
  border: #96f55fe1 1px solid;
}

/* Active button styling */
.game-button.active {
  border: #f10d0d98 1px solid;
}

/* Icon inside button */
.game-button .icon {
  width: 40px;  /* Adjust size of icon */
  height: 40px;
  margin-bottom: 10px;
  object-fit: contain; /* Ensures the icon fits within the defined size */
}

/* Text inside button */
.game-button .game-text {
  font-size: 14px;
  font-weight: bold;
  text-transform: uppercase;
}

/* Game containers */
.container-cricket, .container-tennis, .container-football {
  margin-left: 50px;
  margin-right: 50px;
  display: none;
}

.container-cricket.active, .container-tennis.active, .container-football.active {
  display: block;
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
                <div>{!! $announcementText!!}</div>
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
                  <a class="light" href="index.html">
                    <img
                      id="site-logo"
                      src="{{ asset($setting->logo) }}"
                      alt=""
                      width="118"
                      height="32"
                      data-retina="assets/images/logo/logo@2x.png"
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
                      data-retina="assets/images/logo/logo-dark@2x.png"
                      data-width="118"
                      data-height="32"
                    />
                  </a>
                </div>
                <div class="left__main">
                  <nav id="main-nav" class="main-nav">
                    <ul id="menu-primary-menu" class="menu">
                      <li class="menu-item">
                        <a href="markets.html">Home</a>
                      </li>
                      <li class="menu-item">
                        <a href="markets.html">About</a>
                      </li>
                      <li class="menu-item">
                        <a href="markets.html">Games</a>
                      </li>
                      <li class="menu-item">
                        <a href="markets.html">Contacts</a>
                      </li>
                      <li class="menu-item">
                        <a href="markets.html">Live</a>
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
                <div id="user-profile" class="hidden flex items-center space-x-4" style="cursor: pointer;"
                onclick="toggleDropdown()">
                @php
$image = asset('assets/images/users/avatar-large-square.jpg');
if (Auth::check() && Auth::user()->profile_image) {
    $image = url(Auth::user()->profile_image);
}
@endphp

<img src="{{ $image }}" alt="User Logo" width="40" class="rounded-full" id="user-logo">
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
            </div>

<!-- SignIn and SignUp buttons (Visible only if the user is not logged in) -->
<div id="guest-buttons" @guest class="md:flex" @else class="hidden" @endguest>
<div class="wallet">
    <a href="{{ route('signUp.view') }}">SignUp</a>
</div>
<div class="wallet">
    <a href="{{ route('login.view') }}">SignIn</a>
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
 <div class="banner" style="padding:0; margin-bottom: 200px;">
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000">
          <img src="assets/images/BD/banner.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="2000">
          <img src="assets/images/BD/banner1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="assets/images/BD/banner2.jpg" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
    <section class="crypto" data-aos="fade-up" data-aos-duration="1000">
      <div class="container mx-auto  mb-4 overflow-hidden relative">
        <div class="flex justify-center items-center transition-transform duration-500 ease-in-out">
          <h1 class="text-lg font-semibold text-black" style="font-size:30px; text-align:center;">Our Featured Games</h1>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="crypto__main">
              <div class="row">
                @foreach ($games as $game)
                  <div class="col-md-3"> <!-- Ensure each game takes up 3 columns (4 games per row) -->
                    <div class="crypto-box mt-4 d-flex flex-column align-items-center justify-content-center">
                      <div class="center text-center">
                        <span class="icon-btc">
                          <img src="{{ url($game->logo) }}" alt="Game 1 Logo" width="125" class="mx-auto mb-2 rounded-lg transition-transform duration-300">
                        </span>
                        <h6 class="price">{{ $game->name }}</h6>
    
                        @if (!Auth::check())
                          <button onclick="window.location.href='{{route('login.view')}}'" class="mt-2 bg-red-500 text-white px-4 py-2 rounded-full block mx-auto transition-all duration-300">
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
    

    <section class="services">
      <div class="container mx-auto mb-4 overflow-hidden relative">
        <div class="flex justify-center items-center transition-transform duration-500 ease-in-out">
          <h1 class="text-lg font-semibold text-black" style="font-size:30px; text-align:center;">Our Live Matches</h1>
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
        <div class="services__main d-flex flex-wrap justify-content-start">
          <!-- Your existing cricket service box code here (the same as your current setup) -->
          @foreach ($liveCricket as $cricket)

          <div class="services-box border p-3" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 4px 15px 0px;">
            <div class="live-button-container">
              <a href="{{ route('match.live',['eventId' => $cricket['MatchID'], 'sportId' => 4,'channelId' => $cricket['Channel']]) }}">
                <button class="circular-button">
                  <img src="assets/images/BD/watch-now.png" alt="Live Stream" class="button-image" />
                </button>
              </a>
            </div>
            <a href="" class="text-xl text-black mb-2 w-full block text-start" style="font-size: 15px; line-height: 20px;">{{$cricket['Name']}}</a>
            <hr class="mb-1">
            <div class="match-container">
              <!-- Pakistan Team Info -->
              <div class="team-container">
                <div class="team">
                  <p class="batting">Pak <span style="color: #ff002b">*</span></p>
                </div>
                <div class="stats">
                  <p><span class="batting">45-3</span> <span class="overs">(7.3)</span></p>
                </div>
              </div>
      
              <div class="team-container">
                <div class="team"></div>
                <div class="stats">
                  <p class="-mt-2"><span class="overs">CRR (7.2)</span></p>
                </div>
              </div>
              <div class="team-container">
                <div class="team">
                  <p>Ind</p>
                </div>
                <div class="stats">
                  <p><span>38-2</span> <span class="overs">(7.2)</span></p>
                </div>
              </div>
              <hr class="mt-1">
              <div class="team mt-1">
                <p class="batting">last 6 ball</p>
              </div>
              <div class="balls-container">
                <div class="ball">1</div>
                <div class="ball">0</div>
                <div class="ball">4</div>
                <div class="ball">6</div>
                <div class="ball">1</div>
                <div class="ball">0</div>
              </div>
              <hr class="my-2.5" />
              <p style="font-size: 14px; font-weight: 600; color:#0056b3; margin-bottom: -5px">Pak needs 45 runs in 18 balls</p>
            </div>
          </div>
          @endforeach
          <!-- Repeat for other match boxes if needed -->
        </div>
      </div>
    
      <!-- Tennis Container (hidden by default) -->
      <div class="container-tennis mt-4">
        <div class="services__main d-flex flex-wrap justify-content-start">
          <!-- Your existing cricket service box code here (the same as your current setup) -->
          @foreach ($liveTennis as $tennis)
            
          <div class="services-box border p-3" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 4px 15px 0px;">
            <div class="live-button-container">
              <a href="{{ route('match.live',['eventId' => $tennis['MatchID'], 'sportId' => 2,'channelId'=>$tennis['Channel']]) }}">
                <button class="circular-button">
                  <img src="assets/images/BD/watch-now.png" alt="Live Stream" class="button-image" />
                </button>
              </a>
            </div>
            <a href="" class="text-xl text-black mb-2 w-full block text-start"style="font-size: 15px; line-height: 20px;">{{$tennis['Name']}}</a>
            <hr class="mb-1">
            <div class="match-container">
              <!-- Pakistan Team Info -->
              <div class="team-container">
                <div class="team">
                  <p class="batting">Barce <span style="color: #ff002b">*</span></p>
                </div>
                <div class="stats">
                  <p><span class="batting">45-3</span> <span class="overs">(7.3)</span></p>
                </div>
              </div>
      
              <div class="team-container">
                <div class="team"></div>
              </div>
              <div class="team-container">
                <div class="team">
                  <p>Spain</p>
                </div>
                <div class="stats">
                  <p><span>38-2</span> <span class="overs">(7.2)</span></p>
                </div>
              </div>
              <hr class="my-2.5" />
              <p style="font-size: 14px; font-weight: 600; color:#0056b3; margin-bottom: -5px">Barcelona needs 4 Goals in 30 minutes</p>
            </div>
          </div>
          @endforeach

          <!-- Repeat for other match boxes if needed -->
        </div>
      </div>
    
      <!-- Football Container (hidden by default) -->
      <div class="container-football mt-4">
        <div class="services__main d-flex flex-wrap justify-content-start">
          <!-- Your existing cricket service box code here (the same as your current setup) -->
          @foreach ($liveFootball as $football )
            
          <div class="services-box border p-3" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 4px 15px 0px;">
            <div class="live-button-container">
              <a href="{{ route('match.live',['eventId' => $football['MatchID'], 'sportId' => 1,'channelId' => $football['Channel']]) }}">
                <button class="circular-button">
                  <img src="assets/images/BD/watch-now.png" alt="Live Stream" class="button-image" />
                </button>
              </a>
            </div>
            <a href="" class="text-xl text-black mb-2 w-full block text-start" style="font-size: 15px; line-height: 20px;">{{$football['Name']}}</a>
            <hr class="mb-1">
            <div class="match-container">
              <!-- Pakistan Team Info -->
              <div class="team-container">
                <div class="team">
                  <p class="batting">Ger <span style="color: #ff002b">*</span></p>
                </div>
                <div class="stats">
                  <p><span class="batting">45-3</span> <span class="overs">(7.3)</span></p>
                </div>
              </div>
              <div class="team-container">
                <div class="team">
                  <p>Eng</p>
                </div>
                <div class="stats">
                  <p><span>38-2</span> <span class="overs">(7.2)</span></p>
                </div>
              </div>
              <hr class="my-2.5" />
              <p style="font-size: 14px; font-weight: 600; color:#0056b3; margin-bottom: -5px">Germany needs 2 goals in 30 minutes</p>
            </div>
          </div>

          @endforeach
          <!-- Repeat for other match boxes if needed -->
        </div>
      </div>
    
    </section>
    <section class="about-2">
      <div class="container">
        <div class="row">
          <div class="col-xl-6 col-md-12">
            <div class="about_image">
              <img
                class="img-main"
                src="assets/images/layout/Illustration.png"
                alt=""
              />
              <div class="traders-box">
                <div class="icon">
                  <svg
                    width="26"
                    height="26"
                    viewBox="0 0 26 26"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M8.82861 17.172L10.8172 10.8177L17.1715 8.8291L15.1829 15.1834L8.82861 17.172Z"
                      stroke="#3772FF"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <circle
                      cx="13"
                      cy="13"
                      r="12"
                      stroke="#3772FF"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
                </div>
                <div class="content">
                  <h6 class="numb">198+</h6>
                  <p>Countries</p>
                </div>
              </div>
              <div class="traders-box">
                <div class="icon">
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M22.6666 10.6669C22.3406 8.32055 21.2521 6.14647 19.5688 4.47959C17.8856 2.8127 15.701 1.74548 13.3515 1.44233C11.0021 1.13918 8.61814 1.6169 6.56691 2.80192M1.33331 2.66693V8.00026H6.66665"
                      stroke="#D33535"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M1.33331 13.334C1.65939 15.6804 2.74789 17.8544 4.43113 19.5213C6.11437 21.1882 8.29897 22.2554 10.6484 22.5586C12.9979 22.8617 15.3818 22.384 17.433 21.199M22.6666 21.334V16.0007H17.3333"
                      stroke="#D33535"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
                </div>
                <div class="content">
                  <h6 class="numb">350+</h6>
                  <p>Trading Pairs</p>
                </div>
              </div>
              <div class="traders-box">
                <div class="icon">
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M9.52364 15.7402C5.03897 15.7402 1.2088 16.4181 1.2088 19.1341C1.2088 21.8489 5.01447 22.5524 9.52364 22.5524C14.0083 22.5524 17.8385 21.8734 17.8385 19.1586C17.8385 16.4437 14.0328 15.7402 9.52364 15.7402Z"
                      stroke="#3772FF"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M9.52361 11.8667C12.4823 11.8667 14.8529 9.49484 14.8529 6.53734C14.8529 3.57867 12.4823 1.20801 9.52361 1.20801C6.56611 1.20801 4.19427 3.57867 4.19427 6.53734C4.19427 9.49484 6.56611 11.8667 9.52361 11.8667Z"
                      stroke="#3772FF"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M20.4048 8.11328V12.7916"
                      stroke="#3772FF"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M22.7917 10.4525H18.02"
                      stroke="#3772FF"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
                </div>
                <div class="content">
                  <h6 class="numb">20 million+</h6>
                  <p>Trades</p>
                </div>
              </div>
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
    </section>

    <section class="work">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="block-text center">
              <h3 class="heading">How It Work</h3>
              <p class="fs-20 desc">
                Stacks is a production-ready library of stackable content blocks
                built in React Native.
              </p>
            </div>

            <div class="work__main" data-aos="fade-up" data-aos-duration="1000">
              <div class="work-box">
                <div class="image">
                  <img src="assets/images/icon/Cloud.png" alt="" />
                </div>
                <div class="content">
                  <p class="step">Step 1</p>
                  <a href="#" class="title">Download</a>
                  <p class="text">
                    Stacks is a production-ready library of stackable content
                    blocks built in React Native.
                  </p>
                </div>
                <img
                  class="line"
                  src="assets/images/icon/connect-line.png"
                  alt=""
                />
              </div>
              <div class="work-box">
                <div class="image">
                  <img src="assets/images/icon/Wallet.png" alt="" />
                </div>
                <div class="content">
                  <p class="step">Step 2</p>
                  <a href="#" class="title">Connect wallet</a>
                  <p class="text">
                    Stacks is a production-ready library of stackable content
                    blocks built in React Native.
                  </p>
                </div>
                <img
                  class="line"
                  src="assets/images/icon/connect-line.png"
                  alt=""
                />
              </div>
              <div class="work-box">
                <div class="image">
                  <img src="assets/images/icon/Mining.png" alt="" />
                </div>
                <div class="content">
                  <p class="step">Step 3</p>
                  <a href="#" class="title">Start trading</a>
                  <p class="text">
                    Stacks is a production-ready library of stackable content
                    blocks built in React Native.
                  </p>
                </div>
                <img
                  class="line"
                  src="assets/images/icon/connect-line.png"
                  alt=""
                />
              </div>
              <div class="work-box">
                <div class="image">
                  <img src="assets/images/icon/Comparison.png" alt="" />
                </div>
                <div class="content">
                  <p class="step">Step 4</p>
                  <a href="#" class="title">Earn money</a>
                  <p class="text">
                    Stacks is a production-ready library of stackable content
                    blocks built in React Native.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
{{-- 
    <section class="blog">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="block-text center">
              <h3 class="heading">Learn And Earn</h3>
              <p class="desc">
                Stacks is a production-ready library of stackable content blocks
                built in React Native.
              </p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="blog-box">
              <div class="box-image">
                <img src="assets/images/blog/blog-01.jpg" alt="" />
                <div class="wrap-video">
                  <a
                    href="https://www.youtube.com/watch?v=i7EMACWuErA"
                    class="popup-youtube"
                  >
                    <svg
                      width="13"
                      height="16"
                      viewBox="0 0 13 16"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M0.466675 2.92407C0.466675 1.35705 2.187 0.398733 3.51938 1.22354L11.7197 6.2999C12.9827 7.0818 12.9827 8.91907 11.7197 9.70096L3.51938 14.7773C2.187 15.6021 0.466675 14.6438 0.466675 13.0768V2.92407Z"
                        fill="#777E90"
                      />
                    </svg>
                  </a>
                </div>
              </div>

              <div class="box-content">
                <a href="#" class="category btn-action">learn & earn</a>
                <a href="" class="title"
                  >Learn about UI8 coin and earn an All-Access Pass</a
                >

                <div class="meta">
                  <a href="#" class="name"><span></span>Floyd Buckridge</a>
                  <a href="#" class="time">Feb 03, 2021</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="blog-box">
              <div class="box-image">
                <img src="assets/images/blog/blog-02.jpg" alt="" />
                <div class="wrap-video">
                  <a
                    href="https://www.youtube.com/watch?v=i7EMACWuErA"
                    class="popup-youtube"
                  >
                    <svg
                      width="13"
                      height="16"
                      viewBox="0 0 13 16"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M0.466675 2.92407C0.466675 1.35705 2.187 0.398733 3.51938 1.22354L11.7197 6.2999C12.9827 7.0818 12.9827 8.91907 11.7197 9.70096L3.51938 14.7773C2.187 15.6021 0.466675 14.6438 0.466675 13.0768V2.92407Z"
                        fill="#777E90"
                      />
                    </svg>
                  </a>
                </div>
              </div>

              <div class="box-content">
                <a href="#" class="category btn-action">learn & earn</a>
                <a href="" class="title"
                  >Learn about UI8 coin and earn an All-Access Pass</a
                >

                <div class="meta">
                  <a href="#" class="name"><span></span>Floyd Buckridge</a>
                  <a href="#" class="time">Feb 03, 2021</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="blog-box">
              <div class="box-image">
                <img src="assets/images/blog/blog-02.jpg" alt="" />
                <div class="wrap-video">
                  <a
                    href="https://www.youtube.com/watch?v=i7EMACWuErA"
                    class="popup-youtube"
                  >
                    <svg
                      width="13"
                      height="16"
                      viewBox="0 0 13 16"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M0.466675 2.92407C0.466675 1.35705 2.187 0.398733 3.51938 1.22354L11.7197 6.2999C12.9827 7.0818 12.9827 8.91907 11.7197 9.70096L3.51938 14.7773C2.187 15.6021 0.466675 14.6438 0.466675 13.0768V2.92407Z"
                        fill="#777E90"
                      />
                    </svg>
                  </a>
                </div>
              </div>

              <div class="box-content">
                <a href="#" class="category btn-action">learn & earn</a>
                <a href="" class="title"
                  >Learn about UI8 coin and earn an All-Access Pass</a
                >

                <div class="meta">
                  <a href="#" class="name"><span></span>Floyd Buckridge</a>
                  <a href="#" class="time">Feb 03, 2021</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="button-loadmore">
              <a href="#">
                <svg
                  width="14"
                  height="14"
                  viewBox="0 0 14 14"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M7.00001 0.333008C6.63182 0.333008 6.33334 0.631485 6.33334 0.999674V2.99967C6.33334 3.36786 6.63182 3.66634 7.00001 3.66634C7.3682 3.66634 7.66668 3.36786 7.66668 2.99967V0.999674C7.66668 0.631485 7.3682 0.333008 7.00001 0.333008Z"
                    fill="#23262F"
                  />
                  <path
                    d="M7.00001 10.333C6.63182 10.333 6.33334 10.6315 6.33334 10.9997V12.9997C6.33334 13.3679 6.63182 13.6663 7.00001 13.6663C7.3682 13.6663 7.66668 13.3679 7.66668 12.9997V10.9997C7.66668 10.6315 7.3682 10.333 7.00001 10.333Z"
                    fill="#23262F"
                  />
                  <path
                    d="M13 6.33301C13.3682 6.33301 13.6667 6.63148 13.6667 6.99967C13.6667 7.36786 13.3682 7.66634 13 7.66634H11C10.6318 7.66634 10.3333 7.36786 10.3333 6.99967C10.3333 6.63148 10.6318 6.33301 11 6.33301H13Z"
                    fill="#23262F"
                  />
                  <path
                    d="M3.66668 6.99967C3.66668 6.63148 3.3682 6.33301 3.00001 6.33301H1.00001C0.63182 6.33301 0.333344 6.63148 0.333344 6.99967C0.333343 7.36786 0.63182 7.66634 1.00001 7.66634H3.00001C3.3682 7.66634 3.66668 7.36786 3.66668 6.99967Z"
                    fill="#23262F"
                  />
                  <path
                    d="M10.7713 2.28569C11.0316 2.02535 11.4537 2.02535 11.7141 2.28569C11.9744 2.54604 11.9744 2.96815 11.7141 3.2285L10.2999 4.64272C10.0395 4.90307 9.61742 4.90307 9.35707 4.64272C9.09672 4.38237 9.09672 3.96026 9.35707 3.69991L10.7713 2.28569Z"
                    fill="#23262F"
                  />
                  <path
                    d="M4.64296 9.35666C4.38262 9.09631 3.9605 9.09631 3.70016 9.35666L2.28594 10.7709C2.02559 11.0312 2.02559 11.4533 2.28594 11.7137C2.54629 11.974 2.9684 11.974 3.22875 11.7137L4.64296 10.2995C4.90331 10.0391 4.90331 9.61701 4.64296 9.35666Z"
                    fill="#23262F"
                  />
                  <path
                    d="M11.7141 10.7709C11.9744 11.0313 11.9744 11.4534 11.7141 11.7138C11.4537 11.9741 11.0316 11.9741 10.7713 11.7138L9.35705 10.2995C9.0967 10.0392 9.0967 9.61708 9.35705 9.35673C9.6174 9.09638 10.0395 9.09638 10.2999 9.35673L11.7141 10.7709Z"
                    fill="#23262F"
                  />
                  <path
                    d="M4.64303 4.64263C4.90338 4.38228 4.90338 3.96017 4.64303 3.69982L3.22881 2.28561C2.96846 2.02526 2.54635 2.02526 2.286 2.28561C2.02565 2.54596 2.02565 2.96807 2.286 3.22841L3.70022 4.64263C3.96057 4.90298 4.38268 4.90298 4.64303 4.64263Z"
                    fill="#23262F"
                  />
                </svg>
                Load more</a
              >
            </div>
          </div>
        </div>
      </div>
    </section> --}}

    <footer class="footer style-2">
      <div class="container">
        <div class="footer__main">
          <div class="row">
            <div class="col-xl-4 col-md-6">
              <div class="info">
                <a href="index.html" class="logo">
                  <img src="assets/images/logo/log-footer.png" alt="" />
                </a>
                <h6>Let's talk! 🤙</h6>
                <ul class="list">
                  <li><p>+12 345 678 9101</p></li>
                  <li><p>Info.Avitex@Gmail.Com</p></li>
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
                  <h6 class="title">PRODUCTS</h6>
                  <ul>
                    <li><a href="spot.html">Spot</a></li>
                    <li><a href="#">Inverse Perpetual</a></li>
                    <li><a href="#">USDT Perpetual</a></li>
                    <li><a href="exchange.html">Exchange</a></li>
                    <li><a href="#">Launchpad</a></li>
                    <li><a href="#">Binance Pay</a></li>
                  </ul>
                </div>
                <div class="widget-link s2">
                  <h6 class="title">SERVICES</h6>
                  <ul>
                    <li><a href="buy-crypto-select.html">Buy Crypto</a></li>
                    <li><a href="markets.html">Markets</a></li>
                    <li><a href="#">Tranding Fee</a></li>
                    <li><a href="#">Affiliate Program</a></li>
                    <li><a href="#">Referral Program</a></li>
                    <li><a href="#">API</a></li>
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
                  <input
                    type="email"
                    placeholder="Enter your email"
                    required=""
                  />
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    

    <script>
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

    </script>

    
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
  </body>
</html>
