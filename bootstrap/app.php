<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin.auth' => \App\Http\Middleware\AdminAuthMiddleware::class,
            'member' => \App\Http\Middleware\MemberOnly::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

if (isset($_SERVER['DOCUMENT_ROOT'])) {
    $docRoot = rtrim($_SERVER['DOCUMENT_ROOT'], '/\\');
    if (is_dir($docRoot) && file_exists($docRoot . '/index.php')) {
        $app->usePublicPath($docRoot);
    }
}

return $app;
