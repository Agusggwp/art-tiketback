<?php

use Illuminate\Support\Facades\Route;

// =============================================
// API Routes (GET Only)
// =============================================
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\TestimonialController;


Route::prefix('api')->name('api.')->group(function () {
    Route::get('/settings',     [SettingController::class,      'index'])->name('settings');
    Route::get('/packages',     [PackageController::class,      'index'])->name('packages');
    Route::get('/events',       [EventController::class,        'index'])->name('events');
    Route::get('/gallery',      [GalleryController::class,      'index'])->name('gallery');
    Route::get('/testimonials', [TestimonialController::class,  'index'])->name('testimonials');
    
});

// routes/api.php



// =============================================
// Admin Routes
// =============================================
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingAdminController;
use App\Http\Controllers\Admin\PackageAdminController;
use App\Http\Controllers\Admin\EventAdminController;
use App\Http\Controllers\Admin\GalleryAdminController;
use App\Http\Controllers\Admin\TestimonialAdminController;
use App\Http\Controllers\Admin\OrderAdminController;



// Otomatis redirect root (/) ke halaman login admin
Route::get('/', function () {
    return redirect()->route('admin.login');
    // atau return redirect('/admin/login');
})->name('home');


Route::prefix('admin')->name('admin.')->group(function () {

    // Guest (belum login)
    Route::middleware('guest')->group(function () {
        Route::get('/login',    [AuthController::class, 'loginForm'])->name('login');
        Route::post('/login',   [AuthController::class, 'login']);
        Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
        Route::post('/register',[AuthController::class, 'register']);
    });

    // Authenticated User
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // SETTINGS
        Route::get('/settings', [SettingAdminController::class, 'index'])
             ->name('settings.index');
        Route::put('/settings', [SettingAdminController::class, 'update'])
             ->name('settings.update');

        // PACKAGES
        Route::get('/packages', [PackageAdminController::class, 'index'])->name('packages.index');
        Route::get('/packages/create', [PackageAdminController::class, 'create'])->name('packages.create');
        Route::post('/packages/store', [PackageAdminController::class, 'store'])->name('packages.store');
        Route::get('/packages/edit/{id}', [PackageAdminController::class, 'edit'])->name('packages.edit');
        Route::patch('/packages/update/{id}', [PackageAdminController::class, 'update'])->name('packages.update');
        Route::delete('/packages/delete/{id}', [PackageAdminController::class, 'destroy'])->name('packages.destroy');

        // EVENTS
        Route::get('/events', [EventAdminController::class, 'index'])->name('events.index');
        Route::get('/events/create', [EventAdminController::class, 'create'])->name('events.create');
        Route::post('/events/store', [EventAdminController::class, 'store'])->name('events.store');
        Route::get('/events/edit/{id}', [EventAdminController::class, 'edit'])->name('events.edit');
        Route::patch('/events/update/{id}', [EventAdminController::class, 'update'])->name('events.update');
        Route::delete('/events/delete/{id}', [EventAdminController::class, 'destroy'])->name('events.destroy');

        // GALLERY
        Route::get('/gallery', [GalleryAdminController::class, 'index'])->name('gallery.index');
        Route::get('/gallery/create', [GalleryAdminController::class, 'create'])->name('gallery.create');
        Route::post('/gallery/store', [GalleryAdminController::class, 'store'])->name('gallery.store');
        Route::delete('/gallery/delete/{id}', [GalleryAdminController::class, 'destroy'])->name('gallery.destroy');

        // TESTIMONIALS
        Route::get('/testimonials', [TestimonialAdminController::class, 'index'])->name('testimonials.index');
        Route::get('/testimonials/create', [TestimonialAdminController::class, 'create'])->name('testimonials.create');
        Route::post('/testimonials/store', [TestimonialAdminController::class, 'store'])->name('testimonials.store');
        Route::delete('/testimonials/delete/{id}', [TestimonialAdminController::class, 'destroy'])->name('testimonials.destroy');


        Route::resource('orders', OrderAdminController::class)->except(['create', 'store', 'edit', 'update']);

      
        
    });

      
});
Route::patch('/orders/{order}/status', [OrderAdminController::class, 'updateStatus'])
        ->name('admin.orders.updateStatus');
