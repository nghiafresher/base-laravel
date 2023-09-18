
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ base_assets('assets/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ base_assets('assets/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ base_assets('assets/AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">
<body class="hold-transition login-page">
<div class="login-box">
    <div class="card">
        <div class="card-body login-card-body">
            @include('common.message')
            <form action="{{ route('admin.authenticate') }}" method="post">
                @csrf
                <div class="input-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" value="admin@admin.com">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="input-group mt-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" value="12345678">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="row mt-3">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>

                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>

                </div>
            </form>

{{--            <p class="mb-1">--}}
{{--                <a href="forgot-password.html">I forgot my password</a>--}}
{{--            </p>--}}
{{--            <p class="mb-0">--}}
{{--                <a href="register.html" class="text-center">Register a new membership</a>--}}
{{--            </p>--}}
        </div>

    </div>
</div>


<script src="{{ base_assets('assets/AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>

<script src="{{ base_assets('assets/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ base_assets('assets/AdminLTE-3.2.0/dist/js/adminlte.min.js') }} "></script>
</body>
</html>
