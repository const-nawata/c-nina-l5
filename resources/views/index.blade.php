@extends('layouts.left')

@section('title')
{{ @trans('prompts.home') }}
@stop

@section('buttons')
	@include('blocks/buttons')
@stop

@section('sidebar')
<div>left side bar</div>
@stop

@section('content')
<div>Index content</div>
@stop
