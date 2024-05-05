<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DummyController;
use Illuminate\Support\Facades\Blade;

Route::get('/', function () {
    return "Well hello there o/. so...";
})->middleware('auth');


Route::get('/register', function() {
    return Blade::render(<<<EOL
<html>
<head>
  <title>Register Page</title>
  @vite('resources/js/app.js')
</head>
<body>
  <div class="container mt-5 mb-5">
    <div>
      selamat datang ke register page
    </div>
    <a href="{{ url("login") }}">
      <button class="btn btn-primary">Login</button>
    </a>
  </div>
  <x-header />
</body>
</html>
EOL, );
})->name('register');


Route::get('/login', function () {
    return view('login-page');
})->name('login');


Route::get('/logout', function() {
    return view('login-page');
})->name('logout');


Route::get('/app', [DummyController::class, 'show']);


Route::get('/home', function() {
    return view('home');
})->name('home');


Route::get('/profile', function() {
    return view('profile');
})->name('profile');


Route::prefix('/expert')->group(function () {
    Route::get('/myexpert', function() {
        return view('ManageExpertDomain/myExpertDomain');
    })->name('myexpert');

    Route::get('/addexpert', function() {
        return view('ManageExpertDomain/addExpertProfile');
    })->name('addprofile');

    Route::get('/listexpert', function() {
        return view('ManageExpertDomain/listExpertDomain');
    })->name('listexpert');
});


Route::prefix('/publication')->group(function () {
    Route::get('/mypublication', function() {
        return view('ManageExpertDomain/myExpertDomain');
    })->name('mypublication');
    Route::get('/listpublication', function() {
        return view('ManageExpertDomain/listExpertDomain');
    })->name('listpublication');
});

