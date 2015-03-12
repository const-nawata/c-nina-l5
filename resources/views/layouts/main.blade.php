<?php
/**
 * Main layout
 */
?>
@include('layouts/blocks/header')

<div class="header-page-line">
	<div class="container">
		<div class="jumbotron j-header">
@if (Auth::check())
			<div>{{ @trans('prompts.welcome') }} <span class="user-welcome">{{{ Auth::user()->name }}} {{{ Auth::user()->surname }}}</span></div>
@endif
		</div>
	</div>
</div>

<nav class="navbar navbar-default">
	<div class="container">
		<div class="row">

			<div class="col-sm-6">
				<div class="btn-group btn-group-justified" aria-label="Header-buttons" role="group">
					<div class="btn-group" role="group">
						<a type="button" class="btn btn-default" href="/">{{ @trans('prompts.home') }}</a>
					</div>
					<div class="btn-group" role="group">
						<a type="button" class="btn btn-default" href="/index/about">{{ @trans('prompts.about_us') }}</a>
					</div>
					<div class="btn-group" role="group">
						<a type="button" class="btn btn-default" href="/index/contacts">{{ @trans('prompts.contacts') }}</a>
					</div>

@if( Auth::check() && Auth::user()->role == 'admin' )
					<div class="btn-group" role="group">
						<a type="button" class="btn btn-default" href="/index/dashboard">{{ @trans('prompts.dashboard') }}</a>
					</div>
@endif

				</div>
			</div>

			<div class="col-sm-6">
				<ul class="nav navbar-nav navbar-right">
@if( !Auth::check() )
					<li><a href="/users/login">{{ @trans('prompts.login') }}</a></li>
@else
					<li><a href="/users/logout">{{ @trans('prompts.logout') }}</a></li>
@endif
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ @trans('prompts.lang') }}<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="?lang=en">{{ @trans('prompts.english') }}</a></li>
							<li><a href="?lang=ru">{{ @trans('prompts.russian') }}</a></li>
						</ul>
					</li>
				</ul>
			</div>

		</div>
	</div>
</nav>

<div id="main_container" class="container">
@yield('main_container')
</div>

@include('layouts/blocks/footer')