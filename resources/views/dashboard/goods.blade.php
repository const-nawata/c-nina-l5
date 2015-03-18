@extends('layouts.left')

@section('title')
{{ @trans('prompts.goods') }}
@stop

@section('buttons')
	@include('dashboard/blocks/buttons')
@stop

@section('sidebar')
<div>Left side bar of Goods</div>
@stop

@section('content')
<div>Goods content</div>
@stop
