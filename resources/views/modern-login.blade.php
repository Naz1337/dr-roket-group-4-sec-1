<x-modern-layout title="Login">
    <div
        class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            <!-- Display error message if present in session -->
                            @if(session('error'))
                                <div class="alert alert-{{ session('error-type') ? session('error-type') : 'warning' }} alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                                </div>
                            @endif
                            <!-- Logo -->
                            <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                <img src="{{ @asset('logo.png') }}" width="180" alt="">
                            </a>
                            <p class="text-center">Login</p>
                            <!-- Form to handle user login, submitting data to the 'login-post' route using the POST method -->
                            <form action="{{ route('login-post') }}" method="post">
                                <!-- CSRF token for security -->
                                @csrf
                                <div class="mb-3">
                                    <!-- Email input field -->
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{ old('email') }}" required>
                                </div>
                                <div class="mb-4">
                                    <!-- Password input field -->
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}">
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="form-check">
                                    </div>
                                    <a class="text-primary fw-bold" href="#">Forgot Password ?</a>
                                </div>

                                <!-- Submit button for login -->
                                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-modern-layout>
