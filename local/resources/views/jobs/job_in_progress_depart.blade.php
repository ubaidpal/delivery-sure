@extends('layouts.default')
@section('content')
    @include('includes.sidebar-right-menu')
    <!-- Job In Progress - Depart-->
    <div class="bidders-view autoheight">
        <div class="container">
            <div class="bidders-view-header">
                <!-- Header Meta -->
                <div class="bidders-header-meta">
                    <a href="javascript:void(0);" class="btn btn-sm btn-gray">{{getCategoryName($order->category_id)}}</a>
                    <a href="{{route('order-detail',[HashId::encode($order->id,'orders')])}}" class="btn btn-green pull-right">VIEW
                        LISTING</a>

                </div><!-- /.job-header-meta -->

                <div class="job-header-detail">
                    <div class="h3">{{$order->title}}</div>

                    <div class="job-status">
                        {{--<div class="job-status-item">
                            <div class="h4">Status:</div>
                            <span>Urgent</span>
                        </div><!-- /.job-status-item -->--}}
                        <div class="job-status-item">
                            <div class="h4">Estimated Delivery Fees:</div>
                            <span>{{format_currency($selectedBid->bid_amount)}}</span>
                        </div><!-- /.job-status-item -->
                        <div class="job-status-item">
                            <div class="h4">Estimated Delivery Time:</div>
                            <span>{{getTimeByTZ($order->deliver_date_time,'m:i A M d, Y')}}</span>
                        </div><!-- /.job-status-item -->
                    </div><!-- /.job-status -->
                </div><!-- /.job-header-detail -->

                <ul class="job-progress list-group">
                    <li class="progress-pager list-group-item">
                        <div class="progress-pager-block">
                            <div class="progress-pager-item checklist"></div><!-- /.progress-pager-item -->
                            <span class="progress-pager-separator "></span><!-- /.progress-pager-separator -->
                            <div class="progress-pager-item depart active"></div><!-- /.progress-pager-item -->
                            <span class="progress-pager-separator active"></span><!-- /.progress-pager-separator -->
                            <div class="progress-pager-item delivered"></div><!-- /.progress-pager-item -->
                        </div><!-- /.progress-pager -->
                        @if($user->id === $order->user_id)
                            <div class="order_pin">Order Pin: {{$order->pin_number}}</div>
                        @endif
                    </li><!-- /.list-group-item -->

                    <li class="list-group-item">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="h2b pull-left">Depart</div>
                            @if($order->user_id != $user->id && $order->status == config('constant_settings.ORDER_STATUS.READY_TO_DEPART'))
                                <a href="{{route('delivered', [Hashids::connection('orders')->encode($order->id)])}}"
                                   class="btn btn-green pull-right">Delivered</a>
                            @elseif($order->user_id != $user->id && $order->status == config('constant_settings.ORDER_STATUS.DELIVERED'))
                                <div class="text text-success pull-right col-sm-10">
                                    {{--Waiting for purchaser's receiving--}}
                                    {!! Form::open(['route' => ['order.received.pin'], 'class' => 'form-inline']) !!}
                                    <div class="form-group">
                                        <label class="col-sm-6">Enter Pin to complete order</label>
                                        <div class="col-sm-4">
                                            {!! Form::hidden('job_id', encodeId($order->id,'orders')) !!}
                                            {!! Form::text('pin_number', NULL, ['class' => 'form-control']) !!}
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="">
                                            {!! Form::submit('Save', ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>

                            @elseif($order->user_id == $user->id && $order->status == config('constant_settings.ORDER_STATUS.DELIVERED'))
                                <a href="{{route('received', [Hashids::connection('orders')->encode($order->id)])}}"
                                   class="btn btn-green pull-right">Received</a>
                            @endif
                        </div><!-- /.col-sm-10 -->
                    </li><!-- /.list-group-item -->

                    <li class="list-group-item">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="job-progress-address col-sm-6">
                                <div class="address-item">
                                    <div class="address-icon row">
                                        <span class="glyphicon glyphicon-map-marker"></span>
                                    </div>
                                    <div class="address-txt">
                                        {{$order->delivery_location}}
                                    </div>
                                </div>
                                <div class="address-item">
                                    <div class="address-icon row">
                                        <span class="glyphicon glyphicon-earphone"></span>
                                    </div>
                                    <div class="address-txt">
                                        {{$selectedBid->bidder->phone_number}}
                                    </div>
                                </div>
                            </div><!-- /.col-sm-6 -->
                            <div class="col-sm-6" id="map">

                            </div><!-- /.col-sm-6 -->
                        </div><!-- /.col-sm-10 -->
                    </li><!-- /.list-group-item -->


                </ul><!-- /.list-group -->

            </div><!-- /.bidders-view-header -->
        </div><!-- /.container -->
    </div><!-- Job In Progress - Depart -->
    <a id="show-map" style="display: none;" href="{{Request::url()}}?fullScreen=full-screen" data-toggle="modal"
       data-target="#quick-view-modal">Full Screen</a>
@endsection
@section('footer-scripts')
    @include('includes.modals.master')
    <style>
        #map {
            height: 287px;
            width: 417px;
        }

        #floating-panel {
            position: absolute;
            top: 10px;
            left: 25%;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
            text-align: center;
            font-family: 'Roboto', 'sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }
    </style>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{config('constant_settings.MAP_API_KEY')}}&callback=initMap"
            type="text/javascript"></script>
    <script>
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
        $marker = getMapMarker($order->owner->user_type);
        ?>

        function initMap() {
            var directionsDisplay = new google.maps.DirectionsRenderer;
            var directionsService = new google.maps.DirectionsService;
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: {lat: parseFloat({{$order->latitude}}), lng: parseFloat({{$order->longitude}})}
            });
            directionsDisplay.setMap(map);

            embedZoomButton(map);

                    @if(!empty($order->driver) && !is_null($order->driver->latitude) && $order->driver->latitude != 0)
            var myLatlng = new google.maps.LatLng(parseFloat({{$order->driver->latitude}}), parseFloat({{$order->driver->longitude}}));
            //console.log(myLatlng);
            makeMarker(myLatlng, driverMarker, 'Driver Location', map, "{{$order->driver->address}}"/*legs.end_address*/);
            @endif
            @if($order->pick_up_location == 1)
        calculateAndDisplayRoute(directionsService, directionsDisplay, parseFloat({{$order->latitude}}), parseFloat({{$order->longitude}}), parseFloat({{$lat}}), parseFloat({{$lng}}), function (response) {
                var legs = response.routes[0].legs[0];
                var myLatlng = new google.maps.LatLng(parseFloat({{$order->latitude}}), parseFloat({{$order->longitude}}));
                makeMarker(legs.start_location, driverMarker, "Pickup Location", map, "{{$order->pick_up_location_address}}");
                makeMarker(myLatlng, markerURl + "{{$marker}}.svg", 'Delivery Location', map, "{{$order->delivery_location}}");
                //console.log(myLatlng);

                embedCentralButton(map, {
                    lat: response.routes[0].bounds.getCenter().lat(),
                    lng: response.routes[0].bounds.getCenter().lng()
                }, true);
                return response;
            });
                    @else
            var orderLatLng = new google.maps.LatLng(parseFloat({{$order->latitude}}), parseFloat({{$order->longitude}}));
            //makeMarker(orderLatLng, markerURl + "{{$marker}}.svg", "Delivery Location", map, "{{$order->delivery_location}}");

            embedCentralButton(map, {
                lat: parseFloat({{$order->latitude}}),
                lng: parseFloat({{$order->longitude}})
            }, true);
            @endif
            /*document.getElementById('mode').addEventListener('change', function () {
             calculateAndDisplayRoute(directionsService, directionsDisplay);
             });*/
        }
    </script>
@endsection




