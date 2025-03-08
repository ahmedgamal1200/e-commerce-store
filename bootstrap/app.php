<?php

use App\Http\Middleware\CheckUserType;
use App\Http\Middleware\UpdateUserLastActiveAt;
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
        $middleware->alias([
            'auth.type' => CheckUserType::class,
//            'last_active' => UpdateUserLastActiveAt::class,
        ]);
//        $middleware->prepend(UpdateUserLastActiveAt::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

class_alias(App\Helpers\Currency::class, 'Currency');
