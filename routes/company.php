<?php

use App\Http\Controllers\CompanyAuthController;
use App\Http\Controllers\CompanyDashboardController;
use App\Http\Controllers\CompanyEventController;
use Illuminate\Support\Facades\Route;

// <-- tambahkan middleware('web')
Route::middleware('web')->group(function () {

    Route::get('/login', [CompanyAuthController::class, 'showLoginForm'])
        ->name('company.login');

    Route::post('/login', [CompanyAuthController::class, 'login']);

   Route::middleware('auth:company')->group(function () {
    Route::get('/dashboard', [CompanyDashboardController::class, 'index'])
        ->name('company.dashboard');
    //CREATE EVENT
    Route::get('/events/create', [CompanyEventController::class, 'create'])
        ->name('company.events.create');

    Route::post('/events/store', [CompanyEventController::class, 'store'])
        ->name('company.events.store');
    //DELETE EVENT
    Route::delete('/events/{id}', [CompanyEventController::class, 'destroy'])
    ->name('company.events.delete');

    //EDIT EVENT
    Route::get('/events/{id}/edit', [CompanyEventController::class, 'edit'])
    ->name('company.events.edit');

    Route::put('/events/{id}', [CompanyEventController::class, 'update'])
    ->name('company.events.update');
    }); 
});
