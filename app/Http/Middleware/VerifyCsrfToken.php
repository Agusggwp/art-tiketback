<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        'api/*',           // INI YANG BIKIN CSRF HILANG TOTAL DARI API!
        'sanctum/csrf-cookie',
    ];
}