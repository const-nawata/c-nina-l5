@extends('layouts.middle')

@section('title')
{{ @trans('prompts.goods') }}
@stop

@section('buttons')
	@include('dashboard/blocks/buttons')
@stop


@section('content')


<div class="jumbotron j-tbl">
<table id="goods_table">
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
		<th><input class="form-control" type="text" placeholder="{{ @trans('prompts.search') }}" /></th>
		<th><input class="form-control" type="text" placeholder="{{ @trans('prompts.search') }}" /></th>
		<th colspan="5">&nbsp;</th>
	</tr>
	</tfoot>

</table>
</div>

@stop

@section('js_extra')
<script type="text/javascript">
$(document).ready(function(){
	var goods_table;




	$('#goods_table').dataTable( {
		"bProcessing": true,
		"bServerSide": true,

		"aoColumnDefs": [
			{ "bSearchable": false, "aTargets": [ 2,3,4,5,6 ] }
		],

		"language": tbl_prompts,

		"sAjaxSource": "/dashboard/goodstable"
	});




	goods_table = $('#goods_table').DataTable();

	// Apply the search  control-label
    goods_table.columns().every( function () {
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
