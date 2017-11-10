<!doctype html>
<html lang="en">
<head>
	@include('layouts.head')

	<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.css') }}">
	<link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
	

	@stack('style')
	
	<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		@include('layouts.navbar')
		@include('layouts.sidebar')
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		@yield('sidebar')
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			@yield('content')
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	@include('layouts.scripts')

	
	<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>

	@yield('script')
</body>

</html>
