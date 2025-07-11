<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\AdminController;
use \App\Http\Controllers\SuperAdmin\BillingController;


Route::get('/', [AdminController::class, 'onboarding'])->name('superadmin.onboarding');


require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/superadmin/tenants', [AdminController::class, 'storeTenant'])->name('superadmin.tenants.store');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/billings', [\App\Http\Controllers\BillingController::class, 'index'])->name('billings.index');
    Route::post('/billings/subscribe', [\App\Http\Controllers\BillingController::class, 'subscribe'])->name('billings.subscribe');
    Route::post('/billings/cancel', [\App\Http\Controllers\BillingController::class, 'cancel'])->name('billings.cancel');
});
