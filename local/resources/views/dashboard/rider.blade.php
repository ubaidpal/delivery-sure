{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 29-Jun-16 4:32 PM
    * File Name    : 

--}}
@extends('layouts.home')

@section('content')
        <!-- Featured Image -->
<div class="featured">
    <div class="full-width-img">
        <img src="{!! asset('local/public/assets/images/index-images/index-driver-banner.png') !!}" alt="image">
    </div><!-- /.full-width-img -->
    <div class="featured-content">
        <div class="featured-content-wrapper">
            <h4 class="h1">Start delivering, earn cash</h4>

            <div class="landing-content hidden-xs">
                <p>Want to make some extra cash on your way back from work or school? Do you want to save up for a trip
                    to the mountains
                    or the gadgets you always wanted?<br/> If so, then enjoy the opportunities to quickly make money
                    with ‘Delivery Sure’. Deliver a list of items<br/>
                    from one point to another after setting terms of delivery ‘directly’ss with the purchaser and get
                    paid on the spot.
                </p>
            </div>
            @if(Session::get('accessGranted') || (!env('ACCESS_ENABLED') && !Session::get('accessGranted')))
                <a class="btn btn-green signup" data-target="#modalSignUp" data-toggle="modal" href="javascript:void(0);">Sign up</a>
            @endif
        </div><!-- /.featured-content-wrapper -->
    </div><!-- /.featured-content -->
</div><!-- /.featured -->

<!--How it works -->
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
                    <div class="h3">Find</div>
                    <div class="h3">a job near you</div>
                    <p>As a delivery person you can find delivery jobs within a radius of you desired area.</p>
                    <img src="{!! asset('local/public/assets/images/index-images/iPhone-1.png') !!}" width="auto" height="auto"/>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-3 -->
            </div>
            <div>
              <div class="col-md-12 col-sm-6">
                <a class="icon-item" href="javascript:void(0);">
                    <!--<div class="icon-item-img find"></div>-->
                    <div class="h3">Deliver</div>
                    <div class="h3">items in mins</div>
                    <p>Getting a job awarded within your desired area allows you to act quickly and deliver the items within minutes.</p>
                    <img src="{!! asset('local/public/assets/images/index-images/iPhone-1.png') !!}" width="auto" height="auto"/>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-3 -->
            </div>
            <div>
            	<div class="col-md-12 col-sm-6">
                    <a class="icon-item" href="javascript:void(0);">
                        <!--<div class="icon-item-img pay"></div>-->
                        <div class="h3">Get</div>
                        <div class="h3">your delivery fees</div>
                        <p>Once the items have been delivered to the designated location, collect you agreed amount of fee from the purchaser.</p>
                        <img src="{!! asset('local/public/assets/images/index-images/iPhone-1.png') !!}" width="auto" height="auto"/>
                    </a><!-- /.icon-item -->
                </div><!-- /.col-md-3 -->  
            </div>
        </section>
        
    </div><!-- /.container -->
</div>

<!--What it takes -->
<div class="what-it-takes">
    <div class="container">
        <div class="col-md-12">
            <h1>What it takes to become a delivery person</h1>

            <p>Go through the following form to understand the requirements for registering as a delivery person on
                Delivery Sure</p>
            <table class="table">
                <thead>
                <tr>
                    <th>Required</th>
                    <th>Walker</th>
                    <th>Biker</th>
                    <th>Car Driver</th>
                    <th>Van Driver</th>
                    <th>Truck Driver</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Be at least 19 years old</td>
                    <td><span class="req"></span></td>
                    <td><span class="req"></span></td>
                    <td><span class="req"></span></td>
                    <td><span class="req"></span></td>
                    <td><span class="req"></span></td>
                </tr>
                <tr>
                    <td>Be able to lift 50 lbs</td>
                    <td><span class="req"></span></td>
                    <td><span class="req"></span></td>
                    <td><span class="req"></span></td>
                    <td><span class="req"></span></td>
                    <td><span class="req"></span></td>
                </tr>
                <tr>
                    <td>State Photo ID</td>
                    <td><span class="req"></span></td>
                    <td><span class="req"></span></td>
                    <td><span class="req"></span></td>
                    <td><span class="req"></span></td>
                    <td><span class="req"></span></td>
                </tr>
                <tr>
                    <td>State Driving license</td>
                    <td></td>
                    <td></td>
                    <td><span class="req"></span></td>
                    <td><span class="req"></span></td>
                    <td><span class="req"></span></td>
                </tr>
                <tr>
                    <td>1 year old driving license</td>
                    <td></td>
                    <td></td>
                    <td><span class="req"></span></td>
                    <td><span class="req"></span></td>
                    <td><span class="req"></span></td>
                </tr>
                <tr>
                    <td>Commercial Driving License (CDL)</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><span class="req"></span></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Let The App -->
<div class="let-the-app">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="{!! asset('local/public/assets/images/index-images/index-d-page.png') !!}" width="auto"
                     height="auto"/>
            </div>
            <div class="col-md-7">
                <div class="content-side">
                    <h1>Let the app lead the way</h1>

                    <p>Delivery sure allows you to become potential delivery personnel even if you don’t have ample
                        street knowledge. If you have time on your hands and the urge to make quick money you can always
                        depend on this app to show you the way to the delivery location. Once the delivery destination
                        has been pinned and the service term have been agreed upon, the app will show you the route all
                        the way to you final destination. This relegates any confusion there may be with regards to
                        finding the right location and allows for both parties to see the time and distance remaining
                        before the items are delivered. Apart from saving time, this feature induces a lot of
                        transparency into the process of delivery.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Deliver when you want -->
<div class="deliver-when">
    <div class="container">
        <div class="row">
            <h1>Deliver when you want, earn what you need</h1>

            <div class="col-md-4">
                <div class="row">
                    <h4>work on your schedule</h4>

                    <p>Take trips for a few hours in the morning, afternoon, at night or perhaps just on weekends. It is
                        up to you to decide when you deliver, where you delivery and how many times you want to deliver
                        every day, week or month. You are your own boss, so work out a schedule that’s best for you.</p>
                </div>
            </div>
            <div class="col-md-4">
                <h4>CHOOSE YOUR WHEELS</h4>

                <p>It is up to you to decide how you want to go about making deliveries. You can take the car if you
                    think that’s the best option. You can also take the bike if you want feel the air on your face. You
                    can choose a bicycle if you want to burn some calories. Or you can walk. We’ll guide you through the
                    rest.</p>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <h4>EARN GOOD MONEY.</h4>

                    <p>You'll make money by bringing people the things they love, the things they need and the things
                        they can’t leave home to fetch. Between deliveries, it’s just you. So bump your favorite tunes
                        and enjoy cruising around your city. By the end of it all, you’ll return home a wealthier
                        person.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delivery Person FAQ's -->
<div class="faq np" id="faq">
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
