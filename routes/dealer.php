<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dealer\AuthController;
use App\Http\Controllers\Dealer\DashboardController;
use App\Http\Controllers\Dealer\ProfileController;
use App\Http\Controllers\Dealer\ProductController;
use App\Http\Controllers\Dealer\OrderController;
use App\Http\Controllers\Dealer\CommissionController;
use App\Http\Controllers\Dealer\TargetController;
use App\Http\Controllers\Dealer\DownloadController;

Route::prefix('dealer')->name('dealer.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
        Route::get('/password/forgot', [AuthController::class, 'showForgotForm'])->name('password.forgot');
        Route::post('/password/forgot', [AuthController::class, 'sendResetLink']);
        Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
        Route::post('/password/reset', [AuthController::class, 'resetPassword']);
    });

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::get('/commissions', [CommissionController::class, 'index'])->name('commissions.index');
        Route::get('/commissions/{commission}', [CommissionController::class, 'show'])->name('commissions.show');
        Route::get('/targets', [TargetController::class, 'index'])->name('targets.index');
        Route::get('/downloads', [DownloadController::class, 'index'])->name('downloads.index');
        Route::get('/downloads/{id}', [DownloadController::class, 'download'])->name('downloads.download');
    });
});
