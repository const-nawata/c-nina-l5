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


			obj	= $("#"+$.fn.pid+" .all-check");				//All-checking check-box.   rowcheckbox-

			if(obj){
				obj.on("click", function(e){		//Set onclick handler on "all rows" check-box
					$("#"+$.fn.pid+" .row-check-box").prop('checked', $(this).is(':checked'));
					setDelBtnState();
				}).prop('checked', false);

				//	There is no need in archive button if there are no row selboxes.						Delete
				$("#"+$.fn.pid+"_tools").prepend("<button id='"+$.fn.pid+"_arch_btn'></button>");
				$("#"+$.fn.pid+"_arch_btn").button({
					icons: { primary: "ui-icon-locked" },
					text: false
				}).on( "click", function(e){
//					removeRecords( table );
				}).attr("title", prompts.to_archive );

				setDelBtnState();


				$( document ).ajaxComplete(function(){
					$("#"+$.fn.pid+" .row-check-box").on("click", function(e){
						var all_checked=true;

						$("#"+$.fn.pid+" .row-check-box").each(function(){
							if( !$(this).is(':checked') ){
								all_checked	= false;
								return false;
							}
						});

						$("#"+$.fn.pid+" .all-check").prop('checked', all_checked );

						setDelBtnState();
					});
				});

			}

			//	Add new record button
			$("#"+$.fn.pid+"_tools").prepend("<button id='"+$.fn.pid+"_add_btn'></button>");
			$("#"+$.fn.pid+"_add_btn").button({
				icons: { primary: "ui-icon-circle-plus" },
				text: false
			}).on( "click", function(e){
				showTblRecForm( null );
			}).attr("title",prompts.add);


			//	Handler for edit row.
			$("#"+$.fn.pid+" tbody").on( 'click', 'td', function(){
				$("#"+$.fn.pid+" .selected").removeClass('selected');

				if ( !$(this).hasClass('unclickable') ){
					$("#"+$.fn.pid+" .row-check-box").prop('checked', false);
					$(this).parent('tr').addClass('selected');

					showTblRecForm( $.fn.tbl.cell( '.selected', 0 ).data() );
				}
			});




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
					for(var cn in pE.searchCols )
						$.fn.tbl.column(pE.searchCols[cn]).search( $('#'+$.fn.pid+"_inp_"+pE.searchCols[cn]).val());

				$.fn.tbl.draw();
			}
			//------------------------------------------------------------------

			/**
			 * sets state (enable/disable) of delete button due to state of row check-boxes.
			 * @param string pid - table HTML id.
			 * @returns	void
			 */
			function setDelBtnState(){
				var none_checked = true
					,fade_level=0.5;

				$("#"+$.fn.pid+" .row-check-box").each(function(){
					if( $(this).is(':checked') ){
						none_checked	= false;
						fade_level = 1.0;
						return false;//break each()
					}
				});

				$("#"+$.fn.pid+"_arch_btn").attr( "disabled", none_checked ).fadeTo( "fast", fade_level );

			}
			//------------------------------------------------------------------

			/**
			 * Shows popup dialog to edit table recod
			 * @param object table
			 * @param integer id - record id
			 * @returns void
			 */
			function showTblRecForm( id ){

				var tst
				,id_url	= id == null ? "" : "/"+id
				,dform_id = $.fn.pid+"-form-dialog"
				,dform
				;

				is_submit	= false;

				$('body').append("<div id='"+dform_id+"'></div>");

				if(!dform)
					dform	= $("#"+dform_id);

				$.ajax({
					url: pE.urls.form+"/"+$.fn.pid+id_url,
					success: function(result){
						dform.html( result );
					},

			    	error: function(){
						alert( "Internal Error" );//TODO: Process ajax error by standard response paramenters.
					}
				});


				dform.dialog({
					autoOpen: false,
					dialogClass: "dialog-form",
					width: typeof pE.formWidth != "undefined" ? pE.formWidth : 600,
					modal: true,
					title: typeof pE.formTitle != "undefined" ? pE.formTitle : "",

					buttons: [
					   {
						text: prompts.save,
						click: function(){
							$("#"+$.fn.pid+"form").submit();
						}
					}
					]
				}).dialog("open");

				$( document ).ajaxComplete(function(){

					$("#"+$.fn.pid+"form").submit(function(e){

						if( !is_submit ){
							is_submit	= true;

						    $.ajax({
						        url : $(this).attr("action"),
						        type: "POST",
						        data : $(this).serializeArray(),
						        success:function(data, textStatus, jqXHR){
						        	dform.dialog("close");
						        	inform( prompts.op_result, messages.save_success );//TODO: Get message from server. Like in remove handler.
						        	$.fn.tbl.ajax.reload(null,false);
						        },

						        error: function(jqXHR, textStatus, errorThrown){
						        	var err = jqXHR.responseJSON;

						        	for(var field_id in err ){
						        		inform( prompts.valid_error, err[field_id][0], field_id );
						        		break;
						        	}
						        }
						    });
						}

					    e.preventDefault(); //STOP default action
					});
				});

			}
			//------------------------------------------------------------------

    	}
    });
})(jQuery);