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

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
    ScopeSessions::class,
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

    // Property Inspection Routes
    Route::controller(PropertyInspectionController::class)->prefix('property-inspections')->group(function () {
        Route::post('/', 'store')->name('tenant.property-inspections.store');
        Route::get('/property-details', 'getPropertyDetails')->name('tenant.property-inspections.property-details');
        Route::get('/', 'index')->name('tenant.property-inspections.index');
        Route::patch('/{inspection}/status', 'updateStatus')->name('tenant.property-inspections.update-status');
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

    // Realtor Routes
    Route::prefix('realtor')->group(function () {

        Route::middleware(['auth:tenant', 'user.type:realtor'])->group(function () {
            Route::get('/dashboard', function () {
                return tenant_view('realtor.pages.dashboard');
            })->name('tenant.realtor.dashboard');

            Route::get('/', function () {
                return redirect()->route('tenant.realtor.dashboard');
            });

            // My Properties
            Route::get('/my-properties/add-property', function () {
                return tenant_view('realtor.pages.my-properties.add-property');
            })->name('tenant.realtor.add-property');

            Route::get('/my-properties/edit-property', function () {
                return tenant_view('realtor.pages.my-properties.edit-property');
            })->name('tenant.realtor.edit-property');

            Route::get('/my-properties/listing', function () {
                return tenant_view('realtor.pages.my-properties.listing');
            })->name('tenant.realtor.listing');

            Route::get('/my-properties/favourites', function () {
                return tenant_view('realtor.pages.my-properties.favourites');
            })->name('tenant.realtor.favourites');

            // Manage Users
            Route::get('/manage-users/user-profile', function () {
                return tenant_view('realtor.pages.manage-users.user-profile');
            })->name('tenant.realtor-user-profile');

            Route::get('/manage-users/add-user', function () {
                return tenant_view('realtor.pages.manage-users.add-user');
            })->name('tenant.realtor-add-user');

            Route::get('/manage-users/add-user-wizard', function () {
                return tenant_view('realtor.pages.manage-users.add-user-wizard');
            })->name('tenant.realtor-add-user-wizard');

            Route::get('/manage-users/edit-user', function () {
                return tenant_view('realtor.pages.manage-users.edit-user');
            })->name('tenant.realtor-edit-user');

            Route::get('/manage-users/all-users', function () {
                return tenant_view('realtor.pages.manage-users.all-users');
            })->name('tenant.realtor-all-users');

            // Agents
            Route::get('/agent-profile', function () {
                return tenant_view('realtor.pages.agents.agent-profile');
            })->name('tenant.realtor-agent-profile');

            Route::get('/add-agent', function () {
                return tenant_view('realtor.pages.agents.add-agent');
            })->name('tenant.realtor-add-agent');

            Route::get('/add-agent-wizard', function () {
                return tenant_view('realtor.pages.agents.add-agent-wizard');
            })->name('tenant.realtor-add-agent-wizard');

            Route::get('/edit-agent', function () {
                return tenant_view('realtor.pages.agents.edit-agent');
            })->name('tenant.realtor-edit-agent');

            Route::get('/all-agents', function () {
                return tenant_view('realtor.pages.agents.all-agents');
            })->name('tenant.realtor-all-agents');

            Route::get('/agent-invoice', function () {
                return tenant_view('realtor.pages.agents.agent-invoice');
            })->name('tenant.realtor-agent-invoice');

            // Map
            Route::get('/map', function () {
                return tenant_view('realtor.pages.map');
            })->name('tenant.realtor.map');

            // Family House
            Route::get('/family-house', function () {
                return tenant_view('realtor.pages.types.family-house');
            })->name('tenant.realtor.family-house');

            // Reports
            Route::controller(RealtorReportController::class)->group(function () {
                Route::get('/reports', 'index')->name('tenant.realtor.reports');

                // API endpoints for reports data
                Route::get('/reports/api/sales-summary', 'getSalesSummary')->name('tenant.realtor.reports.api.sales-summary');
                Route::get('/reports/api/chart-data', 'getChartData')->name('tenant.realtor.reports.api.chart-data');
                Route::get('/reports/api/revenue-data', 'getRevenueData')->name('tenant.realtor.reports.api.revenue-data');
                Route::get('/reports/api/property-sales', 'getPropertySales')->name('tenant.realtor.reports.api.property-sales');
                Route::get('/reports/api/income-analysis', 'getIncomeAnalysis')->name('tenant.realtor.reports.api.income-analysis');
                Route::get('/reports/api/recent-transactions', 'getRecentTransactions')->name('tenant.realtor.reports.api.recent-transactions');
                Route::get('/reports/api/management-reports', 'getManagementReports')->name('tenant.realtor.reports.api.management-reports');

                // Report generation and download
                Route::post('/reports/generate', 'generateReport')->name('tenant.realtor.reports.generate');
                Route::get('/reports/download/{reportId}', 'downloadReport')->name('tenant.realtor.reports.download');
            });

            // Payments
            Route::get('/payments', function () {
                return tenant_view('realtor.pages.payments');
            })->name('tenant.realtor.payments');

            // Profile
            Route::controller(RealtorProfileController::class)->group(function () {
                Route::get('/profile', 'show')->name('tenant.realtor.profile');
                Route::get('/profile/data', 'profileData')->name('tenant.realtor.profile.data');
                Route::patch('/profile', 'update')->name('tenant.realtor.profile.update');
                Route::patch('/profile/password', 'updatePassword')->name('tenant.realtor.profile.password');
                Route::delete('/profile', 'destroy')->name('tenant.realtor.profile.destroy');
            });

            // Landing Page
            Route::controller(LandingPageController::class)->group(function () {
                Route::get('/landing-page-list', 'index')->name('tenant.realtor.landing-page-list');
                Route::get('/property/{propertySlug}', 'show')->name('tenant.realtor.landing-page');
                Route::post('/landing-pages/create', 'create')->name('landing-pages.create');
                Route::post('/landing-pages/activate/{id}', 'activate')->name('landing-pages.activate');
                Route::post('/landing-pages/deactivate/{id}', 'deactivate')->name('landing-pages.deactivate');
                Route::delete('/landing-pages/delete/{id}', 'delete')->name('landing-pages.delete');
            });


            // Referrals
            Route::controller(ReferralsController::class)->group(function () {
                Route::get('/referral', 'index')->name('tenant.realtor.referrals');
                Route::post('/referral/create', 'create')->name('tenant.realtor.referrals.create');
                Route::get('/referral/deactivate/{id}', 'index')->name('tenant.realtor.referrals.deactivate');
                Route::get('/referral/delete/{id}', 'index')->name('tenant.realtor.referrals.delete');
            });

            // Sales
            Route::controller(SalesController::class)->group(function () {
                Route::get('/sales', 'index')->name('tenant.realtor.sales');
                Route::post('/sales', 'store')->name('tenant.realtor.sales.store');
                Route::get('/sales/{id}', 'show')->name('tenant.realtor.sales.show');
                Route::patch('/sales/{id}/status', 'updateStatus')->name('tenant.realtor.sales.updateStatus');

                // Client search
                Route::get('/clients/search', 'searchClients')->name('tenant.realtor.clients.search');

                // Templates
                Route::get('/sales/templates', 'getTemplates')->name('tenant.realtor.sales.templates');
                Route::post('/sales/templates', 'saveTemplate')->name('tenant.realtor.sales.templates.store');
                Route::delete('/sales/templates/{id}', 'deleteTemplate')->name('tenant.realtor.sales.templates.delete');
            });

            // Wallet
            Route::controller(WalletController::class)->group(function () {
                Route::get('/wallet', 'index')->name('tenant.realtor.wallet');
                Route::post('/wallet/withdraw', 'withdraw')->name('tenant.realtor.wallet.withdraw');
                Route::get('/wallet/transactions', 'transactions')->name('tenant.realtor.wallet.transactions');
                Route::get('/wallet/stats', 'getWalletStats')->name('tenant.realtor.wallet.stats');
            });

            // Sales Request
            Route::get('/sales-request', function () {
                return tenant_view('realtor.pages.sales-request');
            })->name('tenant.realtor.sales-request');

            // Events
            Route::controller(RealtorEventController::class)->group(function () {
                Route::get('/events', 'index')->name('tenant.realtor.events');
                Route::get('/events/{eventId}/bookings', 'getEventBookings')->name('tenant.realtor.events.bookings');
                Route::get('/events/{eventId}/stats', 'getReferralStats')->name('tenant.realtor.events.stats');
                Route::get('/events/{eventId}/export', 'exportBookings')->name('tenant.realtor.events.export');
            });
        });
    });

    Route::prefix('management')->group(function () {
        Route::middleware(['auth:tenant', 'user.type:admin'])->group(function () {

            Route::get('/', function () {
                return redirect()->route('tenant.admin.dashboard');
            });

            Route::get('/dashboard', function () {
                return tenant_view('admin.pages.dashboard');
            })->name('tenant.admin.dashboard');

            Route::get('/add-admin', function () {
                return tenant_view('admin.pages.manage-admins.add-admin');
            })->name('add-admin');

            Route::get('/edit-admin', function () {
                return tenant_view('admin.pages.manage-admins.edit-admin');
            })->name('edit-admin');

            Route::get('/all-admins', function () {
                return tenant_view('admin.pages.manage-admins.all-admin');
            })->name('all-admins');

            Route::get('/add-admin-wizard', function () {
                return tenant_view('admin.pages.manage-admins.add-admin-wizard');
            })->name('add-admin-wizard');

            Route::get('/admin-invoice', function () {
                return tenant_view('admin.pages.manage-admins.admin-invoice');
            })->name('admin-invoice');

            Route::get('/my-properties/add-property', function () {
                return tenant_view('admin.pages.my-properties.add-property');
            })->name('admin.add-property');

            Route::get('/my-properties/edit-property', function () {
                return tenant_view('admin.pages.my-properties.edit-property');
            })->name('admin.edit-property');

            Route::get('/my-properties/listing', function () {
                return tenant_view('admin.pages.my-properties.listing');
            })->name('admin.listing');

            Route::get('/my-properties/favourites', function () {
                return tenant_view('admin.pages.my-properties.favourites');
            })->name('admin.favourites');


            Route::prefix('manage-users')->group(function () {
                Route::get('/user-profile', function () {
                    return tenant_view('admin.pages.manage-users.user-profile');
                })->name('user-profile');

                Route::get('/add-user', function () {
                    return tenant_view('admin.pages.manage-users.add-user');
                })->name('admin.add-user');

                Route::get('/add-user-wizard', function () {
                    return tenant_view('admin.pages.manage-users.add-user-wizard');
                })->name('admin.add-user-wizard');

                Route::get('/edit-user', function () {
                    return tenant_view('admin.pages.manage-users.edit-user');
                })->name('edit-user');

                Route::get('/all-users', function () {
                    return tenant_view('admin.pages.manage-users.all-users');
                })->name('all-users');
            });

            Route::get('/realtor-profile', function () {
                return tenant_view('admin.pages.realtor.realtor-profile');
            })->name('admin.realtor-profile');

            Route::get('/add-realtor', function () {
                return tenant_view('admin.pages.realtor.add-realtor');
            })->name('add-realtor');

            Route::get('/add-realtor-wizard', function () {
                return tenant_view('admin.pages.realtor.add-realtor-wizard');
            })->name('add-realtor-wizard');

            Route::get('/edit-realtor', function () {
                return tenant_view('admin.pages.realtor.edit-realtor');
            })->name('edit-realtor');

            Route::get('/all-realtors', function () {
                return tenant_view('admin.pages.realtor.all-realtor');
            })->name('all-realtors');

            Route::get('/realtor-invoice', function () {
                return tenant_view('admin.pages.realtor.realtor-invoice');
            })->name('admin.realtor-invoice');



            Route::get('/map', function () {
                return tenant_view('admin.pages.map');
            })->name('admin.pages.map');

            Route::get('/family-house', function () {
                return tenant_view('admin.pages.types.family-house');
            })->name('admin.family-house');

            Route::get('/reports', function () {
                return tenant_view('admin.pages.reports');
            })->name('admin.reports');

            Route::get('/payments', function () {
                return tenant_view('admin.pages.payments');
            })->name('admin.payments');

            Route::get('/events', function () {
                return tenant_view('admin.pages.events');
            })->name('admin.events');

            Route::get('/withdrawal', function () {
                return tenant_view('admin.pages.withdrawal');
            })->name('admin.withdrawal');

            Route::get('/transactions', function () {
                return tenant_view('admin.pages.transactions');
            })->name('admin.transactions');

            Route::get('/invoice', function () {
                return tenant_view('admin.pages.invoice');
            })->name('admin-invoice');
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
