@extends('adminlte::page')

@section('title', 'Transaction')

@section('content_header')
<h1>Transaction</h1>
@stop

@section('content')
<div class="row">
    <a href="{{route('transactions.index')}}">
        <x-adminlte-button label="" theme="info" icon="fas fa fa-arrow-left"/>
    </a>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <label>Customer Name : </label> <span>{{$transactionDetails->customer_name}}</span>
    </div>
    <div class="col-md-12">
        <label>Total Amount : </label> <span>{{$transactionDetails->total_amount}}</span>
    </div>
    <div class="col-md-12">
        <label>Purchase Date : </label> <span>{{$transactionDetails->purchase_date}}</span>
    </div>
    <br>
    <div class="col-md-12">
        <label>Purchase Details</label>
    </div>
    <div class="container">
        @php
        $heads = [
        'Product Name',
        'Quantity',
        'Amount'
        ];
        @endphp
        <x-adminlte-datatable id="table1" :heads="$heads">
            @foreach($transactionDetails->cartItems as $cartItem)
            <tr>
                <td>{{ucfirst($cartItem->product->product_name)}}</td>
                <td>{{$cartItem->quantity}}</td>
                <td><strike>{{$cartItem->actual_price}}</strike>  {{$cartItem->offer_price}}</td>
            </tr>
            @endforeach  
        </x-adminlte-datatable>
    </div>
</div>
@stop