<?php

use App\Http\Controllers\DraftController;
use App\Http\Controllers\FocusItemController;
use App\Http\Controllers\PlatinumController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\WeeklyFocusController;
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


//Route::get('/home', function() {
//    return view('home');
//})->name('home');


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
    //My Expert List
    Route::get('/my-expert', [ExpertDomainController::class, 'showMyExpert'])
    ->name('my-expert');

    //All Expert List
    Route::get('/list-expert', [ExpertDomainController::class, 'showListExpert']
    )->name('list-expert');

    //Add my expert
    Route::get('/addexpert', [ExpertDomainController::class, 'create']
    )->name('addprofile');

    //Store my expert
    Route::post('/addexpert', [ExpertDomainController::class, 'store']
    )->name('createprofile');

    //Show expert
    Route::get('/view-expert/{id}', [ExpertDomainController::class, 'show']
    )->name('view-expert.id');

    Route::get('/edit-expert/{id}', [ExpertDomainController::class, 'edit']
    )->name('edit-expert.id');

    Route::post('/update-expert/{id}', [ExpertDomainController::class, 'update']
    )->name('update-expert.id');

    Route::get('/delete-expert/{id}', [ExpertDomainController::class, 'destroy']
    )->name('delete-expert.id');

    Route::get('/upload-expert-publication/{id}', [ExpertDomainController::class, 'addpublication']
    )->name('upload-expert-publication.id');

    Route::post('/create-expert-publication/{id}', [ExpertDomainController::class, 'storepublication']
    )->name('create-expert-publication.id');

    Route::get('/edit-expert-publication/{id}', [ExpertDomainController::class, 'editpublication']  
    )->name('edit-expert-publication.id');

    Route::post('/update-expert-publication/{id}', [ExpertDomainController::class, 'updatepublication']
    )->name('update-expert-publication.id');

    Route::get('/delete-expert-publication/{id}', [ExpertDomainController::class, 'deletepublication'])
    ->name('delete-expert-publication.id');

    Route::get('/generatereport', [ExpertDomainController::class, 'generateReport']
    )->name('generatereport');

})->middleware('auth');


Route::prefix('/publication')->group(function () {
    Route::get('/addpublications', [PublicationController::class, 'create'])->name('addpublication');
    Route::post('/savepublications', [PublicationController::class, 'store'])->name('savepublication');
    Route::get('/editpublication/{id}', [PublicationController::class, 'edit'])->name('editpublication');
    Route::put('/updatepublication/{id}', [PublicationController::class, 'update'])->name('updatepublication');
    Route::get('/mypublication', [PublicationController::class, 'index'])->name('mypublication');
    Route::delete('/deletepublications/{id}', [PublicationController::class, 'destroy'])->name('deletepublication');
    Route::get('/searchmypublication', [PublicationController::class, 'search'])->name('search');
    Route::get('/viewpublication/{id}', [PublicationController::class, 'show'])->name('viewpublication');
    Route::get('/searchpublication', [PublicationController::class, 'searchOtherPublications'])->name('searchpublication');
    Route::get('/publicationreport', [PublicationController::class, 'generateReport'])->name('publicationreport.page');
    Route::post('/publicationreport', [PublicationController::class, 'generateReport'])->name('publicationreport');
    Route::post('/downloadpublicationreport', [PublicationController::class, 'downloadReport'])->name('downloadpublicationreport');
})->middleware('auth');

Route::middleware(['auth'])->group(function () {

    Route::resource('draft', DraftController::class)->middleware('role:platinum');

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
            Route::get('/my-platinums/{platinum}/drafts', [CrmpController::class, 'viewDraftProgress'])
                ->name('crmp.view_draft_progress');
            Route::post('/my-platinums/feedback/{type}/{platinum}', [CrmpController::class, 'feedback'])
                ->name('crmp.feedback');

            Route::get('/my-platinums/{platinum}/weekly_foci', [CrmpController::class, 'weeklyFocus'])
                ->name('crmp.weekly_foci');
        });
    });

    Route::resource('weekly-focus', WeeklyFocusController::class)->middleware('role:platinum');

    Route::get('/weekly-focus/{weeklyFocus}/edit/{focusItem}', [FocusItemController::class, 'edit'])
        ->name('focus-item.edit');
    Route::get('/focus-item/create/{weeklyFocus}', [FocusItemController::class, 'create'])
        ->name('focus-item.create');
    Route::post('/focus-item/{weeklyFocus}', [FocusItemController::class, 'store'])
        ->name('focus-item.store');
    Route::delete('/focus-item/destroy/{focusItem}', [FocusItemController::class, 'destroy'])
        ->name('focus-item.destroy');
    Route::put('/focus-item/update/{focusItem}/{weeklyFocus}', [FocusItemController::class, 'update'])
        ->name('focus-item.update');
});



