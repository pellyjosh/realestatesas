<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\AdminController;
use \App\Http\Controllers\SuperAdmin\BillingController;


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
    Route::get('/superadmin-dashboard', 'dashboard')->name('superadmin.dashboard');
    Route::get('/superadmin-domains', 'domains')->name('superadmin.domains');
    Route::get('/superadmin-templates', 'templates')->name('superadmin.templates');
    Route::get('/superadmin-subscription', 'subscription')->name('superadmin.subscriptions');
    Route::get('/superadmin-admins', 'admins')->name('superadmin.admins');
    Route::get('/superadmin-inbox', 'inbox')->name('superadmin.inbox');
    Route::get('/superadmin-mail', 'mail')->name('superadmin.mail');
    Route::get('/superadmin-compose-mail', 'composeMail')->name('superadmin.compose.mail');
    Route::get('/superadmin-events', 'events')->name('superadmin.events');
    Route::get('/superadmin-contact', 'contact')->name('superadmin.contact');
    Route::get('/superadmin-profile', 'profile')->name('superadmin.profile');
    Route::get('/superadmin-domain-view', 'domainView')->name('superadmin.domain.view');
});


require __DIR__ . '/auth.php';
