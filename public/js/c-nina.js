
var tbl_prompts = {
	"emptyTable":prompts.empty_table	// And so on
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
 * sets custom controls and also styles and handlers for controls.
 * @param DataTable table - object in which settings are performed
 * @param array sCols - indexes of searching columns
 * @return void
 */
function setTblElements( table, sCols ){

	//Set input CSS styles
    $("#"+table.pid+"_filter input").addClass("form-control");
    $("#"+table.pid+"_length select").addClass("form-control");
    $("#"+table.pid+"_filter input").attr("placeholder", prompts.search );


	//Main search button
    $("#"+table.pid+"_filter").prepend("<button id='search_btn'></button>");
    $("#search_btn").button({
		icons: { primary: "ui-icon-search" },
		text: false
	});
	$("#search_btn").on("click", function(e) {
		execTblSearch(table, sCols)
	});




	//Main clean button
	$("#"+table.pid+"_filter").append("<button id='clean_btn'></button>");
    $("#clean_btn").button({
		icons: { primary: "ui-icon-cancel" },
		text: false
	});
	$("#clean_btn").on("click", function(e) {
		$("#"+table.pid+"_filter input").val("");
		execTblSearch(table,sCols);
	});

	//Change main search input handler
	$("#"+table.pid+"_filter input").unbind();
	$("#"+table.pid+"_filter input").on("keyup change", function(e) {
		(e.keyCode == 13) ? execTblSearch(table,sCols):null;
	});

	//Set handlers for individual search inputs
	if( sCols && sCols.length > 0 ){
		for(var cn in sCols ){
			var inp_obj	= $("input", table.column(cn).footer())
			,btn_indiv	= $(".ind-clean-btn", table.column(cn).footer());

			inp_obj.attr("id", table.pid+"_inp_"+cn);
			btn_indiv.attr("id", table.pid+"cleanbtn-"+cn);

	        btn_indiv.on( "click", function(e){
				idd	= $(this).attr("id").split("-");
				$("#"+table.pid+"_inp_"+idd[1]).val("");
	        	execTblSearch(table,sCols)
	        });
		}

		//Individual search buttons style
	    $(".ind-search-btn").button({
			icons: { primary: "ui-icon-search" },
			text: false
		});

		//Individual clean buttons style
	    $(".ind-clean-btn").button({
			icons: { primary: "ui-icon-cancel" },
			text: false
		});


	    $(".f-inp").on( "keyup change", function(e){
	    	(e.keyCode == 13)
	        	 ? execTblSearch(table,sCols):null;
	    });

	    $(".ind-search-btn").on( "click", function(e){
			execTblSearch(table,sCols);
	    });
	}
}
//------------------------------------------------------------------------------
