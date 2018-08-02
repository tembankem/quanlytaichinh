<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>
	<!-- Bootstrap core CSS-->
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<!-- Custom fonts for this template-->
	<link href="{{ asset('/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
	<!-- Page level plugin CSS-->
	<link href="{{ asset('/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
	<!-- Custom styles for this template-->
	<link href="{{ asset('/css/sb-admin.css') }}" rel="stylesheet">
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
		<a class="navbar-brand" href="{{ url('/home') }}">{{ config('app.name','Quan Ly Tai Chinh') }}</a>
	    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	    </button>
	</nav>
</body>
</html>