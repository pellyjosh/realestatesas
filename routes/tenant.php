<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\EventController;
// use App\Http\Controllers\Admin\AdminController;
// use App\Http\Controllers\Admin\PropertyController;
// use App\Http\Controllers\Admin\UserController;
// use App\Http\Controllers\Admin\AdminRealtorController;
// use App\Http\Controllers\Admin\MapController;
// use App\Http\Controllers\Admin\TypesController;
// use App\Http\Controllers\Admin\ReportController;
// use App\Http\Controllers\Admin\PaymentController;
// use App\Http\Controllers\Admin\AdminEventController;
// use App\Http\Controllers\Admin\AdminInvoice;
// use App\Http\Controllers\Admin\AdminWithdrawalController;
// use App\Http\Controllers\Admin\AuthenticationController;
// use App\Http\Controllers\Admin\AdminTransactionsController;

// Realtor Import
use App\Http\Controllers\Realtor\RealtorAuthenticationController;
use App\Http\Controllers\Realtor\RealtorPropertyController;
use App\Http\Controllers\Realtor\RealtorUserController;
use App\Http\Controllers\Realtor\RealtorMapController;
use App\Http\Controllers\Realtor\RealtorTypesController;
use App\Http\Controllers\Realtor\RealtorReportController;
use App\Http\Controllers\Realtor\RealtorController;
use App\Http\Controllers\Realtor\RealtorAgentController;
use App\Http\Controllers\Realtor\RealtorPaymentController;
use App\Http\Controllers\Realtor\LandingPageController;
use App\Http\Controllers\Realtor\ReferralController;
use App\Http\Controllers\Realtor\EarningsController;
use App\Http\Controllers\Realtor\SalesRequestController;
use App\Http\Controllers\Realtor\RealtorEventController;


// User Import 
use App\Http\Controllers\User\UserFavoritesController;
use App\Http\Controllers\User\UserPaymentsController;
use App\Http\Controllers\User\UserPrivacyController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserPropertiesController;
use App\Http\Controllers\User\UserPropertyDetailsController;

// Tenant Import
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;


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

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return tenant_view('client.pages.index');
    })->name('tenant.client.home');

    Route::get('/realtor-profile', function () {
        return tenant_view('client.pages.realtor-profile');
    })->name('client.realtor-profile');

    Route::get('/compare', function () {
        return tenant_view('client.pages.compare');
    })->name('client.compare');

    Route::get('/property-details', function () {
        return tenant_view('client.pages.property-details');
    })->name('client.property-details');

    Route::controller(EventController::class)->group(function () {
        Route::get('/events', 'index')->name('tenant.client.events');
        Route::post('/book-event', 'bookEvent');
        Route::post('/retrieve-referral', 'retrieveReferral');
    });

    Route::get("/contact", function () {
        return tenant_view('client.pages.contact');
    })->name('tenant.client.contact');

    // user routes
    Route::middleware('auth:tenant')->group(function () {

        Route::controller(DashboardController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('tenant.user.dashboard');
        });

        Route::get('/user-favorites', function () {
            return tenant_view('user.pages.user-favorites');
        })->name('tenant.user.favorites');

        Route::get('/user-payment', function () {
            return tenant_view('user.pages.user-payment');
        })->name('user.payment');

        Route::get('/user-privacy', function () {
            return tenant_view('user.pages.user-privacy');
        })->name('user.privacy');

        Route::get('/user-profile', function () {
            return tenant_view('user.pages.user-profile');
        })->name('user.profile');

        Route::get('/user-properties', function () {
            return tenant_view('user.pages.user-properties');
        })->name('user.properties');

        Route::get('/user-property-details', function () {
            return tenant_view('user.pages.user-property-details');
        })->name('user.property-details');
    });

    // Realtor Routes
    Route::prefix('realtor')->group(function () {
        Route::controller(RealtorAuthenticationController::class)->group(function () {
            Route::get('/login', 'showLoginForm')->name('realtor.login');
            Route::get('/signup', 'showSignupForm')->name('realtor.signup');
            Route::get('/404', 'notfound')->name('realtor.not-found');
        });

        Route::controller(RealtorController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('realtor.dashboard');

            Route::get('/', function () {
                return redirect()->route('realtor.dashboard');
            });
        });

        Route::controller(RealtorPropertyController::class)->group(function () {
            Route::get('/my-properties/add-property', 'addPropertyIndex')->name('realtor.add-property');
            Route::get('/my-properties/edit-property', 'editPropertyIndex')->name('realtor.edit-property');
            Route::get('/my-properties/listing', 'listingIndex')->name('realtor.listing');
            Route::get('/my-properties/favourites', 'favouritesIndex')->name('realtor.favourites');
        });

        Route::controller(RealtorUserController::class)->group(function () {
            Route::get('/manage-users/user-profile', 'index')->name('realtor-user-profile');
            Route::get('/manage-users/add-user', 'addUserIndex')->name('realtor-add-user');
            Route::get('/manage-users/add-user-wizard', 'addUserWizardIndex')->name('realtor-add-user-wizard');
            Route::get('/manage-users/edit-user', 'editUserIndex')->name('realtor-edit-user');
            Route::get('/manage-users/all-users', 'allUsersIndex')->name('realtor-all-users');
        });

        Route::controller(RealtorAgentController::class)->group(function () {
            Route::get('/agent-profile', 'agentProfileIndex')->name('realtor-agent-profile');
            Route::get('/add-agent', 'addAgentIndex')->name('realtor-add-agent');
            Route::get('/add-agent-wizard', 'addAgentWizardIndex')->name('realtor-add-agent-wizard');
            Route::get('/edit-agent', 'editAgentIndex')->name('realtor-edit-agent');
            Route::get('/all-agents', 'allAgentsIndex')->name('realtor-all-agents');
            Route::get('/agent-invoice', 'agentInvoiceIndex')->name('realtor-agent-invoice');
        });

        Route::controller(RealtorMapController::class)->group(function () {
            Route::get('/map', 'index')->name('realtor.map');
        });

        Route::controller(RealtorTypesController::class)->group(function () {
            Route::get('/family-house', 'houseIndex')->name('realtor.family-house');
        });

        Route::controller(RealtorReportController::class)->group(function () {
            Route::get('/reports', 'index')->name('realtor.reports');
        });

        Route::controller(RealtorPaymentController::class)->group(function () {
            Route::get('/payments', 'index')->name('realtor.payments');
        });

        Route::get('/profile', function () {
            return tenant_view('realtor.pages.profile');
        })->name('realtor.profile');

        Route::controller(LandingPageController::class)->group(function () {
            Route::get('/landing-page-list', 'index')->name('realtor.landing-page-list');
            Route::get('/landing-page', 'show')->name('realtor.landing-page');
        });

        Route::controller(ReferralController::class)->group(function () {
            Route::get('/referral', 'index')->name('realtor.referrals');
        });

        Route::controller(EarningsController::class)->group(function () {
            Route::get('/earnings', 'index')->name('realtor.earnings');
        });

        Route::controller(SalesRequestController::class)->group(function () {
            Route::get('/sales-request', 'index')->name('realtor.sales-request');
        });

        Route::controller(RealtorEventController::class)->group(function () {
            Route::get('/events', 'index')->name('realtor.events');
        });
    });

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
