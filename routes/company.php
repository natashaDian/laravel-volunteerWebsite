<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyAuthController;
use App\Http\Controllers\CompanyDashboardController;
use App\Http\Controllers\CompanyEventController;
use App\Http\Controllers\CompanyActivityController;

Route::middleware('web')->group(function () {

    Route::get('/login', [CompanyAuthController::class, 'showLoginForm'])
        ->name('company.login');

    Route::post('/login', [CompanyAuthController::class, 'login']);

    Route::middleware('auth:company')->group(function () {

        // Dashboard
        Route::get('/dashboard', [CompanyDashboardController::class, 'index'])
            ->name('company.dashboard');

        Route::get('/events/create', [CompanyEventController::class, 'create'])
            ->name('company.events.create');

        Route::post('/events/store', [CompanyEventController::class, 'store'])
            ->name('company.events.store');

        Route::get('/activities/{id}/edit', [CompanyActivityController::class, 'edit'])
        ->name('company.activities.edit');

        Route::put('/activities/{id}', [CompanyActivityController::class, 'update'])
            ->name('company.activities.update');

        Route::delete('/activities/{id}', [CompanyActivityController::class, 'destroy'])
            ->name('company.activities.destroy');

    });
});
