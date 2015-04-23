
var tbl_prompts = {//Don't delete. This variable is used in TableDate initialisation.
	"emptyTable":prompts.empty_table
	,"infoEmpty":prompts.info_empty
	,"info":prompts.info
	,"infoFiltered":prompts.info_filtered
	,"zeroRecords":prompts.zero_records
	,"search":""
	,"lengthMenu":prompts.length_menu
	,"processing":prompts.processing
	,"loadingRecords": prompts.loading_records

    ,"paginate":{
        "first":prompts.paginate.first,
        "last":prompts.paginate.last,

//        "next":prompts.paginate.next,
//        "previous":prompts.paginate.previous

        "next":"&raquo;",
        "previous":"&laquo;"
    }
};

/**
 * calls TableDates searching utility
 * @param DataTable table - object in which shearch is performed
 * @param array sCols - indexes of searching columns
 * @return void
 */
function execTblSearch(table){
	table.search( $("#"+table.pid+"_filter input").val() );

	if( table.searchCols  && table.searchCols.length > 0 )
		for(var cn=0; cn<table.searchCols.length; cn++ )
			table.column(table.searchCols[cn]).search( $('#'+table.pid+"_inp_"+table.searchCols[cn]).val());

	table.draw();
}
//------------------------------------------------------------------------------

/**
 * sets state (enable/disable) of delete button due to state of row check-boxes.
 * @param string pid - table HTML id.
 * @returns	void
 */
function setDelBtnState( pid ){
	var none_checked = true
		,fade=0.5;

	$("#"+pid+" .row-check-box").each(function(){
		if( $(this).is(':checked') ){
			none_checked	= false;
			fade = 1.0;
			return false;//break each()
		}
	});

	$("#"+pid+"_arch_btn").attr( "disabled", none_checked ).fadeTo( "fast", fade );

}
//------------------------------------------------------------------------------

/**
 * defines state of main check box due to states of all individual row check boxes in table
 * @param string pid - HTML id of table
 * @returns	void
 */
function processRowCheck(pid){
	var all_checked=true;

	$("#"+pid+" .row-check-box").each(function(){

		if( !$(this).is(':checked') ){
			all_checked	= false;
			return;
		}
	});

	$("#"+pid+" .all-check").prop('checked', all_checked);

	setDelBtnState( pid );
}
//------------------------------------------------------------------------------
/**
 * sets custom controls and also styles and handlers for controls.
 * @param DataTable table - object in which settings are performed
 * @param array sCols - indexes of searching columns
 * @return void
 */
function setTblElements( table ){
	var obj
	,sCols;

	if(table.searchCols)
		sCols=table.searchCols;

    $("#"+table.pid+"_filter input").unbind().on("keyup change", function(e){//Change main search input handler
		(e.keyCode == 13) ? execTblSearch(table):null;
	}).addClass("form-control").attr("placeholder", prompts.search );

    $("#"+table.pid+"_length select").addClass("form-control");

    $("#"+table.pid+"_filter")
    	.prepend("<button id='"+table.pid+"_search_btn'></button>")//Main search button
    	.append("<button id='"+table.pid+"_clean_btn'></button>")//Clean button for main search
    	.prepend("<span id='"+table.pid+"_tools' class='tbl-tool-btns-span'></span>");//	Tool buttons container


    $("#"+table.pid+"_search_btn").button({				//Settings of Main search button
		icons: { primary: "ui-icon-search" },
		text: false
	}).on("click", function(e) {
		execTblSearch(table)
	}).attr("title", prompts.exec_search);

    $("#"+table.pid+"_clean_btn").button({				//Settings of Clean button for main search
		icons: { primary: "ui-icon-cancel" },
		text: false
	}).on("click", function(e) {
		$("#"+table.pid+"_filter input").val("");
		execTblSearch(table);
	}).attr("title", prompts.clean);

	obj	= $("#"+table.pid+" .all-check");

	if(obj){
		obj.on("click", function(e){		//Set onclick handler on "all rows" check-box
			$("#"+table.pid+" .row-check-box").prop('checked', $(this).is(':checked'));
			setDelBtnState( table.pid );
		}).prop('checked', false);

		//	There is no need in archive button if there are no row selboxes.
		$("#"+table.pid+"_tools").prepend("<button id='"+table.pid+"_arch_btn'></button>");
		$("#"+table.pid+"_arch_btn").button({
			icons: { primary: "ui-icon-locked" },
			text: false
		}).on( "click", function(e){
			alert("Arch/Del record. Not implemented yet");
		}).attr("title", prompts.to_archive );

		setDelBtnState( table.pid );
	}

	//	Add new record button
	$("#"+table.pid+"_tools").prepend("<button id='"+table.pid+"_add_btn'></button>");
	$("#"+table.pid+"_add_btn").button({
		icons: { primary: "ui-icon-circle-plus" },
		text: false
	}).on( "click", function(e){
		showTblRecForm( table, null );
	}).attr("title",prompts.add);

	//Set handlers for individual search inputs
	if( sCols && sCols.length > 0 ){

		for(var cn=0; cn<sCols.length; cn++ ){

			$("input", table.column(sCols[cn]).footer()).attr("id", table.pid+"_inp_"+sCols[cn]);

			$(".ind-clean-btn", table.column(sCols[cn]).footer())
				.attr("id", table.pid+"cleanbtn-"+sCols[cn])
				.on( "click", function(e){
					var idd	= $(this).attr("id").split("-");
					$("#"+table.pid+"_inp_"+idd[1]).val("");
		        	execTblSearch(table)
				});
		}

		//Individual search buttons settings
	    $(".ind-search-btn").button({
			icons: { primary: "ui-icon-search" },
			text: false
		}).on( "click", function(e){
			execTblSearch(table);
	    }).attr("title", prompts.exec_search);

		//Individual clean buttons settings
	    $(".ind-clean-btn").button({
			icons: { primary: "ui-icon-cancel" },
			text: false
		}).attr("title", prompts.clean);


	    $(".f-inp").on( "keyup change", function(e){
	    	(e.keyCode == 13)
	        	 ? execTblSearch(table):null;
	    });

	}


//XXX Don't delete next comments
//			goodstable_next prompts.paginate.next paginate_button next
//	$("#"+table.pid+"_next").attr("title","Next");
//	$(".dataTables_paginate .paginate_button .next").attr("title","Next");

//	if($("#"+table.pid+"_next")){
////		alert("Good");
//		$("#"+table.pid+"_next").attr("title","Next");
//	}else{
//		alert("Bad");
//	}
//XXX


	//	Handler for edit row.
	$("#"+table.pid+" tbody").on( 'click', 'td', function () {
		$("#"+table.pid+" .selected").removeClass('selected');

		if ( !$(this).hasClass('unclickable') ){
			$("#"+table.pid+" .row-check-box").prop('checked', false);
			$(this).parent('tr').addClass('selected');

			showTblRecForm( table, table.cell( '.selected', 0 ).data() );
		}
	});

}
//------------------------------------------------------------------------------


/**
 * Shows popup dialog to edit table recod
 * @param object table
 * @param integer id - record id
 * @returns void
 */
function showTblRecForm( table, id ){

	var tst
	,id_url	= id == null ? "" : "/"+id
	,dform_id = table.pid+"-form-dialog"
	,dform
	;

	is_submit	= false;

	$('body').append("<div id='"+dform_id+"'></div>");

	if(!dform)
		dform	= $("#"+dform_id);

	$.ajax({
		url: table.formUrl+"/"+table.pid+id_url,
		success: function(result){
			dform.html( result );
		},

    	error: function(){
			alert( "Internal Error" );
		}
	});


	dform.dialog({
		autoOpen: false,
		dialogClass: "dialog-form",
		width: table.formWidth ? table.formWidth : 600,
		modal: true,
		title: table.formTitle,

		buttons: [
		   {
			text: prompts.save,
			click: function(){
				$("#"+table.pid+"form").submit();
			}
		}
		]
	}).dialog("open");

	$( document ).ajaxComplete(function(){

		$("#"+table.pid+"form").submit(function(e){

			if( !is_submit ){
				is_submit	= true;

			    $.ajax({
			        url : $(this).attr("action"),
			        type: "POST",
			        data : $(this).serializeArray(),
			        success:function(data, textStatus, jqXHR){
			        	dform.dialog("close");
			        	inform( prompts.op_result, messages.save_success );
			        	table.ajax.reload(null,false);
			        },

			        error: function(jqXHR, textStatus, errorThrown){
			        	var err = jQuery.parseJSON(jqXHR.responseText);

			        	for(var field_id in err ){
			        		inform( messages.valid_error, err[field_id][0], field_id );
			        		break;
			        	}
			        }
			    });
			}

		    e.preventDefault(); //STOP default action
		});
	});

}
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

