@extends('adminlte::page')

@section('title', 'Transactions')

@section('content_header')
<h1>Transactions</h1>
@stop

@section('content')

@include('flash-message')

<div class="row">
    <a href="{{route('transactions.create')}}">
        <x-adminlte-button label="Add To Cart" theme="info" icon="fas fa fa-plus"/>
    </a>
</div>
<br>
<div class="container">
    @php
    $heads = [
    'Customer Name',
    'Amount',
    'Purchased Date',
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
    ];
    @endphp
    <x-adminlte-datatable id="transaction_table" :heads="$heads">
        @foreach($transactions as $transaction)
        <tr>
            <td>{{$transaction->customer_name}}</td>
            <td>{{$transaction->total_amount}}</td>
            <td>{{$transaction->purchase_date}}</td>
            <td>
                <nobr>
                    <a href="{{ route('transactions.show', $transaction->id) }}"><button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                    <i class="fa fa-lg fa-fw fa-eye"></i>
                    </button></a>
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