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
	{!! $products->render() !!}

	<div class="container">
		@foreach ($products as $product)

			@if($sell == 0)
		<div class="row">
			@endif

			<div class="col-md-3">
				<div class="thumbnail">
					<img src="{!! $product->photo !!}" alt="{{ $product->name }}">
					<div>{{ $product->name }}</div>
					<div>{{ $product->article }}</div>
				</div>
			</div>

	<?php $sell++; ?>

			@if($sell == 4)
		</div>

	<?php $sell = 0; ?>

			@endif

		@endforeach
	</div>
</div>

@stop
