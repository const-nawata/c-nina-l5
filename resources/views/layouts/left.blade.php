<?php
/**
 * Layout with narrow left sidebar and wide right sidebar (content)
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
	<div id="sidebar" class="col-md-4">
		@yield('sidebar')
	</div>
	<div id="content" class="col-md-8">
		@yield('content')
	</div>
</div>
@stop