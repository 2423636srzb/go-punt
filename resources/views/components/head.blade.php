<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="is-admin" content="{{ Auth::user()->is_admin }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $websiteSettings->name }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('assets/app/dist/app.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/app/dist/magnific-popup.css')}}" />
    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <!-- End Style CSS -->

    <link rel="shortcut icon" href="{{asset('assets/images/BD/All-Panel-Pro-Logo-Favicon.png')}}" />
    <link
      rel="apple-touch-icon-precomposed"
      href="{{asset('assets/images/BD/All-Panel-Pro-Logo-Favicon.png')}}"
    />


    <link rel="icon" type="image/png" href="{{ asset('assets/images/BD/All-Panel-Pro-Logo-Favicon.png') }}" sizes="16x16">
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
    <!-- Add FontAwesome to your project -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<script async src="https://www.googletagmanager.com/gtag/js?id=G-KW476DK53K"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-KW476DK53K');
</script>

<style>
    /* TV Container */
.tv-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 5px auto;
    max-width: 100%;
    padding: 10px;
}

/* TV Title */
.tv-title {
    font-size: 16px;
    font-weight: bold;
    color: #050505;
    text-align: center;
    margin-bottom: 10px;
    /* background: #007bff; */
    padding: 10px;
    border-radius: 8px;
    width: 100%;
    max-width: 900px;
}

/* TV Frame - Aspect Ratio 16:9 */
.tv-frame {
    width: 50vw; /* Use viewport width */
    max-width: 900px; /* Increase for desktops */
    aspect-ratio: 16 / 9; /* Maintain proportion */
    background: #222;
    border-radius: 20px;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.5);
    padding: 10px;
    border: 8px solid #444;
    overflow: hidden;
}

/* TV Screen (Iframe) */
.tv-frame iframe {
    width: 100%;
    height: 100%;
    border-radius: 12px;
    border: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    .tv-frame {
        width: 90vw; /* Smaller width for mobile */
        max-width: 100%;
    }
}
    .sidebar {
    padding-right: 0;
    }
    .crypto-box {
    display: flex;
    flex-direction: column;
    align-items: center; /* Horizontally centers the content */
    justify-content: center; /* Vertically centers the content */
    text-align: center; /* Ensures that text like the game name is centered */
    padding: 20px; /* Add some padding inside the box */
    background-color:rgba(184, 186, 187, 0.2); /* Background color for the game box */
    border-radius: 10px; /* Optional, adds rounded corners */
    box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Optional, adds a subtle shadow */
    width: 100%;
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

/* .live-button-container {
  display: flex;
  justify-content: center;
  align-items: center;
  /* position: absolute;
  left: 100px;
  top: -18px
} */ */
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


#messageContainer {
    margin-top: 10px;
}
.alert-info {
    background-color: #d9edf7;
    color: #31708f;
}
.alert-success {
    background-color: #d4edda;
    color: #155724;
}
.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
}


.live-stream-btn {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #0077ff; /* Change color as needed */
    color: white;
    font-weight: bold;
    text-align: center;
    padding: 6px 10px;
    border-radius: 50px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
    text-decoration: none;
    font-size: 14px;
}

.live-stream-btn:hover {
    background-color: #000fe6; /* Darker shade on hover */
    color: rgb(255, 255, 255);
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
        box-shadow: 0 0 10px rgba(255, 0, 0, 1);
    }
    100% {
        transform: scale(1);
        box-shadow: 0 0 5px rgba(255, 0, 0, 0.8);
    }
}
.btn-live{
padding: 5px 20px;
margin-bottom: 10px;
margin-top:0;
background-color: #ff002b;

transition: all 0.3s ease-in-out;
animation: pulseGlow 1.5s infinite;
}

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
.game-button {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 140px;
  height: 85px;
  color: rgb(89, 116, 206);
  border-radius: 10px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  font-weight: bold;
  padding: 6px;
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
  width: 30px;
  height: 30px;
  font-size: 12px;
  margin-bottom: 10px;
  object-fit: contain;
}

.game-button .game-text {
  font-size: 12px;
  font-weight: bold;
  text-transform: uppercase;
}
.services {
    padding: 20px  0;
    margin-left: 20px
}
.button-container {
  margin: 0 30px 20px 20px;
  display: flex;
  justify-content: flex-start;
  align-items: center;
}

/* Reduce margin and padding on smaller screens */
@media (max-width: 768px) {
  .game-button {
    width: 120px; /* Reduce button width */
    height: 80px; /* Reduce button height */
    padding: 3px; /* Reduce padding */
    margin-right: 3px; /* Reduce margin */
  }

  .game-button .icon {
    width: 25px; /* Reduce icon size */
    height: 25px;
    margin-bottom: 5px;
  }

  .game-button .game-text {
    font-size: 10px; /* Reduce text size */
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

.container-cricket, .container-tennis, .container-football {
  margin-left: 25px;
  margin-right: 25px;
  display: none;
}

.container-cricket.active, .container-tennis.active, .container-football.active {
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
  .container-cricket, .container-tennis, .container-football {
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
    width: 100% !important; /* Force it to take full width */
    margin-bottom: 15px;
    box-sizing: border-box; /* Ensure padding and margin don't affect width */
  }

  .team-container {
    flex-direction: column;
    align-items: flex-start;
  }

  .team-container .team p, .stats p {
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
    flex: 1 1 calc(25% - 20px); /* Default for desktop and larger devices */
    height: auto;
    max-width:240px !important;
    /* max-width: calc(100% - 20px) !important; */
    box-sizing: border-box;
    border-radius: 12px;
    backdrop-filter: blur(4px);
    background: var(--surface);
    text-align: center;
    padding: 0px;
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
        width: 100% !important; /* Force 100% width */
        margin-bottom: 15px !important; /* Adjust margin for mobile */
        box-sizing: border-box;
    }
}

/* Padding classes */
.p-3 {
    padding: 1rem !important; /* Padding for different sections */
}

/* Border styles */
.border {
    border: 1px solid #dee2e6 !important; /* Apply consistent border */
}
    </style>
</head>
