{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 20-Jul-16 11:12 AM
    * File Name    :

--}}
@extends('layouts.default')
@section('content')
    @include('includes.sidebar-right-menu')
    <div class="mt20">
        @include('includes.sidebar-left-categories')

        <div class="dashboard-content col-md-6 morejobs" id="dashboard" data-lat="{{config('constant_settings.DEFAULT_LATITUDE')}}"
             data-lng="{{config('constant_settings.DEFAULT_LONGITUDE')}}">
            @include('includes.alerts')
            {!! Form::open(['route'=>['search-driver'],'method'=>'get','id'=>'search-form']) !!}
            {!! Form::hidden('latitude',isset($filter)?$filter['latitude']:$user->latitude,['id'=>'latitude']) !!}
            {!! Form::hidden('longitude',isset($filter)?$filter['longitude']:$user->longitude,['id'=>'longitude']) !!}
            <ul class="list-group riders-list">
                <li class="list-group-item more-filter">
                    <div class="form-group">
                        <div class="form-group">
                            <!--<label>Radius</label>-->
                            <input type="search" name="search"
                                   value="{{isset($filter['search'])?$filter['search']:''}}" class="form-control"
                                   placeholder="Search by name"
                                   id="search">
                        </div><!-- /.form-group -->
                    </div>
                    <div class="clearfix"></div>
                </li><!-- /.list-group-item -->
                <li class="list-group-item radius-left">
                    <!--<label>Keyword</label>-->
                    <div class="input-group">
                        <input type="number" name="radius"
                               value="{{isset($filter['radius'])?$filter['radius']:''}}"
                               class="form-control"
                               placeholder="Miles"
                               id="radius" step="any">
                    </div><!-- /.input-group -->
                    <div class="clearfix"></div>
                </li><!-- /.list-group-item -->
                <li class="list-group-item filter-dropdown">
                    <div class="form-group">
                        <select name="rating" class="form-control" id="ratingField">
                            <option value="top"
                                    @if(isset($filter['rating']) && $filter['rating'] == 'top' ) selected @endif>
                                Top
                                Rated
                            </option>
                            <option value="5"
                                    @if(isset($filter['rating']) && $filter['rating'] == '5' ) selected @endif>5
                                Star
                            </option>
                            <option value="4"
                                    @if(isset($filter['rating']) && $filter['rating'] == '4' ) selected @endif>4
                                Star
                            </option>
                            <option value="3"
                                    @if(isset($filter['rating']) && $filter['rating'] == '3' ) selected @endif>3
                                Star
                            </option>
                            <option value="2"
                                    @if(isset($filter['rating']) && $filter['rating'] == '2' ) selected @endif>2
                                Star
                            </option>
                            <option value="1"
                                    @if(isset($filter['rating']) && $filter['rating'] == '1' ) selected @endif>1
                                Star
                            </option>
                        </select>
                    </div><!-- /.input-group -->

                </li>
                <li class="list-group-item searh-btn">
                    <!--<label>Keyword</label>-->
                    <div class="input-group">
                        <div class="input-group-btn">
                            <button class="btn btn-default search-icon" type="submit"><i class="glyphicon glyphicon-search"></i>
                            </button>

                        </div>
                    </div><!-- /.input-group -->
                </li>
                <div class="clearfix"></div>
            </ul><!-- /.list-group -->
            {!! Form::close() !!}


            @if(count($drivers)> 0)
                @foreach($drivers as $driver)
                    <div class="job-item">
                        <div class="col-md-9">
                            <div class="job-body">
                                <div class="buyer-detail">
                                    <div class="buyer-img">
                                        <a href="{{route('profile',[encodeId($driver['id'],'favourite')])}}">
                                            <img src="{{getImage($driver['profile_photo_url'],'61x61')}}"
                                                 alt="image">
                                        </a>
                                    </div>

                                    <div class="buyer-detail-wrapper">
                                        <div class="buyer-name mt10 mb5">
                                            <a href="{{route('profile',[encodeId($driver['id'],'favourite')])}}">
                                                {{$driver['display_name']}}
                                            </a>
                                            <div class="addFav">

                                            @if(in_array($driver['id'], $favourites))
                                                <a href="javascript:void(0)" class="add-to-fav"
                                                   data-id="{{encodeId($driver['id'],'favourite')}}"
                                                   data-type="remove"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                            @else
                                                <a href="javascript:void(0)" class="remove-from-fav"
                                                   data-id="{{encodeId($driver['id'],'favourite')}}"
                                                   data-type="add"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            @endif



                                    </div>
                                            <a class=""
                                               href="{{route('share.modal',[encodeId($driver['id'],'favourite')])}}" data-toggle="modal"
                                               data-target="#shares"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
                                            {{--<a class="btn btn-link" style="margin-top:2px;"
                                               href="{{route('flag.get-reasons',[encodeId($driver['id'],'favourite'),'driver'])}}"
                                               data-toggle="modal"
                                               data-target="#flag-inappropriate">
                                                <i class="fa fa-flag" aria-hidden="true"></i>
                                            </a>--}}
                                        </div>
                                        <div class="buyer-ratings"
                                             data-rating="@if(!is_null($driver['rating'])) {{$driver['rating']}} @else 0 @endif ">
                                        </div>
                                        
                                    </div><!-- /.buyer-detail-wrapper -->
                                    <div class="clearfix"></div>
                                </div><!-- /.buyer-detail -->
                            </div><!-- /.job-body -->
                        </div>
                        <div class="col-md-3 j-b">{!! progressBar($driver['rating'],$driver[ 'id' ]) !!}</div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 p0">
                        	<div class="col-md-9">
                                <div class="about mt10">
                                    {{\Illuminate\Support\Str::limit($driver['about'], 85)}}
                                </div>
                            	<div class="buyer-address mt10">
                                    {{--<a data-toggle="modal"
                                       data-target="#quick-view-modal"
                                       href="{{route('quick-view.driver',[encodeId($driver['id'],'favourite')])}}"
                                       id="quick-view-{{$driver['id']}}">--}}
                                        <span class="glyphicon glyphicon-map-marker"></span>
                                    {{--</a>--}}

                                    <span class="buyer-address">

                                    {{--{{$driver['address']}}--}}
                                        {{$driver['city'].', '.getCountryName($driver['country'])}}
                                </span>
                                </div><!-- /.place-to-deliver-->
                                <div class="text mt5 mb10">
                                    <span class="glyphicon glyphicon-user"></span> Member Since: {{dateFormat($driver['created_at'])}}
                                </div>
                            </div>
                        	<div class="col-md-3">
                                <a class="btn btn-orange"
                                   href="{{route('invite',[encodeId($driver['id'],'favourite')])}}" data-toggle="modal"
                                   data-target="#invitation">Invite to Job</a>
                        </div>    
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.job-item -->
                @endforeach
            @else
                <div class="job-item">
                    No job found
                </div>

            @endif

        </div><!-- /.dashboard-content -->
        <div class="clearfix"></div>
    </div>
    @if(Request::path() == 'search-driver')
        <?php
        ?>
        <a id="show-map" style="display: none;" href="{{Request::fullUrl()}}&fullScreen=full-screen" data-toggle="modal"
           data-target="#quick-view-modal">Full Screen</a>
    @else
        <a id="show-map" style="display: none;" href="{{Request::url()}}/full-screen" data-toggle="modal"
           data-target="#quick-view-modal">Full Screen</a>
    @endif
    {!! csrf_field() !!}
@endsection

@section('footer-scripts')
    <div class="modal fade bs-example-modal-lg" id="flag-inappropriate" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <div class="filter-bg hide"></div>
    @include('includes.modals.master')
    <div class="modal fade bs-example-modal-lg" id="invitation" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg" id="shares" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    {!! HTML::script('local/public/assets/plugins/ratting/ratting.js') !!}
    {!! HTML::style('local/public/assets/plugins/ratting/ratting.css') !!}
    {!! HTML::style('local/public/assets/css/magicsuggest-min.css') !!}

    {!! HTML::script('local/public/assets/pages/favourite.js') !!}
    {!! HTML::script('local/public/assets/js/magicsuggest-min.js') !!}
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{config('constant_settings.MAP_API_KEY')}}&callback=initMap"
            type="text/javascript"></script>
    <script>
        var driverLocations = <?php echo json_encode($driverMarkers);?>;

    </script>
    <style>
        #myMap {
            height: 100%;
            width: 100%;
        }

        #map {
            height: 540px;
            width: 100%;
        }

        /*.gm-style-iw {

            top: 39px !important;


        }*/
    </style>

    <script>
        $(document).ready(function () {

            var ratings = $('.buyer-ratings');

            ratings.each(function () {
                var rating = $(this).data('rating');
                $(this).rateYo({
                    rating: rating,
                    readOnly: true,
                    spacing: '2px',
                    height: '20px'
                });
            })
        })
    </script>
@endsection
