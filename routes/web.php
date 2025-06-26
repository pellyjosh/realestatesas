<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventBookingController;
use App\Http\Controllers\Client\EventController;

Route::get('/', function () {
    return view('client.pages.index');
})->name('client.home');

Route::post('/book-event', [EventBookingController::class, 'bookEvent']);
Route::post('/retrieve-referral', [EventBookingController::class, 'retrieveReferral']);
Route::get('/events', [EventController::class, 'index'])->name('client.events');