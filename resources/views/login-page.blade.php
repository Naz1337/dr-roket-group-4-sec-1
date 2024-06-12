<x-app-layout>
    <!-- Form to handle user login, submitting data to the 'login-post' route using the POST method -->
    <form action="{{ route('login-post') }}" method="post">
        <!-- CSRF token for security -->
        @csrf
        <div class="login-panel">
            <!-- Page title component -->
            <x-page-title class="mb-6">LOGIN</x-page-title>

            <div class="col-7">
                <!-- Email input field -->
                <label for="email" class="mb-2">Email</label>
                <input type="text" name="email" id="email" class="mb-4 form-control col-md-4">

                <!-- Password input field -->
                <label for="password" class="mb-2">Password</label>
                <input type="password" name="password" id="password" class="mb-4 form-control">
            </div>
            <!-- Submit button for login -->
            <button type="submit" href="/expert/myexpert" class="login-btn btn btn-primary mb-2">
                Login
            </button>
{{--            <a class="login-btn btn btn-danger mb-2">--}}
{{--                Forget Password--}}
{{--            </a>--}}
        </div>
    </form>
</x-app-layout>

