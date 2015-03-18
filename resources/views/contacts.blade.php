@extends('layouts.left')

@section('title')
{{ @trans('prompts.contacts') }}
@stop

@section('buttons')
	@include('blocks/buttons')
@stop

@section('sidebar')
<div>left side bar</div>
@stop

@section('content')
<div>Contatcs content</div>
@stop
