<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(
            [
                'admin' => \App\Http\Middleware\AdminPermission::class,
                'manager' => \App\Http\Middleware\ManagerPermission::class,
                'promoter' => \App\Http\Middleware\PromoterPermission::class,
                'customer' => \App\Http\Middleware\CustomerPermission::class,
                'staff' => \App\Http\Middleware\StaffPermission::class,
            ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
