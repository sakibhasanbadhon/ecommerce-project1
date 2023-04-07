<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function dashboard()
    {
        Gate::authorize('app.dashboard'); //database a permission na thakle admin ke dashboard access korte dibe na.
        $breadcrumb = ['Dashboard'=>''];
        pageTitle('Dashboard');
        return view('backend.pages.dashboard',['breadcrumb'=>$breadcrumb]);
    }
}


