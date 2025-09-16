<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tenant\Admin\PropertyController;
use App\Http\Controllers\Tenant\Admin\RealtorController;
use App\Http\Controllers\Tenant\Admin\SectionController;
use App\Http\Controllers\Tenant\Admin\AdminEventController;
use App\Http\Controllers\Tenant\Admin\TestimonialController;

/*
|--------------------------------------------------------------------------
| Tenant - Management Routes (renamed from admin.php)
|--------------------------------------------------------------------------
*/

Route::prefix('management')->group(function () {
    Route::middleware(['auth:tenant', 'user.type:admin'])->group(function () {

        Route::get('/', function () {
            return redirect()->route('tenant.admin.dashboard');
        });

        Route::get('/dashboard', function () {
            return tenant_view('admin.pages.dashboard');
        })->name('tenant.admin.dashboard');


        // admin add, edit... admin routes
        Route::get('/add-admin', function () {
            return tenant_view('admin.pages.manage-admins.add-admin');
        })->name('tenant.admin.add');

        Route::get('/edit-admin', function () {
            return tenant_view('admin.pages.manage-admins.edit-admin');
        })->name('tenant.admin.edit');

        Route::get('/all-admins', function () {
            return tenant_view('admin.pages.manage-admins.all-admin');
        })->name('tenant.admin.all');

        Route::get('/admin-profile', function () {
            return tenant_view('admin.pages.manage-admins.admin-profile');
        })->name('tenant.admin.profile');

        Route::get('/add-admin-wizard', function () {
            return tenant_view('admin.pages.manage-admins.add-admin-wizard');
        })->name('tenant.admin.add.wizard');

        Route::get('/admin-invoice', function () {
            return tenant_view('admin.pages.manage-admins.admin-invoice');
        })->name('tenant.admin.invoice');


        // admin add, edit ... properties routes
        Route::controller(PropertyController::class)->group(function () {
            Route::get('/my-properties/listing', 'listing')
                ->name('tenant.admin.listing');
            Route::get('/my-properties/add-property', 'create')
                ->name('tenant.admin.add.property');
            Route::post('/my-properties/store', 'store')
                ->name('tenant.admin.properties.store');
            Route::get('/my-properties', 'index')
                ->name('tenant.admin.properties.index');
            Route::get('/my-properties/{property}/edit', 'edit')
                ->name('tenant.admin.edit.property');
            Route::put('/my-properties/{property}', 'update')
                ->name('tenant.admin.properties.update');
            Route::delete('/my-properties/{property}', 'destroy')
                ->name('tenant.admin.properties.destroy');

            // Toggle featured and latest-for-sale properties
            Route::post('/my-properties/{property}/toggle-featured', 'toggleFeatured')
                ->name('tenant.admin.properties.toggle-featured');
            Route::post('/my-properties/{property}/toggle-latest-for-sale', 'toggleLatest')
                ->name('tenant.admin.properties.toggle-latest-for-sale');
        });


        Route::get('/my-properties/favourites', function () {
            return tenant_view('admin.pages.my-properties.favourites');
        })->name('tenant.admin.favourites');



        // admin add, edit ... user routes
        Route::prefix('manage-users')->group(function () {
            Route::get('/user-profile', function () {
                return tenant_view('admin.pages.manage-users.user-profile');
            })->name('tenant.admin.user.profile');

            Route::get('/add-user', function () {
                return tenant_view('admin.pages.manage-users.add-user');
            })->name('tenant.admin.add.user');

            Route::get('/add-user-wizard', function () {
                return tenant_view('admin.pages.manage-users.add-user-wizard');
            })->name('tenant.admin.add.user.wizard');

            Route::get('/edit-user', function () {
                return tenant_view('admin.pages.manage-users.edit-user');
            })->name('tenant.admin.edit.user');

            Route::get('/all-users', function () {
                return tenant_view('admin.pages.manage-users.all-users');
            })->name('tenant.admin.all.users');
        });

        // admin add, edit ... realtor routes
        Route::controller(RealtorController::class)->group(function () {
            Route::get('/all-realtors', 'index')->name('tenant.admin.all.realtors');
            Route::get('/realtor-profile/{realtor}', 'realtorProfile')->name('tenant.admin.realtor.profile');
            Route::get('/add-realtor', 'create')->name('tenant.admin.add.realtor');
            Route::post('/add-realtor', 'store')->name('tenant.admin.store.realtor');
            Route::get('/realtor/{realtor}', 'show')->name('tenant.admin.realtor.show');
            Route::get('/realtor/{realtor}/edit', 'edit')->name('tenant.admin.edit.realtor');
            Route::put('/realtor/{realtor}', 'update')->name('tenant.admin.update.realtor');
            Route::delete('/realtor/{realtor}', 'destroy')->name('tenant.admin.destroy.realtor');
            Route::post('/realtor/{realtor}/suspend', 'suspend')->name('tenant.admin.suspend.realtor');
            Route::post('/realtor/{realtor}/toggle-homepage', 'toggleHomepage')->name('tenant.admin.realtor.toggle-homepage');
        });

        Route::get('/add-realtor-wizard', function () {
            return tenant_view('admin.pages.realtor.add-realtor-wizard');
        })->name('tenant.admin.add.realtor.wizard');

        Route::get('/realtor-invoice', function () {
            return tenant_view('admin.pages.realtor.realtor-invoice');
        })->name('tenant.admin.realtor.invoice');


        Route::get('/map', function () {
            return tenant_view('admin.pages.map');
        })->name('tenant.admin.map');

        Route::get('/family-house', function () {
            return tenant_view('admin.pages.types.family-house');
        })->name('tenant.admin.family.house');

        Route::get('/reports', function () {
            return tenant_view('admin.pages.reports');
        })->name('tenant.admin.reports');

        Route::get('/payments', function () {
            return tenant_view('admin.pages.payments');
        })->name('tenant.admin.payments');

        Route::get('/withdrawal', function () {
            return tenant_view('admin.pages.withdrawal');
        })->name('tenant.admin.withdrawal');

        Route::get('/transactions', function () {
            return tenant_view('admin.pages.transactions');
        })->name('tenant.admin.transactions');

        Route::get('/invoice', function () {
            return tenant_view('admin.pages.invoice');
        })->name('tenant.admin.invoice');

        Route::get('/sales', function () {
            return tenant_view('admin.pages.sales');
        })->name('tenant.admin.sales');

        //    admin settings route 
        Route::get('/section', [SectionController::class, 'index'])->name('tenant.admin.section');
        Route::post('/sections/{sectionName}', [SectionController::class, 'store'])->name('tenant.admin.sections.store');

        Route::get('/payment-plans', function () {
            return tenant_view('admin.pages.settings.payment-plans');
        })->name('tenant.admin.payment.plans');

        Route::get('/leads', function () {
            return tenant_view('admin.pages.marketing-tools.leads');
        })->name('tenant.admin.leads');

        Route::get('/ai.ad.generator', function () {
            return tenant_view('admin.pages.marketing-tools.ai-ad-generator');
        })->name('tenant.admin.ai.ad.generator');

        Route::controller(AdminEventController::class)->group(function () {
            Route::get('/events', 'index')->name('tenant.admin.events');
            Route::post('/events', 'store')->name('tenant.admin.events.store');
            Route::put('/events/{event}', 'update')->name('tenant.admin.events.update');
            Route::delete('/events/{event}', 'destroy')->name('tenant.admin.events.destroy');
        });

        Route::get('/property/{id}', function ($id) {
            $property = App\Models\Property::findOrFail($id);
            return tenant_view('admin.pages.property-details', compact('property'));
        })->name('client.property-details');
    });

    // Testimonials are outside the admin middleware intentionally
    Route::controller(TestimonialController::class)->group(function () {
        Route::get('/testimonials', 'index');
        Route::post('/testimonials', 'store');
        Route::put('/testimonials/{id}', 'update');
        Route::delete('/testimonials/{id}', 'destroy');
        Route::post('/testimonials/limit', 'setLimit');
    });

    // Manage Users
    Route::get('/manage-users/user-profile', function () {
        return tenant_view('admin.pages.manage-users.user-profile');
    })->name('tenant.admin.user-profile');

    Route::get('/manage-users/add-user', function () {
        return tenant_view('admin.pages.manage-users.add-user');
    })->name('tenant.admin.add-user');

    Route::get('/manage-users/add-user-wizard', function () {
        return tenant_view('admin.pages.manage-users.add-user-wizard');
    })->name('tenant.admin.add-user-wizard');

    Route::get('/manage-users/edit-user', function () {
        return tenant_view('admin.pages.manage-users.edit-user');
    })->name('tenant.admin.edit-user');

    Route::get('/manage-users/all-users', function () {
        return tenant_view('admin.pages.manage-users.all-users');
    })->name('tenant.admin.all-users');
});
