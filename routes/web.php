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


Route::get('/register', function() {
    return view('register-temp');
})->name('register');

Route::post('/register', function() {

    $validated = request()->validate([
        'username' => 'required|unique:users,name',
        'email' => 'required|email:rfc|unique:users,email',
        'password' => 'required|min:2',
    ]);

    $newUser = new \App\Models\User;
    $newUser->name = $validated['username'];
    $newUser->email = $validated['email'];
    $newUser->password = Hash::make($validated['password']);

    if ($newUser->save()) {
        return to_route('login', ['message' => 'ya did it']);
    }

    return to_route('register', ['message' => 'saving to db failed, RARE ENDING']);
})->name('register-post');


Route::get('/login', function () {
    return view('login-page');
})->name('login');

Route::post('/login', function() {
    $credentials = request()->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $loginResult = Auth::attempt($credentials);
    if (!$loginResult) {
        return to_route('login', ['message' => 'Wrong email or password']);
    }
    return to_route('drafts.index', ['message' => 'You are logged in']);

})->name('login-post');


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

