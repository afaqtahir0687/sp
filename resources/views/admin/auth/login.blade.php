<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Smart Print</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/demoes/demo4/title-logo.jpeg') }}">
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 1000px;
            overflow: hidden;
        }

        .smartprint-login-image {
            background-image: url("{{ asset('admin/img/sp-logo.jpeg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 560px;
        }

        .login-form-section {
            min-height: 560px;
            display: flex;
            align-items: center;
        }

        .login-form-inner {
            width: 100%;
        }

        @media (max-width: 991.98px) {
            .smartprint-login-image {
                display: none;
            }

            .login-form-section {
                min-height: auto;
            }
        }
    </style>
</head>

<body class="bg-gradient-primary">
    <div class="container login-wrapper">
        <div class="card o-hidden border-0 shadow-lg my-5 login-card">
            <div class="card-body p-0">
                <div class="row no-gutters">
                    <!-- LEFT SIDE - SMART PRINT IMAGE -->
                    <div class="col-lg-6 smartprint-login-image"></div>
                    <!-- RIGHT SIDE - LOGIN FORM -->
                    <div class="col-lg-6 login-form-section">
                        <div class="p-5 login-form-inner">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                            </div>

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <form class="user" method="POST" action="{{ route('admin.login.store') }}">
                                @csrf

                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user"
                                        placeholder="Enter Email Address..." value="{{ old('email') }}" required>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user"
                                        placeholder="Password" required>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">

                                        <input type="checkbox" class="custom-control-input" id="remember" name="remember">

                                        <label class="custom-control-label" for="remember">Remember Me</label>
                                    </div>
                                </div>
                                <!-- LOGIN BUTTON -->
                                <button type="submit" class="btn btn-primary btn-user btn-block" id="loginBtn">

                                    <span id="loginText">Login</span>

                                    <span id="loginLoader" style="display: none;">
                                        <i class="fas fa-spinner fa-spin"></i>
                                        Logging in...
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
    <script>
        document.querySelector('.user').addEventListener('submit', function () {

            const loginBtn = document.getElementById('loginBtn');
            const loginText = document.getElementById('loginText');
            const loginLoader = document.getElementById('loginLoader');

            // Disable button
            loginBtn.disabled = true;

            // Change button content
            loginText.style.display = 'none';
            loginLoader.style.display = 'inline-block';
        });
    </script>
</body>

</html>