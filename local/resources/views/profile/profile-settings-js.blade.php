{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 08-Nov-16 4:27 PM
    * File Name    : 

--}}

<script>
    function initMap() {

                @role('retailer')
        var marker;

        var geocoder = new google.maps.Geocoder();

        var infowindow = new google.maps.InfoWindow();


        var map = new google.maps.Map(document.getElementById('myMap'), {
            center: {lat: {{$businessLat}}, lng: {{$businessLng}} },
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        embedZoomButton(map);
        /* var pos = {
         lat: parseFloat($('#latitude').val()),
         lng:  parseFloat($('#longitude').val())
         };
         embedCentralButton(map, pos, false, currentLocation = false);*/


        var input = (document.getElementById('business_address'));
        var autocompleteF = new google.maps.places.Autocomplete(input);
        autocompleteF.bindTo('bounds', map);


        //var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        @if(empty($user->business_lat) || empty($user->business_lng))
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                //infoWindow.setPosition(pos);
                //infoWindow.setContent('Location found.');
                map.setCenter(pos);

                myLatlng = new google.maps.LatLng(pos.lat, pos.lng);
                marker = new google.maps.Marker({
                    map: map,
                    position: myLatlng,
                    draggable: true,
                    icon: mainMarker
                });
                geocoder.geocode({'latLng': myLatlng}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            getLatLng($('input[name="business_address"]'), $('#latitude'), $('#longitude'), marker, results[0], map, infowindow);
                        }
                    }
                });
                embedCentralButton(map, pos, false, currentLocation = false);
                google.maps.event.clearListeners(marker, 'dragend');
                google.maps.event.addListener(marker, 'dragend', function () {
                    updateAddress($('input[name="business_address"]'), $('#latitude'), $('#longitude'), marker, map, infowindow);

                });
                autoComplete(map, $('#latitude'), $('#longitude'), autocompleteF, infowindow, $('input[name="business_address"]'), marker);
            }, function () {
                var myLatlng = new google.maps.LatLng({{$businessLat}}, {{$businessLng}});
                marker = new google.maps.Marker({
                    map: map,
                    position: myLatlng,
                    draggable: true,
                    icon: mainMarker
                });

                infowindow.setContent("{{$user->business_address}}");
                infowindow.open(map, marker);

                google.maps.event.addListener(marker, 'dragend', function () {
                    updateAddress($('input[name="business_address"]'), $('#latitude'), $('#longitude'), marker, map, infowindow);

                });
            });
        } else {

            //infowindow.setContent(results[0].formatted_address);
            //infowindow.open(map, marker);
            // Browser doesn't support Geolocation
            //handleLocationError(false, infoWindow, map.getCenter());
        }
                @else
        var myLatlng = new google.maps.LatLng({{$businessLat}}, {{$businessLng}});
        marker = new google.maps.Marker({
            map: map,
            position: myLatlng,
            draggable: true,
            icon: mainMarker
        });
        infowindow.setContent("{{$user->business_address}}");
        infowindow.open(map, marker);

        google.maps.event.addListener(marker, 'dragend', function () {
            updateAddress($('input[name="business_address"]'), $('#latitude'), $('#longitude'), marker, map, infowindow);


        });
        autoComplete(map, $('#latitude'), $('#longitude'), autocompleteF, infowindow, $('input[name="business_address"]'), marker);
        @endif
        @endrole
        // Address Map
        addressMap();
    }
    function addressMap() {

        var markarAddress;

        var geocoder = new google.maps.Geocoder();

        var infowindow = new google.maps.InfoWindow();


        var map = new google.maps.Map(document.getElementById('address-map'), {
            center: {lat: parseFloat({{$lat}}), lng: parseFloat({{$lng}})},
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var zoomControlDiv = document.createElement('div');
        new ZoomControl(zoomControlDiv, map);

        zoomControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(zoomControlDiv);


        var input = (document.getElementById('address'));
        var autocompleteF = new google.maps.places.Autocomplete(input);
        autocompleteF.bindTo('bounds', map);

        //var infoWindow = new google.maps.InfoWindow({map: map});
        @if(empty($user->latitude))

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

                myLatlng = new google.maps.LatLng(pos.lat, pos.lng);
                markarAddress = new google.maps.Marker({
                    map: map,
                    position: myLatlng,
                    draggable: true,
                    icon: mainMarker
                });

                var setCenterControlDiv = document.createElement('div');
                new SetCenterControl(setCenterControlDiv, map, pos);

                setCenterControlDiv.index = 1;
                map.controls[google.maps.ControlPosition.TOP_RIGHT].push(setCenterControlDiv);

                geocoder.geocode({'latLng': myLatlng}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            getLatLng($('input[name="address"]'), $('#addressLatitude'), $('#addressLongitude'), markarAddress, results[0], map, infowindow);
                        }
                    }
                });
                google.maps.event.clearListeners(markarAddress, 'dragend');
                google.maps.event.addListener(markarAddress, 'dragend, click', function () {
                    updateAddress($('input[name="address"]'), $('#addressLatitude'), $('#addressLongitude'), markarAddress, map, infowindow);
                });
                google.maps.event.addListener(map, 'click', function (event) {
                    placeMarker(event, markarAddress, map, $('#addressLatitude'), $('#addressLongitude'), $('input[name="address"]'), infowindow);
                });
                autoComplete(map, $('#addressLatitude'), $('#addressLongitude'), autocompleteF, infowindow, $('input[name="address"]'), markarAddress);
            }, function () {
                var pos = {lat: parseFloat({{$lat}}), lng: parseFloat({{$lng}})};
                var myLatlng = new google.maps.LatLng(parseFloat({{$lat}}), parseFloat({{$lng}}));
                markarAddress = new google.maps.Marker({
                    map: map,
                    position: myLatlng,
                    draggable: true,
                    icon: mainMarker
                });

                google.maps.event.addListener(markarAddress, 'dragend', function () {
                    updateAddress($('input[name="address"]'), $('#addressLatitude'), $('#addressLongitude'), markarAddress, map, infowindow);
                });

                google.maps.event.addListener(map, 'click', function (event) {
                    placeMarker(event, markarAddress, map, $('#addressLatitude'), $('#addressLongitude'), $('input[name="address"]'), infowindow);
                });

                embedCentralButton(map, pos, false, currentLocation = false);
                autoComplete(map, $('#addressLatitude'), $('#addressLongitude'), autocompleteF, infowindow, $('input[name="address"]'), markarAddress);
            });
        } else {

        }
                @else
        var pos = {lat: parseFloat({{$lat}}), lng: parseFloat({{$lng}})};
        myLatlng = new google.maps.LatLng(parseFloat({{$lat}}), parseFloat({{$lng}}));
        markarAddress = new google.maps.Marker({
            map: map,
            position: myLatlng,
            draggable: true,
            icon: mainMarker
        });

        infowindow.setContent("{{$user->address}}");
        infowindow.open(map, markarAddress);

        google.maps.event.addListener(markarAddress, 'dragend', function () {
            updateAddress($('input[name="address"]'), $('#addressLatitude'), $('#addressLongitude'), markarAddress, map, infowindow);
        });

        google.maps.event.addListener(map, 'click', function (event) {
            placeMarker(event, markarAddress, map, $('#addressLatitude'), $('#addressLongitude'), $('input[name="address"]'), infowindow);
        });

        embedCentralButton(map, pos, false, currentLocation = false);
        autoComplete(map, $('#addressLatitude'), $('#addressLongitude'), autocompleteF, infowindow, $('input[name="address"]'), markarAddress);
        @endif
        // Address Map

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
    $(function () {
        $("#dob").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            yearRange: "-90:+0",
            maxDate: 0
        });

        $('#driver-type').change(function () {
            var type = $(this).val();
            if (type == 1 || type == 2) {
                $('#license-picture').hide();
                $('#commercial-license-box').hide();
            } else if (type == 5) {
                $('#license-picture').show();
                $('#commercial-license-box').show();
            } else {
                $('#license-picture').show();
                $('#commercial-license-box').hide();
            }
        })
    });
    $(".become_driver").click(function (evt) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if ($('input[name="become_driver"]:checked').length > 0) {

            $.ajax({
                url: '{{url("/profile-setting/update-user-type/")}}',
                type: 'POST',
                data: {user_type: 101},
                success: function (response) {
                    $(".edit-documents").slideDown();
                },
                error: function () {

                }
            });
        }
        else {
            $.ajax({
                url: '{{url("/profile-setting/update-user-type/")}}',
                type: 'POST',
                data: {user_type: 100},
                success: function (response) {
                    $(".edit-documents").slideUp();
                },
                error: function () {

                }
            });
        }
    });

    $(".crop-avatar").click(function (e) {
        //$(".avatar-input").click();
    });
    var count = $('.vehicles-list').length;
    var i = count;
    if (count == 0) {
        $('#vehicle-header').hide();
    }
    $("#add-more").click(function (e) {
        var totalVehicles = $('.added-fields').length;
        if (totalVehicles >= 2) {
            $('#limit-exceed').text('You can add only 2 vehicles.').fadeIn('fast').delay(5000).fadeOut(2000);
            return false;
        }

        //var html = $("#vehicle-fields").html();
        var html = '<div class="  added-fields" id=""><div class="form-group  pull-left focus"><div class="col-md-3"><input type="text" name="vehicle[' + i + '][make]" class="form-control" required></div><!-- /.col-md-6 --><div class="col-md-2 nopadding"><input type="text" name="vehicle[' + i + '][model]" class="form-control" required> </div><!-- /.col-md-6 --><div class="col-md-2"><select name="vehicle[' + i + '][year]" class="form-control" required><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option></select></div><!-- /.col-md-6 --><div class="col-md-2 nopadding"><input type="text" name="vehicle[' + i + '][color]" required class="form-control"></div><!-- /.col-md-6 --><div class="col-md-2"><input class="form-control" type="text" name="vehicle[' + i + '][plate_number]" required></div><!-- /.col-md-6 --><div class="col-md-1 col-btn-del"><a style="margin-top: 0" class="btn btn-del remove-vehicle" href="javascript:void(0);">×</a></div></div></div>';
        /* var htmlInput = $(html).find('input');
         htmlInput.each(function(index, val){
         var name = $(val).attr('name');
         name = name.replace(1,2);
         $(val).attr('name',name);
         console.log($(val).attr('name'))
         })*/
        i++;
        $('#vehicle-header').show();
        $('.vehicles-block').append(html);
    });


    function deleteVehicle(ele, id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{url('delete-vehicle')}}",
            data: {id: id},
            success: function (data) {
                if (data.error == 1) {
                    alert(data.msg)
                } else {
                    console.log(ele.parents('.added-fields'));
                    ele.parents('.added-fields').remove()
                }

            },
            error: function () {
                alert('Something went wrong. Please try again')
            }
        });
    }
    $(document).on('click', '.remove-vehicle', function (e) {
        e.preventDefault();
        if ($(this).hasClass('delete')) {
            deleteVehicle($(this), $(this).data('id'));
        }
        else {
            $(this).parents('.added-fields').remove()
        }
        var count = $('.vehicles-list').length;
        var i = count;
        if (count == 0) {
            $('#vehicle-header').hide();
        }

    })
    var taken = false;
    $('#username').change(function () {
        var val = $(this).val();
        var _this = $(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{route('check-username')}}",
            data: {username: val, id:{{$user->id}} },
            success: function (data) {
                if (data > 0) {
                    var html = '<div class="text error" id="error" style="color:darkred">User name already taken.</div>';
                    $('#user_name_block').find('#error').remove();
                    $('#user_name_block').append(html)
                    _this.css({
                        border: "1px solid darkred"
                    });
                    taken = true;
                } else {
                    taken = false;
                    _this.css({
                        border: "1px solid #ccc"
                    });
                    $('#user_name_block').find('#error').remove();
                }
            }
        })
    });
    $('.update-profile').click(function (e) {
        if (taken) {
            return false;
        }
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: $('form.profile_setting').attr('action'),
            data: $('form.profile_setting').serialize(),
            success: function (data) {
                if (data.error == 1) {
                    alert(data.message);
                } else {
                    $('form.profile_setting').submit();
                }
            }
        })
    });

</script>
