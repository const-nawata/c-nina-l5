<?php
/**
 * Layout with narrow right sidebar and wide left sidebar (content)
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
	<div id="content" class="col-md-8">
		@yield('content')
	</div>
	<div id="sidebar" class="col-md-4">
		@yield('sidebar')
	</div>
</div>
@stop