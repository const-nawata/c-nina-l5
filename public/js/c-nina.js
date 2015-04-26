//------------------------------------------------------------------------------

/**
 * extends alert functionality. Also sets global is_submit to false.
 * @param string title
 * @param string message
 * @returns void
 */
function inform( title, message, focusId ){

	$("#standard-dialog")
		.dialog( "option", "width", "400px" )
	    .dialog( "option", "title", title )
		.dialog( "option", "buttons",[
			{
				text: prompts.close,
				click: function(){
					$(this).dialog("close");
					is_submit	= false;

					if(focusId)
						$("#"+focusId).focus();
				}
			}
		])
		.html( message )
		.dialog("open");
}

function affirm( title, message, callback ){
//	var result = false;

	$("#standard-dialog")
		.dialog( "option", "width", "400px" )
	    .dialog( "option", "title", title )
		.dialog( "option", "buttons",[
		{
			text: prompts.yes,
			click: function(){
				$(this).dialog("close");
				callback();
			}

		},

		{
			text: prompts.no,
			click: function(){
				$(this).dialog("close");
			}
		}
	])
		.html( message )
		.dialog("open");

}
//------------------------------------------------------------------------------

