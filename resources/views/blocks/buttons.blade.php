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
	<a type="button" class="btn btn-default" href="/dashboard/categories">{{ @trans('prompts.dashboard') }}</a>
</div>
@endif
