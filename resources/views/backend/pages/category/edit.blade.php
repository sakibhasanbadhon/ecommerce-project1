@extends('layouts.app')
@section('title', $title)
@push('styles')

@endpush

@section('action')
    <a href="{{ route('app.categories.index') }}" class="btn btn-sm btn-primary"> <i class="fa fa-list"> Category list </i> </a>
@endsection

@section('content')


<div class="card">
    <div class="card-header">
        <h4>{{ $title }}</h4>
    </div>
    <x-errorMessage/>
    <div class="card-body">
        <form action="{{ route('app.categories.update',$categories->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-sm-8">
                    <div class="mb-3 py-2">
                        <strong><label for="category_name" class="form-label">category Name</label></strong>
                        <input type="text" value="{{ $categories->name }}" name="category_name" class="form-control p-3 @error('category_name') is-invalid @enderror" id="category_name">
                        @error('category_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 py-2">
                        <strong><label for="image" class="form-label">category Image</label></strong>
                        <input type="file" name="image" class="form-control p-3 @error('image') is-invalid @enderror" id="image">
                        <small class="text-secondary"> File type: image, mimes: jpeg, jpg, png </small>
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 py-2">
                        <strong><label for="category_status" class="form-label">Status</label></strong>
                        <select class="form-control form-control @error('category_status') is-invalid @enderror" name="category_status" id="category_status" aria-label="Default select example">
                            <option value="" > Select Active or Pending</option>
                                <option value="0" {{ $categories->status== 0 ? 'selected' : '' }}> Pending </option>
                                <option value="1" {{ $categories->status== 1 ? 'selected' : '' }}> Active </option>

                        </select>

                        @error('category_status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>




                </div>

                <div class="col-sm-4">
                    <img width="300" height="300" class="py-5" src="{{ $categories->image != null ? asset('backend/assets/img/category/'.$categories->image)  : 'https://via.placeholder.com/80' }}" alt="">
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
