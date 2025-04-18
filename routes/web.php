<?php

use App\Models\Customer;
use App\Http\Controllers\AdminAuth;
use App\Http\Controllers\SellerAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAuth;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\CustomerDashboardController;

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

        Route::post('/dashboard/seller-verification/{seller}', [AdminDashboardController::class, 'verifySeller'])->name('dashboard.seller-verification.post');;
        Route::get('/dashboard/seller-verification', [AdminDashboardController::class, 'sellerVerification'])->name('dashboard.seller-verification');
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

    Route::middleware(['auth.custom:customer', 'customer.verified'])->group(function () {
        Route::get('/dashboard', [CustomerDashboardController::class, 'dashboard'])->name('dashboard');
    });
});

# Customer Email Verification
Route::get('/verify/customer/email', [CustomerAuth\EmailVerificationController::class, 'verify'])->name('customer.verify.email');

Route::get('/customer/verify-email/notice', [CustomerAuth\EmailVerificationController::class, 'notice'])
    ->middleware(['auth.custom:customer', 'customer.unverified'])
    ->name('customer.verify.notice');

Route::post('/customer/email/verification/resend', [CustomerAuth\EmailVerificationController::class, 'resend'])
    ->middleware(['auth.custom:customer', 'customer.unverified'])
    ->name('customer.verification.resend');


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
