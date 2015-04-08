@extends('layouts.middle')

@section('title')
{{ @trans('prompts.goods') }}
@stop

@section('buttons')
	@include('dashboard/blocks/buttons')
@stop


@section('content')


<div class="jumbotron j-tbl">
<button type="button" id="sss">SSS</button>
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
	var c_table,

	goods_table=

	$('#goodstable').DataTable( {
		"bProcessing": true,
		"bServerSide": true,

		"aoColumnDefs": [
			{ "bSearchable": false, "aTargets": [ 2,3,4,5,6 ] }
		],

		"language": tbl_prompts,
// 		"iDeferLoading": 0,

		"sAjaxSource": "/dashboard/goodstable"
	});






// 	$('#goodstable_filter input').unbind();
	$('div.dataTables_filter input').unbind();


	$('div.dataTables_filter input').bind('keyup change', function(e) {
		if(e.keyCode == 13) {
	    	   goods_table.fnFilter(this.value);
		}
	});





	c_table = $('#goodstable').DataTable();

								// Apply the search  control-label


    c_table.columns().every( function () {
        var that = this;

        $(  'input', this.footer()).on( 'keyup change', function () {
            that
                .search( this.value )
                .draw();
        } );
    } );


    $('div.dataTables_filter input').addClass('form-control');
    $('div.dataTables_length select').addClass('form-control');



});
</script>
@stop
