<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<title>DUPAK &mdash; {{ config('app.name', 'Laravel') }}</title>

	{{-- for select2 --}}
	<link href="{{ asset('public/css/app.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/css/select2.css') }}" rel="stylesheet" type="text/css">


	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/my-login.css') }}">
	<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/select2.js') }}"></script>

	<script type="text/javascript">
		$(document).ready(function() {
      // Initialize "states" example
      var $states = $(".js-source-states");
      var statesOptions = $states.html();
      $states.remove();
      $(".js-states").append(statesOptions);
  });
</script>
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="{{ asset('assets/img/kementerian_logo.png') }}">
					</div>
					<div class="card fat">
						<div class="card-body">
							@yield('content')
						</div>
					</div>
					<div class="footer">
						Copyright &copy; Magang 2019
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/js/my-login.js')}}"></script>


</body>
</html>