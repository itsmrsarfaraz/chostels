<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));

            Route::middleware('web')
                ->prefix('owner')
                ->name('owner.')
                ->group(base_path('routes/owner.php'));

            Route::middleware('web')
                ->prefix('warden')
                ->name('warden.')
                ->group(base_path('routes/warden.php'));

            Route::middleware('web')
                ->prefix('seeker')
                ->name('seeker.')
                ->group(base_path('routes/seeker.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\EnsureUserHasRole::class,
            'profile.complete' => \App\Http\Middleware\EnsureProfileCompleted::class,
            'password.set' => \App\Http\Middleware\EnsurePasswordIsSet::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // 
    })->create();
