@extends('layouts.default')

        <!-- Sidebar right menue -->
@section('content')
    @include('includes.sidebar-right-menu')
    <div class="mt20">

        @include('includes.sidebar-left-categories')

        <div class="dashboard-content col-md-6 morejobs" >
            @include('includes.alerts')
            {!! Form::open(['route'=>['filter'],'method'=>'get', 'class'=>'filter-form']) !!}
            <ul class="list-group">


                <li class="list-group-item radius-left">
                    <div class="form-group">
                        <!--<label>Radius</label>-->
                        {!! Form::text('radius',(isset($filter['radius'])?$filter['radius']:''), ['class'=>'form-control','placeholder'=>'Miles','id'=>'radius']) !!}
                    </div><!-- /.form-group -->
                    <div class="clearfix"></div>
                </li><!-- /.list-group-item -->
                <li class="list-group-item more-filter">
                    <div class="form-group">
                        <!--<label>Keyword</label>-->

                        <div class="input-group">
                            <input type="text" value="{{(isset($filter['keyword'])?$filter['keyword']:'')}}" name="keyword"
                                   class="form-control search-input" placeholder="Type Keyword Here...">

                            <div class="input-group-btn">
                                <button class="btn btn-default search-icon" type="submit"><i class="glyphicon glyphicon-search"></i>
                                </button>

                            </div>
                        </div><!-- /.input-group -->
                    </div>
                    <div class="clearfix"></div>
                </li><!-- /.list-group-item -->
                <li class="list-group-item filter-dropdown">
                    <div class="input-group-btn filter-box">
                        <button type="button" class="btn btn-default dropdown-toggle" aria-haspopup="true" aria-expanded="false">More Filter
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right list-group">
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label class="pull-left mt5">Delivery Budget</label>
                                    {{--<div class="progress-bar-block">
                                        <div class="progress-bar" style="width: 60%;"></div>
                                    </div>--}}

                                    {{--<div class="slider-snap" id="delivery-budget"></div>
                                    <div class="progress-bar-distance">
                                        <div class="pull-left" id="min-budget">$70</div>
                                        <div class="pull-right" id="max-budget">$100</div>
                                    </div>--}}
                                    <div class="pull-left" style="width:410px;">
                                        <div class="col-sm-6 col-xs-6 pr0">
                                            {!! Form::text('min_budget',(isset($filter['min_budget'])?$filter['min_budget']:''), ['class'=>'form-control','placeholder'=>'From']) !!}
                                        </div>

                                        <div class="col-sm-6 col-xs-6 pr0">
                                            {!! Form::text('max_budget',(isset($filter['max_budget'])?$filter['max_budget']:''), ['class'=>'form-control','placeholder'=>'To']) !!}
                                        </div>
                                    </div>
                                </div><!-- /.form-group -->
                                <div class="clearfix"></div>
                            </li><!-- /.list-group-item -->
                            <li class="list-group-item">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 search-by col-xs-6">
                                            <label>Search By</label>
                                            <select name="type" class="form-control search-input">
                                                <option value="both" @if(isset($filter) && $filter['type'] == 'both') selected @endif>Both
                                                </option>
                                                <option @if(isset($filter) &&$filter['type'] == config('constant_settings.USER_TYPES.PURCHASER')) selected
                                                        @endif value="{{config('constant_settings.USER_TYPES.PURCHASER')}}">Purchaser
                                                </option>
                                                <option @if(isset($filter) &&$filter['type'] == config('constant_settings.USER_TYPES.RETAILER')) selected
                                                        @endif value="{{config('constant_settings.USER_TYPES.RETAILER')}}">Retailer
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 type-name col-xs-6">
                                            <div class="form-group">
                                                <label>Type Name</label>
                                                {{--<div class="progress-bar-block">
                                                    <div class="progress-bar" style="width: 60%;"></div>
                                                </div>--}}
                                                {{-- <div class="slider-snap" id="radius"></div>
                                                 <div class="progress-bar-distance">
                                                     --}}{{-- <div class="pull-left" id="start-radius">0km</div>--}}{{--
                                                     <div class="pull-right" id="end-radius">50km</div>
                                                 </div>--}}
                                                {!! Form::text('name',(isset($filter['name'])?$filter['name']:''), ['class'=>'form-control','placeholder'=>'Type Name','id'=>'name']) !!}
                                            </div><!-- /.form-group -->
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </li><!-- /.list-group-item -->
                            <li class="list-group-item">
                                <div class="categories-list-group moreCategory">
                                    <div class="h3">Categories</div>
                                    @foreach($categories as $category)
                                        <div class="categories-list-item">
                                            <div class="categories-item-icon {{$category->class}}"></div><!-- /.categories-item-icon -->
                                            <div class="categories-item-name">{{$category->name}}</div><!-- /.categories-item-name -->
                                            <div class="checkbox-container">
                                                <input type="checkbox" name="categories[]" value="{{$category->id}}"
                                                       @if(isset($filter['categories']) && in_array($category->id, $filter['categories'])) checked @endif>
                                            </div><!-- /.categories-item-checkbox -->
                                        </div><!-- /.categories-list-item -->
                                    @endforeach

                                </div><!-- /.categories-list -->
                                <div class="clearfix"></div>
                                <button type="submit" class="btn btn-green apply-filter">APPLY FILTERS</button>
                                <button type="button" id="clear-filters" class="btn btn-green apply-filter">Clear Filters</button>
                            </li><!-- /.list-group-item -->
                            <div class="clearfix"></div>
                        </ul>
                    </div>
                </li>
                <div class="clearfix"></div>
            </ul><!-- /.list-group -->
            {!! Form::hidden('lat', isset($filter)?$filter['lat']:config('constant_settings.DEFAULT_LATITUDE'), ['id'=>'latitude']) !!}
            {!! Form::hidden('lng', isset($filter)?$filter['lng']:config('constant_settings.DEFAULT_LONGITUDE'), ['id'=>'longitude']) !!}
            {!! Form::close() !!}


            @if(count($jobs)> 0)
                @include('jobs.list-box',['data' => $jobs])

            @else
                <div class="job-item">
                    No job found
                </div>

            @endif

            @if(count($jobs)> 2)
                <div class="btn-center-block">
                    <a href="javascript:void(0);" class="btn btn-white show_more">SHOW MORE</a>
                </div><!-- /.btn-center-block -->
            @endif
        </div><!-- /.dashboard-content -->
        <div class="clearfix"></div>
    </div>
    @if(Request::path() == 'filter')
        <?php
        ?>
        <a id="show-map" style="display: none;" href="{{Request::fullUrl()}}&fullScreen=full-screen" data-toggle="modal"
           data-target="#quick-view-modal">Full Screen</a>
    @else
        <a id="show-map" style="display: none;" href="{{Request::url()}}?fullScreen=full-screen" data-toggle="modal"
           data-target="#quick-view-modal">Full Screen</a>
    @endif
@endsection
@section('footer-scripts')
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
    {!! csrf_field() !!}
    {{-- {!! HTML::style('local/public/assets/plugins/range-slider/nouislider.min.css') !!}
     {!! HTML::script('local/public/assets/plugins/range-slider/nouislider.min.js') !!}--}}

    {{--@if(isset($allCategories) )--}}
    <script>
        var locations = <?php echo json_encode($markers);?>;

    </script>
    {{--@endif--}}
    {!! HTML::style('local/public/assets/css/magicsuggest-min.css') !!}
    {!! HTML::script('local/public/assets/js/magicsuggest-min.js') !!}
    {!! HTML::script('local/public/assets/pages/dashboard.js') !!}


    @include('includes.modals.master')
    <style>
        #myMap {
            height: 100%;
            width: 100%;
        }

        #map {
            height: 540px;
            width: 100%;
        }
        .add-remove-fav .add-to-fav {
            width: auto;
        }

        /*.gm-style-iw {

            top: 39px !important;


        }*/
    </style>
    <div class="modal fade bs-example-modal-lg" id="shares" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{config('constant_settings.MAP_API_KEY')}}&libraries=places&callback=initMap"
            type="text/javascript"></script>

    {!! HTML::script('local/public/assets/plugins/ratting/ratting.js') !!}
    {!! HTML::style('local/public/assets/plugins/ratting/ratting.css') !!}



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

            $('.dropdown-toggle').on('click', function () {
                $(this).parent().toggleClass('open');
                $('.filter-form').toggleClass('filter');
                $('.filter-bg').toggleClass('hide');
                $('body').css({overflow: 'hidden'});
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
                    $('body').css({overflow: 'auto'});
                }
            });

            /*$('.dropdown-toggle').on('show.bs.dropdown', function () {
             alert('here')
             })*/
        });
        var page = 10;
        $(document).on("click", ".pageSort", function (e) {


            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });//for token purpose in laravel
            //var page;
            var records = $(".nextRecords").attr('id');
            if ($(".nextRecords").length < 1) {
                //page = 7;
            } else {
                //page = page+2;
            }
            $(".nextRecords").remove();
            var url = "{{url('dashboard/viewMoreCategory')}}" + '/' + page;
            $.ajax({
                type: "Get",
                url: url,
                success: function (result) {
                    $(result).insertBefore('.pageSort');
                    page = page + 5;
                    return false;
                }
            });
        });

        var orders = 20;
        $(document).on("click", ".show_more", function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });//for token purpose in laravel
            //var page;
            var records = $(".nextR").attr('id');
            if ($(".nextR").length < 1) {
                //page = 7;
            } else {
                //page = records;
            }
            $(".nextR").remove();
            var url = '{{url('dashboard/showMoreCategory/')}}' + '/' + orders;
            $.ajax({
                type: "POST",
                url: url,
                success: function (result) {
                    //$(".morejobs").html(result);
                    $(result.html).insertBefore('.btn-center-block');
                    if (result.showMore == 0) {
                        $('.btn-center-block').hide();
                    } else {
                        var ratings = $('.ratings');

                        ratings.each(function () {
                            var rating = $(this).data('rating');
                            $(this).rateYo({
                                rating: rating,
                                readOnly: true,
                                spacing: '2px',
                                height: '20px'
                            });
                        })
                    }

                    orders = orders + 10;
                    return false;
                }
            });
        });


    </script>
@endsection
