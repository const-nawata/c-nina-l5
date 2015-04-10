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

function applyTableSearch(table, sCols){
	table.search($('div.dataTables_filter input').val());

	if( sCols ){
		for( var i in sCols ){
			table.column(i).search( $('#'+table.pid+"_inp_"+i).val());
		}
	}

	table.draw();
}
//--------------------------------------------------------------

$(document).ready(function(){
	var pid="goodstable"
		,s_cols=[0,1]
		,goods_table
	;


	goods_table=
	$('#'+pid).DataTable( {
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


	//Set input CSS styles
    $("#"+goods_table.pid+"_filter input").addClass("form-control");
    $("#"+goods_table.pid+"_length select").addClass("form-control");
    $("#"+goods_table.pid+"_filter input").attr("placeholder", "{{ @trans('prompts.search') }}");


	//Main search button
    $("#"+goods_table.pid+"_filter").prepend("<button id='search_btn'></button>");
    $("#search_btn").button({
		icons: { primary: "ui-icon-search" },
		text: false
	});
	$("#search_btn").on("click", function(e) {
		applyTableSearch(goods_table, s_cols)
	});

	//Main clean button
	$("#"+goods_table.pid+"_filter").append("<button id='clean_btn'></button>");
    $("#clean_btn").button({
		icons: { primary: "ui-icon-cancel" },
		text: false
	});
	$("#clean_btn").on("click", function(e) {
		$("#"+goods_table.pid+"_filter input").val("");
		applyTableSearch(goods_table,s_cols);
	});

	//Change main search input handler
	$("#"+goods_table.pid+"_filter input").unbind();
	$("#"+goods_table.pid+"_filter input").on("keyup change", function(e) {
		(e.keyCode == 13) ? applyTableSearch(goods_table,s_cols):null;
	});


	//Set handlers for individual search inputs
	for(var cn in s_cols ){
		var inp_obj	= $("input", goods_table.column(cn).footer())
		,btn_indiv	= $(".ind-clean-btn", goods_table.column(cn).footer());

		inp_obj.attr("id", goods_table.pid+"_inp_"+cn);
		btn_indiv.attr("id", goods_table.pid+"cleanbtn-"+cn);

        btn_indiv.on( "click", function(e){
			idd	= $(this).attr("id").split("-");
			$("#"+goods_table.pid+"_inp_"+idd[1]).val("");
        	applyTableSearch(goods_table,s_cols)
        });
	}


	//Individual search buttons style
    $(".ind-search-btn").button({
		icons: { primary: "ui-icon-search" },
		text: false
	});

	//Individual clean buttons style
    $(".ind-clean-btn").button({
		icons: { primary: "ui-icon-cancel" },
		text: false
	});


    $(".f-inp").on( "keyup change", function(e){
    	(e.keyCode == 13)
        	 ? applyTableSearch(goods_table,s_cols):null;
    });

    $(".ind-search-btn").on( "click", function(e){
		applyTableSearch(goods_table,s_cols);
    });

});
</script>
@stop
