@extends('layouts.home')

@section('content')
<!-- Featured Image -->
<div class="featured">
    <div class="full-width-img">
        <img src="{!! asset('local/public/assets/images/index-images/index-purchaser-banner.png') !!}" alt="image">
    </div><!-- /.full-width-img -->
    <div class="featured-content">
        <div class="featured-content-wrapper">
            <h4 class="h1">Become a delivery partner</h4>
            <h4 class="h1">with DeliverySure</h4>
            <a class="btn btn-green signup" href="javascript:void(0);">Sign up your business</a>
        </div><!-- /.featured-content-wrapper -->
    </div><!-- /.featured-content -->
</div><!-- /.featured -->

<!-- How it works -->
<div class="how-it">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="content-side pt250">
                	<h1>How it works</h1>
                    <p>Lorem ipsum dolor sit amet, ius at timeam honestatis, mea ut primis ullamcorper, at sea sumo mentitum scripserit. Id his corpora reprimique. Mel agam nostrum deleniti te, ei ludus facilis scaevola vim. </p>
                    <p>Sumo mentitum scripserit. Id his corpora reprimique. Mel agam nostrum deleniti te, ei ludus facilis scaevola vim. </p>
                </div>
            </div>
            <div class="col-md-5">
                <img src="{{url('local/public/assets/images/index-images/iphone_1.png')}}" width="auto" height="auto">
            </div>
        </div>
	</div>
</div>

<!-- Choose from Drivers offers -->
<div class="choose-from">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="{{url('local/public/assets/images/index-images/iphone_2.png')}}" width="auto" height="auto">
            </div>
            <div class="col-md-7">
                <div class="content-side">
                	<h1>Choose from Driver Offers</h1>
                    <p>Lorem ipsum dolor sit amet, ius at timeam honestatis, mea ut primis ullamcorper, at sea sumo mentitum scripserit. Id his corpora reprimique. Mel agam nostrum deleniti te, ei ludus facilis scaevola vim. </p>
                    <p>Sumo mentitum scripserit. Id his corpora reprimique. Mel agam nostrum deleniti te, ei ludus facilis scaevola vim. </p>
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
                	<h1>Pick a time. Driver will come to you.</h1>
                    <p>Lorem ipsum dolor sit amet, ius at timeam honestatis, mea ut primis ullamcorper, at sea sumo mentitum scripserit. Id his corpora reprimique. Mel agam nostrum deleniti te, ei ludus facilis scaevola vim. </p>
                    <p>Sumo mentitum scripserit. Id his corpora reprimique. Mel agam nostrum deleniti te, ei ludus facilis scaevola vim. </p>
                </div>
            </div>
            <div class="col-md-5">
                <img src="{{url('local/public/assets/images/index-images/iphone_3.png')}}" width="auto" height="auto">
            </div>
        </div>
	</div>
</div>

<!--Track your stuff  -->
<div class="choose-from pb50">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="{{url('local/public/assets/images/index-images/iphone_4.png')}}" width="auto" height="auto">
            </div>
            <div class="col-md-7">
                <div class="content-side">
                	<h1>Track Your Stuff</h1>
                    <p>Lorem ipsum dolor sit amet, ius at timeam honestatis, mea ut primis ullamcorper, at sea sumo mentitum scripserit. Id his corpora reprimique. Mel agam nostrum deleniti te, ei ludus facilis scaevola vim. </p>
                    <p>Sumo mentitum scripserit. Id his corpora reprimique. Mel agam nostrum deleniti te, ei ludus facilis scaevola vim. </p>
                </div>
            </div>
        </div>
	</div>
</div>

<!--What it takes -->
<div class="how-to-order">
	<div class="container">
    	<div class="col-md-6">
        	<h1>How to order</h1>
            <p>Lorem ipsum dolor sit amet, ius at timeam honestatis, mea ut primis ullamcorper, at sea sumo mentitum scripserit. Id his corpora reprimique. Mel agam nostrum deleniti te, ei ludus facilis scaevola </p>
        </div>
    </div>
    <div class="right-bg">
    	<img src="{!! asset('local/public/assets/images/index-images/order-banner.jpg') !!}" width="auto" height="auto" />
    </div>
</div>

<!--Driver Index Description -->
<div class="desc extra">
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

<!-- Ready to get -->

<div class="get-started">
	<h1>Ready to get started?</h1>
    <p>Sign up today and make your first delivery</p>
    <a class="btn btn-green">Sign up your business</a>
</div>

@endsection
