@extends('layouts.middle')

@section('title')
{{ @trans('prompts.goods') }}
@stop

@section('buttons')
	@include('dashboard/blocks/buttons')
@stop


@section('content')


<div class="jumbotron j-tbl">

<table id="goodstable">
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

	<tfoot>
	<tr>
		<th><button class="ind-search-btn"></button><input class="form-control f-inp" type="text" placeholder="{{ @trans('prompts.column_search') }}" /><button class="ind-clean-btn"></th>
		<th><button class="ind-search-btn"></button><input class="form-control f-inp" type="text" placeholder="{{ @trans('prompts.column_search') }}" /><button class="ind-clean-btn"></th>
		<th colspan="5">&nbsp;</th>
	</tr>
	</tfoot>

</table>
</div>

@stop

@section('js_extra')
<script type="text/javascript">

$(document).ready(function(){
	var pid="goodstable"
		,s_cols=[0,1]
		,goods_table=0
	;


	goods_table = $('#'+pid).DataTable( {
		"processing": true,
		"serverSide": true,

		"columnDefs": [
			{ "searchable": false, "targets": [ 2,3,4,5,6 ] }
		],

		"columns":[
		   {"name":"name"},
		   {"name":"article"},
		   {"name":"w_price"},
		   {"name":"r_price"},
		   {"name":"in_pack"},
		   {"name":"packs"},
		   {"name":"assort"}
		],

		"language": tbl_prompts,

		"ajax": "/dashboard/goodstable"
	});

	goods_table.pid	= pid;

	setTblElements( goods_table, s_cols );

});
</script>
@stop
