
<div class="container">
{!! Form::open(['url'=>'/good/save'.$id_url,'method'=>'post', 'role'=>'form', 'class'=>'form-horizontal','id'=>$pid.'form','name'=>$pid.'form']) !!}




<div class="row">
	<div id="item_data" class="col-md-7">

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

	</div>


<?php

// info(print_r( $cats , TRUE));

?>

	<div id="cats_tree" class="col-md-5">


			<select id="categories" multiple="multiple">
@foreach($cats as $cat)
			    <option value="{!! $cat['id'] !!}" label="{{ $cat['name'] }}"></option>
@endforeach
			</select>



	</div>

</div>
{!! Form::close() !!}
</div>

<script>
$(document).ready(function(){
	$("#categories").multiselect({
		"maxHeight":265
// 		,"checkboxName":"cat-" selected
		,"includeSelectAllOption":true
		,"enableHTML":true
		,"selectAllText":"<span>— "+prompts.sel_all+" —</span>"
		,"nonSelectedText":prompts.sel_none
		,"nSelectedText":prompts.selected.toLowerCase()
		,"allSelectedText":prompts.selected_all
		,"numberDisplayed":0
	});

	$("#{!! $pid !!}form input").each(function(){
		if($(this).attr("type") == "checkbox" ){
			if( $(this).val() == "multiselect-all" ){
				$(this).on("click", function(e){
					var prompt = $(this).is(':checked')
						? prompts.desel_all
						: prompts.sel_all;

					$(this).parent("label").children("span").html("— "+prompt+" —");
				});
			}else{
				$(this).attr("name","categories["+$(this).val()+"]");
			}
		}
	});

});
</script>