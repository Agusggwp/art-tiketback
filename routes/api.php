<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;

// INI SOLUSI TERAKHIR YANG TIDAK BISA GAGAL!
Route::post('/orders', [OrderController::class, 'store'])
    ->withoutMiddleware('csrf')
    ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class);