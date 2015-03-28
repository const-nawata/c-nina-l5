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

	$html	=
	'<div class="panel" style="padding-left:'.(5*$level).'px;">';

	if( count($cat['children']) > 0 ){
		$maw_id	= 'maw-'.$cat['id'];

		$html	.=
		'<div>'.
			'<div class="btn-group btn-group-xs" role="group">'.
				'<button type="button" class="btn-toggle-cat" data-toggle="collapse" data-target="#'.$maw_id.'"></button>'.
			'</div>'.
			'<span id="cat-'.$cat['id'].'" class="cat-name" role="button">'.$cat['name'].'</span>'.
		'</div>'.

		'<div id="'.$maw_id.'" class="panel-collapse collapse'.($cat['expand']?' in':'').'">'.
			'<div class="panel-group">';

		foreach($cat['children'] as $child )
			$html	.= createCatListItem( $child, $level );

		$html	.=
			'</div>'.
		'</div>'.
		'';
	}else
		$html	.=
		'<span id="cat-'.$cat['id'].'" class="cat-name cat-name-single" role="button">'.$cat['name'].'</span>'.
		'<div class="btn-group btn-group-xs list-left-btn-group" role="group">'.
			'<button id="del_btn-'.$cat['id'].'" type="button" title="'.trans('prompts.delete').'"></button>'.
		'</div>'.
		'';

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
		<div class="add-item">
			<button id="add_btn">{{ @trans('prompts.add') }}</button>
		</div>

	@foreach( $tree as $cat )
		{!! createCatListItem( $cat ) !!}
	@endforeach
	</div>
@stop

@section('content')
<div id="edit-form"></div>
@stop

@section('js_extra')
<script type="text/javascript">

$(document).ready(function(){


	$( "#add_btn" ).button({
		icons: { primary: "ui-icon-plusthick" },
	});

	$( "#add_btn" ).on("click", function(e){

		$.ajax({
			url: "/dashboard/category",

			success: function(result){
            	$("#edit-form").html(result);
        	},

        	error: function(){
				alert( "Internal Error" );
			}
        });
});
//-----------------------------------

	$( ".btn-toggle-cat" ).button({
		icons: { primary: "ui-icon-triangle-1-e" },
		text: false
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
//-----------------------------------

	$('.cat-name').on("click", function(e) {
		var cat	= $(this).attr('id').split("-");

		$.ajax({
			url: "/dashboard/category/"+cat[1],

			success: function(result){
            	$("#edit-form").html(result);
        	},

        	error: function(){
				alert( "Internal Error" );
			}
        });

	});
//-----------------------------------

	$( "button[id^='del_btn']" ).button({
		icons: { primary: "ui-icon-closethick" },
		text: false
	});

	$("button[id^='del_btn']").on("click", function(e){
	    e.preventDefault();

	    var cat_name
	    ,message = "{!! @trans( 'messages.del_cat' ) !!}"
	    ,cat	= $(this).attr('id').split("-");

	    cat_name	= $("#cat-"+cat[1]).html();

	    message	= message.replace(":name", '<i>"'+cat_name+'"</i>' );

		$("#is-del-dialog").dialog( "option", "width", "400px" );
	    $("#is-del-dialog").html( message );
	    $("#is-del-dialog" ).dialog( "option", "title", "{{ @trans( 'prompts.del_cat' ) }}" );
	    $("#is-del-dialog").dialog("open");

		$( "#is-del-dialog" ).dialog( "option", "buttons",[
			{
				text: "{{ @trans( 'prompts.yes' ) }}",
				click: function() {
					window.location.href = '/category/remove/'+cat[1];
				}

			},

			{
				text: "{{ @trans( 'prompts.no' ) }}",
				click: function() {
					$(this).dialog("close");
				}
			}
		]);

	});

	$("button[id^='del_btn']").addClass( "del-btn" );

});

</script>
@stop