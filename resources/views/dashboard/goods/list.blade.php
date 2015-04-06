@extends('layouts.middle')

@section('title')
{{ @trans('prompts.goods') }}
@stop

@section('buttons')
	@include('dashboard/blocks/buttons')
@stop

@section('sidebar')
<div>Left side bar of Goods</div>
@stop

@section('content')



<table id="goods_table" border="1">
	<thead>
	<tr>
		<th rowspan="2">{{ @trans('prompts.name') }}</th>
		<th rowspan="2">{{ @trans('prompts.article') }}</th>
		<th colspan="2">{{ @trans('prompts.price') }}</th>
		<th colspan="3">{{ @trans('prompts.quantity') }}</th>
	</tr>
	<tr>
		<th>{{ @trans('prompts.wholesale') }}</th>
		<th>{{ @trans('prompts.retail') }}</th>
		<th>{{ @trans('prompts.in_pack') }}</th>
		<th>{{ @trans('prompts.packs') }}</th>
		<th>{{ @trans('prompts.assort') }}</th>
	</tr>
	</thead>

<?php /* ?>
	<tfoot>
	<tr>
		<th>{{ @trans('prompts.name') }}</th>  retail
		<th>{{ @trans('prompts.article') }}</th>
		<th>F3</th>
		<th>F4</th>
		<th>F5</th>
	</tr>
	</tfoot>
<?php */ ?>
</table>

@stop

@section('js_extra')
<script type="text/javascript">
$(document).ready(function(){

	$('#goods_table').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "/dashboard/goodstable"
	});

});
</script>
@stop