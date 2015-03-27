{!! Form::open(['url'=>action('DashboardController@postCategory').$cat_url, 'method'=>'post', 'role'=>'form', 'class'=>'form-horizontal','id'=>'cat-form']) !!}
<div class="form-group">
    {!! Form::label('name',@trans('prompts.name'),['class'=>'control-label col-sm-3'] ) !!}
    <div class="col-sm-9">
		{!! Form::text('name', $cat->name, ['id'=>'name','class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('parent_id',@trans('prompts.parent'),['class'=>'control-label col-sm-3'] ) !!}
    <div class="col-sm-9">
		{!! Form::select('parent_id', $cats_names, $cat->parent_id,['id'=>'parent_id','class'=>'form-control']) !!}
    </div>
</div>

<div class="btn-group">
	{!! Form::submit(@trans('prompts.save'),['class'=>'btn btn-default']) !!}

@if(!$is_has_chilren && $cat->id != NULL)
	{!! Form::button(@trans('prompts.delete'),['class'=>'btn btn-default','id'=>'del_from_btn']) !!}
@endif
</div>

{!! Form::close() !!}

<script type="text/javascript">
///
$(document).ready(function(){

	$('#del_from_btn').on("click", function(e) {
	    var message = "{!! @trans( 'messages.del_cat' ) !!}";

	    e.preventDefault();

	    message	= message.replace(":name", '<i>"{{ $cat->name }}"</i>' );

		$("#is-del-dialog").dialog( "option", "width", "400px" );
	    $("#is-del-dialog").html( message );
	    $("#is-del-dialog" ).dialog( "option", "title", "{{ @trans( 'prompts.del_cat' ) }}" );
	    $("#is-del-dialog").dialog("open");

		$( "#is-del-dialog" ).dialog( "option", "buttons",[
			{
				text: "{{ @trans( 'prompts.yes' ) }}",
				click: function() {
					window.location.href = "/category/remove/{{ $cat->id }}";
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


});

</script>