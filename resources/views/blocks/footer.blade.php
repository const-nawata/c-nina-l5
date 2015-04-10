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


//TODO: Move all prompts from tbl_prompts to prompts and then move tbl_prompts to c-nina.js
// And I think that it would be better to move var promts to the head of the layout.

var prompts	= {
	"close":"{{ @trans('prompts.close') }}"
	,"empty_table":"{{ @trans('prompts.empty_table') }}"
	,"search":"{{ @trans('prompts.search') }}"
}

,tbl_prompts = {
	"emptyTable":prompts.empty_table	// And so on
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