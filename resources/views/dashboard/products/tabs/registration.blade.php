
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
