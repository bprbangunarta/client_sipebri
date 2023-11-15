<!doctype html>
<html lang="en">

<head>
    @include('theme.header')
</head>

<body>

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->

    @yield('content')

    @include('theme.bottom-menu')

    @include('theme.sidebar')

    @include('theme.footer')

    @stack('myscript')

</body>

</html>
