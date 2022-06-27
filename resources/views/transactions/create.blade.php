@extends('adminlte::page')

@section('title', 'Transaction')

@section('content_header')
<h1>Transaction</h1>
@stop

@section('content')

@error('product_ids.*')
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    {{$message}}
</div>
@enderror

@error('quantities.*')
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    {{$message}}
</div>
@enderror

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{ $message }}</strong>
</div>
@endif

<form role="form" id="transaction-form" method="POST" action="{{ route('transactions.store') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="row" >
        <x-adminlte-input id="customer_name" name="customer_name" label="Customer Name" placeholder="Enter Customer Name"
            fgroup-class="col-md-6" value="{{old('customer_name')}}"/>
    </div>
    <div class="add-cart-section">
        <div class="cart-section-form">
            <div class="cart row">
                <x-adminlte-select name="product_ids[]" label="Product" fgroup-class="col-md-4" id="product_id">
                    @foreach($products as $product)
                    <option value="{{$product->id}}">{{$product->product_name}}</option>
                    @endforeach
                </x-adminlte-select>
                <x-adminlte-input id="quantity" name="quantities[]" label="Quantity" placeholder="Enter Quantity"
                    fgroup-class="col-md-4" value="" type="number"/>
                <div class="col-md-4 divAddButton">
                    <x-adminlte-button  theme="primary" type="button" icon="fas fa-lg fa-plus" class="btn btn-xs btn-primary form-group" class="btn-add"/>
                </div>
            </div>
        </div>
    </div>
    <x-adminlte-button label="Submit" theme="success" icon="fas fa-lg fa-save" type="submit"/>
    <a href="{{route('transactions.index')}}">
        <x-adminlte-button label="Cancel" theme="danger" icon="fa fa-close" type="button"/>
    </a>
</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<style>
    .divAddButton{
    display: flex;
    align-items: center;
    padding-top: 14px
    }
</style>
@stop

@section('js')
<script src="{{asset('js/transaction.js')}}"></script>
@stop