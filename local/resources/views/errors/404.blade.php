<!DOCTYPE html>
<!--
* OOPS - Perfect 404 pages Pack
* Build Date: October 2016
* Last Update: October 2016
* Author: Madeon08 for ThemeHelite
* Copyright (C) 2016 ThemeHelite
* This is a premium product available exclusively here : http://themeforest.net/user/Madeon08/portfolio
* -->
<html lang="en-us" class="no-js">

<head>
    <meta charset="utf-8">
    <title>404 Not found</title>
    <meta name="description" content="The description should optimally be between 150-160 characters.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="ThemeHelite">

    <!-- ================= Favicons ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="{{asset('local/public/assets/images/404/404/favicon.png')}}">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('local/public/assets/images/404/favicon-retina-ipad.png')}}">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('local/public/assets/images/404/favicon-retina-iphone.png')}}">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('local/public/assets/images/404/favicon-standard-ipad.png')}}">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('local/public/assets/images/404/favicon-standard-iphone.png')}}">

    <!-- ============== Resources style ============== -->
    <link rel="stylesheet" type="text/css" href="{{asset('local/public/assets/css/404/style.css')}}" />
</head>

<body>

<div class="image"></div>

<!-- Your logo on the top left -->
<a href="{{url('/')}}" class="logo-link" title="back home">

    <img src="{{asset('local/public/assets/images/404/logo.png')}}" class="logo" alt="Company's logo" />

</a>

<div class="content">

    <div class="content-box">

        <div class="big-content">

            <!-- Main squares for the content logo in the background -->
            <div class="list-square">
                <span class="square"></span>
                <span class="square"></span>
                <span class="square"></span>
            </div>

            <!-- Main lines for the content logo in the background -->
            <div class="list-line">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>

            <!-- The animated searching tool -->
            <i class="fa fa-search" aria-hidden="true"></i>

            <!-- div clearing the float -->
            <div class="clear"></div>

        </div>

        <!-- Your text -->
        <h1>Oops! Error 404 not found.</h1>

        <p>The page you were looking for doesn't exist.<br>
            We think the page may have moved.</p>

    </div>

</div>

<footer class="light">

    <ul>
        <li><a href="{{url('/')}}">Home</a></li>

       {{-- <li><a href="#">Search</a></li>

        <li><a href="#">Help</a></li>

        <li><a href="#">Trust & Safety</a></li>

        <li><a href="#">Sitemap</a></li>--}}

        <li><a href="#"><i class="fa fa-facebook"></i></a></li>

        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
    </ul>

</footer>

<!-- ///////////////////\\\\\\\\\\\\\\\\\\\ -->
<!-- ********** jQuery Resources ********** -->
<!-- \\\\\\\\\\\\\\\\\\\/////////////////// -->

<!-- * Libraries jQuery and Bootstrap - Be careful to not remove them * -->
<script src="{!! asset('local/public/assets/js/jquery-1-11-3.js') !!}"></script>
<script src="{!! asset('local/public/assets/js/bootstrap.min.js') !!}"></script>

</body>

</html>
