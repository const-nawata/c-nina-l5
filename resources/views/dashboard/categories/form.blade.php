{!! Form::open(['url'=>action('DashboardController@postCategory').'/'.$cat->id, 'method'=>'post', 'role'=>'form', 'class'=>'form-horizontal','id'=>'cat-form']) !!}
<div class="form-group">
    {!! Form::label('name',@trans('prompts.name'),['class'=>'control-label col-sm-3'] ) !!}
    <div class="col-sm-9">
		{!! Form::text('name', $cat->name, ['id'=>'name','class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('parent_id',@trans('prompts.parent'),['class'=>'control-label col-sm-3'] ) !!}
    <div class="col-sm-9">
		{!! Form::select('parent_id', ['L' => 'Large', 'S' => 'Small'],NULL,['id'=>'parent_id','class'=>'form-control']) !!}
    </div>
</div>

<div class="btn-group">
	{!! Form::submit(@trans('prompts.save'),['class'=>'btn btn-primary form-control']) !!}
</div>
{!! Form::close() !!}

