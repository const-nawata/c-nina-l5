@extends('layouts.middle')

@section('title')
{!! @trans('prompts.products') !!}
@stop

@section('buttons')
	@include('dashboard/blocks/buttons')
@stop

@section('screen_title')
<div class="page-header"><h3>{{ @trans('prompts.products_manage') }}</h3></div>
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

	var products_table = $("#{!! $pid !!}").cNinaTable({
		"processing": true
		,"serverSide": true

		,"columnDefs": [
			{"searchable": false, "targets": [ 3,4,5,6,7 ] },
			{"className":"right-align-sell", "targets": [ 0,3,4,5,6,7 ]}
		]

		,"columns":{!! $jsFields !!}

		,"ajax": {
			"url": "/products/table"
			,"data":function(srvData){
				srvData.is_show_arch = $("#{!! $pid !!}_archive_chkbx").is(':checked');
			}
		}
	}

	,{
		"searchCols":	[1,2],//	Optional sel_all
		"formWidth":	1000,//	Optional
		"token":	"{!! csrf_token(); !!}",
		"urls": {
			"form":"/product/form",
			"del":"/products/archive"
		}

		,"remove":{
			"message":function(){
				var n_recs = 0;

				$("#{!! $pid !!} tbody td .row-check-box").each(function(){
					$(this).is(':checked') ? n_recs++ :null;
				});

				return $("#{!! $pid !!}_archive_chkbx").is(':checked')
					? messages.activate_recs(n_recs)
					: messages.archivate_recs(n_recs);
			}
			,"data":function(){
				$("#{!! $pid !!}_gen_chkbx").prop('checked', false ).attr("title", prompts.sel_all );
				return {"is_to_arch" : !$("#{!! $pid !!}_archive_chkbx").is(':checked')}
			}
		}
	});

	$("#{!! $pid !!}_tools")
		.prepend('<input class="filter-check-box" type="checkbox" id="{!! $pid !!}_archive_chkbx">')
		.prepend('<span class="tbl-content-type" id="{!! $pid !!}_content_type_span">&nbsp;</span>');

	$("#{!! $pid !!}_archive_chkbx")
		.on("click", function(e){
			var chkbx_title
				,tbl_content_type
				,remove_btn_icon
				,remove_btn_title
			;

			$("#{!! $pid !!}_gen_chkbx").prop('checked', false );

			if(!$(this).is(':checked')){
				remove_btn_icon	= "ui-icon-trash";
				remove_btn_title	= prompts.to_archive;
				chkbx_title	= prompts.show_arch;
				tbl_content_type = "&nbsp;";
			}else{
				remove_btn_icon	= "ui-icon-arrowreturnthick-1-e";
				remove_btn_title= prompts.to_active;
				chkbx_title	= prompts.show_active;
				tbl_content_type	= "&#8212;&nbsp;"+prompts.archive+"&nbsp;&#8212;";
			}

			$("#{!! $pid !!}_remove_btn").button({
					icons: { primary: remove_btn_icon }
			}).attr("title", remove_btn_title );

			$(this).attr("title", chkbx_title );
			$("#{!! $pid !!}_content_type_span").html(tbl_content_type );

        	products_table.ajax.reload(function(json){
        		products_table.setDelBtnState();
        	});
		})
		.attr("title", prompts.show_arch);

	$("#{!! $pid !!}_remove_btn").attr("title", prompts.to_archive);
});

</script>
@stop
