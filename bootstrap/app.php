<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SetLocale;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',

        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {

        // ✅ Apply language middleware to ALL web routes
        $middleware->web(append: [
            SetLocale::class,
        ]);

        // ✅ Your existing alias (UNCHANGED)
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminAuth::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
