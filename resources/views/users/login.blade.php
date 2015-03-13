@extends('layouts.left_a')

@section('title')
{{ @trans('prompts.login') }}
@stop

@section('content')

	@if( count($errors->all()) > 0 )
	<div class="alert alert-danger">
	    @foreach ($errors->all() as $error)
	        <p class="error">{{ $error }}</p>
	    @endforeach
	</div>
	@endif


<form class="form-signin" role="form" method="post">
	<h2 class="form-signin-heading">{{ @trans('prompts.your_login_data') }}</h2>
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="text" class="form-control" placeholder="{{ @trans('prompts.username') }}" name="username" autofocus />
	<input type="password" class="form-control" placeholder="{{ @trans('prompts.password') }}" name="password" />

	<label class="checkbox">
		<input type="checkbox" name="remember" value="remember-me">{{ @trans('prompts.remember_me') }}
	</label>

	<button class="btn btn-lg btn-primary btn-block" type="submit">{{ @trans('prompts.enter') }}</button>

	<a href="/password/remind">{{ @trans('prompts.password_forgotten') }}</a><br />
	<a href="/users/register">{{ @trans('prompts.registration') }}</a>

</form>
@stop
