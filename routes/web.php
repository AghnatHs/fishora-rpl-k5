<?php

use App\Models\Customer;
use App\Http\Controllers\AdminAuth;
use App\Http\Controllers\SellerAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAuth;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductWarningController;

Route::get('/', function () {
    return redirect(route('homepage.index'));
});

#Route untuk halaman pick-login
Route::get('/pick-login', function () {
    return view('splash-screen.pick-login');
})
    ->middleware('guest.custom')
    ->name('pick-login');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest.custom')->group(function () {
        Route::get('/login', [AdminAuth\LoginController::class, 'show'])->name('login');
        Route::post('/login', [AdminAuth\LoginController::class, 'login']); {
        }
    });
    Route::post('/logout', [AdminAuth\LoginController::class, 'logout'])->name('logout');

    Route::middleware('auth.custom:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/dashboard/overview', [AdminDashboardController::class, 'overview'])->name('dashboard.overview');

        Route::post('/dashboard/seller-verification/{seller}', [AdminDashboardController::class, 'verifySeller'])->name('dashboard.seller-verification.post');;
        Route::get('/dashboard/seller-verification', [AdminDashboardController::class, 'sellerVerification'])->name('dashboard.seller-verification');

        Route::get('/dashboard/products-monitoring', [AdminDashboardController::class, 'monitoringView'])->name('dashboard.products-monitoring');
        Route::get('/dashboard/products-monitoring/{product}', [ProductWarningController::class, 'create'])->name('dashboard.products-monitoring.create');
        Route::post('/dashboard/products-monitoring/{product}', [ProductWarningController::class, 'store']);
        Route::delete('/dashboard/products-monitoring/{product}', [ProductWarningController::class, 'destroy'])->name('dashboard.products-monitoring.delete-product');
        Route::put('/dashboard/products-monitoring/{productWarning}', [ProductWarningController::class, 'update'])->name('dashboard.products-monitoring.update');
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
        Route::get('/cart', [OrderController::class, 'indexOnlyCart'])->name('cart');
        Route::post('/cart/{product}', [OrderController::class, 'storeOrUpdate'])->name('add-to-cart');
        Route::delete('/cart/{order}/{product}', [OrderController::class, 'destroyProduct'])->name('remove-from-cart');

        Route::get('/inbox', [CustomerDashboardController::class, 'inbox'])->name('inbox');
        Route::patch('/notification/{id}/read', [CustomerDashboardController::class, 'markAsReadNotification'])
            ->name('notification.read');
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
# END------ Customer Email Verification

# Homepage
Route::prefix('homepage')->name('homepage.')->group(function () {
    Route::get('/', [HomepageController::class, 'index'])->name('index');
    Route::get('/product/{product}', [HomepageController::class, 'showProduct'])->name('show-product');
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

        Route::get('/inbox', [SellerDashboardController::class, 'inbox'])->name('inbox');

        Route::resource('products', ProductController::class);

        Route::patch('/notification/{id}/read', [SellerDashboardController::class, 'markAsReadNotification'])->name('notification.read');
    });
});

# Customer Reset Password
Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('forgot-password', [CustomerAuth\PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [CustomerAuth\PasswordResetController::class, 'sendResetLinkEmail'])->name('password.send-email');
    Route::get('reset-password/{token}', [CustomerAuth\PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [CustomerAuth\PasswordResetController::class, 'reset'])->name('password.update');
});

# END------ Customer Reset Password

# Seller Reset Password
Route::prefix('seller')->name('seller.')->group(function () {
    Route::get('forgot-password', [SellerAuth\PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [SellerAuth\PasswordResetController::class, 'sendResetLinkEmail'])->name('password.send-email');
    Route::get('reset-password/{token}', [SellerAuth\PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [SellerAuth\PasswordResetController::class, 'reset'])->name('password.update');
});

# END------ Customer Reset Password