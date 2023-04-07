@extends('layouts.app')
@section('title','Category Add')
@push('styles')

@endpush

@section('action')
    <a href="{{ route('app.user.create') }}" class="btn btn-sm btn-primary">Add New</a>
@endsection

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>First Name</th>
                                <th> Last Name</th>
                                <th> Email</th>
                                <th> Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $item->role->name }} </td>
                                    <td>{{ $item->first_name }}</td>
                                    <td>{{ $item->last_name }}</td>
                                    <td>{{ $item->email  }}</td>

                                    <td>
                                        <button class="btn btn-primary"> <span class="fa fa-edit"></span></button>
                                        <button class="btn btn-danger"><span class="fa fa-trash"></span></button>
                                    </td>

                                </tr>
                            @endforeach





                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>



@endsection


@push('scripts')

@endpush
