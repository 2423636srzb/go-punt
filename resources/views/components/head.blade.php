<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="is-admin" content="{{ Auth::user()->is_admin }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $websiteSettings->name }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/GP247LogoFavicon.png') }}" sizes="16x16">
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
{{-- <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-TKE60S7NYY"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-TKE60S7NYY');
</script> --}}
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-KW476DK53K"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-KW476DK53K');
</script>


    <style>
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
    </style>
</head>
