<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function heroSection(){
        $products = Product::orderBy('id','DESC')->get();
        // dd($products);
        return view('frontend.pages.home',['products'=>$products]);
    }
}
