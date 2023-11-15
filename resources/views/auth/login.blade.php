<!doctype html>
<html lang="en">

<head>
    @include('theme.header')
</head>

<body class="bg-white">

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->


    <!-- App Capsule -->
    <div id="appCapsule" class="pt-0">

        <div class="login-form mt-1">
            <div class="section">
                <img src="https://simontok.bprbangunarta.co.id/assets/mobile/img/vactor/login.png" alt="image" class="form-image">
            </div>
            <div class="section mt-1">
                <h1>Get started</h1>
                <h4>Fill the form to log in</h4>
            </div>
            <div class="section mt-1 mb-5">
                <form method="POST" action="{{ route('login') }}" class="@error('username') needs-validation was-validated @enderror @error('email') needs-validation was-validated @enderror @error('password') needs-validation was-validated @enderror">
                    @csrf

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required>
                            @error('username')
                                <div class="invalid-feedback" style="text-align:left;">{{ $message }}</div>
                            @enderror
                            @error('email')
                                <div class="invalid-feedback" style="text-align:left;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required>
                            @error('password')
                                <div class="invalid-feedback" style="text-align:left;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-button-group">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Log in</button>
                    </div>

                </form>
            </div>
        </div>


    </div>
    <!-- * App Capsule -->

    @include('theme.footer')
</body>

</html>