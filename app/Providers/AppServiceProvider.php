<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // j login korbe se dashboard button er access pabe na.
        Blade::if('permission', function($permission){
            return Auth::user()->role->permissions->where('slug',$permission)->first() ? true : false;
        });
    }
}
