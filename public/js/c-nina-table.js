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
 * 		string formTitle  (Optional) - create/edit record form title Default "".
 * 		string removeMessage - message, which fiered before records removing
 * 		string token (Mandatory)	- laravel security token.
 * 		array urls (Mandatory)	- urls for differnt actions:
 * 			"form"	- to show form action
 * 			"del"	- to delete action
 *
 *		array remove (Optional) - extra settings for non-standard removing (for examle archiving)
 *			"message"	- message after delete. May be function.
 *			"data"	- extra data which is sent to server by ajax
 *
 * @public function setDelBtnState - see description
 *
 * @example	- See /products/list.blade.php
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
    			,data_func	= function(srvData){}//Needed
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

			$("#"+pid+"_filter input").attr("id",pid+"_main_search_inp");

		    $("#"+pid+"_main_search_inp").unbind().on("keyup change", function(e){//Change main search input handler
				(e.keyCode == 13) ? execTblSearch():null;
			}).addClass("form-control").attr("placeholder", prompts.search );

		    $("#"+pid+"_length select").addClass("form-control");

		    $("#"+pid+"_filter")
		    	.prepend("<button id='"+pid+"_search_btn'></button>")//Main search button
		    	.append("<button id='"+pid+"_clean_btn'></button>")//Clean button for main search
		    	.prepend("<span id='"+pid+"_tools' class='tbl-tool-btns-span'></span>")//	Tool buttons container
		    	;

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
				$("#"+pid+"_main_search_inp").val("");
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
				$(table.column(chk_bx_col).header()).html('<input type="checkbox" id="'+pid+'_gen_chkbx">');	//	Drow general check-box for all secetion

				chkbx_obj	= $("#"+pid+"_gen_chkbx") //Initialize General check-box
					.on("click", function(e){
						$("#"+pid+" tbody td .row-check-box").prop('checked', $(this).is(':checked'));

						if($(this).is(':checked')){
							$("#"+pid+" tbody td .row-check-box").attr("title", prompts.desel);
							$(this).attr("title", prompts.desel_all);
						}else{
							$("#"+pid+" tbody td .row-check-box").attr("title", prompts.sel);
							$(this).attr("title", prompts.sel_all);
						}

						table.setDelBtnState();
					})
					.prop('checked', false)
					.attr("title", prompts.sel_all );

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



				$( document ).ajaxComplete(function(){
					//	Creating check-boxes for row selection.
					$("#"+pid+" tbody .checkboxtd").html("<input type='checkbox' class='row-check-box' />");

					$("#"+pid+" tbody td .row-check-box").on("click", function(e){
						var all_checked	= true, gtitle=prompts.desel_all;

						$(this).attr("title", $(this).is(':checked') ? prompts.desel : prompts.sel);

						$("#"+pid+" tbody td .row-check-box").each(function(){
							if( !$(this).is(':checked') ){
								all_checked	= false;
								gtitle=prompts.sel_all
								return false;
							}
						});

						chkbx_obj
							.prop('checked', all_checked )
							.attr("title", gtitle );

						table.setDelBtnState();
					});
					$("#"+pid+" tbody td .row-check-box").attr("title", prompts.sel );
				});

				//	Creating "Remove" button.
				$("#"+pid+"_tools").prepend("<button id='"+pid+"_remove_btn'></button>");
				$("#"+pid+"_remove_btn").button({
					icons: { primary: "ui-icon-trash" },
					text: false
				}).on( "click", function(e){
					var ids=[]
					,remove_message
					;

					$("#"+pid+" tbody td .row-check-box").each(function(){
						( $(this).is(':checked') )
							? ids.push($(this).parent("td").parent("tr").children("td").first().html()):null;
					});


					if( typeof pE.remove == "undefined")
						remove_message = messages.delete_recs(ids.length);

					else
						switch( typeof pE.remove.message ){
							case "undefined": remove_message = messages.delete_recs(ids.length);break;
							case "function": remove_message = pE.remove.message();break;
							default: remove_message = pE.remove.message;
						}

					remove_message	= 	'<div class="affirm-message-1">'+remove_message+'</div>'+
										'<div class="affirm-message-2">'+messages.confirm+'</div>'

					affirm(prompts.op_confirm, remove_message, function(){
						var to_srv_data;

						if( typeof pE.remove == "undefined")
							to_srv_data = null;

						else
							switch( typeof pE.remove.data ){
								case "undefined": to_srv_data = null;break;
								case "function": to_srv_data = pE.remove.data();break;
								default: to_srv_data = pE.remove.data;
							}

						to_srv_data	= {"_token":pE.token,"ids":ids,"data":to_srv_data};


					    $.ajax({
					        url : pE.urls.del,
					        type: "POST",
					        dataType: "json",
					        data : to_srv_data,
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
				}).attr("title", prompts.del );
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
					$(this).parent("tr").addClass("selected-tr");
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
				table.search( $("#"+pid+"_filter label input").val() );

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
					url: pE.urls.getform+"/"+pid+id_url,
					success: function(result){
						dform.html( result );
						
						$( "#"+pid+"form" ).append( '<button type="submit" id="btn_submit_'+pid+'">Sumbit</button>' );
						$("#btn_submit_"+pid).hide();
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
					title: id == null ? prompts.entry_new : prompts.entry_edit,
					close: function( event, ui ) {
						$("#"+pid+" tbody tr.selected-tr").removeClass("selected-tr");
					},

					buttons: [
					   {
						   text: prompts.save,
						   click: function(){
							   $("#btn_submit_"+pid).trigger( "click" );
						   }
					   }
					]
				}).dialog("open");
			}
			//------------------------------------------------------------------
//	#######################	PRIVATE FUNCTIONS (end)	###########################################################

			return table;
    	}
    });
})(jQuery);