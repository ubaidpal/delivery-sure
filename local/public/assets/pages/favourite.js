/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 20-Jul-16 1:07 PM
 * File Name    :
 */
//var mainMarker = "/local/public/assets/images/biker.svg";
var secondaryMarker = "/local/public/assets/images/driver_small.svg";
var plusSign = "/local/public/assets/images/plus.png";
var minusSign = "/local/public/assets/images/minus.png";
var fullScreenIcon = "/local/public/assets/images/fullscreen.png";
var moveLeft = "/local/public/assets/images/left.png";
var moveRight = "/local/public/assets/images/right.png";
var setPositionIcon = "/local/public/assets/images/position.png";
(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as anonymous module.
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // Node / CommonJS
        factory(require('jquery'));
    } else {
        // Browser globals.
        factory(jQuery);
    }
})(function ($) {
    function Favourite() {
        this.$addFavourite = $('.addFav');
        this.$addFavouriteUrl = '/add-favourite';
        this.$wrapper = $('.driver-list-wrapper');
        this.$searchField = $('#search');
        this.$searchForm = $('#search-form');
        this.$rating = $('#ratingField');
        this.init();

    }

    Favourite.prototype = {
        Constructor: Favourite,
        init: function () {
            this.addListener();
        },
        ajaxSetup: function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                }
            });
        },
        submitSuccess: function () {
            this.$addFavourite = $('.addFav');
            this.$addFavourite.unbind('click');
            this.$addFavourite.on('click', $.proxy(this.addFavourite, this));
            this.$rating.on('change', $.proxy(this.searchDriver, this));

        },
        searchDriver: function () {
            this.$searchForm.submit();
        },
        addFavourite: function (ele) {
            var userId = $(ele.currentTarget).find('a').data('id');
            var type = $(ele.currentTarget).find('a').data('type');
            this.ajaxSetup();
            var _this = this;
            $.ajax({
                type: 'POST',
                url: this.$addFavouriteUrl,
                data: {userId: userId, type: type},
                cache: true,
                async: false,
                beforeSend: function () {
                    _this.submitStart();
                },
                success: function (data) {

                    var btn;
                    if (data == 2) {
                        btn = '</span> <a class="add-to-fav" href="javascript:void(0)" data-id="' + userId + '" data-type="add"><i class="fa fa-heart-o" aria-hidden="true"></i></a>';
                        $(ele.currentTarget).empty();
                        $(ele.currentTarget).append(btn)
                    } else if (data == 1) {
                        btn = '</span><a data-type="remove" class="add-to-fav" data-id="' + userId + '" href="javascript:void(0)"><i class="fa fa-heart" aria-hidden="true"></i></a>';
                        $(ele.currentTarget).empty();
                        $(ele.currentTarget).append(btn)
                    }

                    _this.submitSuccess();
                },

                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    _this.submitFail(textStatus || errorThrown);
                },
                complete: function () {
                    _this.submitEnd();
                }
            });
        },
        submitStart: function () {

        },
        submitFail: function (msg) {
            this.alert(msg);
        },
        submitEnd: function () {

        },
        addListener: function () {
            this.$addFavourite.on('click', $.proxy(this.addFavourite, this))
        },
        alert: function (msg) {
            var $alert = [
                '<div class="alert alert-danger avatar-alert alert-dismissable">',
                '<button type="button" class="close" data-dismiss="alert">&times;</button>',
                msg,
                '</div>'
            ].join('');

            this.$wrapper.before($alert);
        },
    };
    $(function () {
        return new Favourite();
    });
});
var pos;
function initMap(id) {
    id = id || 'myMap';
    var currentLatitude = parseFloat($('#latitude').val());
    var currentLongitude = parseFloat($('#longitude').val());

    if (currentLatitude != '' || currentLongitude != '') {
        latitude = currentLatitude;
        longitude = currentLongitude;
    }
    var driversMap = new google.maps.Map(document.getElementById(id), {
        center: {lat: latitude, lng: longitude},
        zoom: 17,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var myLatlng = new google.maps.LatLng(latitude, longitude);
    markerMain = new google.maps.Marker({
        map: driversMap,
        position: myLatlng,
        id: 'purchaser-marker',
        // draggable: true,
        icon: mainMarker
    });
    embedZoomButton(driversMap);
    var drawCurrentCircle = {
        draw: true,
        markerId: 'purchaser-marker'
    };
    embedCentralButton(driversMap, {
        lat: latitude,
        lng: longitude
    }, true, currentLocation = true, drawCurrentCircle);

    addDriverMarkers(markerMain, driversMap);

    $('#latitude').val(latitude);
    $('#longitude').val(longitude);
    // Try HTML5 geolocation.
    var defaultMap = $('#filter-sidebar').data('default');

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            markerMain.setMap(null);
            radiusCircle.setMap(null);

            pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var myLatlng = new google.maps.LatLng(pos.lat, pos.lng);
            markerMain = new google.maps.Marker({
                map: driversMap,
                position: myLatlng,
                // draggable: true,
                icon: mainMarker
            });
            //infoWindow.setPosition(pos);
            //infoWindow.setContent('Location found.');
            driversMap.setCenter(pos);
            // Add circle overlay and bind to marker
            $('#latitude').val(pos.lat);
            $('#longitude').val(pos.lng);

            //Add markers
            addDriverMarkers(markerMain, driversMap);
            setCurrentPosition(driversMap,pos)

        }, function () {
        });

    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infowindow, driversMap.getCenter());
    }
}

function addDriverMarkers(marker, map) {
    //var infowindow = new google.maps.InfoWindow();

    var script = document.createElement('script');
    script.setAttribute("type", "text/javascript");
    script.setAttribute("src", '/local/public/assets/plugins/google-map/infobox.js');
    $('body').append(script);
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
    var markersDriver;
    $.each(driverLocations, function (index, values) {
        //show markers
        markersDriver = new google.maps.Marker({
            position: new google.maps.LatLng(parseFloat(values.latitude), parseFloat(values.longitude)),
            map: map,
            animation: google.maps.Animation.DROP,
            //icon: secondaryMarker
            icon: markerURl + values.marker+'.svg'

        });
        google.maps.event.addListener(markersDriver, 'click', (function (markersDriver, index) {
            return function () {
                var scale = Math.pow(2, map.getZoom());
                var offsety = ( (100 / scale) || 0 );
                var projection = map.getProjection();

                var markerPosition = markersDriver.getPosition();


                var markerScreenPosition = projection.fromLatLngToPoint(markerPosition);
                var pointHalfScreenAbove = new google.maps.Point(markerScreenPosition.x, markerScreenPosition.y - offsety);
                var aboveMarkerLatLng = projection.fromPointToLatLng(pointHalfScreenAbove);
                infobox.setContent(makeDriverInfo(driverLocations, index));
                infobox.open(map, markersDriver);

                //$('#quick-view-' + driverLocations[index].id).trigger('click');
            }
        })(markersDriver, index));
    });
    var radius = $('#radius').val();
    drawCircle(radius, map, marker)
}

$('.dropdown-toggle').on('click', function () {
    $(this).parent().toggleClass('open');
    $('.filter-form').toggleClass('filter');
    $('.filter-bg').toggleClass('hide');
});

$('body').on('click', function (e) {
    if (!$('.dropdown-toggle').is(e.target)
        && $('.dropdown-toggle').has(e.target).length === 0
        && $('.list-group-item').has(e.target).length === 0
        && $('.open').has(e.target).length === 0
    ) {
        $('.filter-form').removeClass('filter');
        $('.filter-bg').addClass('hide');
        $('.dropdown-toggle').closest('div').removeClass('open');
    }
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
