<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr Roket</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    <header>
        <img src="{{ @asset('logo.png') }}" alt="Logo system">
        <div class="header-action">
            {{-- TODO: guna @@if untuk tengok dah login ke belum --}}
            <button class="btn btn-primary">Login</button>
        </div>
    </header>

    {{ $slot }}

</body>
</html>