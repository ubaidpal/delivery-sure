{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 27-Jul-16 2:44 PM
    * File Name    : 

--}}
<div class="col-md-12">
    <div class="row">
        <div class="modal-map" style="height: 700px; width: 1140px; margin-top: 51px;" id="delivery-route-full">

        </div>
    </div><!-- /.row -->
</div><!-- /.col-md-9 -->
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
<script>
    $(function () {

        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        var map = new google.maps.Map(document.getElementById('delivery-route-full'), {
            zoom: 12,
            center: {lat: {{$order->latitude}}, lng: {{$order->longitude}} }
        });
        var zoomControlDiv = document.createElement('div');
        new ZoomControl(zoomControlDiv, map);

        zoomControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(zoomControlDiv);
        directionsDisplay.setMap(map);

                @if(!empty($order->driver) && !is_null($order->driver->latitude) && $order->driver->latitude != 0)
        var myLatlng = new google.maps.LatLng("{{$order->driver->latitude}}", "{{$order->driver->longitude}}");
        makeMarker(myLatlng, driverMarker, 'Driver Location', map, "{{$order->driver->address}}"/*legs.end_address*/);
        @endif
         @if($order->pick_up_location == 1)
    calculateAndDisplayRoute(directionsService, directionsDisplay, {{$order->latitude}}, {{$order->longitude}}, {{$lat}}, {{$lng}}, function (response) {

            var legs = response.routes[0].legs[0];
            makeMarker(legs.start_location, driverMarker, "Pickup Location", map, "{{$order->pick_up_location_address}}");
            makeMarker(legs.end_location, markerURl + "{{$marker}}.svg", 'Delivery Location', map, "{{$order->delivery_location}}");
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
    })
</script>
