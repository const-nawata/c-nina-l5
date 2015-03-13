@extends('layouts.left')

@section('title')
{{ @trans('prompts.categories') }}
@stop

@section('buttons')
	@include('dashboard/blocks/buttons')
@stop



<pre>{{ print_r( $tree ,1) }}</pre>


@section('sidebar')
<div>Left side bar of Categories</div>
@stop

@section('content')
<div>Categories content</div>
@stop
