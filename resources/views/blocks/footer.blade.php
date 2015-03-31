<?php
/**
 * Main Footer layout
 */
?>

<div id="footer">
	<div class="container">
		<div class="col-md-4">&copy; 2015 {{ @trans('prompts.brand') }}</div>
	</div>
</div>

<div id="standard-dialog"></div>


</body>

<script type="text/javascript">

function showAlert( title, message, width ){
	var d_width	= width ? width : 400;

	$("#standard-dialog").dialog( "option", "width", d_width+"px" );
    $("#standard-dialog").html( message );
    $("#standard-dialog" ).dialog( "option", "title", title );
    $("#standard-dialog").dialog("open");

	$( "#standard-dialog" ).dialog( "option", "buttons",[
		{
			text: "{{ @trans( 'prompts.close' ) }}",
			click: function(){
				$(this).dialog("close");
			}
		}
	]);
}

$(document).ready(function(){

	$("#standard-dialog").dialog({
		autoOpen: false,
		dialogClass: "no-close",
		modal: true
	});

});

</script>
@yield('js_extra')
</html>