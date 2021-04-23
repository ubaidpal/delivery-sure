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
            <h4 class="h1">with DeliverySure</h4>
            <a class="btn btn-green signup" href="javascript:void(0);">Sign up your business</a>
        </div><!-- /.featured-content-wrapper -->
    </div><!-- /.featured-content -->
</div><!-- /.featured -->

<!--Driver Index Description -->
<div class="desc">
	<div class="container">
    	<div class="col-md-6">
        	<p>Lorem ipsum dolor sit amet, ius at timeam honestatis, mea ut primis ullamcorper, at sea sumo mentitum scripserit. Id his corpora reprimique. Mel agam nostrum deleniti te, ei ludus facilis scaevola vim. </p>
            <p>Lorem ipsum dolor sit amet, ius at timeam honestatis, mea ut primis ullamcorper, at sea sumo mentitum scripserit. Id his corpora reprimique. Mel agam nostrum deleniti te, ei ludus facilis scaevola vim. </p>
        </div>
        <div class="col-md-6">
        	<p>Lorem ipsum dolor sit amet, ius at timeam honestatis, mea ut primis ullamcorper, at sea sumo mentitum scripserit. Id his corpora reprimique. </p>
            <p>Mel agam nostrum deleniti te, ei ludus facilis scaevola vim. </p>
        </div>
    </div>
</div>

<!--What it takes -->
<div class="what-it-takes">
	<div class="container">
    	<div class="col-md-12">
        	<h1>What it takes to deliver</h1>
            <p>Lorem ipsum dolor sit amet, ius at timeam honestatis, mea ut primis ullamcorper, at sea sumo mentitum scripserit. Id his corpora reprimique. Mel agam nostrum deleniti te, ei ludus facilis scaevola </p>
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
                        <td>Have a photo ID</td>
                        <td><span class="req"></span></td>
                        <td><span class="req"></span></td>
                        <td><span class="req"></span></td>
                        <td><span class="req"></span></td>
                        <td><span class="req"></span></td>
                    </tr>
                    <tr>
                        <td>Have a driving license</td>
                        <td></td>
                        <td></td>
                        <td><span class="req"></span></td>
                        <td><span class="req"></span></td>
                        <td><span class="req"></span></td>
                    </tr>
                    <tr>
                        <td>Have at least 1 year of driving license</td>
                        <td></td>
                        <td></td>
                        <td><span class="req"></span></td>
                        <td><span class="req"></span></td>
                        <td><span class="req"></span></td>
                    </tr>
                    <tr>
                        <td>Have a CDL driving license</td>
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
                <img src="{!! asset('local/public/assets/images/index-images/index-d-page.png') !!}" width="auto" height="auto" />
            </div>
            <div class="col-md-7">
                <div class="content-side">
                	<h1>Let the app lead the way</h1>
                    <p>Lorem ipsum dolor sit amet, ius at timeam honestatis, mea ut primis ullamcorper, at sea sumo mentitum scripserit. Id his corpora reprimique. Mel agam nostrum deleniti te, ei ludus facilis scaevola vim. </p>
                    <p>Sumo mentitum scripserit. Id his corpora reprimique. Mel agam nostrum deleniti te, ei ludus facilis scaevola vim. </p>
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
                	<p>Take trips for a few hours in the mornings, every night, or just on weekends—it’s up to you. You are your own boss and you can choose when and how much you work.</p>
                </div>
            </div>
            <div class="col-md-4">
            	<h4>CHOOSE YOUR WHEELS</h4>
                <p>Drive your car or ride your bike. You choose the way you want to deliver, and we’ll guide you through the rest.</p>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <h4>EARN GOOD MONEY.</h4>
                    <p>You'll make money by bringing people the things they love. Between deliveries, it’s just you. So bump your favorite tunes and enjoy cruising around your city.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ready to get -->

<div class="get-started">
	<h1>Ready to get started?</h1>
    <p>Sign up today and make your first delivery</p>
    <a class="btn btn-green">Sign up your business</a>
</div>

@endsection
