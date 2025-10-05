<?php

use App\Http\Middleware\Hoosh\ApiAuthMiddleware;
use App\Http\Middleware\Hoosh\IsAdminMiddleware;
use App\Http\Middleware\Hoosh\IsLoginMiddleware;
use App\Http\Middleware\MainAuthMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        api: __DIR__ . '/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'is.login' => IsLoginMiddleware::class,
            'is.admin' => IsAdminMiddleware::class,
            'hoosh.api.auth' => ApiAuthMiddleware::class,
            'main.auth' => MainAuthMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
