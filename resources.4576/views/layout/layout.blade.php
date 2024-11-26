<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<x-head />

<body>
    <?php 
        if(Auth::Check())
            if(Auth::user()->is_admin == 1){ ?>
    <x-sidebaradmin />
    <?php
            } else { ?>
    <x-sidebar />
    <?php }
        ?>

    <main class="dashboard-main">

        <!-- ..::  navbar start ::.. -->
        <x-navbar />
        <!-- ..::  navbar end ::.. -->
        <div class="dashboard-main-body">

            <!-- ..::  breadcrumb  start ::.. -->
            <x-breadcrumb title='{{ $title }}' subTitle='{{ $subTitle }}' />
            <!-- ..::  header area end ::.. -->

            @yield('content')

        </div>
        <!-- ..::  footer  start ::.. -->
        <x-footer />
        <!-- ..::  footer area end ::.. -->

        <div id="toast"
            class="toast hidden fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-md shadow-lg z-50">
            <p id="toast-message">Signup successful!</p>
        </div>
    </main>

    <!-- ..::  scripts  start ::.. -->
    <x-scripts script="{!! isset($script) ? $script : '' !!}" />

    @yield('js')
    <!-- ..::  scripts  end ::.. -->
    <script>
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
</body>

</html>