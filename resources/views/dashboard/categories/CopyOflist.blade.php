
















/*
function drowCatForm(catUrl){
	$.ajax({
		url: "/dashboard/category"+catUrl,                               style="display:{{ $cat_sel->id==NULL?'none':'' }}"

		success: function(result){
        	$("#edit-form").html(result);
    	},

    	error: function(){
			alert( "Internal Error" );
		}
    });
}

@if( !$errors->isEmpty() )
	drowCatForm("");
@endif

$(document).ready(function(){
	var sel_cat_id	= {{ $sel_cat_id != NULL ? $sel_cat_id : 'null' }}
//	,errors={!! json_encode($errors->keys()) !!}
		,err_key
	;

@if( $errors->isEmpty() )
	if( sel_cat_id != null ){
		drowCatForm("/"+sel_cat_id);
	}
@else



// 	err_key=	"{{ $errors->keys()[0] }}";

		$("#standard-dialog").dialog( "option", "width", "400px" );
	    $("#standard-dialog").html( "{{ @trans('validation.required', ['attribute'=>'&quot;'.@trans('prompts.'.$errors->keys()[0]).'&quot;' ]) }}" );
	    $("#standard-dialog" ).dialog( "option", "title", "{{ @trans('prompts.error') }}" );
	    $("#standard-dialog").dialog("open");

		$( "#standard-dialog" ).dialog( "option", "buttons",[
			{
				text: "{{ @trans( 'prompts.close' ) }}",
				click: function() {
					$(this).dialog("close");
				}
			}
		]);


@endif




//	-------------------------------------		Edit/Create category

	$( "#add_btn" ).button({
		icons: { primary: "ui-icon-plusthick" },
	});

	$( "#add_btn" ).on("click", function(e){
		drowCatForm("");
	});


});
*/

