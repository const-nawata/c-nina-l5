@extends('layouts.left')

@section('title')
{{ @trans('prompts.about_us') }}
@stop

@section('buttons')
	@include('blocks/buttons')
@stop

@section('sidebar')
<div>left side bar</div>
@stop

@section('content')
<div>About content</div>
@stop
