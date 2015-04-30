{!! Form::open(['url'=>'/good/save'.$id_url,'method'=>'post', 'role'=>'form', 'class'=>'form-horizontal','id'=>$pid.'form','name'=>$pid.'form']) !!}

	<div class="form-group">
	    {!! Form::label('name',@trans('prompts.name'),['class'=>'control-label col-sm-3'] ) !!}
	    <div class="col-sm-9">
			{!! Form::text('name', $name, ['id'=>'name','class'=>'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('article',@trans('prompts.article'),['class'=>'control-label col-sm-3'] ) !!}
	    <div class="col-sm-9">
			{!! Form::text('article', $article, ['id'=>'article','class'=>'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('wprice',@trans('prompts.wprice'),['class'=>'control-label col-sm-3'] ) !!}
	    <div class="col-sm-9">
			{!! Form::text('wprice', $wprice, ['id'=>'wprice','class'=>'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('rprice',@trans('prompts.rprice'),['class'=>'control-label col-sm-3'] ) !!}
	    <div class="col-sm-9">
			{!! Form::text('rprice', $rprice, ['id'=>'rprice','class'=>'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('inpack',@trans('prompts.inpack'),['class'=>'control-label col-sm-3'] ) !!}
	    <div class="col-sm-9">
			{!! Form::text('inpack', $inpack, ['id'=>'inpack','class'=>'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('name',@trans('prompts.unit'),['class'=>'control-label col-sm-3'] ) !!}
	    <div class="col-sm-9">
			{!! Form::select('unit_id', $units['list'], $units['sel'], ['id'=>'unit_id','class'=>'form-control'] ) !!}
	    </div>
	</div>

{!! Form::close() !!}