@extends('layouts.front')
@section('title','Register')
@push('styles')

@endpush
@section('content')

    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="register-form">
                        <div class="title">
                            <h3>No Account? Register</h3>
                            <p>Registration takes less than a minute but gives you full control over your orders.</p>
                        </div>
                        <form class="row" method="post" action="{{ route('signup.store') }}">
                            @csrf
                            <div class="col-sm-6">
                                <x-front.inputbox labelName="First Name" name="first_name" required="required" error="first_name"/>
                            </div>
                            <div class="col-sm-6">
                                <x-front.inputbox labelName="Last Name" name="last_name" required="required" error="last_name"/>
                            </div>
                            <div class="col-sm-6">
                                <x-front.inputbox type="email" labelName="Email" name="email" required="required" error="email"/>
                            </div>
                            <div class="col-sm-6">
                                <x-front.inputbox type="tel" labelName="Phone" name="phone" optional="(optional)" error="phone"/>
                            </div>
                            <div class="col-sm-6">
                                <x-front.inputbox type="password" labelName="Password" name="password" required="required" error="password"/>
                            </div>
                            <div class="col-sm-6">
                                <x-front.inputbox type="password" labelName="Confirm Password" name="password_confirmation"/>
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Register</button>
                            </div>
                            <p class="outer-link">Already have an account? <a href="{{ url('signin') }}">Login Now</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

@endpush
