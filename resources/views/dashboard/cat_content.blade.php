

{!! Form::open(['url'=>action('DashboardController@postCategory'), 'method'=>'post', 'role'=>'form', 'class'=>'form-horizontal','id'=>'cat-form']) !!}

<?php /* ?>
	<input type="hidden" value="{{ $cat->id }}">
	<label for="name" class="control-label">{{ @trans('prompts.name') }}</label>
<?php */ ?>


<div class="form-group">
    {!! Form::label('name',@trans('prompts.name'),['class'=>'control-label col-sm-3'] ) !!}
    <div class="col-sm-9">
		{!! Form::text('name', $cat->name, ['id'=>'name','class'=>'form-control']) !!}
    </div>
</div>
{!! Form::close() !!}

