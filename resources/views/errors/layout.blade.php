<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/error.css') }}" rel="stylesheet">

</head>

<body>
	<div class="containerError">

		@yield('content')

	</div>
</body>
</html>