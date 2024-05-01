<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr Roket</title>
    
    @vite(['resources/js/app.js'])

</head>
<body>
    <x-header />
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <x-sidebar />
            </div>
            <div class="col">
                {{ $slot }}
            </div>
        </div>
    </div>
    <x-footer />
    </body>
</html>