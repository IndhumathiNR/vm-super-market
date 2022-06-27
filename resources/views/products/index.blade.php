@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
<h1>Products</h1>
@stop

@section('content')

@include('flash-message')

<div class="row">
    <a href="{{route('products.create')}}">
        <x-adminlte-button label="Add" theme="info" icon="fas fa fa-plus"/>
    </a>
</div>
<br>
<div class="container">
    @php
    $heads = [
    'Product ID',
    'Product Name',
    'Product Price',
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
    ];
    @endphp
    <x-adminlte-datatable id="product_table" :heads="$heads">
        @foreach($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->product_name}}</td>
            <td>{{$product->product_price}}</td>
            <td>
                <nobr>
                    <a href="{{ route('products.edit', $product->id) }}"><button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                    <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button></a>
                    <form method="POST" action="{{ route('products.destroy', $product->id) }}" accept-charset="UTF-8" style="display:inline"><input name="_method" type="hidden" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                        <i class="fa fa-lg fa-fw fa-trash"></i></button>
                    </form>
                </nobr>
            </td>
        </tr>
        @endforeach  
    </x-adminlte-datatable>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop