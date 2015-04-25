
/**
 * call server-side method to remove record from table view.
 * @param object table
 * @returns void
 */
//function removeRecords(table){
//	var del_data
//	,ids=[]
//	;
//
//	$("#"+table.pid+" .row-check-box").each(function(){
//		var idd;
//
//		if( $(this).is(':checked') ){
//			idd	= $(this).attr("id").split("-");
//			ids.push(idd[1]);
//		}
//	});
//
//	del_data	= {
//		'_token':table.token,
//		"ids":ids
//	};
//
//    $.ajax({
//        url : table.urls.del,
//        type: "POST",
//        dataType: "json",
//        data : del_data,
//        success:function(data, textStatus, jqXHR){
//        	var resp = jqXHR.responseJSON;
//
//        	inform( prompts.op_result, resp.message );
//
//        	table.ajax.reload(function(json){
//        		setDelBtnState( table.pid );
//        	});
//        },
//
//        error: function(jqXHR, textStatus, errorThrown){
//        	var err = jqXHR.responseJSON;
//        	inform( prompts.sys_error, errorThrown );
//        }
//    });
//}
//------------------------------------------------------------------------------

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
//------------------------------------------------------------------------------

