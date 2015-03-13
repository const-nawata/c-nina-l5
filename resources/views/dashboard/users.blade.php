@extends('layouts.left')

@section('title')
{{ @trans('prompts.users') }}
@stop

@section('buttons')
	@include('dashboard/blocks/buttons')
@stop

@section('sidebar')
<div>Left side bar of Users</div>
@stop

@section('content')
<div>Users content</div>
@stop
