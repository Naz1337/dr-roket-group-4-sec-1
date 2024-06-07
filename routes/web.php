<?php

use App\Http\Controllers\DraftController;
use App\Http\Controllers\PlatinumController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Middleware\EnsureUserStaffMentor;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DummyController;
use App\Http\Controllers\ExpertDomainController;
use App\Http\Controllers\PublicationController;
use Illuminate\Support\Facades\Blade;
use Illuminate\Http\Request;
use App\Http\Controllers\CrmpController;

Route::get('/dashboard', function () {
   return view('dashboard');
})->name('dashboard')->middleware('auth');

//Route::get('/modern-login', [UserController::class,'login'])->name('modern-login');
//
//Route::get('/modern_login', function() {
//    return view('components.modern-layout');
//})->name('modern-login');

Route::get('/', function () {
    return redirect('dashboard');
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


//Route::get('/profile', function() {
//    return view('profile');
//})->name('profile');

Route::prefix('user')->group(function() {
    Route::get('/manage-user-profile', [UserProfileController::class,'manage_user_profile'])->name('manage-user-profile');
    Route::get('/register-platinum', [PlatinumController::class,'register_platinum'])->name('register-platinum')->middleware(EnsureUserStaffMentor::class);
    Route::post('/register-platinum-post', [PlatinumController::class,'register_platinum'])->name('register-platinum-post');
    Route::get('/register-success', [PlatinumController::class,'register_success'])->name('register-success');
    Route::get('/edit-profile/{id}', [UserProfileController::class,'edit_profile'])->name('edit-profile');
    Route::post('/edit-profile-post', [UserProfileController::class,'edit_profile_post'])->name('edit-profile-post');
    Route::get('/user-profile/{id}', [UserProfileController::class,'view_profile'])->name('view-profile-id');
    Route::get('/user-profile', [UserProfileController::class,'view_profile'])->name('view-profile');
    Route::get('/generate-excel', [UserProfileController::class,'generateReportExcel'])->name('generate-excel');
})->middleware('auth');

Route::prefix('/expert')->group(function () {
    Route::get('/my-expert', [ExpertDomainController::class, 'showMyExpert'])
    ->name('my-expert');

    Route::get('/list-expert', [ExpertDomainController::class, 'showListExpert']
    )->name('list-expert');

    Route::get('/addexpert', [ExpertDomainController::class, 'create']
    )->name('addprofile');

    Route::post('/addexpert', [ExpertDomainController::class, 'store']
    )->name('createprofile');

    Route::get('/view-expert/{id}', [ExpertDomainController::class, 'show']
    )->name('view-expert.id');

    Route::get('/edit-expert/{id}', [ExpertDomainController::class, 'edit']
    )->name('edit-expert.id');

    Route::post('/delete-expert/{id}', [ExpertDomainController::class, 'delete']
    )->name('delete-expert.id');

    Route::get('/uploadexpertpublic', function() {
        return view('ManageExpertDomain/uploadExpertPublication');
    })->name('uploadexpertpublic');

    Route::get('/generatereport', [ExpertDomainController::class, 'generateReport']
    )->name('generatereport');

})->middleware('auth');


Route::prefix('/publication')->group(function () {
    Route::get('/mypublication', [PublicationController::class, 'index'])->name('mypublication');
    Route::get('/addpublication', [PublicationController::class, 'create'])->name('addpublication');
    Route::post('/addpublication', [PublicationController::class, 'store'])->name('storepublication');
});

Route::middleware(['auth'])->group(function () {

    Route::resource('draft', DraftController::class)->middleware('role:platinum,mentor');

    Route::prefix('crmp')->group(function () {
        Route::middleware(['role:staff'])->group(function () {

            Route::get('/', [CrmpController::class, 'index'])->name('crmp.index');
            Route::post('/{platinum}', [CrmpController::class, 'toggleCrmp'])
                ->name('crmp.toggle_crmp');

            Route::post('/unassign/{platinum}', [CrmpController::class, 'unassignCrmp'])
                ->name('crmp.unassign_crmp');

            Route::get('/assign/{platinum}', [CrmpController::class, 'assignCrmp'])
                ->name('crmp.assign_crmp');
            Route::post('/assign/{platinum}/{crmp}', [CrmpController::class, 'assignCrmp'])
                ->name('crmp.assign_crmp_post');

        });

        Route::middleware(['role:platinum,mentor'])->group(function () {
            Route::get('/my-platinums', [CrmpController::class, 'myPlatinums'])
                ->name('crmp.my_platinums');
        });
    });
});



