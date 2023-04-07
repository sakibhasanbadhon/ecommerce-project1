<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserManageController;
use App\Http\Controllers\Backend\DashboardController;



 //========== Auth Dashboard ================

Route::prefix('app')->name('app.')->middleware(['auth','is_verify','Permission'])->group(function(){
    Route::get('/',[DashboardController::class, 'dashboard'])->name('dashboard');
    route::resource('roles', RoleController::class)->except('destroy'); // akane resource route er destroy route off kora holo

    Route::get('roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

    Route::resource('user', UserManageController::class);

    Route::post('roles/get-data', [RoleController::class, 'getData'])->name('roles.get-data');


});



