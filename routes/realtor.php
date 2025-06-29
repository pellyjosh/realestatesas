<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Realtor\RealtorController;

Route::prefix('realtor')->group(function () {
    Route::controller(RealtorController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('realtor.dashboard');
       
    });
});