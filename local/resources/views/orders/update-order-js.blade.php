{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 27-Oct-16 12:23 PM
    * File Name    : 

--}}
<script>
    function initMapUpdate() {
        var geocoder = new google.maps.Geocoder();
                @if($order->pick_up_location == 1)
        var pickUpMarker;
        var pickUpInfoWindow = new google.maps.InfoWindow();

        var pickUpMap = new google.maps.Map(document.getElementById('pickUpMap'), {
            center: {lat: {{$order->pick_up_latitude}}, lng: {{$order->pick_up_longitude}}},
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var inputPick = (document.getElementById('pickUpInput'));
        var autocompleteF = new google.maps.places.Autocomplete(inputPick);
        autocompleteF.bindTo('bounds', pickUpMap);
        var myLatlng = new google.maps.LatLng("{{$order->pick_up_latitude}}", "{{$order->pick_up_longitude}}");
        pickUpMarker = new google.maps.Marker({
            map: pickUpMap,
            position: myLatlng,
            //draggable: true,
            icon: mapIcon
        });
        embedZoomButton(pickUpMap);
        var pos = {
            lat: {{$order->pick_up_latitude}},
            lng: {{$order->pick_up_longitude}}
        };
        pickUpMap.setCenter(pos);
        pickUpInfoWindow.setContent("{{$order->pick_up_location_address}}");
        pickUpInfoWindow.open(pickUpMap, pickUpMarker);

        if ($('#mainBox').data('userType') == 'Retailer') {
            pickUpMarker = new google.maps.Marker({
                map: pickUpMap,
                position: myLatlng,
                //draggable: true,
                icon: mapIcon
            });
            embedCentralButton(pickUpMap, pos, false, currentLocation = false);

            getAddress(myLatlng, pos.lat, pos.lng, pickUpInfoWindow, pickUpMap, pickUpMarker, $('#pickUpLatitude'), $('#pickUpLongitude'), $('input[name="pickUp_location"]'));
        }else{
            autoComplete(pickUpMap, $('#pickUpLatitude'), $('#pickUpLongitude'), autocompleteF, pickUpInfoWindow, $('input[name="pickUp_location"]'), pickUpMarker);

            var isOrder = {
                latField: $('#pickUpLatitude'),
                langField: $('#pickUpLongitude'),
                addressField: $('input[name="pickUp_location"]'),
                marker: pickUpMarker,
                infowindow: pickUpInfoWindow,
                autocomplete: autocomplete
            };
            pickUpMarker.setDraggable(true);
            embedCentralButton(pickUpMap, pos, false, currentLocation = true, false, isOrder);

            google.maps.event.addListener(pickUpMarker, 'dragend', function () {
                updateAddress($('input[name="pickUp_location"]'), $('#pickUpLatitude'), $('#pickUpLongitude'),pickUpMarker,pickUpMap, pickUpInfoWindow);
            });

            google.maps.event.addListener(pickUpMap, 'click', function (event) {
                placeMarker(event, pickUpMarker, pickUpMap, $('#pickUpLatitude'), $('#pickUpLongitude'), $('input[name="pickUp_location"]'), pickUpInfoWindow);
            });
            //markerMain = pickUpMarker;
        }

                @endif
        var marker;
        var infowindow = new google.maps.InfoWindow();


        var map = new google.maps.Map(document.getElementById('myMap'), {
            center: {lat: {{$order->latitude}}, lng: {{$order->longitude}}},
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var myLatlng = new google.maps.LatLng("{{$order->latitude}}", "{{$order->longitude}}");
        marker = new google.maps.Marker({
            map: map,
            position: myLatlng,
            draggable: true,
            icon: mapIcon
        });
        embedZoomButton(map);
        var pos = {
            lat: {{$order->latitude}},
            lng: {{$order->longitude}}
        };

        embedCentralButton(map, pos, false, currentLocation = true, false, isOrder);
        var input = (document.getElementById('pac-input'));
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        var isOrder = {
            latField: $('#latitude'),
            langField: $('#longitude'),
            addressField: $('input[name="delivery_location"]'),
            marker: marker,
            infowindow: infowindow,
            autocomplete: autocomplete
        };
        infowindow.setContent("{{$order->delivery_location}}");
        infowindow.open(map, marker);

        google.maps.event.addListener(marker, 'dragend', function () {

           updateAddress($('input[name="delivery_location"]'), $('#latitude'), $('#longitude'), marker, map, infowindow)
        });
        autoComplete(map, $('#latitude'), $('#longitude'), autocomplete, infowindow, $('input[name="delivery_location"]'), marker);
        google.maps.event.addListener(map, 'click', function (event) {

            placeMarker(event, marker, map, $('#latitude'), $('#longitude'), $('input[name="delivery_location"]'), infowindow);
        });
    }
    function placeMarker(location, marker, map, latField, lngField, addressField, infowindow) {
        /*marker=  marker.setMap(null);
         marker = new google.maps.Marker({
         map: map,
         position: location.latLng,
         draggable: true,
         icon: mapIcon
         });*/
        marker.setPosition(location.latLng);
        getAddress(location.latLng, location.latLng.lat(), location.latLng.lng(), infowindow, map, marker, latField, lngField, addressField);
        //map.setCenter(location);


    }
    function getAddress(location, lat, lng, infowindow, map, marker, latField, lngField, addressField) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({'latLng': location}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    addressField.click().val(results[0].formatted_address);
                    latField.val(lat);
                    lngField.val(lng);
                    infowindow.setContent(results[0].formatted_address);
                    infowindow.open(map, marker);
                }
            }
        });
    }
</script>
