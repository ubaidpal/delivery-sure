@extends('layouts.home')

@section('content')
<!-- Featured Image -->
<div class="featured">
    <div class="full-width-img">
        <img src="{!! asset('local/public/assets/images/featured-image.jpg') !!}" alt="image">
    </div><!-- /.full-width-img -->
    <div class="featured-content">
        <div class="featured-content-wrapper">
            <h4 class="h1">Your personal shopper</h4>
            <h4 class="h1">at your door in under an hour</h4>
            <a class="btn btn-green" href="javascript:void(0);">GET STARTED NOW</a>
        </div><!-- /.featured-content-wrapper -->
    </div><!-- /.featured-content -->
</div><!-- /.featured -->

<!-- How It Works -->
<div class="how-it-works">
    <div class="container">
        <div class="index-container-header">
            <div class="h2">How it works</div>
            <p>4 simple ways to learn about DeliverySure delivery application</p>
        </div><!-- /.index-container-header -->

        <div class="icon-item-group row col-md-12 col-md-offset-0 col-xs-8 col-xs-offset-2">
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a class="icon-item" href="javascript:void(0);">
                    <div class="icon-item-img create"></div>
                    <div class="h3">Create</div>
                    <div class="h3">a list of items</div>
                    <p>Lorem ipsum dolor sit amet, cotetur piscing elit. Nam sollicitudin in nulla vitae suscipit. Aenean quat</p>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-3 -->
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a class="icon-item" href="javascript:void(0);">
                    <div class="icon-item-img find"></div>
                    <div class="h3">Find</div>
                    <div class="h3">a delivery person</div>
                    <p>Lorem ipsum dolor sit amet, cotetur piscing elit. Nam sollicitudin in nulla vitae suscipit. Aenean quat</p>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-3 -->
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a class="icon-item" href="javascript:void(0);">
                    <div class="icon-item-img received"></div>
                    <div class="h3">Received</div>
                    <div class="h3">items in mins</div>
                    <p>Lorem ipsum dolor sit amet, cotetur piscing elit. Nam sollicitudin in nulla vitae suscipit. Aenean quat</p>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-3 -->
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a class="icon-item" href="javascript:void(0);">
                    <div class="icon-item-img pay"></div>
                    <div class="h3">Pay</div>
                    <div class="h3">small delivery fees</div>
                    <p>Lorem ipsum dolor sit amet, cotetur piscing elit. Nam sollicitudin in nulla vitae suscipit. Aenean quat</p>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-3 -->
        </div><!-- /.row .icon-item-group -->
    </div><!-- /.container -->
</div><!-- /.how-it-works -->

<!-- Personal Shopper -->
<div class="personal-shopper">
    <div class="personal-shopper-img">
        <img src="{!! asset('local/public/assets/images/personel-img.jpg') !!}" alt="image">
    </div><!-- /.full-width-img -->
    <div class="personal-shopper-txt">
        <div class="personal-shopper-wrapper">
            <div class="h2">Be everyone’s</div>
            <div class="h2">Sersonel Shopper</div>
            <p>Demedat is an on-demand grocery delivery service looking for reliable, independent people to shop for groceries and deliver <span class="hidden-xs">to our members. Earn money, set your own schedule and feel free to sing in your car on the way to a delivery!</span></p>

            <a class="btn btn-white" href="javascript:void(0);">Find More</a>
        </div><!-- /.personal-shopper-wrapper -->
    </div><!-- /.personal-shopper-txt -->
</div><!-- /.personal-shopper -->

<!-- Deliver Items -->
<div class="deliver-items">
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
                    <div class="h5">Flowers<span class="hidden-480"> & Gifts</span></div>
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
                    <div class="h5">Beauty<span class="hidden-480"> & Health</span></div>
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
                    <div class="h5">Home<span class="hidden-480"> & Garden</span></div>
                </a><!-- /.icon-item -->
            </div><!-- /.col-md-2 col-sm-2 col-xs-2 -->


        </div><!-- /.row icon-item-group -->
    </div><!-- /.deliver-items -->
</div><!-- /.deliver-items -->

<!-- Testimonials -->
<div class="testimonials">
    <div class="container">
        <div class="index-container-header">
            <div class="h2">Testimonials</div>
        </div><!-- /.index-container-header -->

        <div id="d-slider" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#d-slider" data-slide-to="0" class="active"></li>
                <li data-target="#d-slider" data-slide-to="1"></li>
                <li data-target="#d-slider" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <div class="item-img">
                        <img src="{!! asset('local/public/assets/images/slider-img.jpg') !!}" alt="image">
                    </div>
                    <div class="carousel-caption">
                        <div class="h4">Lorem ipsum dolor sit cotetur adipiscing elit. Nam sollicitudin ulla vitae suscipit.</div>
                        <div class="carousel-caption-footer">
                            <div class="person-name">by <span>John Doe</span></div>
                            <p>Founder & CEO, Company Name</p>
                        </div>
                    </div><!-- /.carousel-caption -->
                </div><!-- /.item -->
                <div class="item">
                    <div class="item-img">
                        <img src="{!! asset('local/public/assets/images/slider-img.jpg') !!}" alt="image">
                    </div>
                    <div class="carousel-caption">
                        <div class="h4">Lorem ipsum dolor sit cotetur adipiscing elit. Nam sollicitudin ulla vitae suscipit.</div>
                        <div class="carousel-caption-footer">
                            <div class="person-name">by <span>John Doe</span></div>
                            <p>Founder & CEO, Company Name</p>
                        </div>
                    </div><!-- /.carousel-caption -->
                </div><!-- /.item -->
                <div class="item">
                    <div class="item-img">
                        <img src="{!! asset('local/public/assets/images/slider-img.jpg') !!}" alt="image">
                    </div>
                    <div class="carousel-caption">
                        <div class="h4">Lorem ipsum dolor sit cotetur adipiscing elit. Nam sollicitudin ulla vitae suscipit.</div>
                        <div class="carousel-caption-footer">
                            <div class="person-name">by <span>John Doe</span></div>
                            <p>Founder & CEO, Company Name</p>
                        </div>
                    </div><!-- /.carousel-caption -->
                </div><!-- /.item -->
            </div><!-- /.carousel-inner -->

            <!-- Controls -->
            <a class="left carousel-control" href="#d-slider" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#d-slider" role="button" data-slide="next">
                <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div><!-- /.carousel -->
    </div><!-- /.container -->
</div><!-- /.testimonials -->

<!-- FAQ -->
<div class="faq">
    <div class="container">
        <div class="col-md-3 col-xs-12">
            <div class="h2">Faq</div>
        </div><!-- /.col-md-3 -->

        <div class="col-md-9 col-xs-12">
            <div class="faq-item">
                <div class="h4">What is DeliverySure?</div>
                <p>DeliverySure is the new way to get anything you want delivered in - Now. We deliver from any restaurant or store anywhere in the world directly to your door.</p>
            </div><!-- /.faq-item -->
            <div class="faq-item">
                <div class="h4">But what does it mean?</div>
                <p>DeliverySure / A loyal and trusted follower or subordinate who performs tasks for a powerful person.</p>
            </div><!-- /.faq-item -->
            <div class="faq-item">
                <div class="h4">How does it work?</div>
                <p>1. Simply create a job what you want by placing a request online or using our app.</p>
                <p>2. Delivery man will place a bid on the job you have requested – You accept the bid – Delivery man will get the goods from the shop, pay for it, collect it.</p>
                <p>3. It’s with you in less than 60 minutes.</p>
            </div><!-- /.faq-item -->
            <div class="faq-item">
                <div class="h4">What can DeliverySure deliver? </div>
                <p>It doesn’t just stop at food. Deliver what you request. From retail to essentials, to groceries and gifts, DeliverySure is dedicated to doing the hard work so you don’t have to!</p>
            </div><!-- /.faq-item -->
            <div class="faq-item">
                <div class="h4">How fast can you deliver?</div>
                <p>Closet the delivery man will be – Fastest the goods will be delivered to your place.</p>
            </div><!-- /.faq-item -->
        </div><!-- /.col-md-9 -->
    </div><!-- /.container -->
</div><!-- /.faq -->

<!-- Contact Us -->
<div class="contact-us">
    <div class="container">
        <div class="h2">Contact us</div>
        <p>Don't hesistate to contact us for more information.</p>

        <div class="contact-us-form">
            <form>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label class="animate-label">Name <span>&ast;</span></label>
                            <input type="text" class="form-control form-control-animate-border">
                        </div><!-- /.form-group animate-label -->
                    </div><!-- /.col-xs-4 -->
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label class="animate-label">Email <span>&ast;</span></label>
                            <input type="text" class="form-control form-control-animate-border">
                        </div><!-- /.form-group animate-label -->
                    </div><!-- /.col-xs-4 -->
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label class="animate-label">Phone</label>
                            <input type="text" class="form-control form-control-animate-border">
                        </div><!-- /.form-group animate-label -->
                    </div><!-- /.col-xs-4 -->
                </div><!-- /.row -->

                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label class="animate-label">Message <span>&ast;</span></label>
                            <textarea class="form-control form-control-animate-border"></textarea>
                        </div><!-- /.col-md-12 & form-group-->
                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->

                <a class="btn btn-green">Submit <span class="glyphicon glyphicon-send"></span></a>
            </form>
        </div><!-- /.contact-us-form -->
    </div><!-- /.container -->
</div><!-- /.contact -->

@endsection
