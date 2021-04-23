<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @yield('meta')
    <meta name="google-site-verification" content="a9X8bvVPeHLB5ZSCGJrkUSMG5mnktH-yhVDBDpRiABA"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@if(isset($title)){{$title}}@endif :: Delivery Sure </title>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{!! asset('local/public/assets/css/demo.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('local/public/assets/css/styles.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('local/public/assets/css/animate.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('local/public/assets/css/style.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('local/public/assets/css/font-awesome.css') !!}">
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-81206710-1', 'auto');
        ga('send', 'pageview');

    </script>
</head>
<body class="purchaser-theme" onload="startTime();">


<!-- Content -->
@yield('content')

        <!-- Header -->
@include('includes.header-landing')

        <!-- Footer -->
@include('includes.footer-landing')

<script src="{!! asset('local/public/assets/js/jquery-1-11-3.js') !!}"></script>
<script type="text/javascript" src="{!! asset('local/public/assets/js/jquery.flexslider-min.js') !!}"></script>
<script src="{!! asset('local/public/assets/js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('local/public/assets/js/custom.js') !!}"></script>

<script type="text/javascript" charset="utf-8">
    var $ = jQuery.noConflict();
    $(window).load(function () {
        $('.flexslider').flexslider({
            animation: "fade"
        });

        $(function () {
            $('.show_menu').click(function () {
                $('.menu').fadeIn();
                $('.show_menu').fadeOut();
                $('.hide_menu').fadeIn();
            });
            $('.hide_menu').click(function () {
                $('.menu').fadeOut();
                $('.show_menu').fadeIn();
                $('.hide_menu').fadeOut();
            });
        });
    });
</script>

@include('auth.login-modal')
@yield('script')
@yield('footer-content')
</body>
</html>
