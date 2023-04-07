<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    //amar create kora controller ata

    public function signupShowForm(){
        return view('frontend.auth.register');
    }

    public function signupStore(RegisterRequest $request)
    {
        $data = $request->except(['_token','password','password_confirmation','phone']);
        $data['password']= Hash::make($request->password);
        $data['phone_no']= $request->phone;
        $data['role_id']=3;

        User::create($data);

        return back()->with('success','Registration successfully');

        //dd($request->all());


    }

    public function signin(){
        if (Auth::check() && Auth::user()->role->slug == 'client') {
            return redirect('portal');
        }elseif(Auth::check() && Auth::user()->role->slug != 'client') {
            return redirect('app');
        }
        return view('frontend.auth.login');
    }

    public function forgotPassword(){
        return view('frontend.auth.forgot');
    }
}
