{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 15-Jun-16 4:33 PM
    * File Name    : 

--}}
<div class="col-md-9">
    <div class="row">
        <div class="modal-map" id="map">

        </div>
    </div><!-- /.row -->
</div><!-- /.col-md-9 -->

<div class="col-md-3">
    <div class="buyer-detail">
        <div class="buyer-img">
            <img src="{!! getImage($owner->profile_photo_url)!!}" alt="image">
        </div>

        <div class="buyer-detail-wrapper">
            <div class="">{{$owner->display_name}}</div>
            <div>
                <div class="" id="my-rating">{{$owner->averageRating}}</div>
            </div>
            {{--<a href="javascript:void(0);" class="btn btn-blue"><span class="glyphicon glyphicon-erase"></span>Contact
                Marilyn</a>--}}
        </div><!-- /.buyer-detail-wrapper -->
    </div><!-- /.buyer-detail -->

    <!-- Modal Content Detail -->
    <div class="modal-content-detail">
        <div class="h3">Job Details</div>
        <p>{{\Illuminate\Support\Str::limit($job->order_description,150)}}</p>

        <div class="h4">Items list to be delivered</div>
        <ul class="list-group">
            @if(count($items) > 0)
                @foreach($items as $item)
                    <li class="list-group-item">
                        <div class="checkbox-container"
                             style="font-size: 30px; height: 9px; line-height: 21px; margin: 0px 7px 0px 0px;">&bullet;</div>
                        <span>{{$item->name}}</span>
                    </li><!-- /.list-group-item -->
                @endforeach
            @else
                No Item Found

            @endif

        </ul><!-- /.list-group -->

        <a href="{{route('order-detail',[Hashids::connection('orders')->encode($job->id)])}}"
           class="btn btn-block btn-orange">
            @if(!empty($myBid))
                UPDATE YOUR BID
            @else
                SUBMIT YOUR BID
            @endif
        </a>
    </div><!-- /.modal-content-detail -->

</div><!-- /.col-md-3 -->
<?php
$rate = $owner->averageRating;
$rating = ($rate > 0 ? $rate : 0);
?>
<style>
    .modal-body {
        margin-top: 50px;
    }
</style>
<script>


    var marker;

    var geocoder = new google.maps.Geocoder();
    var infowindow = new google.maps.InfoWindow();


    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: {{$job->latitude}}, lng: {{$job->longitude}}},
        zoom: 12,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var zoomControlDiv = document.createElement('div');
    new ZoomControl(zoomControlDiv, map);

    zoomControlDiv.index = 1;
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(zoomControlDiv);
    var myLatlng = new google.maps.LatLng({{$job->latitude}}, {{$job->longitude}});
    marker = new google.maps.Marker({
        map: map,
        position: myLatlng,
        //draggable: true,
        icon: "/local/public/assets/images/{{getMapMarker($owner->user_type)}}.svg"
    });
    geocoder.geocode({'latLng': myLatlng}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                infowindow.setContent(results[0].formatted_address);
                infowindow.open(map, marker);
            }
        }
    });
    var setCenterControlDiv = document.createElement('div');
    new SetCenterControl(setCenterControlDiv, map, {lat: {{$job->latitude}}, lng: {{$job->longitude}}}, false);

    setCenterControlDiv.index = 1;
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(setCenterControlDiv);
    $('#my-rating').rateYo({
        rating: {{$rating}},
        readOnly: true,
        spacing: '2px',
        height: '20px'
    });


</script>
