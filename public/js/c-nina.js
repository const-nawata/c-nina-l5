//------------------------------------------------------------------------------

/**
 * extends alert functionality. Also sets global is_submit to false.
 * @param string title
 * @param string message
 * @returns void
 */
function inform( title, message, focusId ){

	std_dlg
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
//------------------------------------------------------------------------------

/**
 * extends confirm functionality.
 * @param title
 * @param message
 * @param callback
 */
function affirm( title, message, callback ){
	std_dlg
		.dialog( "option", "width", "450px" )
	    .dialog( "option", "title", title )
		.dialog( "option", "buttons",[
			{
				text: prompts.yes,
				click: function(){
					$(this).dialog("close");

					if(typeof callback != "undefined")
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
