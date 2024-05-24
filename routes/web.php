<?php

use App\Http\Controllers\PlatinumController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DummyController;
use App\Http\Controllers\ExpertDomainController;
use Illuminate\Support\Facades\Blade;
use Illuminate\Http\Request;

Route::get('/modern', function () {
   return view('modern');
})->name('modern')->middleware('auth');

Route::get('/modern-login', [UserController::class,'login'])->name('modern-login');

Route::get('/modern_login', function() {
    return view('components.modern-layout');
})->name('modern-login');

Route::get('/', function () {
    return redirect('modern');
})->middleware('auth');


Route::get('/register', [UserController::class,'register'])->name('register');

Route::post('/register', [UserController::class,'register'])->name('register-post');

Route::get('/login', [UserController::class,'login'])->name('login');

Route::post('/login', [UserController::class,'login'])->name('login-post');


Route::get('/logout', [UserController::class,'logout'])->name('logout');


Route::get('/app', [DummyController::class, 'show']);


Route::get('/home', function() {
    return view('home');
})->name('home');


Route::get('/profile', function() {
    return view('profile');
})->name('profile');

Route::prefix('user')->group(function() {
    Route::get('/manage-platinum', [PlatinumController::class,'manage_platinum'])->name('manage-platinum');
    Route::get('/register-platinum', [PlatinumController::class,'register_platinum'])->name('register-platinum');
    Route::get('/user-profile', [UserProfileController::class,'view_profile'])->name('register-platinum');
});

Route::prefix('/expert')->group(function () {
    Route::get('/myexpert', [ExpertDomainController::class, 'showMyExpert'])
    ->name('myexpert');

    Route::get('/listexpert', [ExpertDomainController::class, 'showListExpert']
    )->name('listexpert');

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
})->middleware('auth');


Route::prefix('/publication')->group(function () {
    Route::get('/mypublication', function() {
        return view('/ManageExpertDomain/myExpertDomain');
    })->name('mypublication');
    Route::get('/listpublication', function() {
        return view('/ManageExpertDomain/listExpertDomain');
    })->name('listpublication');
});

