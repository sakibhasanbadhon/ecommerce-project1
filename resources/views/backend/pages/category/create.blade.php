@extends('layouts.app')
@section('title', $title)
@push('styles')

@endpush

@section('action')
    <a href="{{ route('app.categories.index') }}" class="btn btn-sm btn-primary"> <i class="fa fa-list"> Category list </i> </a>
@endsection

@section('content')


<div class="card">
    <x-errorMessage/>
    <div class="card-body">
        <form action="{{ route('app.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-8">
                    <div class="mb-3 py-2">
                        <strong><label for="category_name" class="form-label">category Name</label></strong>
                        <input type="text" name="category_name" class="form-control p-3" id="category_name" placeholder="write category name">
                        @error('category_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 py-2">
                        <strong><label for="image" class="form-label">Category Image</label></strong>
                        <input type="file" name="image" class="form-control p-3" id="image">
                        <small class="text-secondary"> File type: image, mimes: jpeg, jpg, png </small>

                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 py-2">
                        <strong><label for="category_status" class="form-label">Status</label></strong>
                        <select class="form-control form-control" name="category_status" id="category_status" aria-label="Default select example">
                            <option value="" > Select Active or Pending</option>
                                <option value="1">Active</option>
                                <option value="0">pending</option>

                        </select>

                        @error('category_status')
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
