/**
 *
 */

(function($){
//	$.fn.pick_obj	= null;
//	$.fn.timeoutID;

	$.fn.pid	= null;
	$.fn.tbl	= null;

    $.fn.extend({
    	cNinaTable: function(pT, pE){
    		$.fn.pid	= $(this).attr("id");

    		pT.ajax.data=function(srvData){
 	            srvData.pid	= $.fn.pid;
         	};

         	$.fn.tbl	= $(this).DataTable(pT);

		    $("#"+$.fn.pid+"_filter input").unbind().on("keyup change", function(e){//Change main search input handler
				(e.keyCode == 13) ? execTblSearch():null;
			}).addClass("form-control").attr("placeholder", prompts.search );



//	#######################	FUNCTIONS	###########################################################
			/**
			 * calls TableDates searching utility
			 * @param DataTable table - object in which shearch is performed
			 * @param array sCols - indexes of searching columns
			 * @return void
			 */
			function execTblSearch(){
				$.fn.tbl.search( $("#"+$.fn.pid+"_filter input").val() );

				if( typeof pE.searchCols != "undefined" && pE.searchCols.length > 0 )
					for(var cn=0; cn < pE.searchCols.length; cn++ )
						$.fn.tbl.column(pE.searchCols[cn]).search( $('#'+$.fn.pid+"_inp_"+pE.searchCols[cn]).val());

				$.fn.tbl.draw();
			}
			//------------------------------------------------------------------

    	}
    });
})(jQuery);