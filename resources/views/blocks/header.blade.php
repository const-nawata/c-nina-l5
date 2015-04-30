<!DOCTYPE html>
<html>
<head>
	<title>@yield('title') — {{ @trans('prompts.brand') }}</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<meta content="text/html; charset=utf-8" http-equiv="content-type">
	<meta name="keywords" content="магазин,контейтер,764,Нина,калиновский,базар,черновцы,чернівці">
	<meta name="description" content="Контейнер 764. Продажа тапочек оптом и в розницу.">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- jQuery & jQuery UI -->
	<script src="http://code.jquery.com/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>

	<!-- Bootstrap -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>

	<link rel="stylesheet" href="//cdn.datatables.net/1.10.6/css/jquery.dataTables.css">
	<script src="//cdn.datatables.net/1.10.6/js/jquery.dataTables.min.js" type="text/javascript" charset="utf-8"></script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->


<script type="text/javascript">
var prompts	= {
	"add":"{{ @trans('prompts.add') }}"
	,"archive":"{{ @trans('prompts.archive') }}"
	,"clean":"{{ @trans('prompts.clean') }}"
	,"close":"{{ @trans('prompts.close') }}"
	,"column_search":"{{ @trans('prompts.column_search') }}"
	,"del":"{{ @trans('prompts.delete') }}"
	,"desel_all":"{{ @trans('prompts.desel_all') }}"
	,"desel":"{{ @trans('prompts.desel') }}"
	,"entry_edit":"{{ @trans('prompts.entry_edit') }}"
	,"entry_new":"{{ @trans('prompts.entry_new') }}"
	,"empty_table":"{{ @trans('prompts.empty_table') }}"
	,"exec_search":"{{ @trans('prompts.exec_search') }}"
	,"info":"{{ @trans('prompts.info') }}"
	,"info_empty":"{{ @trans('prompts.info_empty') }}"
	,"info_filtered":"{{ @trans('prompts.info_filtered') }}"
	,"length_menu":"{{ @trans('prompts.length_menu') }}"
	,"loading_records":"{{ @trans('prompts.loading_records') }}"
	,"no":"{{ @trans( 'prompts.no' ) }}"
	,"op_confirm": "{{ @trans('prompts.op_confirm') }}"
	,"op_result": "{{ @trans('prompts.op_result') }}"

	,"paginate":{
        "first":"{{ @trans('prompts.paginate.first') }}",
        "last":"{{ @trans('prompts.paginate.last') }}",
        "next":"{{ @trans('prompts.paginate.next') }}",
        "previous":"{{ @trans('prompts.paginate.previous') }}"
	}

	,"processing":"{{ @trans('prompts.processing') }}"
	,"recs":{
		"sn":"{{ @trans('prompts.recs.sn') }}",
		"pl24":"{{ @trans('prompts.recs.pl24') }}",
		"pl":"{{ @trans('prompts.recs.pl') }}"
	}
	,"save":"{{ @trans('prompts.save') }}"
	,"search":"{{ @trans('prompts.search') }}"
	,"sel_all":"{{ @trans('prompts.sel_all') }}"
	,"sel":"{{ @trans('prompts.sel') }}"
	,"show_active":"{{ @trans('prompts.show_active') }}"
	,"show_arch":"{{ @trans('prompts.show_arch') }}"
	,"sys_error":"{{ @trans('prompts.sys_error') }}"
	,"to_active":"{{ @trans('prompts.to_active') }}"
	,"to_archive":"{{ @trans('prompts.to_archive') }}"
	,"valid_error":"{{ @trans('prompts.valid_error') }}"
	,"yes":"{{ @trans( 'prompts.yes' ) }}"
	,"zero_records":"{{ @trans('prompts.zero_records') }}"

}
,messages={
	"confirm": "{{ @trans('messages.confirm') }}"
	,"save_success": "{{ @trans('messages.save_success') }}"
	,"archivate_recs":function(nrecs){return setRemoveMessageParams("{{ @trans('messages.archivate_recs') }}", nrecs);}
	,"activate_recs":function(nrecs){return setRemoveMessageParams("{{ @trans('messages.activate_recs') }}", nrecs);}
	,"delete_recs":function(nrecs){return setRemoveMessageParams("{{ @trans('messages.delete_recs') }}", nrecs);}
};

function setRemoveMessageParams(message, nrecs){
	var
	result,factor;

	result	= message.replace( ":nrecs", nrecs );
	factor	= (nrecs % 10);

	switch( factor ){
		case 1: result	= result.replace( ":recs", "{{ @trans('prompts.recs.sn') }}" );	break;

		case 2:
		case 3:
		case 4: result	= result.replace( ":recs", "{{ @trans('prompts.recs.pl24') }}" );	break;

		default:
			result	= result.replace( ":recs", "{{ @trans('prompts.recs.pl') }}" );
	}
	return result;
}
</script>

	<link rel="stylesheet" href="/css/c-nina-main.css">
	<script src="/js/c-nina.js"></script>
	<script src="/js/c-nina-table.js"></script>

@yield('headExtra')
</head>
<body>

<div class="upper-page-line"></div>
