<?php
/**
 * Main Footer layout
 */
?>

<div id="footer">
	<div class="container">
		<div class="col-md-4">&copy; 2015 {{ @trans('prompts.brand') }}</div>
	</div>
</div>

<div id="standard-dialog"></div>


</body>
<?php
/*									//	Not translated prompts for DataTable ajax
    "infoPostFix":    "",
    "thousands":      ",",

    "aria": {
        "sortAscending":  ": activate to sort column ascending",
        ,"search":"{{ @trans('prompts.search') }}"
        "sortDescending": ": activate to sort column descending"
    }
*/
?>
<script type="text/javascript">
var tbl_prompts = {
	"emptyTable":"{{ @trans('prompts.empty_table') }}"
	,"infoEmpty":"{{ @trans('prompts.info_empty') }}"

	,"info":"{{ @trans('prompts.info') }}"
	,"infoFiltered":"{{ @trans('prompts.info_filtered') }}"
	,"zeroRecords":"{{ @trans('prompts.zero_records') }}"
	,"search":""
	,"lengthMenu":"{{ @trans('prompts.length_menu') }}"
	,"processing":"{{ @trans('prompts.processing') }}"
	,"loadingRecords": "{{ @trans('prompts.loading_records') }}"

    ,"paginate":{
        "first":"{{ @trans('prompts.paginate.first') }}",
        "last":"{{ @trans('prompts.paginate.last') }}",
        "next":"{{ @trans('prompts.paginate.next') }}",
        "previous":"{{ @trans('prompts.paginate.previous') }}"
    }
};

function showAlert( title, message, width ){
	var d_width	= width ? width : 400;

	$("#standard-dialog").dialog( "option", "width", d_width+"px" );
    $("#standard-dialog").html( message );
    $("#standard-dialog" ).dialog( "option", "title", title );
    $("#standard-dialog").dialog("open");

	$( "#standard-dialog" ).dialog( "option", "buttons",[
		{
			text: "{{ @trans( 'prompts.close' ) }}",
			click: function(){
				$(this).dialog("close");
			}
		}
	]);
}

$(document).ready(function(){

	$("#standard-dialog").dialog({
		autoOpen: false,
		dialogClass: "no-close",
		modal: true
	});

});

</script>
@yield('js_extra')
</html>