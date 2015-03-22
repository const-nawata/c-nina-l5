<div class="form-group">

<div class="raw">

{{ Form::open(array('url'=>action('DashboardController@postCategory'), 'method'=>'post', 'role'=>'form', 'class'=>'form-horizontal')) }}


	<input type="hidden" value="{{ $cat->id }}">

	<div class="col-sm-3">
    	<label for="sector" class="control-label">{{ @trans('prompts.name') }}</label>
    </div>
    <div class="col-sm-9">
		<input type="text" class="form-control" value="{{ $cat->name }}">
    </div>

{{ Form::close() }}
</div>

</div>