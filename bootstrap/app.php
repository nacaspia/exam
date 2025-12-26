<?php

use App\Http\Middleware\Auth;
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // Route middleware-lər üçün
        $middleware->alias([
            'auth' => \App\Http\Middleware\Auth::class,
            'userauth' => \App\Http\Middleware\UserAuth::class,
            'ensure.guard' => \App\Http\Middleware\EnsureCorrectGuard::class,
            'permission' => \App\Http\Middleware\CheckPermission::class,
            'check.ip' => \App\Http\Middleware\CheckIp::class,
            'set.locale' => \App\Http\Middleware\SetLocale::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
