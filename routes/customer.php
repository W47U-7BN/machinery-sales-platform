<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\AuthController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\QuotationController;
use App\Http\Controllers\Customer\InvoiceController;
use App\Http\Controllers\Customer\ServiceTicketController;
use App\Http\Controllers\Customer\DownloadController;
use App\Http\Controllers\Customer\ChatController;

Route::prefix('customer')->name('customer.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
        Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [AuthController::class, 'register']);
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
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::get('/quotations', [QuotationController::class, 'index'])->name('quotations.index');
        Route::get('/quotations/{quotation}', [QuotationController::class, 'show'])->name('quotations.show');
        Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
        Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
        Route::get('/invoices/{invoice}/download', [InvoiceController::class, 'download'])->name('invoices.download');
        Route::resource('/service-tickets', ServiceTicketController::class)->only(['index', 'show', 'create', 'store']);
        Route::get('/downloads', [DownloadController::class, 'index'])->name('downloads.index');
        Route::get('/downloads/{id}', [DownloadController::class, 'download'])->name('downloads.download');
        Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
        Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
        Route::get('/chat/messages', [ChatController::class, 'messages'])->name('chat.messages');
    });
});
