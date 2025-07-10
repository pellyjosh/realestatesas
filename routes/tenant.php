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

// Realtor routes
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


// User Routes 
use App\Http\Controllers\User\NormalUserController;
use App\Http\Controllers\User\UserFavoritesController;
use App\Http\Controllers\User\UserPaymentsController;
use App\Http\Controllers\User\UserPrivacyController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserPropertiesController;
use App\Http\Controllers\User\UserPropertyDetailsController;



/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
*/

// Route::group(
//     [
//         'middleware' => [
//             'web',
//             'tenancy.domain',
//             'tenancy.prevent-central',
//         ],
//     ],
//     function () {
        Route::get('/tenant', function () {
            return view('client.pages.index');
        })->name('client.home');

        Route::get('/realtor-profile', function () {
            return view('client.pages.realtor-profile');
        })->name('client.realtor-profile');

        Route::get('/realtor-profile', function () {
            return view('client.pages.realtor-profile');
        })->name('client.realtor-profile');

        Route::get('/compare', function () {
            return view('client.pages.compare');
        })->name('client.compare');

        Route::get('/property-details', function () {
            return view('client.pages.property-details');
        })->name('client.property-details');

        Route::controller(EventController::class)->group(function () {
            Route::get('/events', 'index')->name('client.events');
            Route::post('/book-event', 'bookEvent');
            Route::post('/retrieve-referral', 'retrieveReferral');
        });

        Route::get("/contact", function () {
            return view('client.pages.contact');
        })->name('client.contact');

        // user routes
        Route::prefix('user')->group(function () {
            Route::controller(NormalUserController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('user.dashboard');
            });

            Route::controller(UserFavoritesController::class)->group(function () {
                Route::get('/user-favorites', 'index')->name('user.favorites');
            });

            Route::controller(UserPaymentsController::class)->group(function () {
                Route::get('/user-payment', 'index')->name('user.payment');
            });

            Route::controller(UserPrivacyController::class)->group(function () {
                Route::get('/user-privacy', 'index')->name('user.privacy');
            });

            Route::controller(UserProfileController::class)->group(function () {
                Route::get('/user-profile', 'index')->name('user.profile');
            });

            Route::controller(UserPropertiesController::class)->group(function () {
                Route::get('/user-properties', 'index')->name('user.properties');
            });

            Route::controller(UserPropertyDetailsController::class)->group(function () {
                Route::get('/user-property-details', 'index')->name('user.property-details');
            });
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
                return view('realtor.pages.profile');
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
//     }
// );
