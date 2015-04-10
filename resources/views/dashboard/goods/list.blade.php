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

//TODO: Move functions to global JS file.

function execTblSearch(table, sCols){
	table.search($('div.dataTables_filter input').val());

	if( sCols )
		for( var i in sCols )
			table.column(i).search( $('#'+table.pid+"_inp_"+i).val());



	table.draw();
}
//--------------------------------------------------------------

function setTblElements( table, sCols ){

	//Set input CSS styles
    $("#"+table.pid+"_filter input").addClass("form-control");
    $("#"+table.pid+"_length select").addClass("form-control");
    $("#"+table.pid+"_filter input").attr("placeholder", "{{ @trans('prompts.search') }}");


	//Main search button
    $("#"+table.pid+"_filter").prepend("<button id='search_btn'></button>");
    $("#search_btn").button({
		icons: { primary: "ui-icon-search" },
		text: false
	});
	$("#search_btn").on("click", function(e) {
		execTblSearch(table, sCols)
	});

	//Main clean button
	$("#"+table.pid+"_filter").append("<button id='clean_btn'></button>");
    $("#clean_btn").button({
		icons: { primary: "ui-icon-cancel" },
		text: false
	});
	$("#clean_btn").on("click", function(e) {
		$("#"+table.pid+"_filter input").val("");
		execTblSearch(table,sCols);
	});

	//Change main search input handler
	$("#"+table.pid+"_filter input").unbind();
	$("#"+table.pid+"_filter input").on("keyup change", function(e) {
		(e.keyCode == 13) ? execTblSearch(table,sCols):null;
	});


//TODO: Check if sCols is not null for tables which don't use individual search.

	//Set handlers for individual search inputs
	for(var cn in sCols ){
		var inp_obj	= $("input", table.column(cn).footer())
		,btn_indiv	= $(".ind-clean-btn", table.column(cn).footer());

		inp_obj.attr("id", table.pid+"_inp_"+cn);
		btn_indiv.attr("id", table.pid+"cleanbtn-"+cn);

        btn_indiv.on( "click", function(e){
			idd	= $(this).attr("id").split("-");
			$("#"+table.pid+"_inp_"+idd[1]).val("");
        	execTblSearch(table,sCols)
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
        	 ? execTblSearch(table,sCols):null;
    });

    $(".ind-search-btn").on( "click", function(e){
		execTblSearch(table,sCols);
    });


}
//--------------------------------------------------------------

$(document).ready(function(){
	var pid="goodstable"
		,s_cols=[0,1]
		,goods_table=0
// 		,ss
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
