<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use League\Flysystem\UrlGeneration\PrefixPublicUrlGenerator;
use PHPUnit\TextUI\XmlConfiguration\Group;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('admin', function () {
//     return view('backend.pages.dashboard');
// });
Route::get('/', function () {
    return view('frontend.pages.home');
});

Auth::routes([
    'register'         => false,
    'password.confirm' => false,
    'password.email'   => false,
    'password.request' => false,
    'password.reset'   => false,
    'password.update'  => false
]);


//================ Authentication ========================//

Route::get('signup', [AuthController::class, 'signupShowForm']);
Route::post('signup.store', [AuthController::class, 'signupStore'])->name('signup.store');
Route::get('signin', [AuthController::class, 'signin'])->name('signin');
Route::get('forgot-password', [AuthController::class, 'forgotPassword']);


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

