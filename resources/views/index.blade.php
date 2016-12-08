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
@stop
