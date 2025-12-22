<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyAuthController;
use App\Http\Controllers\CompanyDashboardController;
use App\Http\Controllers\CompanyEventController;
use App\Http\Controllers\CompanyActivityController;
use App\Http\Controllers\CompanyProfileController;

Route::middleware('web')->prefix('company')->group(function () {

    Route::get('/login', [CompanyAuthController::class, 'showLoginForm'])
        ->name('company.login');

    Route::post('/login', [CompanyAuthController::class, 'login']);

    Route::middleware('auth:company')->group(function () {

        Route::get('/dashboard', [CompanyDashboardController::class, 'index'])
            ->name('company.dashboard');

        Route::get('/profile', [CompanyProfileController::class, 'edit'])
            ->name('company.profile.edit');

        Route::patch('/profile', [CompanyProfileController::class, 'update'])
            ->name('company.profile.update');

        Route::put('/profile/password', [CompanyProfileController::class, 'updatePassword'])
            ->name('company.profile.password.update');

        Route::delete('/profile', [CompanyProfileController::class, 'destroy'])
            ->name('company.profile.destroy');

        Route::get('/activities/create', [CompanyActivityController::class, 'create'])
            ->name('company.activities.create');

        // ===== LOGOUT COMPANY =====
        Route::post('/logout', function () {
            auth('company')->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            return redirect()->route('company.login');
        })->name('company.logout');
    });
});
