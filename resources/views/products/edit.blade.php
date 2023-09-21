@extends('layouts.app')

@section('title', 'Edit Product')

@section('contents')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Product</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('products') }}"> Back</a>
        </div>
    </div>
</div>

<form action="{{ route('products.update', ['id' => $product['id']]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @if($errors->any())
    <div class="alert alert-danger mt-2">
        {{ $errors->first() }}
    </div>
@endif
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Title:</strong>
                <input type="text" name="title" value="{{ $product['title'] }}" class="form-control" placeholder="Title" required>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Price:</strong>
                <input type="number" name="price" value="{{ $product['price'] }}" class="form-control" placeholder="Price" required>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Product Code:</strong>
                <input type="text" name="product_code" value="{{ $product['product_code'] }}" class="form-control" placeholder="Product Code" required>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea class="form-control" style="height:150px" name="description" placeholder="Description" required>{{ $product['description'] }}</textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-sm-right">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection
