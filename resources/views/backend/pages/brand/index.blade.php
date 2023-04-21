@extends('layouts.app')
@section('title', $title)
@push('styles')

    <style>

    </style>

@endpush



@section('action')
    @can('role-create', Auth::user())
        <a href="{{ route('app.roles.create') }}" class="btn btn-sm btn-primary">Add New</a>
    @endcan
@endsection

@section('content')

    <div class="row">

        <div class="col-12">
            <div class="ibox">
                <span class="alert-message mb-3"></span>
                <div class="ibox-head">
                    <div class="ibox-title">{{ $title }}</div>

                </div>
                <div class="ibox-body px-0">
                    <table class="table table-sm" id="role-datatables">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Role Name</th>
                                <th>Note</th>
                                <th>Permission</th>
                                <th>Created_at</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




@endsection





@endsection

@push('scripts')



@endpush
