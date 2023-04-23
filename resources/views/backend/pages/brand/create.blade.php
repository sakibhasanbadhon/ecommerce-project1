@extends('layouts.app')
@section('title','Category Add')
@push('styles')

@endpush

@section('action')
    <a href="{{ route('app.roles.index') }}" class="btn btn-sm btn-primary"> <i class="fa fa-list"> Role list </i> </a>
@endsection

@section('content')


<div class="card">
    <x-errorMessage/>
    <div class="card-body">
        <form action="{{ route('app.brands.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-sm-8">
                    <div class="mb-3 py-2">
                        <strong><label for="brand_name" class="form-label">Brand Name</label></strong>
                        <input type="text" name="brand_name" class="form-control p-3" id="brand_name" placeholder="write brand name">
                        @error('brand_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 py-2">
                        <strong><label for="image" class="form-label">Brand Image</label></strong>
                        <input type="file" name="image" class="form-control p-3" id="image">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 py-2">
                        <strong><label for="brand_status" class="form-label">Status</label></strong>
                        <select class="form-control form-control" name="brand_status" id="brand_status" aria-label="Default select example">
                            <option value="" >Select Role id</option>
                                <option value="1">Active</option>
                                <option value="0">pending</option>
                                
                        </select>

                        @error('brand_status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
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

    <script>


    </script>


@endpush
