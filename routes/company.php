<?php

use App\Http\Controllers\CompanyAuthController;
use Illuminate\Support\Facades\Route;

// <-- tambahkan middleware('web')
Route::middleware('web')->group(function () {

    Route::get('/login', [CompanyAuthController::class, 'showLoginForm'])
        ->name('company.login');

    Route::post('/login', [CompanyAuthController::class, 'login']);

    Route::middleware('auth:company')->group(function () {
        Route::get('/dashboard', function () {
            return view('company.dashboard');
        })->name('company.dashboard');
    });
});
