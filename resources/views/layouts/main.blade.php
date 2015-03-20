<?php
/**
 * Main layout
 */
?>
@include('blocks/header')

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

			@yield('buttons')

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

@include('blocks/footer')
