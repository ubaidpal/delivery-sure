/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 13-Jun-16 3:31 PM
 * File Name    :
 */
var mapIcon = mainMarker;
var geocoder;
var marker;
var orderAmount = 0;
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
    function Orders() {
        this.$addPickUpPoint = $('input[name="pickUp"]');
        this.$pickUpLocationBlock = $('#picUpLocationBlock');
        this.$addNewItem = $('#add-new-delivery-item');
        this.$appendAmount = $('#total-amount');
        this.$itemsPrice = $('#items-price');
        this.$deliveryFeeText = $('#delivery-fee');
        this.$totalAmount = 0;
        this.$deliveryFee = $('input[name="estimate_delivery_fee"]');
        this.$itemPrice = $('input[name="item_price[]"]');
        this.$mainBox = $('#mainBox');
        this.$saveOrderBtn = $('#save-order-btn');
        this.$placeOrderForm = $('#place_order_form');
        this.$deliveryTime = $('#delivery-time');
        this.$pickUpTime = $('#pickup-time');
        this.$deliveryDate = $('#pickup-date');
        this.$pickUpDate = $('#pickUp');
        this.totalAmount();
        this.init();

    }

    Orders.prototype = {
        Constructor: Orders,
        init: function () {
            this.addListener();
        },


        totalAmount: function () {
            //this.$totalAmount = 0;
            var amount = 0;
            if (this.$deliveryFee.val() != '') {
                var deliveryFee = parseFloat(this.$deliveryFee.val());
            }
            $.each(this.$itemPrice, function () {

                if ($(this).val() != '') {
                    amount = parseFloat(amount) + parseFloat($(this).val());
                }
            });

            //this.$totalAmount = amount;
            //console.log(this.$totalAmount);

            //this.$totalAmount = parseInt(this.$totalAmount) + parseInt($(ele.target).val());
            if (isNaN(amount)) {
                amount = 0;
            }

            this.$itemsPrice.text('$ ' + amount.toFixed(2));
            if (typeof deliveryFee == 'undefined' || isNaN(deliveryFee)) {
                deliveryFee = 0;
            }
            this.$deliveryFeeText.text('$ ' + deliveryFee.toFixed(2));
            var total = parseFloat(amount) + parseFloat(deliveryFee);
            this.$appendAmount.text('$' + total.toFixed(2));
            orderAmount = total;
        },
        saveOrder: function (e) {
            //e.preventDefault();

            //var startDateTextBox = $('#pickUp');
            //var endDateTextBox = $('#datepicker');

            //var startTime = $('#pickup-time');
            //var endTime = $('#delivery-time');

            //var date = $.datepicker.parseDate('dd-mm-yy', startDateTextBox.val()+' '+startTime.val()+"00");
            //alert(startDateTextBox.val()+' '+startTime.val());
            //alert(date);
        },

        validateAmount: function (ele) {
            var val = $(ele.currentTarget).val();
            // var parts = val.toString().split('.');

            if (val.length > 4) {
                // $(ele.currentTarget).val(val.substring(0, 4))
            }
            this.totalAmount();
        },
        isNumber: function (number) {
            return !isNaN(number - 0);
        },
        addListener: function () {
            this.$addPickUpPoint.on('click', $.proxy(this.addPickUpPoint, this));
            this.$addNewItem.on('click', $.proxy(this.appendNewItem, this));
            this.$deliveryFee.on('change', $.proxy(this.totalAmount, this));
            this.$itemPrice.on('change', $.proxy(this.validateAmount, this));
            this.$saveOrderBtn.on('click', $.proxy(this.saveOrder, this));
            this.$deliveryTime.on('changeTime', $.proxy(this.validateDate, this));
            this.$pickUpTime.on('changeTime', $.proxy(this.validateDate, this));
        },
        validateDate: function (ele) {
            var time = $(ele.currentTarget).val();

            var eleId = $(ele.currentTarget).attr('id');
            var date = this.$deliveryDate.val();
            if (eleId == 'pickup-time') {
                date = this.$pickUpDate.val();
            }

            var dateTime = moment(date + ' ' + time, 'DD-MM-YYYY h:mm A');

            if (moment().isAfter(dateTime)) {

                setTimeout(function () {
                    $(ele.currentTarget).val('');
                    $(ele.currentTarget).parent().addClass('has-error');

                }, 100)
            } else {

                $(ele.currentTarget).parent().removeClass('has-error');
            }

        },
        appendNewItem: function () {
            var html = '<div class="row" ><div class="col-md-8"><div class="form-group"><label class="animate-label"></label><input type="text" class="form-control" name="item_name[]" required></div></div><div class="col-md-3"><div class="form-group"><label class="animate-label"></label><input type="number" class="form-control " name="item_price[]" step="any" ></div></div><div class="col-md-1 col-btn-del"><a href="javascript:void(0);" class="btn btn-del removeItemCol">&times;</a></div></div>';
            //$('.btn-del').unbind('click');

            $(html).insertBefore('#add-new-delivery-item');
            this.$itemPrice = $('input[name="item_price[]"]');
            this.$itemPrice.unbind('change');
            $('.col-btn-del').on('click', $.proxy(this.removeItemHtml, this));

            this.$itemPrice.on('change', $.proxy(this.validateAmount, this));

        },
        removeItemHtml: function (ele) {
            $(ele.currentTarget).parent('.row').remove();
            this.$itemPrice = $('input[name="item_price[]"]');
            this.totalAmount();
        },
        addPickUpPoint: function () {

            if (this.$addPickUpPoint.is(':checked')) {
                var pickUpMarker;
                this.$pickUpLocationBlock.show().find('input').prop('required', true);
                $('html, body').animate({
                    scrollTop: this.$pickUpLocationBlock.offset().top
                }, 1000);

                var geocoder = new google.maps.Geocoder();
                var pickUpInfoWindow = new google.maps.InfoWindow();

                var pickUpMap = new google.maps.Map(document.getElementById('pickUpMap'), {
                    center: {lat: latitude, lng: longitude},
                    zoom: 12,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                var myLatlng = new google.maps.LatLng(latitude, longitude);
                pickUpMarker = new google.maps.Marker({
                    map: pickUpMap,
                    position: myLatlng,
                    //draggable: true,
                    icon: mapIcon
                });
                embedZoomButton(pickUpMap);
                var pos = {
                    lat: latitude,
                    lng: longitude
                };
                pickUpMap.setCenter(pos);
                //var infoWindow = new google.maps.InfoWindow({map: map});

                if (this.$mainBox.data('userType') == 'Business') {
                    pickUpMarker = new google.maps.Marker({
                        map: pickUpMap,
                        position: myLatlng,
                        //draggable: true,
                        icon: mapIcon
                    });
                    embedCentralButton(pickUpMap, pos, false, currentLocation = false);

                    getAddress(myLatlng, pos.lat, pos.lng, pickUpInfoWindow, pickUpMap, pickUpMarker, $('#pickUpLatitude'), $('#pickUpLongitude'), $('input[name="pickUp_location"]'));
                } else {


                    var isOrder = {
                        latField: $('#pickUpLatitude'),
                        langField: $('#pickUpLongitude'),
                        addressField: $('input[name="pickUp_location"]'),
                        marker: pickUpMarker,
                        infowindow: pickUpInfoWindow,
                        autocomplete: autocomplete
                    };
                    embedCentralButton(pickUpMap, pos, false, currentLocation = true, false, isOrder);

                    google.maps.event.addListener(pickUpMarker, 'dragend', function () {
                        geocoder.geocode({'latLng': pickUpMarker.getPosition()}, function (results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                if (results[0]) {
                                    getLatLng($('input[name="pickUp_location"]'), $('#pickUpLatitude'), $('#pickUpLongitude'), pickUpMarker, results[0], pickUpMap, pickUpInfoWindow);
                                }
                            }
                        });
                    });

                    google.maps.event.addListener(pickUpMap, 'click', function (event) {
                        placeMarker(event, pickUpMarker, pickUpMap, $('#pickUpLatitude'), $('#pickUpLongitude'), $('input[name="pickUp_location"]'), pickUpInfoWindow);
                    });
                    var input = (document.getElementById('pickUpInput'));
                    var autocomplete = new google.maps.places.Autocomplete(input);
                    autocomplete.bindTo('bounds', pickUpMap);
                    //marker = pickUpMarker;
                    autoComplete(pickUpMap, $('#pickUpLatitude'), $('#pickUpLongitude'), autocomplete, pickUpInfoWindow, $('input[name="pickUp_location"]'), pickUpMarker);
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function (position) {
                            pickUpMarker.setMap(null);
                            var pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };

                            pickUpMap.setCenter(pos);
                            var myLatlng = new google.maps.LatLng(pos.lat, pos.lng);
                            pickUpMarker = new google.maps.Marker({
                                map: pickUpMap,
                                position: myLatlng,
                                draggable: true,
                                icon: mapIcon
                            });
                            geocoder.geocode({'latLng': myLatlng}, function (results, status) {
                                if (status == google.maps.GeocoderStatus.OK) {
                                    if (results[0]) {
                                        getLatLng($('input[name="pickUp_location"]'), $('#pickUpLatitude'), $('#pickUpLongitude'), pickUpMarker, results[0], pickUpMap, pickUpInfoWindow);
                                    }
                                }
                            });
                            google.maps.event.clearListeners(pickUpMarker, 'dragend');
                            google.maps.event.addListener(pickUpMarker, 'dragend', function () {

                                geocoder.geocode({'latLng': pickUpMarker.getPosition()}, function (results, status) {
                                    if (status == google.maps.GeocoderStatus.OK) {
                                        if (results[0]) {
                                            getLatLng($('input[name="pickUp_location"]'), $('#pickUpLatitude'), $('#pickUpLongitude'), pickUpMarker, results[0], pickUpMap, pickUpInfoWindow);
                                        }
                                    }
                                });
                            });
                            google.maps.event.clearListeners(pickUpMarker, 'click');
                            google.maps.event.addListener(pickUpMap, 'click', function (event) {
                                placeMarker(event, pickUpMarker, pickUpMap, $('#pickUpLatitude'), $('#pickUpLongitude'), $('input[name="pickUp_location"]'), pickUpInfoWindow);
                            });
                            //marker = pickUpMarker;
                            autoComplete(pickUpMap, $('#pickUpLatitude'), $('#pickUpLongitude'), autocomplete, pickUpInfoWindow, $('input[name="pickUp_location"]'), pickUpMarker);
                        }, function () {

                        });
                    }
                }
            } else {
                this.$pickUpLocationBlock.hide().find('input').prop('required', false);
            }

        }
    };
    $(function () {
        return new Orders();
    });
    var startDateTextBox = $('#pickUp');
    var endDateTextBox = $('#datepicker');
    var startTime = $('#pickup-time');
    var endTime = $('#delivery-time');

    $(function () {
        $('#pickup-time, #delivery-time').timepicker({
            'showDuration': true,
            'timeFormat': 'g:i A',
            'scrollDefault': 'now'
        });
        var dateFormat = "dd-mm-yy",
            from = $('#pickUp')
                .datepicker({
                    dateFormat: dateFormat,
                    changeMonth: true,
                    minDate: 0
                    // numberOfMonths: 3
                })
                .on("change", function () {
                    to.datepicker("option", "minDate", getDate(this));
                }),
            to = $('#pickup-date').datepicker({
                dateFormat: dateFormat,
                changeMonth: true,
                minDate: 0
                // numberOfMonths: 3
            })
                .on("change", function () {
                    from.datepicker("option", "maxDate", getDate(this));
                });

        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }

            return date;
        }
    });

    $(document).on('click', '.col-btn-del', function () {
        // $(this).parent('.row').remove();
    });
    $("#pac-input, #pickUpInput").focusin(function () {
        $(document).keypress(function (e) {
            if (e.which == 13) {
                e.preventDefault();
            }
        });
    });

});

$(document).ready(function () {

});

function initMap() {

    geocoder = new google.maps.Geocoder();
    var infowindow = new google.maps.InfoWindow();


    var map = new google.maps.Map(document.getElementById('myMap'), {
        center: {lat: latitude, lng: longitude},
        zoom: 12
    });
    embedZoomButton(map);

    // map.setOptions({styles: styles});
    var myLatlng = new google.maps.LatLng(latitude, longitude);
    marker = new google.maps.Marker({
        map: map,
        position: myLatlng,
        draggable: true,
        icon: mapIcon
    });
    var pos = {
        lat: latitude,
        lng: longitude
    };

    map.setCenter(pos);
    // Create the search box and link it to the UI element.
    var input = (document.getElementById('pac-input'));
    var autocompleteF = new google.maps.places.Autocomplete(input);
    autocompleteF.bindTo('bounds', map);
    autoComplete(map, $('#latitude'), $('#longitude'), autocompleteF, infowindow, $('input[name="delivery_location"]'), marker);
    var isOrder = {
        latField: $('#latitude'),
        langField: $('#longitude'),
        addressField: $('input[name="delivery_location"]'),
        marker: marker,
        infowindow: infowindow,
        autocomplete: autocompleteF
    };
    embedCentralButton(map, pos, false, currentLocation = true, false, isOrder);
    google.maps.event.addListener(map, 'click', function (event) {

        placeMarker(event, marker, map, $('#latitude'), $('#longitude'), $('input[name="delivery_location"]'), infowindow);
    });
    google.maps.event.addListener(marker, 'dragend', function () {

        geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    getLatLng($('input[name="delivery_location"]'), $('#latitude'), $('#longitude'), marker, results[0], map, infowindow);
                }
            }
        });
    });
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            //infoWindow.setPosition(pos);
            //infoWindow.setContent('Location found.');
            map.setCenter(pos);
            marker.setMap(null);
            myLatlng = new google.maps.LatLng(pos.lat, pos.lng);
            //marker = new google.maps.Marker();
            marker = new google.maps.Marker({
                map: map,
                position: myLatlng,
                draggable: true,
                icon: mapIcon
            });
            geocoder.geocode({'latLng': myLatlng}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        getLatLng($('input[name="delivery_location"]'), $('#latitude'), $('#longitude'), marker, results[0], map, infowindow);
                    }
                }
            });
            google.maps.event.clearListeners(marker, 'dragend');
            google.maps.event.addListener(marker, 'dragend', function () {

                geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            getLatLng($('input[name="delivery_location"]'), $('#latitude'), $('#longitude'), marker, results[0], map, infowindow);
                        }
                    }
                });
            });

            google.maps.event.addListener(map, 'click', function (event) {

                placeMarker(event, marker, map, $('#latitude'), $('#longitude'), $('input[name="delivery_location"]'), infowindow);
            });

            autoComplete(map, $('#latitude'), $('#longitude'), autocompleteF, infowindow, $('input[name="delivery_location"]'), marker);

        }, function () {
        });
    } else {

    }

}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
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
function autoComplete(map, latField, lngField, autocomplete, infowindow, addressField, marker) {
    //autocomplete.clearListeners('place_changed');

    autocomplete.addListener('place_changed', function () {
        infowindow.close();
        /* marker='';
         marker = new google.maps.Marker({
         map:map,
         draggable: true
         });*/
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(12);  // Why 17? Because it looks good.
        }


        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }

        //infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.setContent(address);
        infowindow.open(map, marker);
        latField.val(place.geometry.location.lat());
        lngField.val(place.geometry.location.lng());

        google.maps.event.addListener(marker, 'dragend', function () {

            getAddress(marker.getPosition(), marker.getPosition().lat(), marker.getPosition().lng(), infowindow, map, marker, latField, lngField, addressField);

        });
        google.maps.event.addListener(map, 'click', function (event) {
            placeMarker(event, marker, map, latField, lngField, addressField, infowindow);
        });
    });

}

function getAddress(location, lat, lng, infowindow, map, marker, latField, lngField, addressField) {
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

function disableEnter() {
    var input = $('#pac-input');
    google.maps.event.addDomListener(input, 'keydown', function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
        }
    });
}


$(function () {
    $('#save-order-btn').click(function () {
        var deliveryDateTime = $('#pickup-date').val() + ' ' + $('#delivery-time').val();
        var pickUpDateTime = $('#pickUp').val() + ' ' + $('#pickup-time').val();
        if (deliveryDateTime < pickUpDateTime) {
            alert('Pick up time must be earlier than the delivery time.');
            $('#pickup-time').val('').addClass('has-error');
            return false;
        } else {
            $('#pickup-time').removeClass('has-error')
        }
        /*if (parseInt(orderAmount) > 9999.99) {
         alert('Total price must be less then 10000');
         return false;
         }*/
        $('#place_order_form').submit(function (e) {
            e.preventDefault();
            $('#order-summary').modal();
        });
    });

    $('#submit-order').click(function () {
        var data = $('#place_order_form').serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            }
        });
        $.ajax({
            type: "POST",
            url: $('#place_order_form').attr('action'),
            data: data,
            beforeSend: function () {
                $('#submit-order').text('Wait...').attr('disabled', true)
            }, success: function (data) {
                if (data.error == 2) {
                    $('#order-summary').modal('toggle');
                    alert(data.message);
                } else if (data.error == 1) {
                    $('#order-summary').modal('toggle');
                    var html = '<ul>';
                    $.each(data.errors, function (index, value) {
                        html += '<li>' + value + '</li>'
                    });
                    html += '</ul>';
                    alert(html);
                } else {
                    window.location = '/my-orders'
                }
            }, error: function () {
                alert('Something went wrong. PLease try again');
                $('#submit-order').text('Confirm & PROCEED').attr('disabled', false)
            }, complete: function () {
                $('#submit-order').text('Confirm & PROCEED').attr('disabled', false)
            }
        });
        // $('#place_order_form').unbind('submit').submit()
    });

    $('#order-summary').on('show.bs.modal', function () {
        var values = ['', ''];
        $.each($('#place_order_form').serializeArray(), function (i, field) {
            if (field.name == 'order_description') {
                $('#' + field.name).empty().html(field.value.replace(/\n/g, '<br/>'));
            }
            if (field.name == 'item_name[]' || field.name == 'item_price[]') {
                //console.log(i);

                // values[field.name] = field.value;
            } else {
                $('#' + field.name).empty().text(field.value);
                //values[field.name] = field.value;
            }

        });

        $('#items').empty();
        var item_price = $("input[name='item_price[]']").map(function () {
            return this.value; // $(this).val()
        }).get();
        var sum = 0;
        $.each(item_price, function () {
            sum += parseFloat(this) || 0;
        });
        $('#item-price').empty().text('$ ' + sum);
        var deliveryFee = parseFloat($("input[name='estimate_delivery_fee']").val());
        $('#total').empty().text('$ ' + (sum + deliveryFee));
        $("input[name='item_name[]']").each(function (i) {
            var html = '<tr> <td>' + $(this).val() + '</td> <td class="align-right">$ ' + item_price[i] + '</td> </tr>';
            $('#items').append(html)
        });

        if ($('input[name="pickUp"]').is(':checked')) {
            $('#pickup-block').show();
        } else {
            $('#pickup-block').hide();
        }

    });
});
