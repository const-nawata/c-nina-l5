/**
 * 
 */


function showProductsTable( tableParams ){

	var table = $("#"+tableParams.pid).cNinaTable({
		"processing": true
		,"serverSide": true

		,"columnDefs": [
			{"searchable": false, "targets": [ 3,4,5,6,7 ] },
			{"className":"right-align-sell", "targets": [ 0,3,4,5,6,7 ]}
		]

		,"columns":tableParams.js_fields

		,"ajax": {
			"url": "/products/table"
			,"data":function(srvData){
				srvData.is_show_arch = $("#"+tableParams.pid+"_archive_chkbx").is(':checked');
			}
		}
	}

	,{
		"searchCols":	[1,2],//	Optional sel_all
		"formWidth":	1000,//	Optional
		"token":	tableParams.token,
		"urls": {
			"getform":"/product/registrationform",
			"del":"/products/archive"
		}

		,"remove":{
			"message":function(){
				var n_recs = 0;

				$("#"+tableParams.pid+" tbody td .row-check-box").each(function(){
					$(this).is(':checked') ? n_recs++ :null;
				});

				return $("#"+tableParams.pid+"_archive_chkbx").is(':checked')
					? messages.activate_recs(n_recs)
					: messages.archivate_recs(n_recs);
			}
			,"data":function(){
				$("#"+tableParams.pid+"_gen_chkbx").prop('checked', false ).attr("title", prompts.sel_all );
				return {"is_to_arch" : !$("#"+tableParams.pid+"_archive_chkbx").is(':checked')}
			}
		}
	});

	$("#"+tableParams.pid+"_tools")
		.prepend('<input class="filter-check-box" type="checkbox" id="'+tableParams.pid+'_archive_chkbx">')
		.prepend('<span class="tbl-content-type" id="'+tableParams.pid+'_content_type_span">&nbsp;</span>');

	$("#"+tableParams.pid+"_archive_chkbx")
		.on("click", function(e){
			var chkbx_title
				,tbl_content_type
				,remove_btn_icon
				,remove_btn_title
			;

			$("#"+tableParams.pid+"_gen_chkbx").prop('checked', false );

			if(!$(this).is(':checked')){
				remove_btn_icon	= "ui-icon-trash";
				remove_btn_title	= prompts.to_archive;
				chkbx_title	= prompts.show_arch;
				tbl_content_type = "&nbsp;";
			}else{
				remove_btn_icon	= "ui-icon-arrowreturnthick-1-e";
				remove_btn_title= prompts.to_active;
				chkbx_title	= prompts.show_active;
				tbl_content_type	= "&#8212;&nbsp;"+prompts.archive+"&nbsp;&#8212;";
			}

			$("#"+tableParams.pid+"_remove_btn").button({
					icons: { primary: remove_btn_icon }
			}).attr("title", remove_btn_title );

			$(this).attr("title", chkbx_title );
			$("#"+tableParams.pid+"_content_type_span").html(tbl_content_type );

			table.ajax.reload(function(json){
				table.setDelBtnState();
        	});
		})
		.attr("title", prompts.show_arch);

	$("#"+tableParams.pid+"_remove_btn").attr("title", prompts.to_archive);

	return table;
}

function buildTableContent( tableParams ){
	switch( tableParams.pid ){
		case "productstable": showProductsTable( tableParams ); break;
		case "incomestable": break;
		case "salestable": break;
		case "offstable": break;
	}
}
