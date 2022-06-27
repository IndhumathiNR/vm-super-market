@extends('adminlte::page')

@section('title', 'Product')

@section('content_header')
<h1>Product</h1>
@stop

@section('content')

<form role="form" id="product-form" method="POST" action="{{ route('products.update',$product->id) }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="PUT">
    <div class="row">
        <x-adminlte-input name="product_name" label="Product Name" placeholder="Enter Product Name"
            fgroup-class="col-md-6" value="{{ old('product_name')??$product->product_name}}"/>
    </div>
    <div class="row">
        <x-adminlte-input name="product_price" label="Product Price" placeholder="Enter Product Price"
            fgroup-class="col-md-6" type="number" value="{{old('product_price')??$product->product_price}}"/>
    </div>
    <x-adminlte-button label="Submit" theme="success" icon="fas fa-lg fa-save" type="submit"/>
    <a href="{{route('products.index')}}">
        <x-adminlte-button label="Cancel" theme="danger" icon="fa fa-close" type="button"/>
    </a>
</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop