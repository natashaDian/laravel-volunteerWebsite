<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::prefix('company')->group(function () {
                require base_path('routes/company.php');
            });
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // 🔥 OVERRIDE AUTH REDIRECT (INI KUNCINYA)
        $middleware->redirectGuestsTo(function ($request) {

            if ($request->is('company/*')) {
                return route('company.login');
            }

            return route('login');
        });

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
