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
</style>
  </head>
  <body class="body header-fixed home-2">



    <div class="container">
      <div class="flex gap-10">
          <!-- Left Side: Match Details -->
          {{-- <div class="col-md-5 match-details">
              <h3 class="match-title">Pakistan vs India</h3>
  
              <!-- Pakistan Team Info -->
              <div class="team-container">
                  <div class="team">
                      <p class="team-name">Pakistan <span class="batting-indicator">*</span></p>
                  </div>
                  <div class="stats">
                      <p><span class="batting">45-3</span> <span class="overs">(7.3)</span></p>
                  </div>
              </div>
  
              <!-- CRR Info -->
              <div class="team-container">
                  <div class="team"></div>
                  <div class="stats">
                      <p><span class="overs">CRR (7.2)</span></p>
                  </div>
              </div>
  
              <!-- India Team Info -->
              <div class="team-container">
                  <div class="team">
                      <p class="team-name">India</p>
                  </div>
                  <div class="stats">
                      <p><span>38-2</span> <span class="overs">(7.2)</span></p>
                  </div>
              </div>
  
              <!-- Last 6 Balls -->
              <div class="last-6-balls">
                  <p class="title">Last 6 Balls</p>
                  <div class="balls-container mb-2">
                      <div class="ball">1</div>
                      <div class="ball">0</div>
                      <div class="ball">4</div>
                      <div class="ball">6</div>
                      <div class="ball">1</div>
                      <div class="ball">0</div>
                  </div>
              </div>
          </div> --}}
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
              <iframe width="100%" src="https://www.youtube.com/embed/mLld0ZvQMsY?si=hsKJX0gs8qQ2ejCW" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
         
      </div>
  </div>
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
  