@extends('layouts.app')

@section('title', 'Show Product')

@section('contents')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('products') }}">Back</a>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th>Title</th>
                        <td>{{ $product['title'] }}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>{{ $product['price'] }}</td>
                    </tr>
                    <tr>
                        <th>Product Code</th>
                        <td>{{ $product['product_code'] }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $product['description'] }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
