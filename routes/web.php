<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DummyController;
use Illuminate\Support\Facades\Blade;
use Illuminate\Http\Request;

Route::get('/modern', function () {
   return view('modern');
})->name('modern');

Route::get('/modern-login', [UserController::class,'login'])->name('modern-login');

Route::get('/modern_login', function() {
    return view('components.modern-layout');
})->name('modern-login');

Route::get('/', function () {
    return "Well hello there o/. so...";
})->middleware('auth');


Route::get('/register', [UserController::class,'register'])->name('register');

Route::post('/register', [UserController::class,'register'])->name('register-post');

Route::get('/login', [UserController::class,'login'])->name('login');

Route::post('/login', [UserController::class,'login'])->name('login-post');


Route::get('/logout', function(Request $request) {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();
    return to_route('login', ['message' => 'You are logged out']);
})->name('logout');


Route::get('/app', [DummyController::class, 'show']);


Route::get('/home', function() {
    return view('home');
})->name('home');


Route::get('/profile', function() {
    return view('profile');
})->name('profile');

Route::get('/manage-platinum', function () {
    return view('/ManagePlatinum/index');
})->name('manage-platinum');

Route::prefix('/expert')->group(function () {
    Route::get('/myexpert', function() {
        return view('ManageExpertDomain/myExpertDomain');
    })->name('myexpert');

    Route::get('/listexpert', function() {
        return view('ManageExpertDomain/listExpertDomain');
    })->name('listexpert');

    Route::get('/addexpert', function() {
        return view('ManageExpertDomain/addExpertProfile');
    })->name('addprofile');

    Route::get('/viewexpert', function() {
        return view('ManageExpertDomain/viewExpertProfile');
    })->name('viewexpert');

    Route::get('/editexpert', function() {
        return view('ManageExpertDomain/editExpertProfile');
    })->name('editexpert');

    Route::get('/uploadexpertpublic', function() {
        return view('ManageExpertDomain/uploadExpertPublication');
    })->name('uploadexpertpublic');
});


Route::prefix('/publication')->group(function () {
    Route::get('/mypublication', function() {
        return view('ManageExpertDomain/myExpertDomain');
    })->name('mypublication');
    Route::get('/listpublication', function() {
        return view('ManageExpertDomain/listExpertDomain');
    })->name('listpublication');
});

