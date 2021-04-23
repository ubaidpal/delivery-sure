<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>DeliverySure @yield('title')</title>

    <!-- Bootstrap -->
	<link rel="stylesheet" href="{!! asset('local/public/assets/css/style.css') !!}">
	<link rel="stylesheet" href="{!! asset('local/public/assets/css/font-awesome.css') !!}">	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{!! asset('local/public/assets/js/jquery-1-11-3.js') !!}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    
    <script src="{!! asset('local/public/assets/js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('local/public/assets/js/custom.js') !!}"></script>
    
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div>
<!-- Header -->
@include('includes.header-blank')

<!-- Content -->
	@yield('content')
@yield('script')
</div>
</body>
</html>
