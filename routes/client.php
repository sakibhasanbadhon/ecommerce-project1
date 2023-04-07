<?php

use App\Http\Controllers\Client\DashboardController;
use Illuminate\Support\Facades\Route;



 //========== Auth Dashboard ================

 Route::prefix('portal')->name('portal.')->middleware(['is_client'])->group(function(){
    Route::get('/',[DashboardController::class, 'dashboard'])->name('dashboard');

});
