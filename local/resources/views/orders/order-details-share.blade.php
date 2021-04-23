@extends('layouts.default')
@section('meta')
    <meta property="og:url" content="{{route('order-detail',[encodeId($order->id,'orders')])}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{$order->title}} - Delivery Sure"/>
    <meta property="og:description" content="{{$order->order_description}}"/>
    <meta property="og:image" content="{!! asset('local/public/assets/images/slider/slide2.jpg') !!}"/>
@stop
@section('content')
    {{-- @include('includes.sidebar-right-menu')--}}
    <!-- Job Detail View -->
    <div class="job-detail-view autoheight">
        <div class="container">
            @if(\Privacy::check($order->user_id,\Config::get('constant_privacy.JOB_VIEW.KEY')))
                @include('includes.alerts')
                <header class="job-detail-header">
                    <div class="jd-header-btn">
                        <a class="btn btn-sm btn-gray pull-left"
                           href="javascript:void(0);">{{getCategoryName($order->category_id)}}</a>

                        @if(\Privacy::check($order->user_id,\Config::get('constant_privacy.JOB_SHARE.KEY')))
                            <div class="fb-share-button" data-href="{{route('order-detail.share',[encodeId($order->id,'orders')])}}"
                                 data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore"
                                                                                                           target="_blank"
                                                                                                           href="https://www.facebook.com/sharer/sharer.php?u={{route('order-detail.share',[encodeId($order->id,'orders')])}}&amp;src=sdkpreparse">Share</a>
                            </div>
                    @endif

                    {{--<a class="btn btn-link pull-right" href="javascript:void(0);">
                        Flag this listing<i class="fa fa-flag" aria-hidden="true"></i>--}}

                    <!--<a href="{{URL::previous()}}" class="btn btn-link pull-right">
                    View Listing
                </a>-->
                    </div><!-- /.jd-header-btn -->

                    <div class="job-header-detail">
                        <div class="h3">{{$order->title}}</div>


                        <div class="job-status">
                            <div class="job-status-item">
                                <div class="h4">Estimated Delivery Fees:</div>
                                <span>{{format_currency($order->estimate_delivery_fee)}}</span>
                            </div><!-- /.job-status-item -->
                            <div class="job-status-item">
                                <div class="h4">Item Value:</div>
                                <span>{{format_currency($order->item_value)}}</span>
                            </div><!-- /.job-status-item -->
                            <div class="job-status-item">
                                <div class="h4">Estimated Delivery Time:</div>
                                <span>{{\Carbon\Carbon::parse($order->deliver_date_time)->format('h:i A | d-m-y')}}</span>
                            </div><!-- /.job-status-item -->
                        </div><!-- /.job-status -->
                    </div><!-- /.job-header-detail -->
                </header><!-- /.job-detail-header -->

                <!-- Job Detail View - Body -->
                <div class="job-detail-view-body">
                    <div class="col-md-8">
                        <div class="row">

                            <!-- Job View Detail Block -->
                            <div class="job-view-detail-block">
                                <div class="jvd-item-title h3b">Description</div><!-- /.jvd-item-title -->

                                <div class="job-view-detail-item">
                                    <p class="txt">{{$order->order_description}}</p>
                                </div><!-- /.job-view-detail-item -->
                            </div><!-- /.job-view-detail-block -->

                            <!-- Job View Detail Block -->
                            <div class="job-view-detail-block">
                                <div class="jvd-item-title h3b">Item List</div><!-- /.jvd-item-title -->

                                @foreach($items as $item)
                                    <div class="job-view-detail-item">
                                        <div class="col-xs-6">
                                            <div class="row">{{$item->name}}</div>
                                        </div><!-- /.col-xs-6 -->
                                        <div class="col-xs-6">
                                            <div class="row"><span class="dollar">$</span>{{$item->price}}</div>
                                        </div><!-- /.col-xs-6 -->
                                    </div><!-- /.job-view-detail-item -->
                                @endforeach
                            </div><!-- /.job-view-detail-block -->

                            <!-- Job View Detail Block -->
                            <div class="job-view-detail-block">
                                <div class="jvd-item-title h3b">Location</div><!-- /.jvd-item-title -->

                                <div class="job-view-detail-item">
                                    @if($order->pick_up_location == 1)
                                        <div class="col-xs-6">
                                            <div class="row">
                                                <div class="lead"><span class="glyphicon glyphicon-map-marker"></span>Pickup
                                                    Address
                                                </div>
                                                <p class="ml20">{{$order->pick_up_location_address}}</p>
                                                {{--<a type="button" class="btn btn-link" data-toggle="modal"
                                                   data-target="#quick-view-modal"
                                                   href="{{route('view-map',[$order->pick_up_latitude, $order->pick_up_longitude,$owner->user_type])}}">View
                                                    Map</a>--}}
                                            </div>
                                        </div><!-- /.col-xs-6 -->
                                    @endif
                                    <div class="col-xs-6">
                                        <div class="row">
                                            <div class="lead"><span class="glyphicon glyphicon-map-marker"></span>Delivery
                                                Address
                                            </div>
                                            <p class="ml20">{{$order->delivery_location}}</p>

                                            {{-- <a type="button" class="btn btn-link" data-toggle="modal"
                                                data-target="#quick-view-modal"
                                                href="{{route('view-map',[$order->latitude, $order->longitude,$owner->user_type])}}">View Map</a>--}}
                                        </div>
                                    </div><!-- /.col-xs-6 -->
                                </div><!-- /.job-view-detail-item -->


                            </div><!-- /.job-view-detail-block -->

                            <div class="job-view-detail-block mb20 p0">
                                {{--@if($order->pick_up_location == 1)--}}
                                <div class="map" id="delivery-route">

                                </div>
                                {{--   @endif--}}
                            </div>

                        </div><!-- /.row -->
                    </div><!-- /.col-md-8 -->


                {{--@permission('delivery.man')
                    @include('partials.place-bid')
                @endpermission--}}

                <!-- /.col-md-4 -->
                </div><!-- /.job-detail-view-body -->
            @else
                <div class="alert alert-danger " role="alert">
                    <strong>Error!</strong> You cannot view order detail of this user. <a href="{{url('login')}}">Log In</a> to view order
                    detail.
                </div>
            @endif

        </div><!-- /.container -->
    </div><!-- /.job-detail -->
    <?php
    if(empty($order->pick_up_latitude)) {
        $lat = config('constant_settings.DEFAULT_LATITUDE');
    } else {
        $lat = $order->pick_up_latitude;
    }

    if(empty($order->pick_up_longitude)) {
        $lng = config('constant_settings.DEFAULT_LONGITUDE');
    } else {
        $lng = $order->pick_up_longitude;
    }
    $marker = getMapMarker($owner->user_type);
    ?>
    <a id="show-map" style="display: none;" href="{{Request::url()}}?fullScreen=full-screen" data-toggle="modal"
       data-target="#quick-view-modal">Full Screen</a>
@endsection
@section('footer-scripts')

    @include('includes.modals.master')

    {!! HTML::script('local/public/assets/js/bootstrap/validator.js') !!}
    {!! HTML::script('local/public/assets/plugins/ratting/ratting.js') !!}
    {!! HTML::style('local/public/assets/plugins/ratting/ratting.css') !!}
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{config('constant_settings.MAP_API_KEY')}}&callback=initMap"
            type="text/javascript"></script>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=377607942628457";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <script>

        function initMap() {
            var directionsDisplay = new google.maps.DirectionsRenderer;
            var directionsService = new google.maps.DirectionsService;
            var map = new google.maps.Map(document.getElementById('delivery-route'), {
                zoom: 8,
                center: {lat: {{$order->latitude}}, lng: {{$order->longitude}} }
            });
            var zoomControlDiv = document.createElement('div');
            new ZoomControl(zoomControlDiv, map);

            zoomControlDiv.index = 1;
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(zoomControlDiv);

            directionsDisplay.setMap(map);

            // embedCentralButton(map, {lat: {{$order->latitude}}, lng: {{$order->longitude}} }, true);
                    @if(!empty($order->driver) && !is_null($order->driver->latitude) && $order->driver->latitude != 0)
            var myLatlng = new google.maps.LatLng("{{$order->driver->latitude}}", "{{$order->driver->longitude}}");
            makeMarker(myLatlng, driverMarker, 'Driver Location', map, "{{$order->driver->address}}"/*legs.end_address*/);
            @endif

        @if($order->pick_up_location == 1)
        calculateAndDisplayRoute(directionsService, directionsDisplay, {{$order->latitude}}, {{$order->longitude}}, {{$lat}}, {{$lng}}, function (response) {

                var legs = response.routes[0].legs[0];
                makeMarker(legs.start_location, driverMarker, "Pickup Location", map, "{{$order->pick_up_location_address}}");
                makeMarker(legs.end_location, markerURl + "{{$marker}}.svg", 'Delivery Location', map, "{{$order->delivery_location}}"/*legs.end_address*/);
                embedCentralButton(map, {
                    lat: response.routes[0].bounds.getCenter().lat(),
                    lng: response.routes[0].bounds.getCenter().lng()
                }, true);
                return response;
            });
                    @else
            var orderLatLng = new google.maps.LatLng("{{$order->latitude}}", "{{$order->longitude}}");
            makeMarker(orderLatLng, markerURl + "{{$marker}}.svg", "Delivery Location", map, "{{$order->delivery_location}}");

            embedCentralButton(map, {
                lat: "{{$order->latitude}}",
                lng: "{{$order->longitude}}"
            }, true);
            @endif

        }


        $(document).ready(function () {
            var ratings = $('#ratings').data('rating');
            $('#ratings').rateYo({
                rating: ratings,
                readOnly: true,
                spacing: '2px',
                height: '20px'
            });
        });
    </script>
    <style>
        #delivery-route {
            width: 100%;
            height: 400px;
        }
    </style>
    @if(isset($myBid))
        <div class="modal fade bs-example-modal-lg" id="update-bid" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document" style="width:20%;">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="popup-wrapper">
                            @if($order->status == config('constant_settings.ORDER_STATUS.IN_PROCESS') && $myBid->status != config('constant_settings.BID_STATUS.CANCELED_DRIVER'))
                                <div class="pro-title">
                                    <h4>Propose different terms?</h4>

                                </div>
                                {!! Form::open(['route' => ['update-bid',Hashids::connection('orders')->encode($myBid->id)],'role'=>'form']) !!}
                                {!! Form::hidden('_method','put') !!}
                                {!! Form::hidden('order_id', Hashids::connection('orders')->encode($order->id)) !!}
                                <div class="form-group">
                                    <label class="sr-only">Amount (in dollars)</label>

                                    <div class="input-group">
                                        <div class="input-group-addon">$</div>
                                        <input name="item_value" type="number" value="" class="form-control"
                                               placeholder="Items(s) Cost"
                                               min="0" step="any">
                                    </div>
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                    <label class="sr-only">Amount (in dollars)</label>

                                    <div class="input-group">
                                        <div class="input-group-addon">$</div>
                                        <input name="delivery_fee" type="number" class="form-control" value=""
                                               placeholder="Delivery Fee"
                                               required min="1" step="any">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Message" required name="description"
                                              rows="8"></textarea>
                                </div>


                                <button type="submit" class="btn btn-orange btn-block">Update
                                </button>
                                {!! Form::close() !!}
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

