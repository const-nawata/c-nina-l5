<?php
function createCatListItem( $cat, $parentId, $level=-1 ){
	$bullet	= ++$level ? '&#8226; ' : '';

	$general_buttons	=
				'<button type="button" class="btn glyphicon glyphicon-pencil tree-branch-btn" title="'.trans('prompts.edit').'"></button>'.
				'<button type="button" class="btn glyphicon glyphicon-remove tree-branch-btn shadow-left" title="'.trans('prompts.delete').'"></button>';

	$html	=
	'<div class="panel" style="padding-left:'.($level*3).'px;">';

	if( count($cat['children']) > 0 ){
		$this_parent_id	= 'acc-'.$cat['id'];
		$maw_id	= 'maw-'.$cat['id'];
//TODO: Check while does not work re-wrap
		$html	.=
		'<div class="">'.
			$bullet.$cat['name'].
			'<div class="btn-group btn-group-xs categories-btn-group" role="group">'.
				$general_buttons.
				'<button type="button" onclick="isVisible( \''.$maw_id.'\', $(this) );" class="btn glyphicon glyphicon-eject tree-branch-btn shadow-left" '.
					'data-toggle="collapse" data-parent="#'.$parentId.'" data-target="#'.$maw_id.'" title="'.trans('prompts.expand').'">'.
				'</button>'.
			'</div>'.
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

		$bullet.$cat['name'].
		'<div class="btn-group btn-group-xs categories-btn-group" role="group">'.
			$general_buttons.
		'</div>'.
	'';

	$html	.=
	'</div>';

	return $html;
}
?>
@extends('layouts.left')

@section('title')
{{ @trans('prompts.categories') }}
@stop

@section('buttons')
	@include('dashboard/blocks/buttons')
@stop

@section('sidebar')
	<div class="panel-group" id="acc-main">
	@foreach( $tree as $cat )
		{!! createCatListItem( $cat, 'main' ) !!}
	@endforeach
	</div>
@stop

@section('content')
<div>Categories content</div>
@stop
