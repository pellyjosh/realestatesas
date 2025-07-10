<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');



require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/billings', [\App\Http\Controllers\BillingController::class, 'index'])->name('billings.index');
    Route::post('/billings/subscribe', [\App\Http\Controllers\BillingController::class, 'subscribe'])->name('billings.subscribe');
    Route::post('/billings/cancel', [\App\Http\Controllers\BillingController::class, 'cancel'])->name('billings.cancel');
});

Route::get('/', function () {
    return view('welcome');
});
