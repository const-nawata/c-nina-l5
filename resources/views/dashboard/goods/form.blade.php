{!! Form::open(['url'=>action('DashboardController@postGood').$id_url,'method'=>'post', 'role'=>'form', 'class'=>'form-horizontal','id'=>'goodform','name'=>'goodform']) !!}

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
	    {!! Form::label('wprice',@trans('prompts.wholesale'),['class'=>'control-label col-sm-3'] ) !!}
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
	    {!! Form::label('in_pack',@trans('prompts.in_pack'),['class'=>'control-label col-sm-3'] ) !!}
	    <div class="col-sm-9">
			{!! Form::text('in_pack', $in_pack, ['id'=>'in_pack','class'=>'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('name',@trans('prompts.unit'),['class'=>'control-label col-sm-3'] ) !!}
	    <div class="col-sm-9">
			{!! Form::text('unit_id', $unit_id, ['id'=>'unit_id','class'=>'form-control']) !!}
	    </div>
	</div>

{!! Form::close() !!}