{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 29-Jun-16 4:31 PM
    * File Name    : 

--}}
@extends('layouts.home')

@section('content')
        <!-- Featured Image -->
<div class="featured">
    <div class="full-width-img">
        <img src="{!! asset('local/public/assets/images/index-images/index-purchaser-banner.png') !!}" alt="image">
    </div><!-- /.full-width-img -->
    <div class="featured-content">
        <div class="featured-content-wrapper">
            <h4 class="h1">Get a break, get it delivered!</h4>

            <div class="landing-content hidden-xs">
                <p>
                    Not everyone works 12 hours a day, helps children with homework, prepares for a job interview,
                    does laundry, pays bills,<br/>attends patients, mows the lawn or runs to the second job every day.
                    But everyone deserves a break from those trips to the mart,<br/>chemist or the book store.
                    Small breaks have now been made easier with DELIVERY SURE. Post a job, receive the items, GET A
                    BREAK.
                </p>
            </div>
            @if(Session::get('accessGranted') || (!env('ACCESS_ENABLED') && !Session::get('accessGranted')))
                <a class="btn btn-green signup" data-target="#modalSignUp" data-toggle="modal" href="javascript:void(0);">Sign up</a>
            @endif
        </div><!-- /.featured-content-wrapper -->
    </div><!-- /.featured-content -->
</div><!-- /.featured -->

<!-- How it works -->
<div class="how-it-works" id="how-it-works">
    <div class="container">
        <div class="index-container-header">
            <div class="h2">How it works</div>
            <p>4 simple ways to learn about DeliverySure delivery application</p>
        </div><!-- /.index-container-header -->
		<section class="autoplay slider slick-slider">
            <div>
              <div class="col-md-12 col-sm-6">
                <a class="icon-item" href="javascript:void(0);">
                    <!--<div class="icon-item-img create"></div>-->
                    <div class="h3">Create</div>
                    <div class="h3">a list of items</div>
                    <p>Make a list of items you need delivered to your desired location at your desired time.</p>
                    <img src="{!! asset('local/public/assets/images/index-images/iPhone-1.png') !!}" width="auto" height="auto"/>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-3 -->
            </div>
            <div>
              <div class="col-md-12 col-sm-6">
                <a class="icon-item" href="javascript:void(0);">
                    <!--<div class="icon-item-img find"></div>-->
                    <div class="h3">Find</div>
                    <div class="h3">a delivery person</div>
                    <p>Sit back and receive quotes from people willing to delivery your items in under an hour.</p>
                    <img src="{!! asset('local/public/assets/images/index-images/iPhone-1.png') !!}" width="auto" height="auto"/>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-3 -->
            </div>
            <div>
              <div class="col-md-12 col-sm-6">
                <a class="icon-item" href="javascript:void(0);">
                    <!--<div class="icon-item-img received"></div>-->
                    <div class="h3">Receive</div>
                    <div class="h3">items in mins</div>
                    <p>Receive your items at your doorstep in less than an hour with guaranteed satisfaction.</p>
                    <img src="{!! asset('local/public/assets/images/index-images/iPhone-1.png') !!}" width="auto" height="auto"/>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-3 -->
            </div>
            <div>
            	<div class="col-md-12 col-sm-6">
                    <a class="icon-item" href="javascript:void(0);">
                        <!--<div class="icon-item-img pay"></div>-->
                        <div class="h3">Pay</div>
                        <div class="h3">small delivery fees</div>
                        <p>Pay a small delivery fee and enable yourself to save time and energy.</p>
                        <img src="{!! asset('local/public/assets/images/index-images/iPhone-1.png') !!}" width="auto" height="auto"/>
                    </a><!-- /.icon-item -->
                </div><!-- /.col-md-3 -->  
            </div>
        </section>
    </div><!-- /.container -->
</div>
<?php /*?><!-- Choose from Drivers offers -->
<div class="choose-from">
    <div class="container">
        <div class="row">
            <div class="col-md-5 hidden-xs">
                <img src="{!! asset('local/public/assets/images/index-images/iphone_2.png') !!}" width="auto"
                     height="auto">
            </div>
            <div class="col-md-7">
                <div class="content-side">
                    <h1>Place order and choose your delivery person</h1>

                    <p>Once you have made a list of the required items and placed the job for people to bid on, you can
                        literally expect responses within minutes. You can choose the delivery person of your liking
                        based you several preferences like delivery time, budget and the local street knowledge in case
                        there’s a hard to find item on your list. You delivery person could be your neighbor, coworker,
                        friend or relative. Such factors allow you a degree of trust and satisfaction that encourages
                        you to opt for ‘delivery sure’ time and time again.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Pick a time -->
<div class="choose-from">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="content-side">
                    <h1>Choose your time, pickup location and destination</h1>

                    <p>The idea behind Delivery Sure is to provide the purchaser with comfort and peace of mind as far
                        as sourcing and delivering the required items are concerned. Delivery Sure does not just allow
                        you a large number of delivery options, it also allows you a fair degree of control over the
                        delivery ‘method’. As you make a list of item you need delivered you can also inform the
                        delivery person regarding your preferred delivery time, your preferred pickup location for the
                        listed items as well as the destination you want to receive the items at. This allows the
                        purchaser a fair amount of satisfaction as far as the pricing and the quality of the listed
                        items is concerned. Preferred delivery time allows for better time management for the purchaser
                        and the delivery person.</p>
                </div>
            </div>
            <div class="col-md-5 hidden-xs">
                <img src="{!! asset('local/public/assets/images/index-images/iphone_3.png') !!}" width="auto"
                     height="auto">
            </div>
        </div>
    </div>
</div>

<!--Track your stuff  -->
<div class="choose-from pb50">
    <div class="container">
        <div class="row">
            <div class="col-md-5 hidden-xs">
                <img src="{!! asset('local/public/assets/images/index-images/iphone_4.png') !!}" width="auto"
                     height="auto">
            </div>
            <div class="col-md-7">
                <div class="content-side">
                    <h1>Track Your delivery order</h1>

                    <p>How often do you come across a delivery service that allows you to track and monitor the delivery
                        while it is being made? It is not a very common service being offered. Nevertheless, now you can
                        track your order around every corner, across every traffic light, under every bridge, over every
                        flyover, past every crossing and down every step. Once your items have been picked up by the
                        delivery person he/she will update the status of the items i.e. purchased/collected. From this
                        point onwards the Delivery Sure app will allow you to track/see your order on the map. The map
                        will show you the chosen route as well as the current location of your order. This allows the
                        purchaser to see the items being delivered to his/her desired delivery location in real
                        time. </p>
                </div>
            </div>
        </div>
    </div>
</div><?php */?>

<!-- Retailer FAQ's -->
<div class="faq" id="faq">
    <div class="container">
        <div class="col-md-3 col-xs-12">
            <div class="h2">Faq</div>
        </div><!-- /.col-md-3 -->

        <div class="col-md-9 col-xs-12">
            <div class="faq-item">
                <div class="h4">What is DeliverySure?</div>
                <p>DeliverySure is the new way to get anything you want delivered in - Now. We deliver from any
                    restaurant or store anywhere in the world directly to your door.</p>
            </div><!-- /.faq-item -->
            <div class="faq-item">
                <div class="h4">But what does it mean?</div>
                <p>DeliverySure / A loyal and trusted follower or subordinate who performs tasks for a powerful
                    person.</p>
            </div><!-- /.faq-item -->
            <div class="faq-item">
                <div class="h4">How does it work?</div>
                <p>1. Simply create a job what you want by placing a request online or using our app.</p>

                <p>2. Delivery man will place a bid on the job you have requested – You accept the bid – Delivery man
                    will get the goods from the shop, pay for it, collect it.</p>

                <p>3. It’s with you in less than 60 minutes.</p>
            </div><!-- /.faq-item -->
            <div class="faq-item">
                <div class="h4">What can DeliverySure deliver?</div>
                <p>It doesn’t just stop at food. Deliver what you request. From retail to essentials, to groceries and
                    gifts, DeliverySure is dedicated to doing the hard work so you don’t have to!</p>
            </div><!-- /.faq-item -->
            <div class="faq-item">
                <div class="h4">How fast can you deliver?</div>
                <p>Closet the delivery man will be – Fastest the goods will be delivered to your place.</p>
            </div><!-- /.faq-item -->
        </div><!-- /.col-md-9 -->
    </div><!-- /.container -->
</div>

<!-- Ready to get -->

<div class="get-started">
    <a class="btn btn-green mr10" href="#">Watch Video</a>
    @if(Session::get('accessGranted') || (!env('ACCESS_ENABLED') && !Session::get('accessGranted')))
        <a class="btn btn-green" data-target="#modalSignUp" data-toggle="modal" href="javascript:void(0);">Sign up</a>
    @endif
</div>

@endsection

