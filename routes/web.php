<?php

use App\Http\Controllers\AdminAuth;
use App\Http\Controllers\CustomerAuth;
use App\Http\Controllers\SellerAuth;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\SellerDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('customer.login'));
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest.custom')->group(function () {
        Route::get('/login', [AdminAuth\LoginController::class, 'show'])->name('login');
        Route::post('/login', [AdminAuth\LoginController::class, 'login']);
    });
    Route::post('/logout', [AdminAuth\LoginController::class, 'logout'])->name('logout');

    Route::middleware('auth.custom:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/dashboard/overview', [AdminDashboardController::class, 'overview'])->name('dashboard.overview');
        Route::get('/dashboard/seller-verification', [AdminDashboardController::class, 'sellerVerification'])->name('dashboard.seller-verification');
        Route::post('/dashboard/seller-verification/{seller}', [AdminDashboardController::class, 'verifySeller'])->name('dashboard.seller-verification');;
    });
});

Route::prefix('customer')->name('customer.')->group(function () {
    Route::middleware('guest.custom')->group(function () {
        Route::get('/login', [CustomerAuth\LoginController::class, 'show'])->name('login');
        Route::post('/login', [CustomerAuth\LoginController::class, 'login']);

        Route::get('/register', [CustomerAuth\RegisterController::class, 'show'])->name('register');
        Route::post('/register', [CustomerAuth\RegisterController::class, 'register']);
    });
    Route::post('/logout', [CustomerAuth\LoginController::class, 'logout'])->name('logout');

    Route::middleware('auth.custom:customer')->group(function () {
        Route::get('/dashboard', [CustomerDashboardController::class, 'dashboard'])->name('dashboard');
    });
});

Route::prefix('seller')->name('seller.')->group(function () {
    Route::middleware('guest.custom')->group(function () {
        Route::get('/login', [SellerAuth\LoginController::class, 'show'])->name('login');
        Route::post('/login', [SellerAuth\LoginController::class, 'login']);

        Route::get('/register', [SellerAuth\RegisterController::class, 'show'])->name('register');
        Route::post('/register', [SellerAuth\RegisterController::class, 'register']);
    });
    Route::post('/logout', [SellerAuth\LoginController::class, 'logout'])->name('logout');

    Route::middleware('auth.custom:seller')->group(function () {
        Route::get('/dashboard', [SellerDashboardController::class, 'dashboard'])->name('dashboard');
    });
});
