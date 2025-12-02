<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AuthOwner;
// Override PHP limits for file uploads
if (function_exists('ini_set')) {
    ini_set('upload_max_filesize', '100M');
    ini_set('post_max_size', '100M');
    ini_set('max_execution_time', '300');
    ini_set('memory_limit', '256M');
}

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'AuthOwner' => AuthOwner::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
