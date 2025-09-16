<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tenant\Realtor\LandingPageController;
use App\Http\Controllers\Tenant\Realtor\EventController as RealtorEventController;
use App\Http\Controllers\Tenant\Realtor\ReferralsController;
use App\Http\Controllers\Tenant\Realtor\SalesController;
use App\Http\Controllers\Tenant\Realtor\WalletController;
use App\Http\Controllers\Tenant\Realtor\ProfileController as RealtorProfileController;
use App\Http\Controllers\Tenant\Realtor\ReportController as RealtorReportController;

/*
|--------------------------------------------------------------------------
| Tenant - Realtor Routes
|--------------------------------------------------------------------------
*/

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
        })->name('tenant.realtor.add.property');

        Route::get('/my-properties/edit-property', function () {
            return tenant_view('realtor.pages.my-properties.edit-property');
        })->name('tenant.realtor.edit.property');

        Route::get('/my-properties/listing', function () {
            return tenant_view('realtor.pages.my-properties.listing');
        })->name('tenant.realtor.listing');

        Route::get('/my-properties/favourites', function () {
            return tenant_view('realtor.pages.my-properties.favourites');
        })->name('tenant.realtor.favourites');

       

        // Realtor Profile
        Route::get('/agent-profile', function () {
            return tenant_view('realtor.pages.agents.agent-profile');
        })->name('tenant.realtor-agent-profile');

        Route::get('/add-agent', function () {
            return tenant_view('realtor.pages.agents.add-agent');
        })->name('tenant.realtor-add-agent');

        Route::get('/add-agent-wizard', function () {
            return tenant_view('realtor.pages.agents.add-agent-wizard');
        })->name('tenant.realtor.add.agent-wizard');

        Route::get('/edit-agent', function () {
            return tenant_view('realtor.pages.agents.edit-agent');
        })->name('tenant.realtor.edit.agent');

        Route::get('/all-agents', function () {
            return tenant_view('realtor.pages.agents.all-agents');
        })->name('tenant.realtor-all.agents');

        Route::get('/agent-invoice', function () {
            return tenant_view('realtor.pages.agents.agent-invoice');
        })->name('tenant.realtor.agent.invoice');

        // Map
        Route::get('/map', function () {
            return tenant_view('realtor.pages.map');
        })->name('tenant.realtor.map');

        // Family House
        Route::get('/family-house', function () {
            return tenant_view('realtor.pages.types.family-house');
        })->name('tenant.realtor.family.house');

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
        })->name('tenant.realtor.sales.request');

        // Events
        Route::controller(RealtorEventController::class)->group(function () {
            Route::get('/events', 'index')->name('tenant.realtor.events');
            Route::get('/events/{eventId}/bookings', 'getEventBookings')->name('tenant.realtor.events.bookings');
            Route::get('/events/{eventId}/stats', 'getReferralStats')->name('tenant.realtor.events.stats');
            Route::get('/events/{eventId}/export', 'exportBookings')->name('tenant.realtor.events.export');
        });
    });
});
