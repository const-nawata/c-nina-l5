
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
        "next":prompts.paginate.next,
        "previous":prompts.paginate.previous
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
	table.search($('div.dataTables_filter input').val());

	if( sCols )
		for( var i in sCols )
			table.column(i).search( $('#'+table.pid+"_inp_"+i).val());

	table.draw();
}
//------------------------------------------------------------------------------

/**
 * sets state (enable/disable) of delete button due to state of row check-boxes.
 * @param string pid - table HTML id.
 * @returns	void
 */
function setDelBtnState( pid ){
	var none_checked	= true;

	$("#"+pid+" .row-check-box").each(function(){
		if( $(this).is(':checked') ){
			none_checked	= false;
			return;
		}
	});

	$("#"+pid+"_del_btn").attr( "disabled", none_checked );

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

	//Set input CSS styles
    $("#"+table.pid+"_filter input").unbind().on("keyup change", function(e){//Change main search input handler
		(e.keyCode == 13) ? execTblSearch(table,sCols):null;
	}).addClass("form-control").attr("placeholder", prompts.search );

    $("#"+table.pid+"_length select").addClass("form-control");

    $("#"+table.pid+"_filter")
    	.prepend("<button id='search_btn'></button>")//Main search button
    	.append("<button id='clean_btn'></button>")//Clean button for main search
    	.prepend("<span id='tbl-tool-btns' class='tbl-tool-btns-span'></span>");//	Tool buttons container


    $("#search_btn").button({				//Settings of Main search button
		icons: { primary: "ui-icon-search" },
		text: false
	}).on("click", function(e) {
		execTblSearch(table, sCols)
	}).attr("title", prompts.exec_search);

    $("#clean_btn").button({				//Settings of Clean button for main search
		icons: { primary: "ui-icon-cancel" },
		text: false
	}).on("click", function(e) {
		$("#"+table.pid+"_filter input").val("");
		execTblSearch(table,sCols);
	}).attr("title", prompts.clean);

	obj	= $("#"+table.pid+" .all-check");

	if(obj){
		obj.on("click", function(e){		//Set onclick handler on "all rows" check-box
			var that=$(this);

			$("#"+table.pid+" .row-check-box").each(function(){
				$(this).prop('checked', that.is(':checked'));
			});

			setDelBtnState( table.pid );
		}).prop('checked', false);

		//	There is no need in delete button if there are no row selboxes.
		$("#"+table.pid+"_filter #tbl-tool-btns").prepend("<button id='"+table.pid+"_del_btn'></button>");
		$("#"+table.pid+"_del_btn").button({
			icons: { primary: "ui-icon-circle-minus" },
			text: false
		}).on( "click", function(e){
			alert("Delete record. Not implemented yet");
		}).attr("title", prompts.del ).attr( "disabled", true );
	}

	//	Add new record button
	$("#"+table.pid+"_filter #tbl-tool-btns").prepend("<button id='"+table.pid+"_add_btn'></button>");
	$("#"+table.pid+"_add_btn").button({
		icons: { primary: "ui-icon-circle-plus" },
		text: false
	}).on( "click", function(e){
		alert("Add record. Not implemented yet");
	}).attr("title",prompts.add);

	//Set handlers for individual search inputs
	if( sCols && sCols.length > 0 ){

		for(var cn in sCols ){
			$("input", table.column(cn).footer()).attr("id", table.pid+"_inp_"+cn);

			$(".ind-clean-btn", table.column(cn).footer())
				.attr("id", table.pid+"cleanbtn-"+cn)
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