<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckLocale;
use App\Http\Middleware\TeacherMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')->group(base_path('routes/admin.php'));
        }

    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->append([
            'CheckLocale' => CheckLocale::class,
        ]);
        
        $middleware->alias([
            'CheckLocale' => CheckLocale::class,
            'admin' => AdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
