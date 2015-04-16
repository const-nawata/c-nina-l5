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
		<th rowspan="2">id</th>
		<th rowspan="2">{{ @trans('prompts.name') }}</th>
		<th rowspan="2">{{ @trans('prompts.article') }}</th>
		<th colspan="2">{{ @trans('prompts.price') }}</th>
		<th colspan="3">{{ @trans('prompts.quantity') }}</th>
		<th rowspan="2"><input type="checkbox" class="all-check"></th>
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
		<th>&nbsp;</th>
		<th><button class="ind-search-btn"></button><input class="form-control f-inp" type="text" placeholder="{{ @trans('prompts.column_search') }}" /><button class="ind-clean-btn"></th>
		<th><button class="ind-search-btn"></button><input class="form-control f-inp" type="text" placeholder="{{ @trans('prompts.column_search') }}" /><button class="ind-clean-btn"></th>
		<th colspan="6">&nbsp;</th>
	</tr>
	</tfoot>

</table>
</div>

@stop

@section('js_extra')
<script type="text/javascript">

$(document).ready(function(){
	var pid="goodstable"//This value must be equel to model table name + "table".
		,search_cols=[1,2]
	;




	goods_table = $('#'+pid).DataTable( {
		"processing": true,
		"serverSide": true,

		"columnDefs": [
			{"visible": true, "width":"40px", "targets": [0] },
			{"searchable": false, "targets": [ 0,3,4,5,6,7,8 ] },
			{"orderable": false, "targets": [0,8] },
			{"className":"right-align-col", "targets": [ 3,4,5,6,7 ]}
			,{"className":"unclickable center-align-col", "targets": [8]}

		],

		"columns":[
		   {"name":"id"},
		   {"name":"name"},
		   {"name":"article"},
		   {"name":"w_price"},
		   {"name":"r_price"},
		   {"name":"in_pack"},
		   {"name":"packs"},
		   {"name":"assort"},
		   {"name":"all_check"}
		]

		,"language": tbl_prompts

		,"ajax": "/dashboard/goodstable"
	});

	goods_table.pid	= pid;//This value must be equel to model table name + "table".

	setTblElements( goods_table, search_cols );

});
</script>
@stop
