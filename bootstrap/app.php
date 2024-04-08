<?php

use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\MainAdminMiddleware;
use App\Http\Middleware\Tenant;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->statefulApi();
        $middleware->alias([
            'connect_tenant' => Tenant::class,
            'user_type' => MainAdminMiddleware::class,
            'permission' => CheckPermission::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
