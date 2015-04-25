(function($){
    $.fn.extend({
/**
 * extends DataTable functionality.
 * @param	JSON object pT - standard DataTable parameters.
 * @param	JSON object pE - extended parameters needed for table tuning.
 * @returns	void
 */
    	cNinaTable: function(pT, pE){

    		var table
    			,pid		= $(this).attr("id")
    			,isIndivSch	= false
    			;

    		isIndivSch	= typeof pE.searchCols != "undefined" && pE.searchCols.length > 0;

    		pT.ajax.data=function(srvData){//Data to send to server
 	            srvData.pid	= pid;
         	};

         	pT.language	= {
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


         	table	= $(this).DataTable(pT);//						Start table creating ###############################################

		    $("#"+pid+"_filter input").unbind().on("keyup change", function(e){//Change main search input handler
				(e.keyCode == 13) ? execTblSearch():null;
			}).addClass("form-control").attr("placeholder", prompts.search );

		    $("#"+pid+"_length select").addClass("form-control");

		    $("#"+pid+"_filter")
		    	.prepend("<button id='"+pid+"_search_btn'></button>")//Main search button
		    	.append("<button id='"+pid+"_clean_btn'></button>")//Clean button for main search
		    	.prepend("<span id='"+pid+"_tools' class='tbl-tool-btns-span'></span>");//	Tool buttons container

		    $("#"+pid+"_search_btn").button({				//Settings of Main search button
				icons: { primary: "ui-icon-search" },
				text: false
			}).on("click", function(e) {
				execTblSearch();
			}).attr("title", prompts.exec_search);

		    $("#"+pid+"_clean_btn").button({				//Settings of Clean button for main search
				icons: { primary: "ui-icon-cancel" },
				text: false
			}).on("click", function(e) {
				$("#"+pid+"_filter input").val("");
				execTblSearch();
			}).attr("title", prompts.clean);

			if( isIndivSch ){								//Set handlers for individual search inputs

				for(var cn in pE.searchCols ){
					$("input", table.column(pE.searchCols[cn]).footer()).attr("id", pid+"_inp_"+pE.searchCols[cn]);

					$(".ind-clean-btn", table.column(pE.searchCols[cn]).footer())
						.attr("id", pid+"cleanbtn-"+pE.searchCols[cn])
						.on( "click", function(e){
							var idd	= $(this).attr("id").split("-");
							$("#"+pid+"_inp_"+idd[1]).val("");
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


			obj	= $("#"+pid+" .all-check");				//All-checking check-box.   rowcheckbox-

			if(obj){
				obj.on("click", function(e){		//Set onclick handler on "all rows" check-box
					$("#"+pid+" .row-check-box").prop('checked', $(this).is(':checked'));
					setDelBtnState();
				}).prop('checked', false);

				//	There is no need in archive button if there are no row selboxes.						Delete
				$("#"+pid+"_tools").prepend("<button id='"+pid+"_arch_btn'></button>");
				$("#"+pid+"_arch_btn").button({
					icons: { primary: "ui-icon-locked" },
					text: false
				}).on( "click", function(e){
					var del_data
					,ids=[]
					;

					$("#"+pid+" .row-check-box").each(function(){
						var idd;

						if( $(this).is(':checked') ){
							idd	= $(this).attr("id").split("-");
							ids.push(idd[1]);
						}
					});

					del_data	= {
						'_token':pE.token,
						"ids":ids
					};

				    $.ajax({
				        url : pE.urls.del,
				        type: "POST",
				        dataType: "json",
				        data : del_data,
				        success:function(data, textStatus, jqXHR){
				        	var resp = jqXHR.responseJSON;

				        	inform( prompts.op_result, resp.message );

				        	table.ajax.reload(function(json){
				        		setDelBtnState();
				        	});
				        },

				        error: function(jqXHR, textStatus, errorThrown){
				        	var err = jqXHR.responseJSON;
				        	inform( prompts.sys_error, errorThrown );
				        }
				    });
				}).attr("title", prompts.to_archive );

				$( document ).ajaxComplete(function(){// Row check-boxes handlers.

					$("#"+pid+" .row-check-box").on("click", function(e){
						var all_checked=true;

						$("#"+pid+" .row-check-box").each(function(){
							if( !$(this).is(':checked') ){
								all_checked	= false;
								return false;
							}
						});

						$("#"+pid+" .all-check").prop('checked', all_checked );

						setDelBtnState();
					});
				});

				setDelBtnState();

			}

			//	Add new record button
			$("#"+pid+"_tools").prepend("<button id='"+pid+"_add_btn'></button>");
			$("#"+pid+"_add_btn").button({
				icons: { primary: "ui-icon-circle-plus" },
				text: false
			}).on( "click", function(e){
				showTblRecForm( null );
			}).attr("title",prompts.add);


			//	Handler for edit row.
			$("#"+pid+" tbody").on( 'click', 'td', function(){
				$("#"+pid+" .selected").removeClass('selected');

				if ( !$(this).hasClass('unclickable') ){
					$("#"+pid+" .row-check-box").prop('checked', false);
					$(this).parent('tr').addClass('selected');

					showTblRecForm( table.cell( '.selected', 0 ).data() );
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
				table.search( $("#"+pid+"_filter input").val() );

				if( isIndivSch )
					for(var cn in pE.searchCols )
						table.column(pE.searchCols[cn]).search( $('#'+pid+"_inp_"+pE.searchCols[cn]).val());

				table.draw();
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

				$("#"+pid+" .row-check-box").each(function(){
					if( $(this).is(':checked') ){
						none_checked	= false;
						fade_level = 1.0;
						return false;//break each()
					}
				});

				$("#"+pid+"_arch_btn").attr( "disabled", none_checked ).fadeTo( "fast", fade_level );

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
				,dform_id = pid+"-form-dialog"
				,dform
				;

				is_submit	= false;

				$('body').append("<div id='"+dform_id+"'></div>");

				if(!dform)
					dform	= $("#"+dform_id);

				$.ajax({
					url: pE.urls.form+"/"+pid+id_url,
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
							$("#"+pid+"form").submit();
						}
					}
					]
				}).dialog("open");

				$( document ).ajaxComplete(function(){

					$("#"+pid+"form").submit(function(e){

						if( !is_submit ){
							is_submit	= true;

						    $.ajax({
						        url : $(this).attr("action"),
						        type: "POST",
						        data : $(this).serializeArray(),
						        success:function(data, textStatus, jqXHR){
						        	dform.dialog("close");
						        	inform( prompts.op_result, messages.save_success );//TODO: Get message from server. Like in remove handler.
						        	table.ajax.reload(null,false);
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