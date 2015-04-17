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
	,"clean":"{{ @trans('prompts.clean') }}"
	,"close":"{{ @trans('prompts.close') }}"
	,"del":"{{ @trans('prompts.delete') }}"
	,"empty_table":"{{ @trans('prompts.empty_table') }}"
	,"exec_search":"{{ @trans('prompts.exec_search') }}"
	,"info":"{{ @trans('prompts.info') }}"
	,"info_empty":"{{ @trans('prompts.info_empty') }}"
	,"info_filtered":"{{ @trans('prompts.info_filtered') }}"
	,"length_menu":"{{ @trans('prompts.length_menu') }}"
	,"loading_records":"{{ @trans('prompts.loading_records') }}"

	,"paginate":{
        "first":"{{ @trans('prompts.paginate.first') }}",
        "last":"{{ @trans('prompts.paginate.last') }}",
        "next":"{{ @trans('prompts.paginate.next') }}",
        "previous":"{{ @trans('prompts.paginate.previous') }}"
	}

	,"processing":"{{ @trans('prompts.processing') }}"
	,"save":"{{ @trans('prompts.save') }}"
	,"search":"{{ @trans('prompts.search') }}"
	,"to_archive":"{{ @trans('prompts.to_archive') }}"
	,"zero_records":"{{ @trans('prompts.zero_records') }}"
}
</script>

	<link rel="stylesheet" href="/css/c-nina-main.css">
	<script src="/js/c-nina.js"></script>

@yield('headExtra')
</head>
<body>

<div class="upper-page-line"></div>
