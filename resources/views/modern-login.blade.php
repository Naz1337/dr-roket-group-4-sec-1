{{--<!doctype html>--}}
{{--<html lang="en">--}}

{{--<head>--}}
{{--  <meta charset="utf-8">--}}
{{--  <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--  <title>The Platinum Orbits | Login</title>--}}
{{--  <link rel="shortcut icon" type="image/png" href="{{ @asset('logo.png') }}" />--}}
{{--  <link rel="stylesheet" href="../assets/css/styles.min.css" />--}}
{{--</head>--}}

{{--<body>--}}
{{--  <!--  Body Wrapper -->--}}
{{--  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"--}}
{{--    data-sidebar-position="fixed" data-header-position="fixed">--}}
{{--    --}}
{{--  </div>--}}
{{--  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>--}}
{{--  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>--}}
{{--</body>--}}

{{--</html>--}}
<x-modern-layout title="Login">
    <div
        class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-{{ session('error-type') ? session('error-type') : 'warning' }} alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                                </div>
                            @endif
                            <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                <img src="{{ @asset('logo.png') }}" width="180" alt="">
                            </a>
                            <p class="text-center">Login</p>
                            <form action="{{ route('login-post') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{ old('email') }}" required>
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}">
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="form-check">
                                        <!-- <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                                        <label class="form-check-label text-dark" for="flexCheckChecked">
                                          Remeber this Device
                                        </label> -->
                                    </div>
                                    <a class="text-primary fw-bold" href="#">Forgot Password ?</a>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                                <!-- <div class="d-flex align-items-center justify-content-center">
                                  <p class="fs-4 mb-0 fw-bold">New to Modernize?</p>
                                  <a class="text-primary fw-bold ms-2" href="./authentication-register.html">Create an account</a>
                                </div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-modern-layout>
