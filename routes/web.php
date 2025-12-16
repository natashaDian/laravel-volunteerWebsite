<?php

use Illuminate\Support\Facades\Route;

// ================= USER CONTROLLERS =================
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityRegistrationController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\OrganizationController;

// ================= COMPANY CONTROLLERS =================
use App\Http\Controllers\CompanyDashboardController;
use App\Http\Controllers\CompanyActivityController;
use App\Http\Controllers\PointsTransactionController;
use App\Http\Controllers\RewardController;

/*
|--------------------------------------------------------------------------
| Landing
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| USER DASHBOARD
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    | Profile
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    | Events (legacy)
    */
    Route::get('/events/{id}', [EventController::class, 'eventDetail'])
        ->name('events.show');

    /*
    | Activities (USER SIDE)
    */
    Route::get('/activities', [ActivityController::class, 'index'])
        ->name('activities.index');

    Route::get('/activities/{activity}', [ActivityController::class, 'show'])
        ->name('activities.show');

    Route::post('/activities/{activity}/register', [ActivityRegistrationController::class, 'store'])
        ->name('activities.register');

    Route::post('/activities/{activity}/confirm', [ActivityRegistrationController::class, 'confirm'])
        ->name('activities.confirm');

    /*
    | Organizations
    */
    Route::get('/organizations', [OrganizationController::class, 'index'])
        ->name('organizations.index');

    Route::get('/organizations/{company}', [OrganizationController::class, 'show'])
        ->name('organizations.show');

    /*
    | Rewards
    */
    Route::middleware(['auth'])->group(function () {
        Route::get('/rewards', [RewardController::class, 'index'])->name('rewards.index');
        Route::post('/rewards/{reward}/redeem', [RewardController::class, 'redeem'])->name('rewards.redeem');
    });

    /*
    | Points History
    */
    Route::get('/points-history', [PointsTransactionController::class, 'index'])
        ->name('points.history')->middleware('auth');

    /*
    | Donations
    */
    Route::get('/donations', [DonationController::class, 'index'])
        ->name('donations.index');

    Route::get('/donations/method', [DonationController::class, 'method'])
        ->name('donations.method');

    Route::get('/donations/checkout', [DonationController::class, 'checkout'])
        ->name('donations.checkout');

    Route::post('/donations/confirm', [DonationController::class, 'confirm'])
        ->name('donations.confirm');

    /*
    | About
    */
    Route::get('/about', [AboutController::class, 'index'])
        ->name('about');
});

/*
|--------------------------------------------------------------------------
| COMPANY ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth:company')
    ->prefix('company')
    ->name('company.')
    ->group(function () {

        /*
        | Company Dashboard
        */
        Route::get('/dashboard', [CompanyDashboardController::class, 'index'])
            ->name('dashboard');

        /*
        | Company Activities (CRUD)
        */
        Route::resource('activities', CompanyActivityController::class);
    });

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
