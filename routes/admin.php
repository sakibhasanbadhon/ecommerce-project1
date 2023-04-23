<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserManageController;
use App\Http\Controllers\Backend\DashboardController;



 //========== Auth Dashboard ================

Route::prefix('app')->name('app.')->middleware(['auth','is_verify','Permission','admin_switch'])->group(function(){
    Route::get('/',[DashboardController::class, 'dashboard'])->name('dashboard');

    Route::resource('roles', RoleController::class)->except('show','destroy');
    Route::post('roles/get-data', [RoleController::class, 'getData'])->name('roles.get-data');
    Route::post('roles/destroy', [RoleController::class,'destroy'])->name('roles.destroy');

    Route::resource('users', UserManageController::class)->except('show','destroy');
    Route::post('users/get-data', [UserManageController::class, 'getData'])->name('users.get-data');
    Route::post('users/destroy', [UserManageController::class, 'destroy'])->name('users.destroy');

    Route::resource('brands', BrandController::class);
    Route::post('brands/get-data', [BrandController::class, 'getData'])->name('brands.get-data');
    Route::post('brands/destroy', [BrandController::class, 'destroy'])->name('brands.destroy');

});


Route::get('welcome',function(){
    return view('welcome');
});

