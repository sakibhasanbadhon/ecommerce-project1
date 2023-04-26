@extends('layouts.app')
@section('title','Category Add')
@push('styles')

@endpush

@section('action')
    <button class="btn btn-sm btn-primary">Add New</button>
@endsection

@section('content')


<div class="card-body">
    {{-- successfull alert message --}}
    @include('backend.include.alert')

    <div class="row bg-white py-3">
        <div class="col-md-12">
            <h3 class="card-title d-flex justify-content-between" style="font-weight:bold"> Add Product

                <a href="{{ route('product.index') }}" class="btn btn-primary"> <i class="fa fa-list"></i> Product List</a>
            </h3> <hr>

            @include('backend.include.alert')

            <form action="{{ route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                    <div class="col-md-10">

                        <div class="md-3 py-2">
                            <label for="product_name" class="form-label">product Name</label>
                            <input type="text" name="name" class="form-control p-3" value="{{ $product->name }}" id="product_name" required>
                            @error('name')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="md-3 py-2">
                            <label for="product_slug" class="form-label">product Slug</label>
                            <input type="text" name="slug" class="form-control p-3" value="{{ $product->slug }}" id="product_slug" required>
                            @error('slug')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="md-3 py-2">
                            <label for="product_image" class="form-label">Feature Image</label>
                            <input type="file" name="image" class="form-control p-3"  id="product_image" >
                            @error('image')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror

                            <img class="mt-3" width="100" height="70" src="{{ $product->image != null ? asset('backend/image/product/'.$product->image)  : 'https://via.placeholder.com/80' }}"> </td>

                        </div>

                        <div class="md-3 py-2">
                            <label for="details" class="form-label">Product Details</label>
                            <input type="text" name="details" class="form-control p-3" value="{{ $product->details }}" id="details" required>
                            @error('details')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="md-3 py-2">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" name="price" class="form-control p-3" value="{{ $product->price }}" id="price" required>
                            @error('price')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="md-3 py-2">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" name="author" class="form-control p-3" value="{{ $product->author }}" id="author" required>
                            @error('author')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="md-3 py-2">
                            <label for="brand" class="form-label">Brand</label>
                            <select name="brand_id" id="brand" class="form-control p-3">

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
                            <label for="category" class="form-label">Category</label>
                            <select name="category_id" id="category" class="form-control p-3">

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
                            <label for="status" class="form-label">status</label>

                            <select name="status" id="status" class="form-control">
                                <option value="">Brand Select</option>
                                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}> Active </option>
                                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}> Pending </option>
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

</div>


@endsection

@push('scripts')

@endpush
