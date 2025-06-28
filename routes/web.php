<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\EventController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\MapController;
use App\Http\Controllers\Admin\TypesController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\AuthenticationController;

Route::get('/', function () {
    return view('client.pages.index');
})->name('client.home');

Route::view('/compare', 'client.pages.compare');


Route::controller(EventController::class)->group(function () {
    Route::get('/events', 'index')->name('client.events');
    Route::post('/book-event', 'bookEvent');
    Route::post('/retrieve-referral', 'retrieveReferral');
});

Route::get("/contact", function () {
    return view('client.pages.contact');
})->name('client.contact');


Route::prefix('management')->group(function () {
    Route::controller(AdminController::class)->group(function(){
        Route::get('/dashboard', 'index')->name('admin.dashboard');
        Route::get('/', function () {
            return  redirect()->route('admin.dashboard');
        });   
    });

    Route::controller(PropertyController::class)->group(function(){
        Route::get('/my-properties/add-property', 'addPropertyIndex')->name('admin.add-property');
        Route::get('/my-properties/edit-property', 'editPropertyIndex')->name('admin.edit-property');
        Route::get('/my-properties/listing', 'listingIndex')->name('admin.listing');
        Route::get('/my-properties/favourites', 'favouritesIndex')->name('admin.favourites');
    });

    Route::controller(UserController::class)->group(function(){
        Route::get('/manage-users/user-profile', 'index')->name('user-profile');
        Route::get('/manage-users/add-user', 'addUserIndex')->name('admin.add-user');
        Route::get('/manage-users/add-user-wizard', 'addUserWizardIndex')->name('admin.add-user-wizard');
        Route::get('/manage-users/edit-user', 'editUserIndex')->name('edit-user');
        Route::get('/manage-users/all-users', 'allUsersIndex')->name('all-users');
    });

    Route::controller(AgentController::class)->group(function(){
        Route::get('/agent-profile', 'agentProfileIndex')->name('agent-profile');
        Route::get('/add-agent', 'addAgentIndex')->name('add-agent');
        Route::get('/add-agent-wizard', 'addAgentWizardIndex')->name('add-agent-wizard');
        Route::get('/edit-agent', 'editAgentIndex')->name('edit-agent');
        Route::get('/all-agents', 'allAgentsIndex')->name('all-agents');
        Route::get('/agent-invoice', 'agentInvoiceIndex')->name('agent-invoice');
    });

    Route::controller(MapController::class)->group(function(){
        Route::get('/map', 'index')->name('admin.map');
    });

    Route::controller(TypesController::class)->group(function(){
        Route::get('/family-house', 'houseIndex')->name('admin.family-house');
    });

    Route::controller(ReportController::class)->group(function(){
        Route::get('/reports', 'index')->name('admin.reports');
    });

    Route::controller(PaymentController::class)->group(function(){
        Route::get('/payments', 'index')->name('admin.payments');
    });

    Route::controller(AuthenticationController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('admin.login');
        Route::get('/signup', 'showSignupForm')->name('admin.signup');
        Route::get('/404', 'notfound')->name('admin.not-found');

        // Route::post('/login', 'login')->name('admin.login.submit');
        // Route::post('/signup', 'signup')->name('admin.signup.submit');
    });

    // In routes/web.php
});

Route::prefix('realtor')->group(function () {
   
});