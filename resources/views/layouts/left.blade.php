<?php
/**
 * Layout with narrow left sidebar and wide right sidebar (content)
 */
?>
@extends('layouts.main')

@section('main_container')
<div class="row">
	<div id="sidebar" class="col-md-3">
		@yield('sidebar')
	</div>
	<div id="content" class="col-md-9">
		@yield('content')
	</div>
</div>
@stop