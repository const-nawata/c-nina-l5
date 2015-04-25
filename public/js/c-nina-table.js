/**
 *
 */

(function($){
//	$.fn.pick_obj	= null;
//	$.fn.timeoutID;

	$.fn.pid	= null;
	$.fn.tbl	= null;
	$.fn.isIndSearch	= false;

    $.fn.extend({
    	cNinaTable: function(pT, pE){
    		$.fn.pid	= $(this).attr("id");
    		$.fn.isIndSearch	= typeof pE.searchCols != "undefined" && pE.searchCols.length > 0;

    		pT.ajax.data=function(srvData){
 	            srvData.pid	= $.fn.pid;
         	};

         	$.fn.tbl	= $(this).DataTable(pT);

		    $("#"+$.fn.pid+"_filter input").unbind().on("keyup change", function(e){//Change main search input handler
				(e.keyCode == 13) ? execTblSearch():null;
			}).addClass("form-control").attr("placeholder", prompts.search );

		    $("#"+$.fn.pid+"_length select").addClass("form-control");

		    $("#"+$.fn.pid+"_filter")
		    	.prepend("<button id='"+$.fn.pid+"_search_btn'></button>")//Main search button
		    	.append("<button id='"+$.fn.pid+"_clean_btn'></button>")//Clean button for main search
		    	.prepend("<span id='"+$.fn.pid+"_tools' class='tbl-tool-btns-span'></span>");//	Tool buttons container

		    $("#"+$.fn.pid+"_search_btn").button({				//Settings of Main search button
				icons: { primary: "ui-icon-search" },
				text: false
			}).on("click", function(e) {
				execTblSearch();
			}).attr("title", prompts.exec_search);

		    $("#"+$.fn.pid+"_clean_btn").button({				//Settings of Clean button for main search
				icons: { primary: "ui-icon-cancel" },
				text: false
			}).on("click", function(e) {
				$("#"+$.fn.pid+"_filter input").val("");
				execTblSearch();
			}).attr("title", prompts.clean);


			//Set handlers for individual search inputs
			if( $.fn.isIndSearch ){

				for(var cn in pE.searchCols ){
					$("input", $.fn.tbl.column(pE.searchCols[cn]).footer()).attr("id", $.fn.pid+"_inp_"+pE.searchCols[cn]);

					$(".ind-clean-btn", $.fn.tbl.column(pE.searchCols[cn]).footer())
						.attr("id", $.fn.pid+"cleanbtn-"+pE.searchCols[cn])
						.on( "click", function(e){
							var idd	= $(this).attr("id").split("-");
							$("#"+$.fn.pid+"_inp_"+idd[1]).val("");
				        	execTblSearch()
						});
				}

				//Individual search buttons settings
			    $(".ind-search-btn").button({
					icons: { primary: "ui-icon-search" },
					text: false
				}).on( "click", function(e){
					execTblSearch();
			    }).attr("title", prompts.exec_search);

				//Individual clean buttons settings
			    $(".ind-clean-btn").button({
					icons: { primary: "ui-icon-cancel" },
					text: false
				}).attr("title", prompts.clean);


			    $(".f-inp").on( "keyup change", function(e){
			    	(e.keyCode == 13)
			        	 ? execTblSearch():null;
			    });

			}














			obj	= $("#"+$.fn.pid+" .all-check");				//All-check check box.


//	#######################	FUNCTIONS	###########################################################
			/**
			 * calls TableDates searching utility
			 * @param DataTable table - object in which shearch is performed
			 * @param array sCols - indexes of searching columns
			 * @return void
			 */
			function execTblSearch(){
				$.fn.tbl.search( $("#"+$.fn.pid+"_filter input").val() );

				if( $.fn.isIndSearch )
//					for(var cn=0; cn < pE.searchCols.length; cn++ )
					for(var cn in pE.searchCols )
						$.fn.tbl.column(pE.searchCols[cn]).search( $('#'+$.fn.pid+"_inp_"+pE.searchCols[cn]).val());

				$.fn.tbl.draw();
			}
			//------------------------------------------------------------------

    	}
    });
})(jQuery);