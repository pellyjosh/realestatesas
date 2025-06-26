<?php

use App\Http\Controllers\Client\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('client.pages.index');
})->name('client.home');

Route::get('/events', function () {
    return view('client.pages.events');
})->name('client.events');
