<?php

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
    // API: HANYA CORS — TIDAK ADA SESSION, TIDAK ADA CSRF
    $middleware->api([
        \Illuminate\Http\Middleware\HandleCors::class,
    ]);

    // WEB: Semua middleware web + CSRF
    $middleware->web([
        \Illuminate\Cookie\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ]);

    $middleware->alias([
        'admin' => \App\Http\Middleware\CheckAdmin::class ?? null,
    ]);
})
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();