<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;



class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $allPermissions = Permission::all(); // permission model theke sob permission newa holo
            foreach ($allPermissions as $key => $permission) {
                Gate::define($permission->slug, function(User $user) use ($permission){
                    return $user->hasPermission($permission->slug); //hasPermission method a slug pathano holo.
                });
            }
        }


 



        return $next($request);
    }
}
