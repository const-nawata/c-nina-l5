@extends('layouts.left')

@section('title')
{{ @trans('prompts.categories') }}
@stop

@section('buttons')
	@include('dashboard/blocks/buttons')
@stop

@section('sidebar')
<div>Left side bar of Categories</div>
@stop

@section('content')
<div>Categories content</div>
@stop
