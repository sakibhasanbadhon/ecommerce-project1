@extends('layouts.app')
@section('title',$title)
@push('styles')

@endpush

@section('action')
    <a href="{{ route('app.products.index') }}" class="btn btn-sm btn-primary"> <i class="fa fa-list"></i> Product List </a>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <h4>{{ $title }}</h4>
    </div>
    <div class="card-body">
        <x-errorMessage/>

        <form action="{{ route('app.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">

                    <div class="md-3 py-2">
                        <label for="product_name" class="form-label"> <strong>product Name</strong> </label>
                        <input type="text" name="name" class="form-control p-3" id="product_name" value="{{ $product->name }}">
                        @error('name')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md-3 py-2">
                        <label for="product_image" class="form-label"> <strong>Feature Image</strong> </label>
                        <input type="file" name="image" class="form-control p-3" id="product_image" >
                        @error('image')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md-3 py-2">
                        <label for="details" class="form-label"> <strong>Product Details</strong> </label>
                        <input type="text" name="details" class="form-control p-3" id="details" value="{{ $product->details }}" >
                        @error('details')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md-3 py-2">
                        <label for="price" class="form-label"> <strong>Price</strong> </label>
                        <input type="text" name="price" class="form-control p-3" id="price" value="{{ $product->price }}">
                        @error('price')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md-3 py-2">
                        <label for="author" class="form-label"> <strong>Author</strong> </label>
                        <input type="text" name="author" class="form-control p-3" id="author" value="{{ $product->author }}">
                        @error('author')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>




                    {{-- <div class="md-3 py-2">
                        <label for="gallery" class="form-label">Gallery</label>
                        <input type="file" name="gallery[]" class="form-control p-3" id="gallery" required multiple>
                        @error('gallery')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror

                    </div> --}}

                </div>
                <div class="col-md-4">
                    <img class="py-5" src="{{ $product->image != null ? asset('backend/assets/img/product/'.$product->image)  : 'https://via.placeholder.com/80' }}" alt="">
                    <div class="md-3 py-2">
                        <label for="brand" class="form-label"> <strong>Brand</strong> </label>

                        <select name="brand_id" id="brand" class="form-control">
                            <option value="">Brand Select</option>
                            @forelse ($data['brands'] as $brandItem)
                            <option value="{{ $brandItem->id }}" {{ $product->brand_id == $brandItem->id ? 'selected' : '' }} > {{ $brandItem->name }}</option>
                        @empty

                        @endforelse

                        </select>

                        @error('brand_id')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md-3 py-2">
                        <label for="category" class="form-label"> <strong> Category </strong> </label>
                        <select name="category_id" id="category" class="form-control">
                            <option value="">Category Select</option>

                            @forelse ($data['categories'] as $categryItem)
                                <option value="{{ $categryItem->id }}" {{ $product->category_id == $categryItem->id ? 'selected' : '' }}> {{ $categryItem->name }}</option>
                            @empty

                            @endforelse

                        </select>

                        @error('category_id')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror

                    </div>

                    <div class="md-3 py-2">
                        <label for="status" class="form-label"> <strong>status</strong> </label>

                        <select name="status" id="status" class="form-control">
                            <option value="">Select Active / pending</option>
                            <option value="0" {{ $product->status == 1 ? 'selected' : '' }}> Active </option>
                            <option value="1" {{ $product->status == 0 ? 'selected' : '' }}> Pending </option>
                        </select>

                        @error('status')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12 py-3">
                    <button type="submit" class="btn btn-info "> Create </button>

                </div>
            </div>

        </form>
    </div>
</div>



@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

@push('scripts')

    <script>


        $("#dynamic-ar").click(function(){
            alert('kam Hoyse')
        });




    </script>
@endpush
