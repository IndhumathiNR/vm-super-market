@extends('adminlte::page')

@section('title', 'Offers')

@section('content_header')
<h1>Offers</h1>
@stop

@section('content')

@include('flash-message')

<div class="row">
   <a href="{{route('offers.create')}}">
      <x-adminlte-button label="Add" theme="info" icon="fas fa fa-plus"/>
   </a>
</div>
<br>

<div class="container">
   @php
   $heads = [
   'Product Name',
   'Quantity',
   'Product Price',
   'Purchased With',
   ['label' => 'Actions', 'no-export' => true, 'width' => 5],
   ];
   @endphp

   <x-adminlte-datatable id="offer_table" :heads="$heads">
      @foreach($offers as $offer)
      <tr>
         <td>{{$offer->product->product_name}}</td>
         <td>{{!empty($offer->quantity)?$offer->quantity:'-'}}</td>
         <td>{{$offer->offer_price}}</td>
         <td>{{$offer->getProductName()}}</td>
         <td>
            <nobr>
               <form method="POST" action="{{ route('offers.destroy', $offer->id) }}" accept-charset="UTF-8" style="display:inline"><input name="_method" type="hidden" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}">
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