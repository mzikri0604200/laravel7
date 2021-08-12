<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	{{-- <title>@yield('title')</title> --}}
	<title>{{ $title ?? "Blog Zikri"}}</title>

	<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	@yield('head')

</head>
<body>
	@include('layouts.navigation')
	
	<div class="py-4">
		@include('alert')
		@yield('content')
	</div>
	
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>

	<script>
		$(document).ready(function() {
			$('.select2').select2({
				placeholder: "Choose some tags"
			});
		});
	</script>
	
</body>
</html>