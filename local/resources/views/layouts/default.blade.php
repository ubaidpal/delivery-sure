<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{--<meta name="google-site-verification" content="a9X8bvVPeHLB5ZSCGJrkUSMG5mnktH-yhVDBDpRiABA" />--}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @yield('meta')
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@if(isset($title)) {{ $title }} @else Dashboard @endif :: Delivery Sure</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{!! asset('local/public/assets/css/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('local/public/assets/css/font-awesome.css') !!}">
    @yield('styles')

</head>

<?php $class = 'purchaser-theme' ?>
@if(Auth::check() && !empty($user))
    @if($user->is('delivery.man'))
        <?php $class = 'rider-theme' ?>
    @elseif($user->is('retailer'))
        <?php $class = 'retailer-theme' ?>
    @else
        <?php $class = 'purchaser-theme' ?>
    @endif
@endif
<body class="{{$class}}">


<!-- Header -->
@if(Auth::check())
    @include('includes.header-default')
@else
    @include('includes.header-home')
@endif
<!-- DashBoard -->
<div class="dashboard mt50" id="dashboard" data-lat="{{config('constant_settings.DEFAULT_LATITUDE')}}"
     data-lng="{{config('constant_settings.DEFAULT_LONGITUDE')}}">
    <div class="container">
        <div class="row">
            <!-- Content -->
            @yield('content')

        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.dashboard -->

<!-- Footer -->

@include('includes.footer-default')

<script src="{!! asset('local/public/assets/js/jquery-1-11-3.js') !!}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->

<script src="{!! asset('local/public/assets/js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('local/public/assets/js/custom.js') !!}"></script>
<script src="{!! asset('local/public/assets/js/bootstrap/dropdown.js') !!}"></script>


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<!-- Include all compiled plugins (below), or include individual files as needed -->

{!! HTML::script('local/public/assets/js/scripts.js') !!}
{!! HTML::script('local/public/assets/js/y-map.js') !!}
@yield('footer-scripts')
@if(!Auth::check())
    @include('auth.login-modal')
@endif
<style media="all" type="text/css">
    .nopadding {
        padding: 0 !important;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .checked-through {
        text-decoration: line-through;
    }
</style>
</body>
</html>
