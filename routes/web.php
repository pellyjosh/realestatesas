<?php

// Auth imports
use App\Http\Controllers\SuperAdmin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SuperAdmin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\SuperAdmin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\SuperAdmin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\SuperAdmin\Auth\NewPasswordController;
use App\Http\Controllers\SuperAdmin\Auth\PasswordController;
use App\Http\Controllers\SuperAdmin\Auth\PasswordResetLinkController;
use App\Http\Controllers\SuperAdmin\Auth\RegisteredUserController;
use App\Http\Controllers\SuperAdmin\Auth\VerifyEmailController;

// Admin imports
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\AdminController;
use \App\Http\Controllers\SuperAdmin\BillingController;


Route::get('/', function () {
    return view('superadmin.welcome');
})->name('superadmin.welcome');


// foreach (config('tenancy.central_domains', []) as $domain) {
Route::middleware(['web']) // or whatever middleware you want
    ->domain(config('tenancy.central_domains')[0])
    ->group(function () {
        Route::get('/billings', [\App\Http\Controllers\BillingController::class, 'index'])->name('billings.index');
        Route::get('/dashboard', [AdminController::class, 'onboarding'])->name('superadmin.dashboard');

        Route::middleware(['auth:web', 'verified'])->group(function () {
            Route::post('/billings/subscribe', [\App\Http\Controllers\BillingController::class, 'subscribe'])->name('billings.subscribe');
            Route::post('/billings/cancel', [\App\Http\Controllers\BillingController::class, 'cancel'])->name('billings.cancel');
        });

        // Auth routes
        Route::middleware('guest')->group(function () {
            Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
            Route::post('register', [RegisteredUserController::class, 'store']);
            Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
            Route::post('login', [AuthenticatedSessionController::class, 'store']);
            Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
            Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
            Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
            Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
        });

        Route::middleware('auth:web')->group(function () {
            Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
            Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
            Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
            Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
            Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
            Route::put('password', [PasswordController::class, 'update'])->name('password.update');
            Route::match(['POST', 'GET'], 'logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        });
    });
// }
Route::get('/', [AdminController::class, 'onboarding'])->name('superadmin.onboarding');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/superadmin/tenants', [AdminController::class, 'storeTenant'])->name('superadmin.tenants.store');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/billings', [\App\Http\Controllers\BillingController::class, 'index'])->name('billings.index');
    Route::post('/billings/subscribe', [\App\Http\Controllers\BillingController::class, 'subscribe'])->name('billings.subscribe');
    Route::post('/billings/cancel', [\App\Http\Controllers\BillingController::class, 'cancel'])->name('billings.cancel');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/landing-page', 'LandingPage')->name('superadmin.landing');
    Route::get('/superadmin-index', 'index')->name('superadmin.index');
    Route::get('/superadmin', function () {
        return redirect()->route('superadmin.index');
    });
});
