<?php
function createCatLine( $cat, $suff ){
	$html	=
	'<div class="panel">';

	if( count($cat['children']) > 0 ){
		$html	.=
		'<div class="" data-toggle="collapse" data-parent="#acc-'.$suff.'" href="#collapse-'.$cat['id'].'">'.$cat['name'].'</div>'.

		'<div id="collapse-'.$cat['id'].'" class="panel-collapse collapse">'.
			'<div class="panel-group" id="acc-'.$cat['id'].'">';

		foreach($cat['children'] as $child ){
			$html	.= createCatLine( $child, $cat['id'] );
		}

		$html	.=
			'</div>'.
		'</div>'.

		'';
	}else{
		$html	.= $cat['name'];
	}

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
