<?php
/**
 * creates recursive categories list presentation
 * @param array $cat - category data
 * @param integer $parentId - HTML id for parent element.
 * @param integer $level- level of HTML element
 * @return string - HTML content
 */
function createCatListItem( $cat, $level=-1 ){
	$level++;

	$sel_css	= $cat['is_selected'] ? 'celected-cat' : '';
	$cat_name_span	= '<span id="cat-'.$cat['id'].'" class="cat-name '.$sel_css.' %s" role="button">'.$cat['name'].'</span>';

	$html	=
	'<div class="panel" style="padding-left:'.(5*$level).'px;">';

	if( count($cat['children']) > 0 ){
		$maw_id	= 'maw-'.$cat['id'];

		$html	.=
		'<div>'.
			'<div class="btn-group btn-group-xs" role="group">'.
				'<button type="button" class="btn-toggle-cat" data-toggle="collapse" data-target="#'.$maw_id.'"></button>'.
			'</div>'.
			sprintf($cat_name_span, '' ).
		'</div>'.

		'<div id="'.$maw_id.'" class="panel-collapse collapse'.($cat['expand']?' in':'').'">'.
			'<div class="panel-group">';

		foreach( $cat['children'] as $child )
			$html	.= createCatListItem( $child, $level );

		$html	.=
			'</div>'.
		'</div>';
	}else
		$html	.=
		sprintf($cat_name_span, 'cat-name-single' ).
		'<div class="btn-group btn-group-xs list-left-btn-group" role="group">'.
			'<button id="del_btn-'.$cat['id'].'" type="button" title="'.trans('prompts.delete').'"></button>'.
		'</div>';

	$html	.=
	'</div>';

	return $html;
}
?>
@extends('layouts.left')

@section('title')
{{ @trans('prompts.categories') }}
@stop

@section('buttons')
	@include('dashboard/blocks/buttons')
@stop

@section('screen_title')
	<center><h3>{{ @trans('prompts.cats_manage') }}</h3></center>
@stop

@section('sidebar')
<div class="panel-group cat-tree">
<?php /* ?>
		<div class="add-item">
			<button id="add_btn">{{ @trans('prompts.add') }}</button>
		</div>
<?php */ ?>
	@foreach( $tree as $cat )
		{!! createCatListItem( $cat ) !!}
	@endforeach

</div>
@stop

@section('content')
<div id="edit-form" >
	{!! Form::open(['url'=>action('DashboardController@postCategory'),'method'=>'post', 'role'=>'form', 'class'=>'form-horizontal']) !!}

	<div class="form-group">
	    {!! Form::label('name',@trans('prompts.name'),['class'=>'control-label col-sm-3'] ) !!}
	    <div class="col-sm-9">
			{!! Form::text('name', '', ['id'=>'name','class'=>'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('parent_id',@trans('prompts.parent'),['class'=>'control-label col-sm-3'] ) !!}
	    <div class="col-sm-9">
			{!! Form::select('parent_id', $cats_names, null,['id'=>'parent_id','class'=>'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('rank',@trans('prompts.list_order'),['class'=>'control-label col-sm-3'] ) !!}
	    <div class="col-sm-9">
			{!! Form::text('rank', '', ['id'=>'rank','class'=>'form-control']) !!}
	    </div>
	</div>

	<div class="btn-group" id="form_buttons">
		{!! Form::submit(@trans('prompts.save'),['class'=>'btn btn-default']) !!}
		{!! Form::button(@trans('prompts.delete'),['class'=>'btn btn-default','id'=>'del_form_btn']) !!}
	</div>
	{!! Form::close() !!}
</div>
@stop

@section('js_extra')
<script type="text/javascript">

function fillCatForm( id ){

	var url_cat	= id != null ? "/"+id : "";

	$.ajax({
		dataType: "json",
		url: "/dashboard/category"+url_cat,

		success: function(cat){
			$("#name").val(cat.name);
			$("#parent_id").val(cat.parent_id!=null?cat.parent_id:-1);
			$("#rank").val(cat.rank);
			$('form').attr("action", "{!! action('DashboardController@postCategory') !!}"+url_cat);

			if( cat.n_children > 0 ){
				$("#del_form_btn").attr("disabled", true);
				$("#del_form_btn").on("click","");
			}else{
				$("#del_form_btn").attr("disabled", false);

				$("#del_form_btn").on("click", function(e){
					showDelCatDialog( id, cat.name );
				});
			}
    	},

    	error: function(){
			alert( "Internal Error" );
		}
    });
}
//------------------------------------------------------------------------------

function showDelCatDialog( id, name ){
    var message = "{!! @trans( 'messages.del_cat' ) !!}";
    message	= message.replace(":name", '<i>"'+name+'"</i>' );

	$("#standard-dialog").dialog( "option", "width", "400px" );
    $("#standard-dialog").html( message );
    $("#standard-dialog" ).dialog( "option", "title", "{{ @trans( 'prompts.del_cat' ) }}" );
    $("#standard-dialog").dialog("open");

	$( "#standard-dialog" ).dialog( "option", "buttons",[
		{
			text: "{{ @trans( 'prompts.yes' ) }}",
			click: function() {
				window.location.href =
				"{!! action('DashboardController@removeCategory') !!}/"+id;
			}

		},

		{
			text: "{{ @trans( 'prompts.no' ) }}",
			click: function(){
				$(this).dialog("close");
			}
		}
	]);
}
//------------------------------------------------------------------------------

$(document).ready(function(){
	fillCatForm( {{ $sel_id }} );

//-------------------------------------------	Edit
	$('.cat-name').on("click", function(e){
		var cat;
		cat	= $(this).attr('id').split("-");
		fillCatForm( cat[1] );

		$('.cat-name').removeClass( "celected-cat" );
		$(this).addClass( "celected-cat" );
	});

//-----------------------------------		Expand/Wrap category
	$( ".btn-toggle-cat" ).each(function(){
		var btn_css
		,maw_id	= "#"+$(this).attr("data-target").substring(1);

		btn_css	= ($(maw_id).hasClass("in"))
			? "ui-icon-triangle-1-se"
			: "ui-icon-triangle-1-e";

		$(this).button({
			icons: { primary: btn_css },
			text: false
		});
	});

	$( ".btn-toggle-cat" ).on("click", function(e){
		var	el = $( this ).children('span').first();

		if(el.hasClass( "ui-icon-triangle-1-e" )){
			$(this).attr("title", "{{ @trans('prompts.wrap') }}");
			el.removeClass("ui-icon-triangle-1-e");
			el.addClass("ui-icon-triangle-1-se");
		}else{
			$(this).attr("title", "{{ @trans('prompts.expand') }}");
			el.removeClass("ui-icon-triangle-1-se");
			el.addClass("ui-icon-triangle-1-e");
		}
	});

	$('.btn-toggle-cat').attr("title", "{{ @trans( 'prompts.expand' ) }}");

//-----------------------------------			Delete category (buttons on list)
	$( "button[id^='del_btn']" ).button({
		icons: { primary: "ui-icon-closethick" },
		text: false
	});


	$("button[id^='del_btn']").on("click", function(e){
	    e.preventDefault();

	    var cat_name
	    ,cat	= $(this).attr('id').split("-");

	    cat_name	= $("#cat-"+cat[1]).html();
	    showDelCatDialog( cat[1], cat_name );
	});

	$("button[id^='del_btn']").addClass( "del-btn" );


});
</script>
@stop