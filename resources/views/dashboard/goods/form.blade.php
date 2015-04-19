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
	    {!! Form::label('w_price',@trans('prompts.wholesale'),['class'=>'control-label col-sm-3'] ) !!}
	    <div class="col-sm-9">
			{!! Form::text('w_price', $w_price, ['id'=>'w_price','class'=>'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('r_price',@trans('prompts.retail'),['class'=>'control-label col-sm-3'] ) !!}
	    <div class="col-sm-9">
			{!! Form::text('r_price', $r_price, ['id'=>'r_price','class'=>'form-control']) !!}
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