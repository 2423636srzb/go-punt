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
      .container {
          margin-top: 30px;
      }
  
      .match-title {
          font-size: 2rem;
          font-weight: bold;
          color: #007bff;
          margin-bottom: 20px;
      }
/*   
      .team-container {
          display: flex;
          justify-content: space-between;
          align-items: center;
          margin-bottom: 15px;
      }
  
      .team {
          font-size: 1.25rem;
          font-weight: 500;
      }
  
      .team-name {
          font-size: 1.3rem;
          font-weight: bold;
      }
  
      .batting-indicator {
          color: #ff002b;
          font-size: 1.2rem;
      }
  
      .stats p {
          font-size: 1.1rem;
          color: #333;
      }
  
      .balls-container {
          display: flex;
          gap: 10px;
          margin-top: 10px;
      }
  
      .ball {
          width: 35px;
          height: 35px;
          background-color: #007bff;
          color: white;
          text-align: center;
          line-height: 35px;
          font-weight: bold;
          border-radius: 50%;
          font-size: 1.1rem;
      }
  
      .last-6-balls .title {
          font-weight: 600;
          font-size: 1.1rem;
          color: #333;
      } */
  
      .video-title {
          font-size: 1.5rem;
          font-weight: bold;
          margin-bottom: 15px;
          color: #007bff;
      }
  
      /* Responsive design */
      @media (max-width: 768px) {
          .container {
              margin-top: 15px;
          }
  
          /* .match-title {
              font-size: 1.6rem;
          }
  
          .team-container {
              flex-direction: column;
              align-items: flex-start;
          }
  
          .balls-container {
              justify-content: center;
          }
  
          .ball {
              width: 30px;
              height: 30px;
              font-size: 1rem;
          }*/
      } 


.match-container {
  border-radius: 8px;
  padding: 3px;
  
}
.team-container {
    height: 35px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.team p {
  font-size: 16px;
  font-weight: bold;
}

.stats p {
  font-size: 16px;
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
.overs {
  font-size: 10px;
  font-weight: light;
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
@if ($sportId == 4)
    <div class="container">
      <div class="flex gap-10">
          <div class="services-box border p-3" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 4px 15px 0px; height: 315px; width: 350px; min-width: 350px; border-radius: 15px;">
          
            <a href="" class="text-xl text-black mb-2 w-full block text-center">Pak VS Ind</a>
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
              <p style="font-size: 14px; font-weight: 600; color:#0056b3; margin: 20px; margin-left: 50px;">Pak needs 45 runs in 18 balls</p>
            </div>
          </div>
          <!-- Right Side: Video Player (Live Stream) -->
          
              <!-- Embed the live stream using iframe -->
              <iframe width="100%" src="https://live.oldd247.com/betfairtv/?cid={{$channelId}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"  allowfullscreen></iframe>
         
      </div>
  </div>
  @endif
@if ($sportId == 2)
  <div class="container">
    <div class="flex gap-10">
        <div class="services-box border p-3" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 4px 15px 0px; height: 200px; width: 350px; min-width: 350px; border-radius: 15px;">
        
          <a href="" class="text-xl text-black mb-2 w-full block text-center">Germany  VS  England</a>
          <hr class="mb-1">
          <div class="match-container">
            <!-- Pakistan Team Info -->
            <div class="team-container">
              <div class="team">
                <p class="batting">Ger<span style="color: #ff002b">*</span></p>
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
            <p style="font-size: 14px; font-weight: 600; color:#0056b3; margin: 20px; margin-left: 50px;">Ger needs 4 Goals in 30 minutes</p>
          </div>
        </div>
        <!-- Right Side: Video Player (Live Stream) -->
          <div style="min-height: 350px; width: 100%;">
            <!-- Embed the live stream using iframe -->
            <iframe width="100%" height="100%" src="https://live.oldd247.com/betfairtv/?cid={{$channelId}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
          </div>
    </div>
</div>

@endif
@if ($sportId == 1)
<div class="container">
  <div class="flex gap-10">
      
      <div class="services-box border p-3" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 4px 15px 0px; height: 200px; width: 350px; min-width: 350px; border-radius: 15px;">
        <a href="" class="text-xl text-black mb-2 w-full block text-center">Barcelona VS Spain</a>
        <hr class="mb-1">
        <div class="match-container">
          <!-- Pakistan Team Info -->
          <div class="team-container">
            <div class="team">
              <p class="batting">Barcelona<span style="color: #ff002b">*</span></p>
            </div>
            <div class="stats">
              <p><span class="batting">45-3</span> <span class="overs">(7.3)</span></p>
            </div>
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
          <p style="font-size: 14px; font-weight: 600; color:#0056b3; margin: 20px; margin-left: 50px;">Pak needs 45 runs in 18 balls</p>
        </div>
      </div>
      <!-- Right Side: Video Player (Live Stream) -->
      <div style="min-height: 350px; background-color: #007bff; width: 100%;">
          <!-- Embed the live stream using iframe -->
          <iframe width="100%" height="100%" src="https://live.oldd247.com/betfairtv/?cid={{$channelId}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"  allowfullscreen></iframe>
      </div>
  </div>
</div>
@endif
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
  </body>
  </html>
  