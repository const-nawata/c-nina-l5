@extends('layouts.middle')

@section('title')
{!! @trans('prompts.products') !!}
@stop

@section('headExtra')
<script src="/js/products.js"></script>
@stop

@section('buttons')
	@include('dashboard/blocks/buttons')
@stop

@section('screen_title')
	<div class="row">

		<div class="col-sm-3">
			<h3>{{ @trans('prompts.products_manage') }}</h3>
		</div>

		<div class="col-sm-9">
			<ul class="nav nav-tabs products-actions">
				<li class="active" role="presentation"><a>{!! @trans('prompts.registration') !!}</a></li>
				<li role="presentation"><a href="#">{!! @trans('prompts.income') !!}</a></li>
				<li role="presentation"><a href="#">{!! @trans('prompts.selling') !!}</a></li>
				<li role="presentation"><a href="#">{!! @trans('prompts.writing_off') !!}</a></li>
			</ul>
		</div>

	</div>
@stop

@section('content')
<div class="jumbotron j-tbl" id="products_content">
	@if( $pid == 'productstable' )
		@include('dashboard/products/tabs/registration')
	@else

	@endif
</div>
@stop

@section('js_extra')
<script type="text/javascript">

$(document).ready(function(){
	var table_content
		,table_params	= {
			"pid":			"{!! $pid !!}",
			"token":		"{!! csrf_token(); !!}",
			"js_fields":	{!! $jsFields !!}
		}
	;
	table_content	= buildTableContent( table_params );
});

</script>
@stop
