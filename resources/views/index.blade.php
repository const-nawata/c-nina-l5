@extends('layouts.middle')

@section('title')
{{ @trans('prompts.home') }}
@stop

@section('buttons')
	@include('blocks/buttons')
@stop

@section('screen_title')
<h3>{{ @trans('prompts.assortment') }}</h3>
@stop

@section('content')

	@foreach ($products as $product)
        {{ $product->name }}<br>
	@endforeach

	{!! $products->render() !!}




<div class="row">
  <div class="col-md-3">
    <a href="#" class="thumbnail">
      <img src="/uploads/products/images/1480877728.jpg" alt="alld">
    </a>
  </div>

  <div class="col-md-3">
    <a href="#" class="thumbnail">
      <img src="/uploads/products/images/1481225226.jpg" alt="alld">
    </a>
  </div>

  <div class="col-md-3">
    <a href="#" class="thumbnail">
      <img src="/uploads/products/images/1480877728.jpg" alt="alld">
    </a>
  </div>


  <div class="col-md-3">
    <a href="#" class="thumbnail">
      <img src="/uploads/products/images/1481225226.jpg" alt="alld">
    </a>
  </div>

</div>


@stop
