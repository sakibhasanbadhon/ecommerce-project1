@extends('layouts.app')
@section('title','Category Add')
@push('styles')

@endpush

@section('action')
    <a href="{{ route('app.users.index') }}" class="btn btn-sm btn-primary"> <i class="fa fa-list"></i> User List</a>
@endsection

@section('content')


    <div class="card">
        <x-errorMessage/>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-8 mx-auto">
                    <form action="{{ route('app.users.store') }}" method="POST">
                        @csrf

                        <div class="md-3 py-2">
                            <strong><label for="role_id" class="form-label">Role Name</label></strong>
                            <select class="form-control form-control" name="role_id" id="role_id" aria-label="Default select example">
                                <option value="" >Select Role id</option>
                                @foreach ($roles as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                                @error('role_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="md-3 py-2">
                            <strong><label for="first_name" class="form-label">First Name</label></strong>
                            <input type="text" name="first_name" class="form-control p-3" id="first_name" placeholder="write first name">
                            @error('first_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="md-3 py-2">
                            <strong><label for="last_name" class="form-label">Last Name</label></strong>
                            <input type="text" name="last_name" class="form-control p-3" id="last_name" placeholder="write last name">
                                @error('last_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="md-3 py-2">
                            <strong><label for="email" class="form-label">Email</label></strong>
                            <input type="text" name="email" class="form-control p-3" id="email" placeholder="write email address">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="md-3 py-2">
                            <strong><label for="password" class="form-label">Password</label></strong>
                            <input type="text" name="password" class="form-control p-3" id="password" placeholder="write password">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="md-3 py-2">
                            <strong><label for="confirm_password" class="form-label">Confirm password</label></strong>
                            <input type="text" name="password_confirmation" class="form-control p-3" id="confirm_password" placeholder="re-write password">

                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="md-3 py-2">
                            <strong><label for="phone_no" class="form-label">Phone</label></strong>
                            <input type="text" name="phone" class="form-control p-3" id="phone" placeholder="phone number">
                        </div>
                        <br>

                        <div class="md-3">

                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>


                    </form>



                </div>
            </div>
        </div>
    </div>



@endsection


@push('scripts')

@endpush
