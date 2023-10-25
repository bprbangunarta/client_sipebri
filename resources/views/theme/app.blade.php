<!doctype html>
<html lang="en">

<head>
    @include('theme.header')
</head>

<body>

    <!-- loader -->
    <div id="loader">
        <img src="https://presensi.bprbangunarta.co.id/mobile/img/logo-icon.png" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->

    @yield('content')
    
    @include('theme.bottom-menu')

    @include('theme.sidebar')

    @include('theme.footer')

</body>

</html>