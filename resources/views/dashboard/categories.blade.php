<?php
function createCatLine( $cat, $suff, $level=-1 ){//
	$bullet	= ++$level ? '&#8226; ' : '';

	$general_buttons	=
				'<button type="button" class="btn glyphicon glyphicon-pencil tree-branch-btn" title="'.trans('prompts.edit').'"></button>'.
				'<button type="button" class="btn glyphicon glyphicon-remove tree-branch-btn shadow-left" title="'.trans('prompts.delete').'"></button>';

	$html	=
	'<div class="panel" style="padding-left:'.($level*3).'px;">';

	if( count($cat['children']) > 0 ){
		$html	.=
		'<div class="">'.
			$bullet.$cat['name'].
			'<div class="btn-group btn-group-xs categori-btn-group" role="group">'.
				$general_buttons.
				'<button type="button" class="btn glyphicon glyphicon-eject tree-branch-btn shadow-left" data-toggle="collapse" data-parent="#acc-'.$suff.'" href="#collapse-'.$cat['id'].'" title="'.trans('prompts.expand').'"></button>'.
			'</div>'.
		'</div>'.

		'<div id="collapse-'.$cat['id'].'" class="panel-collapse collapse">'.
			'<div class="panel-group" id="acc-'.$cat['id'].'">';

		foreach($cat['children'] as $child )
			$html	.= createCatLine( $child, $cat['id'], $level );

		$html	.=
			'</div>'.
		'</div>'.

		'';
	}else
		$html	.=

		$bullet.$cat['name'].
		'<div class="btn-group btn-group-xs categori-btn-group" role="group">'.
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
		{!! createCatLine( $cat, 'main' ) !!}
	@endforeach
	</div>
@stop

@section('content')
<div>Categories content</div>
@stop
