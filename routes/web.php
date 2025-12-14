<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityRegistrationController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Group route yang butuh auth — lebih rapi bila digabung
Route::middleware('auth')->group(function () {
    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // events
    Route::get('/events/{id}', [EventController::class, 'eventDetail'])->name('events.show');

    // activities
    // 1) index menerima query string untuk filter/sort/search (contoh: /activities?filter=seni&sort=latest&q=kata)
    Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');

    // 2) detail (pakai route model binding lebih aman) — pastikan controller show(Activity $activity)
    Route::get('/activities/{activity}', [ActivityController::class, 'show'])->name('activities.show');

    // Organizations (index + show)
    Route::get('/organizations', [\App\Http\Controllers\OrganizationController::class, 'index'])->name('organizations.index');
    Route::get('/organizations/{company}', [\App\Http\Controllers\OrganizationController::class, 'show'])->name('organizations.show');

    // Donations page (list / info)
    Route::get('/donations', [\App\Http\Controllers\DonationController::class, 'index'])->name('donations.index');

    // About page (static)
    Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index'])->name('about');

    Route::post(
        '/activities/{activity}/register',
        [ActivityRegistrationController::class, 'store']
    )->name('activities.register');


});

require __DIR__.'/auth.php';
