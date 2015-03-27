<?php
/**
 * Layout with narrow right sidebar, wide middle sidebar (content) and additional left sidebar
 */
?>
@extends('layouts.main')

@section('buttons')
	@yield('buttons')
@stop

@section('screen_title')
	@yield('screen_title')
@stop

@section('main_container')
<div class="row">
	<div id="a_sidebar" class="col-md-3">
		@yield('a_sidebar')
	</div>
	<div id="content" class="col-md-6">
		@yield('content')
	</div>
	<div id="sidebar" class="col-md-3">
		@yield('sidebar')
	</div>
</div>
@stop