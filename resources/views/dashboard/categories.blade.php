<?php
/**
 * creates recursive categories list
 * @param array $cat - category data
 * @param integer $parentId - HTML id for parent element.
 * @param integer $level- level of HTML element
 * @return string - HTML content
 */
function createCatListItem( $cat, $parentId, $level=-1 ){
	$level++;

	$buttons	=
				'<button type="button" class="btn glyphicon glyphicon-remove tree-branch-btn" title="'.trans('prompts.delete').'"></button>'.
				'';
	$html	=
	'<div class="panel" style="padding-left:'.(5*$level).'px;">';

	if( count($cat['children']) > 0 ){
		$this_parent_id	= 'acc-'.$cat['id'];
		$maw_id	= 'maw-'.$cat['id'];

		$html	.=
		'<div>'.
			'<div class="btn-group btn-group-xs categories-btn-group" role="group">'.
				'<button type="button" class="btn glyphicon glyphicon-play tree-expand-btn" data-toggle="collapse" data-parent="#'.$parentId.'" data-target="#'.$maw_id.'"></button>'.
			'</div>'.
			'<span id="cat-'.$cat['id'].'" class="cat-name">'.$cat['name'].'</span>'.
			'<div class="btn-group btn-group-xs categories-btn-group" role="group">'.$buttons.'</div>'.
		'</div>'.

		'<div id="'.$maw_id.'" class="panel-collapse collapse">'.
			'<div class="panel-group" id="'.$this_parent_id.'">';

		foreach($cat['children'] as $child )
			$html	.= createCatListItem( $child, $this_parent_id, $level );

		$html	.=
			'</div>'.
		'</div>'.
		'';
	}else
		$html	.=

		'<span id="cat-'.$cat['id'].'" class="cat-name cat-name-single">'.$cat['name'].'</span>'.
		'<div class="btn-group btn-group-xs categories-btn-group" role="group">'.$buttons.'</div>'.
	'';

	$html	.=
	'</div>';

	return $html;
}
$main_id	= 'acc-main';
?>
@extends('layouts.left')

@section('title')
{{ @trans('prompts.categories') }}
@stop

@section('buttons')
	@include('dashboard/blocks/buttons')
@stop

@section('sidebar')
	<div class="panel-group" id="{{ $main_id }}">
	@foreach( $tree as $cat )
		{!! createCatListItem( $cat, $main_id ) !!}
	@endforeach
	</div>
@stop

@section('content')
<div id="cat_content"></div>
@stop

@section('js_extra')
<script type="text/javascript">

$(document).ready(function(){
	$('.cat-name').click(function(){
		var cat	= $(this).attr('id').split("-");

		$.ajax({
			url: "category/"+cat[1],

			success: function(result){
            	$("#cat_content").html(result);
        	},

        	error: function(){
				alert( "Ajax Error" );
			}
        });

	});
});

</script>
@stop