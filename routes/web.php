<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DummyController;

Route::get('/', function () {
    return view('bootstrap-test');
});

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

Route::get('/logout', function() {
    return view('login-page');
})->name('logout');