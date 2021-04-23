@extends('layouts.home')

@section('content')
<!-- Featured Image -->
<div class="featured">
    <div class="full-width-img">
        <img src="{!! asset('local/public/assets/images/index-images/index-retailer-banner.png') !!}" alt="image">
    </div><!-- /.full-width-img -->
    <div class="featured-content">
        <div class="featured-content-wrapper">
            <h4 class="h1">Impress your customers with</h4>
            <h4 class="h1">on-demand delivery</h4>
            <a class="btn btn-green signup" href="javascript:void(0);">Sign up your business</a>
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
		<div class="col-md-1"></div>
        <div class="icon-item-group row col-md-10 col-md-offset-0 col-xs-8 col-xs-offset-2">
            <div class="col-md-4 col-sm-6 col-xs-6">
                <a class="icon-item" href="javascript:void(0);">
                    <div class="icon-item-img create"></div>
                    <div class="h3">Create</div>
                    <div class="h3">a list of items</div>
                    <p>Lorem ipsum dolor sit amet, cotetur piscing elit. Nam sollicitudin in nulla vitae suscipit. Aenean quat</p>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-3 -->
            <div class="col-md-4 col-sm-6 col-xs-6">
                <a class="icon-item" href="javascript:void(0);">
                    <div class="icon-item-img find"></div>
                    <div class="h3">Find</div>
                    <div class="h3">a delivery person</div>
                    <p>Lorem ipsum dolor sit amet, cotetur piscing elit. Nam sollicitudin in nulla vitae suscipit. Aenean quat</p>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-3 -->
            <div class="col-md-4 col-sm-6 col-xs-6">
                <a class="icon-item" href="javascript:void(0);">
                    <div class="icon-item-img pay"></div>
                    <div class="h3">Pay</div>
                    <div class="h3">small delivery fees</div>
                    <p>Lorem ipsum dolor sit amet, cotetur piscing elit. Nam sollicitudin in nulla vitae suscipit. Aenean quat</p>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-3 -->
        </div><!-- /.row .icon-item-group -->
        <div class="col-md-1"></div>
    </div><!-- /.container -->
</div>

<div class="delivery-right">
    <div class="container">
        <div class="row">
            <div class="col-md-7"></div>
            <div class="col-md-5">
                <div class="content-side">
                	<h1>Delivery right when you need it</h1>
                    <p>Lorem ipsum dolor sit amet, ius at timeam honestatis, mea ut primis ullamcorper, at sea sumo mentitum scripserit. Id his corpora reprimique. Mel agam nostrum deleniti te, ei ludus facilis scaevola vim. </p>
                    <p>Sumo mentitum scripserit. Id his corpora reprimique. Mel agam nostrum deleniti te, ei ludus facilis scaevola vim. </p>
                </div>
            </div>
        </div>
</div>
</div>

<!-- Hire someone to deliver items-->
<div class="deliver-items pb50">
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
</div>

<!-- Delivery Right When you need -->
<div class="delivery-right-pnl">
	<div class="container">
    	<div class="col-md-4">
        	<h1>Delivery right when you need it</h1>
            <p>Lorem ipsum dolor sit amet, ius at timeam honestatis, mea ut primis ullamcorper, at sea sumo mentitum scripserit. Id his corpora reprimique. Mel agam nostrum deleniti te, ei ludus facilis scaevola </p>
        </div>
        <div class="col-md-8 pr">
    		<div class="mac-img"><img src="{{url('local/public/assets/images/index-images/mac.png')}}" width="893" height="482"></div>
    	</div>
    </div>
</div>



<!-- Choose from Drivers offers -->
<div class="choose-from pt50">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="{{url('local/public/assets/images/index-images/iPhone-5.png')}}" width="auto" height="auto">
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

<!-- Ready to get -->

<div class="get-started">
	<h1>Sign up for free and put the DeliverySure<br/>delivery network to work.</h1>
    <a class="btn btn-green">Sign up your business</a>
</div>

@endsection
