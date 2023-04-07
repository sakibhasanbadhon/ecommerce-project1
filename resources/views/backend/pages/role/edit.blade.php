@extends('layouts.app')
@section('title','Category Add')
@push('styles')

@endpush

@section('action')
<a href="{{ route('app.roles.index') }}" class="btn btn-sm btn-primary"><span class="fa fa-list"> Admin List</span></a>
@endsection

@section('content')


<div class="card">
    <div class="card-body">
        <form action="{{ route('app.roles.update',$role->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-sm-12">
                    <div class="md-3 py-2">
                        <label for="brand_name" class="form-label"> Name</label> <span class="text-danger">*</span>
                        <input type="text" name="role" class="form-control p-3" id="brand_name"
                            placeholder="write brand name" value="{{ $role->name }}">
                    </div>

                </div>
            </div>

            <div class="row">
                @foreach ($modules as $module)
                <div class="col-md-6">
                    <h4 class="mb-0">{{ $module->name }}</h4>
                    @foreach ($module->permissions as $permission)
                    <div class="form-group">
                        <label class="ui-checkbox">
                            <input type="checkbox" name="permission[]" value="{{ $permission->id }}"
                                @foreach ($role->permissions as $selectPermission)
                                    {{ $permission->id == $selectPermission->id ? 'checked' : '' }}
                                @endforeach
                            >
                            <span class="input-span"></span>{{ $permission->name }}</label>
                    </div>
                    @endforeach
                </div>

                @endforeach
            </div>

            <button type="submit">submit</button>
        </form>
    </div>
</div>







@endsection

@push('scripts')

@endpush
