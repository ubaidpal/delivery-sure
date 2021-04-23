@extends('layouts.landing')

@section('content')
    <div class="slider-container">
        <div class="slider_container">
            <div class="flexslider">
                <ul class="slides">
                    <li>
                        <img src="{!! asset('local/public/assets/images/slider/slide1.jpg') !!}" alt="" title=""/>

                        <div class="featured-content">
                            <div class="featured-content-wrapper">
                                <h4 class="h1">Delivering anything, anywhere, anytime</h4>

                                <div class="landing-content">
                                    <p>Not everyone works 12 hours a day, helps children with homework, prepares for a
                                        job interview,
                                        does laundry, pays bills,<br/>attends patients, mows the lawn or runs to the
                                        second job every day.
                                        But everyone deserves a break from those trips to the mart,<br/>chemist or the
                                        book store.
                                        Small breaks have now been made easier with DELIVERY SURE. Post a job, receive
                                        the items, GET A BREAK.</p>
                                </div>
                                <div class="signup-buttons">
                                    <a class="btn btn-green white-blank" href="{{route('purchaser')}}">WATCH VIDEO</a>
                                    @if(Session::get('accessGranted') || (!env('ACCESS_ENABLED') && !Session::get('accessGranted')))
                                        <a class="btn btn-green" data-target="#modalSignUp" data-toggle="modal" href="javascript:void(0);">SIGN UP</a>
                                    @endif
                                </div>
                            </div><!-- /.featured-content-wrapper -->
                        </div>
                    </li>
                    <li>
                        <img src="{!! asset('local/public/assets/images/slider/slide2.jpg') !!}" alt="" title=""/>

                        <div class="featured-content">
                            <div class="featured-content-wrapper">
                                <h4 class="h1">Start delivering, earn cash</h4>

                                <div class="landing-content">
                                    <p>Want to make some extra cash on your way back from work or school? Do you want to
                                        save up for a trip to the mountains
                                        or the gadgets you always wanted?<br/> If so, then enjoy the opportunities to
                                        quickly make money with ‘Delivery Sure’. Deliver a list of items<br/>
                                        from one point to another after setting terms of delivery ‘directly’ss with the
                                        purchaser and get paid on the spot.
                                    </p>
                                </div>
                                <h4 class="h1"></h4>

                                <div class="signup-buttons">
                                    <a class="btn btn-green white-blank" href="{{route('delivery-driver')}}">WATCH VIDEO</a>
                                    @if(Session::get('accessGranted') || (!env('ACCESS_ENABLED') && !Session::get('accessGranted')))
                                        <a class="btn btn-green" data-target="#modalSignUp" data-toggle="modal" href="javascript:void(0);">SIGN UP</a>
                                    @endif
                                </div>
                            </div><!-- /.featured-content-wrapper -->
                        </div>
                    </li>

                    <li>
                        <img src="{!! asset('local/public/assets/images/slider/slide3.jpg') !!}" alt="" title=""/>

                        <div class="featured-content">
                            <div class="featured-content-wrapper">
                                <h4 class="h1">Don't lose a sale, start delivering</h4>

                                <div class="landing-content">
                                    <p>As a retailer, Delivery Sure allows you to meet the demands of your customers by
                                        delivering over a larger area throughout the day.
                                        <br/>By awarding a job to a delivery person you are guaranteed to have a larger
                                        base of satisfied customers, by paying a small amount as delivery fee.
                                        <br/>Happy customers translate into more business!

                                    </p>
                                </div>
                                <div class="signup-buttons">
                                    <a class="btn btn-green white-blank" href="{{route('retailer')}}">WATCH VIDEO</a>
                                    @if(Session::get('accessGranted') || (!env('ACCESS_ENABLED') && !Session::get('accessGranted')))
                                        <a class="btn btn-green" data-target="#modalSignUp" data-toggle="modal" href="javascript:void(0);">SIGN UP</a>
                                    @endif
                                </div>
                            </div><!-- /.featured-content-wrapper -->
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('footer-content')
    @if(env('ACCESS_ENABLED'))
        @if(!\Session::get('accessGranted'))
            <script type="text/javascript">
                $(window).load(function () {
                    $('#access-token').modal('show');
                });
            </script>
        @endif
    @endif
@stop
