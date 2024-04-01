<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DummyController;

Route::get('/', function () {
    return view('login-page');
});

Route::get('/app', [DummyController::class, 'show']);