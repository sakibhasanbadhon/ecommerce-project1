<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserManageController;
use App\Http\Controllers\Backend\DashboardController;



 //========== Auth Dashboard ================

Route::prefix('app')->name('app.')->middleware(['auth','is_verify','Permission','admin_switch'])->group(function(){
    // this is dashboard route
    Route::get('/',[DashboardController::class, 'dashboard'])->name('dashboard');

    // this is role route
    Route::resource('roles', RoleController::class)->except('show','destroy');
    Route::post('roles/get-data', [RoleController::class, 'getData'])->name('roles.get-data');
    Route::post('roles/destroy', [RoleController::class,'destroy'])->name('roles.destroy');

    // this is user route
    Route::resource('users', UserManageController::class)->except('show','destroy');
    Route::post('users/get-data', [UserManageController::class, 'getData'])->name('users.get-data');
    Route::post('users/destroy', [UserManageController::class, 'destroy'])->name('users.destroy');

    // this is brand route
    Route::resource('brands', BrandController::class)->except('show','destroy');
    Route::post('brands/get-data', [BrandController::class, 'getData'])->name('brands.get-data');
    Route::post('brands/destroy', [BrandController::class, 'destroy'])->name('brands.destroy');

    // this is category route
    Route::resource('categories', CategoryController::class)->except('show','destroy');
    Route::post('categories/get-data', [CategoryController::class, 'getData'])->name('categories.get-data');
    Route::post('categories/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // this is product route
    Route::resource('products', ProductController::class)->except('show','destroy');
    Route::post('products/get-data', [ProductController::class, 'getData'])->name('products.get-data');
    Route::post('products/destroy', [ProductController::class, 'destroy'])->name('products.destroy');


});


Auth::routes(['verify' => true]);


Route::get('welcome',function(){
    return view('welcome');
});

