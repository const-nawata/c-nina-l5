<?php
/**
 * Layout with narrow right sidebar and wide left sidebar (content)
 */
?>
@extends('layouts.main')

@section('buttons')
	@yield('buttons')
@stop

@section('main_container')
<div class="row">
	<div id="content" class="col-md-9">
		@yield('content')
	</div>
	<div id="sidebar" class="col-md-3">
		@yield('sidebar')
	</div>
</div>
@stop