
<div class="container">
{!! Form::open(['url'=>'/category/save'.$id_url,'method'=>'post', 'role'=>'form', 'class'=>'form-horizontal','id'=>$pid.'form','name'=>$pid.'form']) !!}


		<div class="form-group">
		    {!! Form::label('name',@trans('prompts.name'),['class'=>'control-label col-sm-3'] ) !!}
		    <div class="col-sm-9">
				{!! Form::text('name', $name, ['id'=>'name','class'=>'form-control']) !!}
		    </div>
		</div>

{!! Form::close() !!}
</div>