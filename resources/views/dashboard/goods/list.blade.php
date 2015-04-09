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
		<th><input class="form-control f-inp" type="text" placeholder="{{ @trans('prompts.column_search') }}" /></th>
		<th><input class="form-control f-inp" type="text" placeholder="{{ @trans('prompts.column_search') }}" /></th>
		<th colspan="5">&nbsp;</th>
	</tr>
	</tfoot>

</table>
</div>

@stop

@section('js_extra')
<script type="text/javascript">
$(document).ready(function(){
	var	goods_table=

	$('#goodstable').DataTable( {
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

								// Apply individual colamn search   ui-icon-search


    $('#goodstable_filter input').addClass('form-control');
    $('div.dataTables_length select').addClass('form-control');
    $("#goodstable_filter input").attr("placeholder", "{{ @trans('prompts.search') }}");
//     $("div.dataTables_filter label").append("<button type='button' onclick='alert(444);'></button>");


    $("#goodstable_filter").prepend("<button id='search_btn'></button>");
    $("#search_btn").button({
		icons: { primary: "ui-icon-search" },
		text: false
	});

	$('#search_btn').on('click', function(e) {
		goods_table.search($('div.dataTables_filter input').val()).draw();
	});


	$('#goodstable_filter input').unbind();

	$('#goodstable_filter input').on('keyup change', function(e) {

		(e.keyCode == 13)
			? goods_table.search(this.value).draw():null;
	});

    goods_table.columns().every( function () {
        var that = this;

        $( 'input', this.footer()).on( 'keyup change', function(e){
        	(e.keyCode == 13)
            	? that.search( this.value ).draw():null;
        });
    });

});
</script>
@stop
