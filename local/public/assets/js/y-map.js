var mainIcon = $('#header').data('default');
//var mainIcon = $('#header').data('default');
var markerURl = "/local/public/assets/images/";
var mainMarker = "/local/public/assets/images/" + mainIcon + ".svg";
var driverMarker = "/local/public/assets/images/driver.svg";
var secondaryMarker = "/local/public/assets/images/driver.png";
var plusSign = "/local/public/assets/images/plus.png";
var minusSign = "/local/public/assets/images/minus.png";
var fullScreenIcon = "/local/public/assets/images/fullscreen.png";
var moveLeft = "/local/public/assets/images/left.png";
var moveRight = "/local/public/assets/images/right.png";
var setPositionIcon = "/local/public/assets/images/position.png";
var setCurrentPositionIcon = "/local/public/assets/images/navigation.png";

var latitude = parseFloat($('#dashboard').data('lat')),
    longitude = parseFloat($('#dashboard').data('lng'));

var markerMain, radiusCircle, isRadius = false;
function ZoomControl(controlDiv, map) {
    var option = {
        mapTypeControl: false,
        streetViewControl: false,
        zoomControl: false
    };
    map.setOptions(option);
// Creating divs & styles for custom zoom control
    controlDiv.style.padding = '5px';
    controlDiv.style.left = '0px';

// Set CSS for the control wrapper
    var controlWrapper = document.createElement('div');
    controlWrapper.style.cursor = 'pointer';
    controlWrapper.style.textAlign = 'center';
    controlWrapper.style.width = '61px';
    controlWrapper.style.height = '30px';
    controlDiv.appendChild(controlWrapper);

// Set CSS for the zoomIn
    var zoomInButton = document.createElement('div');
    zoomInButton.style.width = '30px';
    zoomInButton.style.height = '30px';
    zoomInButton.style.float = 'left';
    zoomInButton.style.marginRight = '1px';
    zoomInButton.style.backgroundImage = 'url("' + plusSign + '")';
    controlWrapper.appendChild(zoomInButton);

// Set CSS for the zoomOut
    var zoomOutButton = document.createElement('div');
    zoomOutButton.style.width = '30px';
    zoomOutButton.style.height = '30px';
    zoomOutButton.style.float = 'left';
    zoomOutButton.style.backgroundImage = 'url("' + minusSign + '")';
    controlWrapper.appendChild(zoomOutButton);

// Setup the click event listener - zoomIn
    google.maps.event.addDomListener(zoomInButton, 'click', function () {
        map.setZoom(map.getZoom() + 1);
    });

// Setup the click event listener - zoomOut
    google.maps.event.addDomListener(zoomOutButton, 'click', function () {
        map.setZoom(map.getZoom() - 1);
    });

}

function setCurrentPosition(map, pos) {
    var bottomCenterControls = map.controls[google.maps.ControlPosition.TOP_RIGHT].getAt(0).childNodes;
    google.maps.event.clearListeners(bottomCenterControls[0], 'click');
    google.maps.event.addDomListener(bottomCenterControls[0], 'click', function () {
        map.setCenter(pos);
    });
}
function getCurrentLocation(map, drawCurrentCircle, isOrder) {

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            if (isOrder) {
                markerMain = isOrder.marker;
            }
            markerMain.setMap(null);
            var myLatlng = new google.maps.LatLng(pos.lat, pos.lng);
            markerMain = new google.maps.Marker({
                map: map,
                position: myLatlng,
                // draggable: true,
                icon: mainMarker
            });

            //infoWindow.setPosition(pos);
            //infoWindow.setContent('Location found.');
            map.setCenter(pos);

            if (drawCurrentCircle) {
                drawCircle('', map, markerMain);
            }
            // Add circle overlay and bind to marker
            $('#latitude').val(pos.lat);
            $('#longitude').val(pos.lng);

            //Add markers
            //addMarkers(markerMain, map);
            setCurrentPosition(map, pos);
            if (isOrder) {
                markerMain.setDraggable(true);
                google.maps.event.clearListeners(map, 'click');
                isOrder.marker.setMap(null);
                isOrder.infowindow.close();

                var geocoder = new google.maps.Geocoder();
                var infowindow = new google.maps.InfoWindow();
                geocoder.geocode({'latLng': markerMain.getPosition()}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            getLatLng(isOrder.addressField, isOrder.latField, isOrder.langField, markerMain, results[0], map, infowindow);
                        }
                    }
                });

                google.maps.event.addListener(markerMain, 'dragend', function () {

                    geocoder.geocode({'latLng': markerMain.getPosition()}, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                                getLatLng(isOrder.addressField, isOrder.latField, isOrder.langField, markerMain, results[0], map, infowindow);
                            }
                        }
                    });
                });

                google.maps.event.addListener(map, 'click', function (event) {

                    placeMarker(event, markerMain, map, isOrder.latField, isOrder.langField, isOrder.addressField, infowindow);
                });
                google.maps.event.clearListeners(isOrder.autocomplete, 'place_changed');

                autoComplete(map, isOrder.latField, isOrder.langField, isOrder.autocomplete, infowindow, isOrder.addressField, markerMain);
            }
        }, function () {

            $('#latitude').val(latitude);
            $('#longitude').val(longitude);
            var myLatlng = new google.maps.LatLng(latitude, longitude);
            var markerMain = new google.maps.Marker({
                map: map,
                position: myLatlng,
                // draggable: true,
                icon: mainMarker
            });
            //handleLocationError(true, infoWindow, map.getCenter());
            ///drawCircle('', map, markerMain);

        });

    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }
}
function SetCenterControl(controlDiv, map, position, fullScreenEnabled, currentLocation, drawCurrentCircle, isOrder) {

    if (typeof fullScreenEnabled == 'undefined') {
        fullScreenEnabled = true;
    }

    if (typeof currentLocation == 'undefined' || currentLocation == false) {
        currentLocation = false;
    }

    if (typeof drawCurrentCircle == 'undefined' || currentLocation == false) {
        drawCurrentCircle = false;
    }
    if (typeof isOrder == 'undefined' || isOrder == false) {
        isOrder = false;
    }

    //fullScreenEnabled = typeof fullScreenEnabled == 'undefined';
// Creating divs & styles for custom zoom control
    controlDiv.style.padding = '5px';
    controlDiv.style.right = '0px';
    // controlDiv.style.bottom = '0px';

// Set CSS for the control wrapper
    var controlWrapper = controlDiv;
    controlDiv.style.cursor = 'pointer';
    controlDiv.style.textAlign = 'center';
    controlDiv.style.width = '103px';
    controlDiv.style.height = '30px';
    //controlDiv.appendChild(controlWrapper);

// Set CSS for the zoomIn
    var setPosition = document.createElement('div');
    setPosition.style.width = '30px';
    setPosition.style.height = '30px';
    setPosition.style.float = 'left';
    setPosition.style.marginRight = '1px';
    setPosition.setAttribute('id', 'setPosition');
    setPosition.style.backgroundImage = 'url("' + setPositionIcon + '")';
    controlWrapper.appendChild(setPosition);

// Set CSS for the zoomOut
    var fullScreen = document.createElement('div');
    if (fullScreenEnabled) {
        fullScreen.style.width = '30px';
        fullScreen.style.height = '30px';
        fullScreen.style.float = 'left';
        fullScreen.style.backgroundImage = 'url("' + fullScreenIcon + '")';
        controlWrapper.appendChild(fullScreen);
    }

    var currentLocationWrapper = document.createElement('div');
    if (currentLocation) {
        currentLocationWrapper.style.width = '30px';
        currentLocationWrapper.style.height = '30px';
        currentLocationWrapper.style.float = 'left';
        currentLocationWrapper.style.marginLeft = '1px';
        currentLocationWrapper.style.backgroundImage = 'url("' + setCurrentPositionIcon + '")';
        controlWrapper.appendChild(currentLocationWrapper);

        // Setup the click event listener - currentLocation
        google.maps.event.addDomListener(currentLocationWrapper, 'click', function () {

            getCurrentLocation(map, drawCurrentCircle, isOrder);
        });
    }


// Setup the click event listener - fullScreen
    google.maps.event.addDomListener(fullScreen, 'click', function () {
        $('#show-map').trigger('click');
    });

// Setup the click event listener - setPosition
    google.maps.event.addDomListener(setPosition, 'click', function () {
        map.setCenter(position);
    });

}

function drawCircle(radius, map, marker, fitBounds) {
    fitBounds = typeof fitBounds == 'undefined';
    if (!radius && radius == '') {
        //radius = 500000;
        radius = 8046.7;
    } else {
        //radius = radius * 1000; //Km
        radius = radius * 1609.34; //mile
    }
    if (isRadius) {
        radiusCircle.setMap(null);

    }
    radiusCircle = new google.maps.Circle({
        map: map,
        radius: radius,   // metres
        fillColor: '#98CAE3',
        strokeColor: '#98CAE3',
        strokeWeight: 2,
        fillOpacity: 0.35,
        strokeStyle: {
            boxShadow: '15 15 15 300'
        }
    });
    radiusCircle.bindTo('center', marker, 'position');
    // if(fitBounds){
    map.fitBounds(radiusCircle.getBounds());
    // }
    isRadius = true;


}

function calculateAndDisplayRoute(directionsService, directionsDisplay, lat, lng, destLat, destLng, callback) {

    // directionsDisplay.setMap(map);
    var selectedMode = 'DRIVING';
    directionsDisplay.setOptions({suppressMarkers: true});
    directionsService.route({
        origin: {lat: destLat, lng: destLng},  // Haight.
        destination: {lat: lat, lng: lng},  // Ocean Beach.
        /*waypoints: [{
         location: new google.maps.LatLng(31.424747, 74.181297),
         stopover: true
         }],
         optimizeWaypoints: true,*/
        travelMode: google.maps.TravelMode[selectedMode]
    }, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
            var legs = response.routes[0].legs[0];
            return callback(response);
            // makeMarker(leg.start_location, mainMarker, "title", map);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}

function makeMarker(position, icon, title, map, address) {
    var marker = new google.maps.Marker({
        position: position,
        map: map,
        icon: icon,
        title: title
    });
    var pickUpInfoWindow = new google.maps.InfoWindow();
    var content = '<b>' + title + '<br></b>' + address + '';
    pickUpInfoWindow.setContent(content);
    //pickUpInfoWindow.open(map, marker);

    marker.addListener('click', (function () {
        pickUpInfoWindow.setContent(content);
        pickUpInfoWindow.open(map, marker);
    }));
}

function embedCentralButton(map, position, showFullScreen, currentLocation, drawCurrentCircle, isOrder) {
    var setCenterControlDiv = document.createElement('div');
    new SetCenterControl(setCenterControlDiv, map, position, showFullScreen, currentLocation, drawCurrentCircle, isOrder);

    setCenterControlDiv.index = 1;
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(setCenterControlDiv);
}


function embedZoomButton(map) {
    var zoomControlDiv = document.createElement('div');
    new ZoomControl(zoomControlDiv, map);

    zoomControlDiv.index = 1;
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(zoomControlDiv);

}

function makeInfoWindow(values, index) {
    var infoboxContent = document.createElement("div");
    infoboxContent.className = 'property-item item-grid map-info-box';
    var UserClass = 'purchaser-job';
    if (values[index].userType == 'Retailer') {
        UserClass = 'retailer-job';
    }

    var BtnTitle = 'View Detail';
    if (values[index].is_bidded == 1) {
        BtnTitle = 'Update Bid';
    }
    infoboxContent.innerHTML = '<div class="job-item map-popup ' + UserClass + '">' +
        '<div class="buyer-detail">' +
        '<div class="buyer-img">' +
        '<img src="' + values[index].owner.profile_picture + '" alt="image">' +
        '</div>' +
        '<div class="buyer-detail-wrapper">' +
        '<a class="buyer-name" href="/profile/' + values[index].owner.id + '">' + values[index].owner.name + '</a>' +
        '<div class="info-ratings" id="info-ratings-' + values[index].id + '" data-rating="' + values[index].owner.rating + '"></div>' +
        '</div><!-- /.buyer-detail-wrapper -->' +
        '<a class="view-detail btn" href="/order-detail/' + values[index].url + '">' + BtnTitle + '</a>' +
        '</div><!-- /.buyer-detail -->' +
        '<div class="col-md-8">' +
        '<div class="job-header-detail">' +
        '<div class="h3">' + values[index].title +
        '<a data-id="7ZB69AB5" href="javascript:void(0);" class="btn btn-gray save-job">' +
        '<span class="glyphicon glyphicon-star-empty"></span>' +
        '</a>' +
        '</div>' +
        '</div>' +
        '<div class="job-body">' +
        '<p class="job-detail">' +
        values[index].description +
        '</p>' +
        '</div>' +
        '</div>' +
        '<div class="col-md-4">' +
        '<div class="row">' +
        '<div class="job-status-item">' +
        '<span>' + values[index].deliveryFee + '</span>' +
        '<div class="h4">Delivery Fee</div>' +
        '</div><!-- /.job-status-item -->' +
        '</div>' +
        '</div>' +
        '<div class="clearfix"></div>' +
        '<div class="buyer-address">' +
        '<span class="glyphicon glyphicon-map-marker"></span>' +
        '<span>' + values[index].address + '</span>' +
        '</div>' +
        '<div class="delivery-time">' +
        '<div class="h4">Delivery Time <span class="glyphicon glyphicon-time pull-right"></span></div>' +
        '<span>' + values[index].time + '</span>' +

        '</div>' +
        '</div> ';

    return infoboxContent;

}
function getLatLng($addressField, $latitude, $longitude, marker, result, map, infowindow) {
    $addressField.val(result.formatted_address).parents('.form-group').addClass('focus');
    $latitude.val(marker.getPosition().lat());
    $longitude.val(marker.getPosition().lng());
    infowindow.setContent(result.formatted_address);
    infowindow.open(map, marker);
    map.setCenter({lat: marker.getPosition().lat(), lng: marker.getPosition().lng()});
}

function updateAddress($addressField, $latitude, $longitude, marker, map, infoWindow) {
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                getLatLng($addressField, $latitude, $longitude, marker, results[0], map, infoWindow);
            }
        }
    });
}
function makeDriverInfo(values, index) {
    var infoboxContent = document.createElement("div");
    infoboxContent.className = 'property-item item-grid map-info-box';
    var UserClass = 'purchaser-job';
    if (values[index].userType == 'Retailer') {
        UserClass = 'retailer-job';
    }

    var BtnTitle = 'View Profile';
    infoboxContent.innerHTML = '<div class="job-item map-popup ' + UserClass + '">' +
        '<div class="buyer-detail">' +
        '<div class="buyer-img">' +
        '<img src="' + values[index].profile_picture + '" alt="image">' +
        '</div>' +
        '<div class="buyer-detail-wrapper">' +
        '<a class="buyer-name" href="' + values[index].url + '">' + values[index].name + '</a>' +
        '<div class="info-ratings" id="info-ratings-' + values[index].id + '" data-rating="' + values[index].rating + '"></div>' +
        '<div class="member col-sm-7 nopadding" id="" data-rating="">Member Since: ' + values[index].member_since + '</div>' +
        values[index].progress_bar+
        '</div><!-- /.buyer-detail-wrapper -->' +
        '<a class="view-detail btn" href="' + values[index].url + '">' + BtnTitle + '</a>' +
        '</div><!-- /.buyer-detail -->' +
        '<div class="col-md-12">' +
        '<div class="job-body">' +
        '<p class="job-detail">' +
        values[index].about +
        '</p>' +
        '</div>' +
        '</div>' +
        '<div class="clearfix"></div>' +
        '<div class="buyer-address">' +
        '<span class="glyphicon glyphicon-map-marker"></span>' +
        '<span>' + values[index].address + '</span>' +
        '</div>' +
        '</div> ';

    return infoboxContent;

}
function currentLocation(map) {

}

function geolocationNotSupported(map, infoWindow) {
    handleLocationError(false, infoWindow, map.getCenter());
}

function hasGeolocation(position) {


}

function noGeolocation(map) {


}
