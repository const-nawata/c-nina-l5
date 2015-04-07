@extends('layouts.middle')

@section('title')
{{ @trans('prompts.goods') }}
@stop

@section('buttons')
	@include('dashboard/blocks/buttons')
@stop

@section('sidebar')
<div>Left side bar of Goods</div>
@stop

@section('content')



<table id="goods_table" border="1">
	<thead>
	<tr>
		<th rowspan="2"><div>{{ @trans('prompts.name') }}</div><div><input class="form-control field-search-input" type="text" placeholder="{{ @trans('prompts.search') }}" /></div></th>
		<th rowspan="2"><div>{{ @trans('prompts.article') }}</div><div><input class="form-control field-search-input" type="text" placeholder="{{ @trans('prompts.search') }}" /></div></th>
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

<?php /* ?>
	<tfoot>
	<tr>
		<th>{{ @trans('prompts.name') }}</th>  retail
		<th>{{ @trans('prompts.article') }}</th>
		<th>F3</th>
		<th>F4</th>
		<th>F5</th>
	</tr>
	</tfoot>


{
    "emptyTable":     "No data available in table",
    "info":           "Showing _START_ to _END_ of _TOTAL_ entries",
    "infoEmpty":      "Showing 0 to 0 of 0 entries",
    "infoFiltered":   "(filtered from _MAX_ total entries)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Show _MENU_ entries",
    "loadingRecords": "Loading...",
    "processing":     "Processing...",
    "search":         "Search:",
    "zeroRecords":    "No matching records found",
    "paginate": {
        "first":      "First",
        "last":       "Last",
        "next":       "Next",
        "previous":   "Previous"
    },
    "aria": {
        "sortAscending":  ": activate to sort column ascending",
        "sortDescending": ": activate to sort column descending"
    }
}
*/
?>
</table>

@stop

@section('js_extra')
<script type="text/javascript">
$(document).ready(function(){

	$('#goods_table').dataTable( {
		"bProcessing": true,
		"bServerSide": true,

		"aoColumnDefs": [
			{ "bSearchable": false, "aTargets": [ 2,3,4,5,6 ] }
		],

		"language":{
			"search":"{{ @trans('prompts.search') }}"
		},

		"sAjaxSource": "/dashboard/goodstable"
	});

});
</script>
@stop
