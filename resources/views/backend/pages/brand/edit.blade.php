@extends('layouts.app')
@section('title', $title)
@push('styles')

@endpush

@section('action')
    <a href="{{ route('app.brands.index') }}" class="btn btn-sm btn-primary"> <i class="fa fa-list"> Brands list </i> </a>
@endsection

@section('content')


<div class="card">
    <div class="card-header">
        <h4>{{ $title }}</h4>
    </div>
    <x-errorMessage/>
    <div class="card-body">
        <form action="{{ route('app.brands.update',$brands->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-sm-8">
                    <div class="mb-3 py-2">
                        <strong><label for="brand_name" class="form-label">Brand Name</label></strong>
                        <input type="text" value="{{ $brands->name }}" name="brand_name" class="form-control p-3 @error('brand_name') is-invalid @enderror" id="brand_name">
                        @error('brand_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 py-2">
                        <strong><label for="image" class="form-label">Brand Image</label></strong>
                        <input type="file" name="image" class="form-control p-3 @error('image') is-invalid @enderror" id="image">
                        <small class="text-secondary"> File type: image, mimes: jpeg,jpg,png </small>
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 py-2">
                        <strong><label for="brand_status" class="form-label">Status</label></strong>
                        <select class="form-control form-control @error('brand_status') is-invalid @enderror" name="brand_status" id="brand_status" aria-label="Default select example">
                            <option value="" > Select Active or Pending</option>
                                <option value="0" {{ $brands->status== 0 ? 'selected' : '' }}> Pending </option>
                                <option value="1" {{ $brands->status== 1 ? 'selected' : '' }}> Active </option>

                        </select>

                        @error('brand_status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>




                </div>

                <div class="col-sm-4">
                    <img class="py-5" src="{{ $brands->image != null ? asset('backend/assets/img/brand/'.$brands->image)  : 'https://via.placeholder.com/80' }}" alt="">
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
