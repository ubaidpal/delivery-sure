{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 14-Jun-16 11:27 AM
    * File Name    : 

--}}
<?php
    $mapIcon = getMapMarker($userType)
?>
<div class="col-md-12">
    <div class="row">
        <div class="modal-map" style="height: 700px; width: 1140px; margin-top: 51px;" id="myMap">

        </div>
    </div><!-- /.row -->
</div><!-- /.col-md-9 -->


<script>
    //function initMap() {

        var marker;

        var geocoder = new google.maps.Geocoder();
        var infowindow = new google.maps.InfoWindow();


        var map = new google.maps.Map(document.getElementById('myMap'), {
            center: {lat: {{$lat}}, lng: {{$lng}}},
            zoom: 17,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var myLatlng = new google.maps.LatLng({{$lat}}, {{$lng}});
        marker = new google.maps.Marker({
            map: map,
            position: myLatlng,
            //draggable: true,
            icon: "/local/public/assets/images/{{$mapIcon}}"+".svg"
        });
        geocoder.geocode({'latLng': myLatlng}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    infowindow.setContent(results[0].formatted_address);
                    infowindow.open(map, marker);
                }
            }
        });
    var zoomControlDiv = document.createElement('div');
    new ZoomControl(zoomControlDiv, map);

    zoomControlDiv.index = 1;
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(zoomControlDiv);

    var setCenterControlDiv = document.createElement('div');
    new SetCenterControl(setCenterControlDiv, map,{lat: {{$lat}}, lng: {{$lng}}},false);

    setCenterControlDiv.index = 1;
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(setCenterControlDiv);

    //}
</script>
