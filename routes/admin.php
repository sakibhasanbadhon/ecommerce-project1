<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserManageController;
use App\Http\Controllers\Backend\DashboardController;



 //========== Auth Dashboard ================

Route::prefix('app')->name('app.')->middleware(['auth','is_verify','Permission'])->group(function(){
    Route::get('/',[DashboardController::class, 'dashboard'])->name('dashboard');

    Route::resource('roles', RoleController::class)->except('show','destroy');
    Route::post('roles/get-data', [RoleController::class, 'getData'])->name('roles.get-data');
    Route::post('roles/destroy', [RoleController::class,'destroy'])->name('roles.destroy');

    Route::resource('users', UserManageController::class);
    Route::post('users/get-data', [UserManageController::class, 'getData'])->name('users.get-data');
    Route::post('users/destroy', [UserManageController::class, 'destroy'])->name('users.destroy');


});



