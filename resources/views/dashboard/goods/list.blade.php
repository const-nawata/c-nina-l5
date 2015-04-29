@extends('layouts.middle')

@section('title')
{!! @trans('prompts.goods') !!}
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
		<th rowspan="2">{!! @trans('prompts.name') !!}</th>
		<th rowspan="2">{!! @trans('prompts.article') !!}</th>
		<th colspan="2">{!! @trans('prompts.price') !!}</th>
		<th colspan="3">{!! @trans('prompts.quantity') !!}</th>
		<th rowspan="2"></th>
	</tr>
	<tr>
		<th>{!! @trans('prompts.wprice') !!}</th>
		<th>{!! @trans('prompts.rprice') !!}</th>
		<th>{!! @trans('prompts.inpack') !!}</th>
		<th>{!! @trans('prompts.packs') !!}</th>
		<th>{!! @trans('prompts.assort') !!}</th>
	</tr>
	</thead>

	<tfoot>
	<tr>
		<th>&nbsp;</th>
		<th></th>
		<th></th>
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
		"processing": true
		,"serverSide": true

		,"columnDefs": [
			{"searchable": false, "targets": [ 3,4,5,6,7 ] },
			{"className":"right-align-sell", "targets": [ 0,3,4,5,6,7 ]}
		]

		,"columns":{!! $jsFields !!}

		,"ajax": {
			"url": "/goods/table",
			"data":function(srvData){
				srvData.is_show_arch = $("#{!! $pid !!}_archive_chkbx").is(':checked');
			}
		}
	}

	,{
		"searchCols":	[1,2],//	Optional
		"formWidth":	700,//	Optional
		"formTitle": "{!! @trans('prompts.prod_edit') !!}",//	Optional
		"token":	"{!! csrf_token(); !!}",
		"urls": {
			"form":"/good/form",
			"del":"/goods/archive"
		}
	});



	$("#{!! $pid !!}_tools")
		.prepend('<input class="filter-check-box" type="checkbox" id="{!! $pid !!}_archive_chkbx">')
		.prepend('<span class="tbl-content-type" id="{!! $pid !!}_content_type_span">&nbsp;</span>');

	$("#{!! $pid !!}_archive_chkbx")
		.on("click", function(e){
			var chkbx_title
				,tbl_content_type
			;

			if(!$(this).is(':checked')){
				chkbx_title	= "{!! @trans('prompts.show_arch') !!}";
				tbl_content_type = "&nbsp;";
			}else{
				chkbx_title	= "{!! @trans('prompts.show_active') !!}";
				tbl_content_type	= "&#8212;&nbsp;{!! @trans('prompts.archive') !!}&nbsp;&#8212;";
			}

			$(this).attr("title", chkbx_title );
			$("#{!! $pid !!}_content_type_span").html(tbl_content_type );

        	goods_table.ajax.reload(function(json){
        		goods_table.setDelBtnState();
        	});
		})
		.attr("title", "{!! @trans('prompts.show_arch') !!}");
});

</script>
@stop
