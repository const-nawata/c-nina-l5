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

<?php $sell	= 0; ?>
<div class="jumbotron  j-tbl">
<div class="container">
	@foreach ($products as $product)

		@if($sell == 0)
	<div class="row">
		@endif
		  <div class="col-md-3">
		    <a href="#" class="thumbnail">
		      <img src="{!! $path !!}default.jpg" alt="{{ $product->name }}">
		      <div>{{ $product->name }}</div>
		    </a>
		  </div>

<?php $sell++; ?>

		@if($sell == 4)
	</div>

<?php $sell = 0; ?>

		@endif

	@endforeach
</div>
	{!! $products->render() !!}
</div>

@stop
