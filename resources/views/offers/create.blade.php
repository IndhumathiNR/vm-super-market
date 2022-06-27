@extends('adminlte::page')

@section('title', 'Offer')

@section('content_header')
<h1>Offer</h1>
@stop

@section('content')

<form role="form" id="offer-form" method="POST" action="{{ route('offers.store') }}">
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
   <div class="row">
      <x-adminlte-select name="product_id" fgroup-class="col-md-6" id="product_id">
         @foreach($products as $product)
         <option value="{{$product->id}}">{{$product->product_name}}</option>
         @endforeach
      </x-adminlte-select>
   </div>
   <div class="row">
      <x-adminlte-input id="quantity" name="quantity" label="Quantity" placeholder="Enter Quantity"
         fgroup-class="col-md-6" value="{{old('quantity')}}" type="number"/>
   </div>
   <div class="row">
      <x-adminlte-input name="offer_price" label="Offer Price" placeholder="Enter Offer Price"
         fgroup-class="col-md-6" type="number" value="{{old('offer_price')}}"/>
   </div>
   <div class="form-group col-md-6">
      <input name="offer_check_box" id="offer_check_box" type="checkbox" /> Offer related with other product purchase
   </div>
   <div class="row" id="div-checkbox" >
      <x-adminlte-select name="related_product_id" id="related_product_id" fgroup-class="col-md-6" disabled>
         <option value="" disabled=disabled selected>None</option>
         @foreach($products as $product)
         <option value="{{$product->id}}">{{$product->product_name}}</option>
         @endforeach
      </x-adminlte-select>
   </div>
   <x-adminlte-button label="Submit" theme="success"  type="submit"/>
   <a href="{{route('offers.index')}}">
      <x-adminlte-button label="Cancel" theme="danger"  type="button"/>
   </a>
</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="{{asset('js/offer.js')}}"></script>
@stop