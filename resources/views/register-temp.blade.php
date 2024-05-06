<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Temporary Register Page</title>
    @vite('resources/js/app.js')
</head>
<body>
    <div class="mt-4 ms-4">
        <p>Page ni implement simple register interface, dengan server side form validation</p>
        <p>username kene uniq, email kene nampak cam email dan unik, password kene 2 character atau lebih panjangnya</p>
    </div>

    <form action="{{ route('register-post') }}" method="post" class="mx-auto p-2 border-secondary rounded-5 mt-5"
          style="max-width: 480px">
        @csrf
        <div class="form-floating mb-3">
            <input class="form-control @error('username') is-invalid @enderror"
                   type="text" name="username" id="username" placeholder="Username"
                   value="{{ old('username') }}">
            <label for="username">Username</label>
            <div class="invalid-feedback">{{ $errors->first('username') }}</div>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control @error('email') is-invalid @enderror"
                   type="text" name="email" id="email" placeholder="Email"
                   value="{{ old('email') }}">
            <label for="email">Email</label>
            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
        </div>
        <div class="form-floating mb-4">
            <input class="form-control @error('password') is-invalid @enderror"
                   type="password" name="password" id="password" placeholder="Password">
            <label for="password">Password</label>
            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</body>
</html>
