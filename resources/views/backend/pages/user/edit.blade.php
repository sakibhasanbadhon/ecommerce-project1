@extends('layouts.app')
@section('title','Category Add')
@push('styles')

@endpush

@section('action')
<a href="{{ route('app.users.index') }}" class="btn btn-sm btn-primary"><span class="fa fa-list"> Admin List</span></a>
@endsection

@section('content')


<div class="card">
    <x-errorMessage/>
    <div class="card-body">
        <form action="{{ route('app.users.update',$users->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-sm-8">
                    <div class="mb-3 py-2">
                        <strong><label for="first_name" class="form-label">First Name</label></strong>
                        <input type="text" value="{{ $users->first_name }}" name="first_name" class="form-control p-3" id="first_name">
                        @error('first_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 py-2">
                        <strong><label for="last_name" class="form-label">Last Name</label></strong>
                        <input type="text" name="last_name" value="{{ $users->last_name }}" class="form-control p-3" id="last_name">
                            @error('last_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="mb-3 py-2">
                        <strong><label for="email" class="form-label">Email</label></strong>
                        <input type="text" name="email" value="{{ $users->email }}" class="form-control p-3" id="email">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="mb-3 py-2">
                        <strong><label for="phone_no" class="form-label">Phone</label></strong>
                        <input type="text" name="phone" value="{{ $users->phone_no }}" class="form-control p-3" id="phone">
                    </div>




                </div>
                <div class="col-sm-4">
                    <div class="md-3 py-2">
                        <strong><label for="role_id" class="form-label">Role Name</label></strong>
                        <select class="form-control form-control" name="role_id" id="role_id" aria-label="Default select example">
                            <option value="" >Select Role id</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $users->role_id == $role->id ? 'selected' : '' }} > {{ $role->name }} </option>
                            @endforeach
                        </select>
                            @error('role_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="md-3 py-2">
                        <strong><label for="status" class="form-label"> Status</label></strong>
                        <select class="form-control form-control" name="status" id="status" aria-label="Default select example">
                            <option value="1" {{ $users->status == 1 ? 'selected' : '' }} > Active </option>
                            <option value="0" {{ $users->status == 0 ? 'selected' : '' }}> Pending </option>
                        </select>

                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="md-3 py-2">
                        <img class="border border-5" src="{{ asset('/') }}images/blog/blog-1.jpg" alt="">
                    </div>


                </div>
            </div>


            <div class="d-flex justify-content-end mr-3">
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>

        </form>
    </div>
</div>







@endsection

@push('scripts')

@endpush
