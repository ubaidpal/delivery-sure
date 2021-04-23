{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 20-Jul-16 11:12 AM
    * File Name    :

--}}
@extends('layouts.default')

@section('content')
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=377607942628457";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    @include('includes.sidebar-right-menu')
    <div class="col-md-12">
        <div class="h2b col-sm-6">Favourite Drivers</div>
        <div class="clearfix"></div>
        @if(count($drivers)> 0)
            @foreach($drivers as $driver)
                <div class="job-item">
                    <div class="col-md-6">
                        <div class="job-body">
                            <div class="buyer-detail">
                                <div class="buyer-img">
                                    <a href="{{route('profile',[encodeId($driver->driver->id,'favourite')])}}">
                                        <img src="{{getImage($driver->driver->profile_photo_url,'61x61')}}"
                                             alt="image">
                                    </a>
                                </div>

                                <div class="buyer-detail-wrapper">
                                    <div class="buyer-name mt10 pull-left">
                                        <a href="{{route('profile',[encodeId($driver->driver->id,'favourite')])}}">
                                            {{$driver->driver->display_name}}
                                        </a>
                                    </div>
                                    <div class="invitation-box pull-left ml10">
                                    	@if(\Privacy::check($driver->driver->id,\Config::get('constant_privacy.PROFILE_SHARE.KEY')))
                                        <div class="fb-share-button" data-href="{{route('user.profile',[encodeId($driver->driver->id,'favourite')])}}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{route('user.profile',[encodeId($driver->driver->id,'favourite')])}}&amp;src=sdkpreparse">Share</a></div>
                                        @endif
                                        <div class="addFav pull-left">
                                            @if(in_array($driver->driver->id, $favourites))
                                                <a href="#" class="add-to-fav rem-fav" data-id="{{encodeId($driver->driver->id,'favourite')}}"
                                                ><i class="fa fa-heart" aria-hidden="true"></i></a>
                                            @else
                                                <a href="#" class="remove-from-fav" data-id="{{encodeId($driver['id'],'favourite')}}"
                                                   data-type="add"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            @endif
                                            <a class=""
                                               href="{{route('share.modal',[encodeId($driver->driver->id,'favourite')])}}" data-toggle="modal"
                                               data-target="#shares"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
                                        </div>                                
                                    </div><!-- /.job-footer -->
                            		<div class="clearfix"></div>
                                    <div class="member text"> Member Since: {{dateFormat($driver->driver->created_at)}}</div>
                                    <div class="buyer-address mt10">
                                        <a data-toggle="modal"
                                           data-target="#quick-view-modal"
                                           href="{{route('quick-view.driver',[encodeId($driver->driver->id,'favourite')])}}"
                                           id="quick-view-{{$driver->id}}">
                                            <span class="glyphicon glyphicon-map-marker"></span>
                                        </a>
                                        <span class="buyer-address">

                                           {{-- {{$driver->driver->address}}--}}
                                            {{$driver->driver->city.', '.getCountryName($driver->driver->country)}}
                                        </span>
                                    </div><!-- /.place-to-deliver-->
                                </div><!-- /.buyer-detail-wrapper -->
                                <div class="clearfix"></div>
                            </div><!-- /.buyer-detail -->
                        </div><!-- /.job-body -->
                    </div>
                    <div class="col-md-3 fav-list">
                    	<div class="buyer-ratings"
                             data-rating="@if(!is_null($driver->driver->rating)) {{$driver->driver->rating}} @else 0 @endif ">
                        </div>
                        {!! progressBar($driver->driver->rating,$driver->driver->id) !!}
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="">
                                    <a class="btn btn-orange"
                                       href="{{route('invite',[encodeId($driver->driver->id,'favourite')])}}" data-toggle="modal"
                                       data-target="#invitation">Invite to JOB</a>
                                </div>
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
@endsection

@section('footer-scripts')
    {!! csrf_field() !!}
    <div class="modal fade bs-example-modal-lg" id="shares" tabindex="-1" role="dialog"
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
    <div class="modal fade bs-example-modal-lg" id="invitation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    {!! HTML::script('local/public/assets/plugins/ratting/ratting.js') !!}
    {!! HTML::style('local/public/assets/plugins/ratting/ratting.css') !!}

    {!! HTML::script('local/public/assets/pages/favourite.js') !!}
    {!! HTML::style('local/public/assets/css/magicsuggest-min.css') !!}
    {!! HTML::script('local/public/assets/js/magicsuggest-min.js') !!}
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
        });
        /*$('.rem-fav').click(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault();
            var id = e.target.id;
            $.ajax({
                type: 'POST',
                url: '{{url('removed-favourite-driver')}}',
                data: {userId: id, '_token': $('input[name=_token]').val()},
                success: function (data) {
                    if (data > 0) {
                        var url = window.location.href = '{{url('favourite-jobs-purchaser')}}';
                        location.reload(url);
                    }
                }.bind(this),
                error: function () {
                    this.lastError = NetError.invalidURL;
                }.bind(this)
            });

        });*/

    </script>
@endsection
