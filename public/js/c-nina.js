
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
 * Shows alert on error etc.
 * @param string title
 * @param string message
 * @param integer width - in px.
 */
function showAlert( title, message, width ){
	var d_width	= width ? width : 400;

	$("#standard-dialog").dialog( "option", "width", d_width+"px" );
    $("#standard-dialog").html( message );
    $("#standard-dialog" ).dialog( "option", "title", title );
    $("#standard-dialog").dialog("open");

	$( "#standard-dialog" ).dialog( "option", "buttons",[
		{
			text: prompts.close,
			click: function(){
				$(this).dialog("close");
			}
		}
	]);
}
//------------------------------------------------------------------------------

/**
 * calls TableDates searching utility
 * @param DataTable table - object in which shearch is performed
 * @param array sCols - indexes of searching columns
 * @return void
 */
function execTblSearch(table, sCols){
	table.search( $("#"+table.pid+"_filter input").val() );

	if( sCols )
		for(var cn=0; cn<sCols.length; cn++ )
			table.column(sCols[cn]).search( $('#'+table.pid+"_inp_"+sCols[cn]).val());

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
function setTblElements( table, sCols ){
	var obj;

    $("#"+table.pid+"_filter input").unbind().on("keyup change", function(e){//Change main search input handler
		(e.keyCode == 13) ? execTblSearch(table,sCols):null;
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
		execTblSearch(table, sCols)
	}).attr("title", prompts.exec_search);

    $("#"+table.pid+"_clean_btn").button({				//Settings of Clean button for main search
		icons: { primary: "ui-icon-cancel" },
		text: false
	}).on("click", function(e) {
		$("#"+table.pid+"_filter input").val("");
		execTblSearch(table,sCols);
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
			alert("Delete record. Not implemented yet");
		}).attr("title", prompts.to_archive );

		setDelBtnState( table.pid );
	}

	//	Add new record button
	$("#"+table.pid+"_tools").prepend("<button id='"+table.pid+"_add_btn'></button>");
	$("#"+table.pid+"_add_btn").button({
		icons: { primary: "ui-icon-circle-plus" },
		text: false
	}).on( "click", function(e){
		alert("Add record. Not implemented yet");
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
		        	execTblSearch(table,sCols)
				});
		}

		//Individual search buttons settings
	    $(".ind-search-btn").button({
			icons: { primary: "ui-icon-search" },
			text: false
		}).on( "click", function(e){
			execTblSearch(table,sCols);
	    }).attr("title", prompts.exec_search);

		//Individual clean buttons settings
	    $(".ind-clean-btn").button({
			icons: { primary: "ui-icon-cancel" },
			text: false
		}).attr("title", prompts.clean);


	    $(".f-inp").on( "keyup change", function(e){
	    	(e.keyCode == 13)
	        	 ? execTblSearch(table,sCols):null;
	    });

	}


	//	Handler for edit row.
	$("#"+table.pid+" tbody").on( 'click', 'td', function () {
		$("#"+table.pid+" .selected").removeClass('selected');


		if ( !$(this).hasClass('unclickable') ){
			$("#"+table.pid+" .row-check-box").prop('checked', false);
			$(this).parent('tr').addClass('selected');

			alert(  "Show edit form for id: "+table.cell( '.selected', 0 ).data()  );

		}

	});

}
//------------------------------------------------------------------------------
