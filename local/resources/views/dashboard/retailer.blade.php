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
        <img src="{!! asset('local/public/assets/images/index-images/index-retailer-banner.png') !!}" alt="image">
    </div><!-- /.full-width-img -->
    <div class="featured-content">
        <div class="featured-content-wrapper">
            <h4 class="h1">Don't lose a sale, start delivering</h4>

            <div class="landing-content hidden-xs">
                <p>As a retailer, Delivery Sure allows you to meet the demands of your customers by delivering over a
                    larger area throughout the day.
                    <br/>By awarding a job to a delivery person you are guaranteed to have a larger base of satisfied
                    customers, by paying a small amount as delivery fee.
                    <br/>Happy customers translate into more business!

                </p>
            </div>
            @if(Session::get('accessGranted') || (!env('ACCESS_ENABLED') && !Session::get('accessGranted')))
                <a class="btn btn-green signup" data-target="#modalSignUp" data-toggle="modal" href="javascript:void(0);">Sign up</a>
            @endif
        </div><!-- /.featured-content-wrapper -->
    </div><!-- /.featured-content -->
</div><!-- /.featured -->

<!-- How it works -->

<div class="how-it-works">
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
                    <p>Create a list of items you want to delivery to your customer while your post a job</p>
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
                    <p>Once you start receiving responses to your job posting, you can choose a delivery person within
                        the radius of your specified area.</p>
                    <img src="{!! asset('local/public/assets/images/index-images/iPhone-1.png') !!}" width="auto" height="auto"/>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-3 -->
            </div>
            <div>
              <div class="col-md-12 col-sm-6">
                <a class="icon-item" href="javascript:void(0);">
                    <!--<div class="icon-item-img received"></div>-->
                    <div class="h3">Send</div>
                    <div class="h3">items in mins</div>
                    <p>With several delivery personnel at your disposal, you can dispatch items to their destinations
                        within mins.</p>
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
                    	<p>Once the delivery has been made and you receive a notification from your customer, you can pay a
                        small pre-agreed delivery fee to your delivery person.</p>
                        <img src="{!! asset('local/public/assets/images/index-images/iPhone-1.png') !!}" width="auto" height="auto"/>
                    </a><!-- /.icon-item -->
                </div><!-- /.col-md-3 -->  
            </div>
        </section>
    </div><!-- /.container -->
</div>

<!-- Hire someone to deliver items-->
<?php /*?><div class="deliver-items pb50">
    <div class="container">
        <div class="index-container-header">
            <div class="h2">Hire someone to deliver items you need</div>
        </div><!-- /.index-container-header -->

        <div class="icon-item-group row no-gutter">
            <div class="col-md-2 col-sm-2 col-xs-2">
                <a class="icon-item-small" href="javascript:void(0);">
                    <div class="icon-item-img apparel"></div>
                    <div class="h5">Apparel</div>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-2 col-sm-2 col-xs-2 -->
            <div class="col-md-2 col-sm-2 col-xs-2">
                <a class="icon-item-small" href="javascript:void(0);">
                    <div class="icon-item-img automotive"></div>
                    <div class="h5">Automotive</div>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-2 col-sm-2 col-xs-2 -->
            <div class="col-md-2 col-sm-2 col-xs-2">
                <a class="icon-item-small" href="javascript:void(0);">
                    <div class="icon-item-img beverages"></div>
                    <div class="h5">Beverages</div>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-2 col-sm-2 col-xs-2 -->
            <div class="col-md-2 col-sm-2 col-xs-2">
                <a class="icon-item-small" href="javascript:void(0);">
                    <div class="icon-item-img flowers-gifts"></div>
                    <div class="h5">Flowers<span class="hidden-480"> &amp; Gifts</span></div>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-2 col-sm-2 col-xs-2 -->
            <div class="col-md-2 col-sm-2 col-xs-2">
                <a class="icon-item-small" href="javascript:void(0);">
                    <div class="icon-item-img health-care"></div>
                    <div class="h5">Health<span class="hidden-480"> Care</span></div>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-2 col-sm-2 col-xs-2 -->
            <div class="col-md-2 col-sm-2 col-xs-2">
                <a class="icon-item-small" href="javascript:void(0);">
                    <div class="icon-item-img household"></div>
                    <div class="h5">Household</div>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-2 col-sm-2 col-xs-2 -->
            <div class="col-md-2 col-sm-2 col-xs-2">
                <a class="icon-item-small" href="javascript:void(0);">
                    <div class="icon-item-img electronics"></div>
                    <div class="h5">Electronics</div>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-2 col-sm-2 col-xs-2 -->
            <div class="col-md-2 col-sm-2 col-xs-2">
                <a class="icon-item-small" href="javascript:void(0);">
                    <div class="icon-item-img beauty-health"></div>
                    <div class="h5">Beauty<span class="hidden-480"> &amp; Health</span></div>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-2 col-sm-2 col-xs-2 -->
            <div class="col-md-2 col-sm-2 col-xs-2">
                <a class="icon-item-small" href="javascript:void(0);">
                    <div class="icon-item-img foods"></div>
                    <div class="h5">Foods</div>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-2 col-sm-2 col-xs-2 -->
            <div class="col-md-2 col-sm-2 col-xs-2">
                <a class="icon-item-small" href="javascript:void(0);">
                    <div class="icon-item-img stationary"></div>
                    <div class="h5">Stationary</div>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-2 col-sm-2 col-xs-2 -->
            <div class="col-md-2 col-sm-2 col-xs-2">
                <a class="icon-item-small" href="javascript:void(0);">
                    <div class="icon-item-img hardware"></div>
                    <div class="h5">Hardware</div>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-2 col-sm-2 col-xs-2 -->
            <div class="col-md-2 col-sm-2 col-xs-2">
                <a class="icon-item-small" href="javascript:void(0);">
                    <div class="icon-item-img home-garden"></div>
                    <div class="h5">Home<span class="hidden-480"> &amp; Garden</span></div>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-2 col-sm-2 col-xs-2 -->


        </div><!-- /.row icon-item-group -->

        <a class="btn btn-white" href="javascript:void(0);">view all categories</a>
    </div><!-- /.deliver-items -->
</div><?php */?>

<!-- Delivery Right When you need -->
<div class="delivery-right-pnl">
    <div class="container">
        <div class="col-md-4">
            <h1>Post your delivery orders</h1>

            <p>As a retailer you have the option of posting more as many delivery orders as you want in as much time you
                time them. This is an effective way of catering to multiple customers simultaneously. Simply fill in the
                form with the list of items you wish to deliver to your customers in various areas and you will be
                responded by several delivery personnel willing to work with you. The more delivery order you dispatch
                the more visible you will become which could lead to bringing in more orders and keeping you ahead of
                the competition.
            </p>
        </div>
        <div class="col-md-8 pr hidden-xs">
            <div class="mac-img"><img src="{!! asset('local/public/assets/images/index-images/mac.png') !!}" width="893"
                                      height="482"></div>
        </div>
    </div>
</div>


<div class="delivery-right">
    <div class="container">
        <div class="row">
            <div class="col-md-7"></div>
            <div class="col-md-5">
                <div class="content-side">
                    <h1>Expand your delivery options</h1>

                    <p>With ‘Delivery Sure’ you can cater to a much larger customer base simply by delivering over a
                        larger area. Without hiring a large team for delivery purposes you can have a large pool of
                        delivery personnel at your disposal any time you need them. This allows you a presence in places
                        previously out of your delivery radius. By simply paying a small delivery fee you can expand
                        your services through a manageable process to new and old customers. The fact that you can
                        deliver order anywhere at any time, can make you the first option and the last resort for
                        customers. Register with Delivery Sure today to get your business where it has not gone
                        before.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php /*?><!-- Choose from Drivers offers -->
<div class="choose-from pt50">
    <div class="container">
        <div class="row">
            <div class="col-md-5 hidden-xs">
                <img src="{!! asset('local/public/assets/images/index-images/iPhone-5.png') !!}" width="auto"
                     height="auto">
            </div>
            <div class="col-md-7">
                <div class="content-side">
                    <h1>Don't depend on singal driver choose your best options</h1>

                    <p>Once a job is posted, you are bound to receive multiple responses from various delivery personnel
                        from various locations. This allows you to pick the one option that best serves your purpose.
                        Your delivery preferences can depend on factors like distance from the destination, mode of
                        travelling, amount of fee, knowledge of the area and previous experiences.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Choose from Drivers offers -->
<div class="choose-from pt50">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="content-side">
                    <h1>Add your favourite drivers for repeat orders</h1>

                    <p>Another plus point of receiving multiple bid on your job postings is that after a couple of job
                        you can start pin pointing your favorite delivery personnel and add them to you list of favorite
                        drivers. This will allow you better mental satisfaction for future jobs dispatch the order
                        faster than ever. Moreover, you can have a number of delivery hands shortlisted as per areas of
                        delivery, cost effectiveness, mode of transport, availability, presentation and punctuality.</p>
                </div>
            </div>
            <div class="col-md-5 hidden-xs">
                <img src="{!! asset('local/public/assets/images/index-images/iPhone-5.png') !!}" width="auto"
                     height="auto">
            </div>
        </div>
    </div>
</div><?php */?>

<!-- Retailer FAQ's -->
<div class="faq pt50" id="faq">
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
    <a class="btn btn-green mr10" href="#.">Watch Video</a>
    @if(Session::get('accessGranted') || (!env('ACCESS_ENABLED') && !Session::get('accessGranted')))
        <a class="btn btn-green" data-target="#modalSignUp" data-toggle="modal" href="javascript:void(0);">Sign up</a>
    @endif
</div>

@endsection
