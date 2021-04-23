/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 15-Jun-16 4:18 PM
 * File Name    :
 */
//var mainIcon = $('#header').data('default');
//var mainIcon = $('#header').data('default');
//var mainMarker = "/local/public/assets/images/" + mainIcon + ".svg";
var secondaryMarker = "/local/public/assets/images/driver.svg";
var markerUrl = "/local/public/assets/images/";

function initMap() {

    var currentLatitude = parseFloat($('#latitude').val());
    var currentLongitude = parseFloat($('#longitude').val());

    if (currentLatitude != '' || currentLongitude != '') {
        latitude = currentLatitude;
        longitude = currentLongitude;
    }


    var map = new google.maps.Map(document.getElementById('myMap'), {
        center: {lat: latitude, lng: longitude},
        zoom: 12
    });
    var myLatlng = new google.maps.LatLng(latitude, longitude);
    markerMain = new google.maps.Marker({
        map: map,
        position: myLatlng,
        // draggable: true,
        icon: mainMarker,
        id: 'purchaser-marker'
    });
    addMarkers(markerMain, map);
    //handleLocationError(true, infoWindow, map.getCenter());
    //drawCircle('', map, markerMain);
    //$('#latitude').val(latitude);
    //$('#longitude').val(longitude);
    embedZoomButton(map);
    embedCentralButton(map, {
        lat: latitude,
        lng: longitude
    }, true, currentLocation = true);
    //embedCurrentLocationButton(map);
    // Try HTML5 geolocation.
    var defaultMap = $('#filter-sidebar').data('default');
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            markerMain.setMap(null);
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            myLatlng = new google.maps.LatLng(pos.lat, pos.lng);
            markerMain = new google.maps.Marker({
                map: map,
                position: myLatlng,
                // draggable: true,
                icon: mainMarker,
                id: 'purchaser-marker'
            });

            //infoWindow.setPosition(pos);
            //infoWindow.setContent('Location found.');
            map.setCenter(pos);

            // Add circle overlay and bind to marker
            $('#latitude').val(pos.lat);
            $('#longitude').val(pos.lng);

            //Add markers
            if (defaultMap == 0) {
                addMarkers(markerMain, map);
            } else {
                //  drawCircle('', map, markerMain)
                addMarkers(markerMain, map, false);
            }

            setCurrentPosition(map,pos)
        }, function () {
            //drawCircle('', map, markerMain);
        });

    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infowindow, map.getCenter());
    }
}

function setBoxPosition(position, infoBox) {
    var x = position.x;
    var y = position.y;
    console.log(JSON.stringify(position));
    if (y < 344 && (x > 165 && x < 371)) {
        console.log('7');
        infoBox.setOptions({
            pixelOffset: new google.maps.Size(-160, 0),
            alignBottom: false
        })
    } else if (x < 165 && y < 344) {
        console.log('1');
        infoBox.setOptions({
            pixelOffset: new google.maps.Size(20, (y - y) - 40),
            alignBottom: false
        })
    } else if (x > 365 && y < 344) {
        console.log('2');
        infoBox.setOptions({
            pixelOffset: new google.maps.Size(-350, 0),
            alignBottom: false
        })
    } else if (x > 365 && (y > 344 && y < 640)) {
        console.log('3');
        infoBox.setOptions({
            pixelOffset: new google.maps.Size(-350, -247),
            alignBottom: false
        })
    } else if (x < 165 && (y > 344 && y < 640)) {
        console.log('4');
        infoBox.setOptions({
            pixelOffset: new google.maps.Size(20, -247),
            alignBottom: false
        })
    } else if (x < 165 && y > 640) {
        console.log('5');
        infoBox.setOptions({
            pixelOffset: new google.maps.Size(20, -240),
            alignBottom: false
        })
    } else if (x > 365 && y > 640) {
        console.log('6');
        infoBox.setOptions({
            pixelOffset: new google.maps.Size(-350, -257),
            alignBottom: false
        })
    } else {
        infoBox.setOptions({
            pixelOffset: new google.maps.Size(-160, -50),
            alignBottom: true

        })
    }
}
function addMarkers(marker, map, fitBounds) {
    var script = document.createElement('script');
    script.setAttribute("type", "text/javascript");
    script.setAttribute("src", '/local/public/assets/plugins/google-map/infobox.js');
    $('body').append(script);
    var infowindow = new google.maps.InfoWindow();
    var infobox = new InfoBox({
        disableAutoPan: false, //false
        maxWidth: 340,
        alignBottom: true,
        pixelOffset: new google.maps.Size(-160, -60),
        zIndex: null,
        closeBoxMargin: "0 0 -16px -16px",
        //closeBoxURL: mainMarker,
        infoBoxClearance: new google.maps.Size(1, 1),
        //isHidden: false,
        pane: "floatPane",
        enableEventPropagation: true,
        hideCloseButton: true
    });
    var markers;
    $.each(locations, function (index, values, rating) {
        //show markers
        var image = {
            //url: secondaryMarker
            url: markerUrl + values.marker + '.svg'

            // This marker is 20 pixels wide by 32 pixels high.
            //size: new google.maps.Size(32,43)

        };
        markers = new google.maps.Marker({
            position: new google.maps.LatLng(values.latitude, values.longitude),
            map: map,
            animation: google.maps.Animation.DROP,
            icon: image,
            title: values.userType

        });
        google.maps.event.addListener(markers, 'click', (function (markers, index) {

            return function () {
                // console.log(markers)
                //$('#quick-view-' + locations[index].id).trigger('click');

                var scale = Math.pow(2, map.getZoom());
                var offsety = ( (100 / scale) || 0 );
                var projection = map.getProjection();

                var markerPosition = markers.getPosition();


                var markerScreenPosition = projection.fromLatLngToPoint(markerPosition);
                var pointHalfScreenAbove = new google.maps.Point(markerScreenPosition.x, markerScreenPosition.y - offsety);
                var aboveMarkerLatLng = projection.fromPointToLatLng(pointHalfScreenAbove);
                //map.setCenter(aboveMarkerLatLng);
                infobox.setContent(makeInfoWindow(locations, index));
                infobox.open(map, markers);

                $('#info-ratings-' + locations[index].id).rateYo({
                    rating: locations[index].owner.rating,
                    readOnly: true,
                    spacing: '2px',
                    height: '20px'
                });
                // setBoxPosition(positions, infobox);

            }
        })(markers, index));
    });

    fitBounds = typeof fitBounds == 'undefined';
    if (fitBounds) {
        var radius = $('#radius').val();
        if (radius != '') {
            drawCircle(radius, map, marker, fitBounds);
        }
    }

    // Event that closes the Info Window with a click on the map
    google.maps.event.addListener(map, 'click', function () {
        infobox.close();
    });

}
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
}
$(document).ready(function () {
    // var element = $('.save-job');
    $('.job-item').on('click', '.save-job', function () {
        var order_id = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            }
        });
        var _this = $(this);
        $.ajax({
            type: "POST",
            url: '/save-job',
            data: {order_id: order_id, type: $(this).data('type')},
            success: function (data) {
                var btn;
                if (data == 2) {
                    btn = '<a class="add-to-fav  save-job" href="javascript:void(0)" data-id="' + order_id + '" data-type="add"><i class="fa fa-heart-o" aria-hidden="true"></i></a>';
                } else if(data == 1) {
                    btn = '<a class="add-to-fav  save-job" href="javascript:void(0)" data-id="' + order_id + '" data-type="remove"><i class="fa fa-heart" aria-hidden="true"></i></a>';
                }
                //_this.addClass('disabled');
                _this.parent('.add-remove-fav').empty().html(btn);
                //$('.save-job').unbind('click').bind('click');
                //$('.save-job').bind('click');
            },
            error: function (status) {

            }

        });
    });

    $('#clear-filters').click(function () {

        $('.filter-form').find("input[type=text]")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
        /* $(':input')
         .not(':button, :submit, :reset, :hidden')
         .val('')
         .removeAttr('checked')
         .removeAttr('selected');*/
    })


});
