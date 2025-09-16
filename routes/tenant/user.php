<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tenant\Client\DashboardController;

/*
|--------------------------------------------------------------------------
| Tenant - User Routes
|--------------------------------------------------------------------------
| Moved from routes/tenant.php to keep tenant routes organized by area.
*/

Route::middleware('auth:tenant')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('tenant.user.dashboard');
    });

    Route::get('/user-favorites', function () {
        return tenant_view('client.pages.dashboard.user-favorites');
    })->name('tenant.user.favorites');

    Route::get('/user-payment', function () {
        return tenant_view('client.pages.dashboard.user-payment');
    })->name('tenant.user.payment');

    Route::get('/user-privacy', function () {
        return tenant_view('client.pages.dashboard.user-privacy');
    })->name('tenant.user.privacy');

    Route::get('/user-profile', function () {
        return tenant_view('client.pages.dashboard.user-profile');
    })->name('tenant.user.profile');

    Route::get('/user-properties', function () {
        return tenant_view('client.pages.dashboard.user-properties');
    })->name('tenant.user.properties');

    Route::get('/user-property-details', function () {
        return tenant_view('client.pages.dashboard.user-property-details');
    })->name('tenant.user.property-details');
});
