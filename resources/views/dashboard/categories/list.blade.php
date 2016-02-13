<?php
/**
 * creates recursive categories list presentation
 * @param array $cat - category data
 * @param integer $parentId - HTML id for parent element.
 * @param integer $level- level of HTML element
 * @return string - HTML content
 */
function createCatListItem( $cat, $level=-1 ){
	$level++;

	$sel_css	= $cat['is_selected'] ? 'celected-cat' : '';
	$cat_name_span	= '<span id="cat-'.$cat['id'].'" class="cat-name '.$sel_css.' %s" role="button">'.$cat['name'].'</span>';

	$html	=
	'<div class="panel" style="padding-left:'.(5*$level).'px;">';

	if( count($cat['children']) > 0 ){
		$maw_id	= 'maw-'.$cat['id'];

		$html	.=
		'<div>'.
			'<div class="btn-group btn-group-xs" role="group">'.
				'<button type="button" class="btn-toggle-cat" data-toggle="collapse" data-target="#'.$maw_id.'"></button>'.
			'</div>'.
			sprintf($cat_name_span, '' ).
		'</div>'.

		'<div id="'.$maw_id.'" class="panel-collapse collapse'.($cat['expand']?' in':'').'">'.
			'<div class="panel-group">';

		foreach( $cat['children'] as $child )
			$html	.= createCatListItem( $child, $level );

		$html	.=
			'</div>'.
		'</div>';
	}else
		$html	.=
		sprintf($cat_name_span, 'cat-name-single' ).
		'<div class="btn-group btn-group-xs list-left-btn-group" role="group">'.
			'<button id="del_btn-'.$cat['id'].'" type="button" title="'.trans('prompts.delete').'"></button>'.
		'</div>';

	$html	.=
	'</div>';

	return $html;
}
?>
@extends('layouts.middle')

@section('title')
{{ @trans('prompts.categories') }}
@stop

@section('buttons')
	@include('dashboard/blocks/buttons')
@stop

@section('screen_title')
<h3>{{ @trans('prompts.cats_manage') }}</h3>
@stop


@section('content')
<div class="jumbotron j-tbl">
	<div class="row">

		<div class="col-sm-6">
			<div>TREE</div>
		</div>

	 	<div class="col-sm-6">
			<table id="{{ $pid }}">
				<thead>
					<tr><th>id</th><th>{!! @trans('prompts.name') !!}</th><th></th></tr>
				</thead>

				<tfoot>
					<tr><th>&nbsp;</th><th></th><th></th></tr>
				</tfoot>
			</table>
		</div>

	</div>
</div>
@stop

@section('js_extra')
<script type="text/javascript">
$(document).ready(function(){

	var cats_table = $("#{!! $pid !!}").cNinaTable({
		"processing": true
		,"serverSide": true

		,"columnDefs": [
			{"className":"right-align-sell", "targets": [0]}
		]

		,"columns":{!! $jsFields !!}

		,"ajax": {
			"url": "/categories/table"
		}
	}

	,{
		"formWidth":	1000,//	Optional
		"token":	"{!! csrf_token(); !!}",
		"urls": {
			"form":"/category/form",
			"del":"/categories/remove"
		}

	});

});
</script>
@stop