
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tenant\Client\EventController;
use App\Http\Controllers\Tenant\Client\PropertyInspectionController;

// Realtor Import
use App\Http\Controllers\Tenant\Realtor\LandingPageController;
use App\Http\Controllers\Tenant\Realtor\EventController as RealtorEventController;

// Tenant Import
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;

// client import
use App\Http\Controllers\Tenant\Client\ClientSectionController;

// Admin Import
use App\Http\Controllers\Tenant\Admin\AdminEventController;
use App\Http\Controllers\Tenant\Admin\PropertyController;
use App\Http\Controllers\Tenant\Admin\RealtorController;
use App\Http\Controllers\Tenant\Admin\SectionController;
use App\Http\Controllers\Tenant\Admin\TestimonialController;

// Auth imports
use App\Http\Controllers\Tenant\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Tenant\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Tenant\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Tenant\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Tenant\Auth\NewPasswordController;
use App\Http\Controllers\Tenant\Auth\PasswordController;
use App\Http\Controllers\Tenant\Auth\PasswordResetLinkController;
use App\Http\Controllers\Tenant\Auth\RegisteredUserController;
use App\Http\Controllers\Tenant\Auth\VerifyEmailController;
use App\Http\Controllers\Tenant\Client\DashboardController;
use App\Http\Controllers\Tenant\Realtor\ReferralsController;
use App\Http\Controllers\Tenant\Realtor\SalesController;
use App\Http\Controllers\Tenant\Realtor\WalletController;
use App\Http\Controllers\Tenant\Realtor\ProfileController as RealtorProfileController;
use App\Http\Controllers\Tenant\Realtor\ReportController as RealtorReportController;
use Stancl\Tenancy\Middleware\ScopeSessions;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
*/

use Illuminate\Support\Facades\DB;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
    ScopeSessions::class,
])->group(function () {
    // DEBUG: Quick route to check realtor status values
    Route::get('/debug/realtor-status', function () {
        $realtors = DB::table('realtors')->select('id', 'user_id', 'status')->get();
        return response()->json($realtors);
    });

    Route::get('/', [ClientSectionController::class, 'index'])->name('tenant.client.home');

    Route::get('/compare', function () {
        return tenant_view('client.pages.compare');
    })->name('client.compare');

    Route::controller(EventController::class)->group(function () {
        Route::get('/events', 'index')->name('tenant.client.events');
        Route::post('/book-event', 'bookEvent');
        Route::post('/retrieve-referral', 'retrieveReferral');
    });

    // Property Inspection Routes
    Route::controller(PropertyInspectionController::class)->prefix('property-inspections')->group(function () {
        Route::post('/', 'store')->name('tenant.property-inspections.store');
        Route::get('/property', 'getPropertyDetails')->name('tenant.property-inspections.property-details');
        Route::get('/', 'index')->name('tenant.property-inspections.index');
        Route::patch('/{inspection}/status', 'updateStatus')->name('tenant.property-inspections.update-status');
    });

    Route::get("/contact", function () {
        return tenant_view('client.pages.contact');
    })->name('tenant.client.contact');

    require __DIR__ . '/tenant/user.php';

    require __DIR__ . '/tenant/realtor.php';

    require __DIR__ . '/tenant/management.php';

    // Auth Routes
    Route::middleware('guest')->group(function () {
        Route::get('register', [RegisteredUserController::class, 'create'])
            ->name('tenant.register');

        Route::post('register', [RegisteredUserController::class, 'store']);

        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('tenant.login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('tenant.password.request');

        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('tenant.password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('tenant.password.reset');

        Route::post('reset-password', [NewPasswordController::class, 'store'])
            ->name('tenant.password.store');
    });

    Route::middleware('auth:tenant')->group(function () {
        Route::get('verify-email', EmailVerificationPromptController::class)
            ->name('tenant.verification.notice');

        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('tenant.verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('tenant.verification.send');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
            ->name('tenant.password.confirm');

        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::put('password', [PasswordController::class, 'update'])->name('tenant.password.update');

        Route::match(['POST', 'GET'], 'logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('tenant.logout');
    });
});
