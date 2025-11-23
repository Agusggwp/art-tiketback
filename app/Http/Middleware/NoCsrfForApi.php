<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class NoCsrfForApi extends Middleware
{
    protected $except = [
        'api/*',        // SEMUA API BEBAS CSRF
        'orders/*',
        'webhook/*',
    ];

    public function handle($request, Closure $next)
    {
        // Jika request ke API, langsung lewatin CSRF check
        if ($request->is('api/*')) {
            return $next($request);
        }

        return parent::handle($request, $next);
    }
}