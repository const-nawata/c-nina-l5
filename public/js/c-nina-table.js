/**
 * extends DataTable functionality.
 * Sets additional controls for searching, creating, editing and deleting records.
 *
 * Deleting possibility needs extra item with name "checkbox" in "columns" array of pT parameter.
 * And for this purpose you must create extra th column (epmty) in the header of the table view.
 * @important "checkbox" number in "columns" array and "checkbox" th number must be the same!!!
 *
 * @param	JSON object pT - standard DataTable parameters. See API in https://legacy.datatables.net/
 * @param	JSON object pE - extended parameters needed for table tuning. This data includes next parameters:
 * 		array searchCols (Optional) - columns numbers which will be used for individual searching (start from 0).
 * 							For those columns text fields is created in the footer. So you must ctreate appropriate th colamnts (empty) in footer.
 * 		integer formWidth (Optional) - create/edit record form width in pixels. Default 600.
 * 		string formTitle  (Optional) - create/edit record form title Default "".
 * 		string token (Mandatory)	- laravel security token.
 * 		array urls (Mandatory)	- urls for differnt actions:
 * 			"form"	- to show form action
 * 			"del"	- to delete action
 *
 * @public function setDelBtnState - see description
 *
 * @example	- See /goods/list.blade.php
 *
 * @returns	void
 */
(function($){
    $.fn.extend({
    	cNinaTable: function(pT, pE){

    		var table
    			,pid		= $(this).attr("id")
    			,isIndivSch	= false
    			,chkbx_obj
    			,chk_bx_col	= -1
    			,data_func	= function(srvData){}
    			;

    		isIndivSch	= typeof pE.searchCols != "undefined" && pE.searchCols.length > 0;

    		for(var nc in pT.columns )
    			if(pT.columns[nc].name == "checkbox" ){
    				chk_bx_col	= parseInt(nc);
    				pT.columnDefs.push({"className":"checkboxtd unclickable center-align-sell", "targets": [chk_bx_col]});
    				pT.columnDefs.push({"orderable": false, "targets": [chk_bx_col] });
    				pT.columnDefs.push({"searchable": false, "targets": [chk_bx_col]});
    				break;
    			}

    		data_func	= ( typeof pT.ajax.data != "undefined")
    			? pT.ajax.data
    			: data_func;


    		pT.ajax.data	= function(srvData){//Data to send to server
    			data_func(srvData);
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

//	#######################	PUBLIC FUNCTIONS	###########################################################
			/**
			 * sets state (enable/disable) of delete button due to state of row check-boxes.
			 * @public
			 * @param string pid - table HTML id.
			 * @returns	void
			 */
			table.setDelBtnState = function (){
				var disabled_state = true
					,fade_level=0.5;

				$("#"+pid+" .row-check-box").each(function(){
					if( $(this).is(':checked') ){
						disabled_state	= false;
						fade_level = 1.0;
						return false;//break each()
					}
				});

				$("#"+pid+"_remove_btn").attr( "disabled", disabled_state ).fadeTo( "fast", fade_level );

			};
			//------------------------------------------------------------------
//	#######################	PUBLIC FUNCTIONS (end)	###########################################################

         	( chk_bx_col >= 0 )//	Drow general check-box
         		? $(table.column(chk_bx_col).header()).html('<input type="checkbox">'):null;

		    $("#"+pid+"_filter input").unbind().on("keyup change", function(e){//Change main search input handler
				(e.keyCode == 13) ? execTblSearch():null;
			}).addClass("form-control").attr("placeholder", prompts.search );

		    $("#"+pid+"_length select").addClass("form-control");

		    $("#"+pid+"_filter")
		    	.prepend("<button id='"+pid+"_search_btn'></button>")//Main search button
		    	.append("<button id='"+pid+"_clean_btn'></button>")//Clean button for main search
		    	.prepend("<span id='"+pid+"_tools' class='tbl-tool-btns-span'></span>");//	Tool buttons container

		    $("#"+pid+"_search_btn").button({				//Settings for Main search button
				icons: { primary: "ui-icon-search" },
				text: false
			}).on("click", function(e) {
				execTblSearch();
			}).attr("title", prompts.exec_search);

		    $("#"+pid+"_clean_btn").button({				//Settings for Clean button of main search
				icons: { primary: "ui-icon-cancel" },
				text: false
			}).on("click", function(e) {
				$("#"+pid+"_filter input").val("");
				execTblSearch();
			}).attr("title", prompts.clean);

			if( isIndivSch ){								//Set individual search inputs
				for(var cn in pE.searchCols ){
					$(table.column(pE.searchCols[cn]).footer()).html('<button class="ind-search-btn"></button><input class="form-control" type="text" placeholder="'+prompts.column_search+'" /><button class="ind-clean-btn">');

					$("input", table.column(pE.searchCols[cn]).footer())
						.attr("id", pid+"_inp_"+pE.searchCols[cn])
						.on( "keyup change", function(e){
							(e.keyCode == 13) ? execTblSearch():null;
						});

					//Individual clean buttons settings
					$(".ind-clean-btn", table.column(pE.searchCols[cn]).footer())
						.attr("id", pid+"cleanbtn-"+pE.searchCols[cn])
						.button({
							icons: { primary: "ui-icon-cancel" },
							text: false
						})
						.on( "click", function(e){
							var idd	= $(this).attr("id").split("-");
							$("#"+pid+"_inp_"+idd[1]).val("");
				        	execTblSearch();
						}).attr("title", prompts.clean);
				}

				//Individual search buttons settings
			    $(".ind-search-btn").button({
					icons: { primary: "ui-icon-search" },
					text: false
				}).on( "click", function(e){
					execTblSearch();
			    }).attr("title", prompts.exec_search);
			}

			if(chk_bx_col >= 0){	//	Creating check-boxes for row selection and "Remove" button to remove rows.
				chkbx_obj	= $("#"+pid+" thead .checkboxtd input") //Initialize General check-box
					.on("click", function(e){
						$("#"+pid+" tbody td .row-check-box").prop('checked', $(this).is(':checked'));
						table.setDelBtnState();
					}).prop('checked', false);



				$( document ).ajaxComplete(function(){
					//	Creating check-boxes for row selection.
					$("#"+pid+" tbody .checkboxtd").html("<input type='checkbox' class='row-check-box' />");

					$("#"+pid+" tbody td .row-check-box").on("click", function(e){
						var all_checked	= true;

						$("#"+pid+" tbody td .row-check-box").each(function(){
							if( !$(this).is(':checked') ){
								all_checked	= false;
								return false;
							}
						});

						chkbx_obj.prop('checked', all_checked );

						table.setDelBtnState();
					});
				});

				//	Creating "Remove" button.
				$("#"+pid+"_tools").prepend("<button id='"+pid+"_remove_btn'></button>");
				$("#"+pid+"_remove_btn").button({
					icons: { primary: "ui-icon-locked" },
					text: false
				}).on( "click", function(e){
					var ids=[];

					$("#"+pid+" tbody td .row-check-box").each(function(){
						( $(this).is(':checked') )
							? ids.push($(this).parent("td").parent("tr").children("td").first().html()):null;
					});

					affirm(prompts.op_confirm, messages.arch_recs(ids.length)+"<br />"+"<b>"+messages.confirm+"</b>", function(){
					    $.ajax({
					        url : pE.urls.del,
					        type: "POST",
					        dataType: "json",
					        data : {"_token":pE.token,"ids":ids},
					        success:function(data, textStatus, jqXHR){
					        	var resp = jqXHR.responseJSON;

					        	inform( prompts.op_result, resp.message );

					        	table.ajax.reload(function(json){
					        		table.setDelBtnState();
					        	});
					        },

					        error: function(jqXHR, textStatus, errorThrown){
					        	var err = jqXHR.responseJSON;
					        	inform( prompts.sys_error, errorThrown );
					        }
					    });
					});

				}).attr("title", prompts.to_archive );
				table.setDelBtnState();
			}

			//	Creating "Add New Record" button
			$("#"+pid+"_tools").prepend("<button id='"+pid+"_add_btn'></button>");
			$("#"+pid+"_add_btn").button({
				icons: { primary: "ui-icon-circle-plus" },
				text: false
			}).on( "click", function(e){
				showTblRecForm( null );
			}).attr("title",prompts.add);

			//	Handler to start row item editing.
			$("#"+pid+" tbody").on( 'click', 'td', function(){
				if ( !$(this).hasClass('unclickable') ){
					$("#"+pid+" .row-check-box").prop('checked', false);
					showTblRecForm( $(this).parent("tr").children("td").first().html());
					table.setDelBtnState();
				}
			});

//	#######################	PRIVATE FUNCTIONS	###########################################################
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
//	#######################	PRIVATE FUNCTIONS (end)	###########################################################

			return table;
    	}
    });
})(jQuery);