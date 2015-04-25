@extends('layouts.middle')

@section('title')
{{ @trans('prompts.goods') }}
@stop

@section('buttons')
	@include('dashboard/blocks/buttons')
@stop


@section('content')


<div class="jumbotron j-tbl">

<table id="{{ $pid }}">
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
		<th>{{ @trans('prompts.wprice') }}</th>
		<th>{{ @trans('prompts.rprice') }}</th>
		<th>{{ @trans('prompts.inpack') }}</th>
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
	var goods_table = $("#{!! $pid !!}").cNinaTable({
		"processing": true,
		"serverSide": true,

		"columnDefs": [
			{"searchable": false, "targets": [ 3,4,5,6,7,8 ] },
			{"orderable": false, "targets": [8] },
			{"className":"right-align-sell", "targets": [ 0,3,4,5,6,7 ]}
			,{"className":"unclickable center-align-sell", "targets": [8]}

		],

		"columns":[
		   {"name":"id"},
		   {"name":"name"},
		   {"name":"article"},
		   {"name":"wprice"},
		   {"name":"rprice"},
		   {"name":"inpack"},
		   {"name":"packs"},
		   {"name":"assort"},
		   {"name":"all_check"}
		]

		,"language": tbl_prompts

		,"ajax": {
			"url": "/goods/table"
		}

	}

	,{
		"searchCols":	[1,2],//	Optional
		"formWidth":	700,//	Optional
		"formTitle": "{{ @trans('prompts.prod_edit') }}",//	Optional
		"urls": {
			"form":"/good/form",
			"del":"/goods/archive"
		}
	});
});
/*
$(document).ready(function(){

	goods_table = $("#{{ $pid }}").DataTable( {
		"processing": true,
		"serverSide": true,

		"columnDefs": [
			{"searchable": false, "targets": [ 3,4,5,6,7,8 ] },
			{"orderable": false, "targets": [8] },
			{"className":"right-align-sell", "targets": [ 0,3,4,5,6,7 ]}
			,{"className":"unclickable center-align-sell", "targets": [8]}

		],

		"columns":[
		   {"name":"id"},
		   {"name":"name"},
		   {"name":"article"},
		   {"name":"wprice"},
		   {"name":"rprice"},
		   {"name":"inpack"},
		   {"name":"packs"},
		   {"name":"assort"},
		   {"name":"all_check"}
		]

		,"language": tbl_prompts

		,"ajax": {
			"url": "/goods/table",
			"data":function(d) {
	            d.pid	= "{{ $pid }}";
        	}
		}
	});

	goods_table.pid			= "{{ $pid }}";
	goods_table.searchCols	= [1,2];//	Optional
	goods_table.formWidth	= 700;//	Optional
	goods_table.token		= "{!! csrf_token(); !!}";
	goods_table.formTitle	= "{{ @trans('prompts.prod_edit') }}";

	goods_table.urls	= {
		"form":"/good/form",
		"del":"/goods/archive",
	};

	setTblElements( goods_table );
});
 */

</script>
@stop
