@extends('layouts.default')
@section('meta')
    <meta property="og:url" content="{{route('profile',[encodeId($userData->id,'favourite')])}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{$userData->display_name}} - Delivery Sure"/>
    <meta property="og:description" content="{{$userData->about}}"/>
    <meta property="og:image" content="{!! getImage($userData->profile_photo_url, '500x500') !!}"/>
@stop
@section('content')
    {{--@include('includes.sidebar-right-menu')--}}

    <!-- Job Detail View -->
    <div class="job-detail-view autoheight">
        <div class="container">
            <!-- Job Detail View - Body -->
            <div class="job-detail-view-body">
                @if(\Privacy::check($userData->id,\Config::get('constant_privacy.PROFILE_PRIVACY.KEY')))
                    <div class="col-md-8">
                        <div class="row">

                            <!-- Job View Detail Block -->
                            <div class="job-view-detail-block">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="row">
                                                <img src="{!! getImage($userData->profile_photo_url, '254x254') !!}" alt="image">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="profile-wrapper">
                                                <div class="name_l">
                                                    <div class="userName">
                                                        <h2>{{$userData->display_name}}</h2>
                                                        <div class="member text"> Member Since: {{dateFormat($userData->created_at)}}</div>
                                                        <div class="location"><span
                                                                    class="glyphicon glyphicon-map-marker"></span>
                                                            {{$userData->city.', '.getCountryName($userData->country)}}
                                                        </div>
                                                        @if($userData->is('delivery.man'))
                                                            Able to lift: {{$userData->lift_weight}} LB
                                                        @endif
                                                        <p class="text mt10">
                                                            {!! nl2br($userData->about) !!}
                                                        </p>
                                                    </div>
                                                    @if($userData->is('delivery.man'))
                                                        <div class=" col-sm-8 row">
                                                            <h2>Vehicles</h2>
                                                            @if(!empty($userData))
                                                                @foreach($vehicles as $index => $vehicle)
                                                                    <div class="col-sm-12 row">
                                                                        Vehicle {{$index+1}}: {{$vehicle->make.', '.$vehicle->model.', '.$vehicle->color}}
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                No Vehicle added!
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                            {{--<div class="description">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, fuga repellat! Alias consequuntur dolorem neque numquam provident quisquam quo, totam.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, fuga repellat! Alias consequuntur dolorem neque numquam provident quisquam quo, totam. <a href="#">more</a></p>
                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.job-view-detail-block -->

                        <!-- Job View Detail Block -->
                        <div class="job-view-detail-block row">
                            <div class="work-history">Work History <span>({{count($userData->ratings)}} Reviews)</span>
                            </div><!-- /.jvd-item-title -->
                            @foreach($userData->ratings as $rating)
                                <div class="review-wrapper">
                                    <div class="date-box">
                                        <div class="date">{{getTimeByTZ($rating->created_at, 'M d, Y')}} |</div>
                                        <div class="buyer-ratings" data-rating="{{$rating->rating}}"></div>
                                    </div>
                                    <div class="tag-line">
                                        {{--<a href="{{route('order-detail',[encodeId($rating->order->id,'orders')])}}">--}}
                                        {{$rating->order->title}}
                                        {{--</a>--}}
                                    </div>
                                    <p>{{$rating->feedback}}</p>
                                </div>
                            @endforeach
                        </div><!-- /.job-view-detail-block -->

                    </div><!-- /.row -->
            </div><!-- /.col-md-8 -->

            {!! csrf_field() !!}
            <div class="col-md-4">
                <div class="job-view-buyer-detail">
                    <!-- Buyer Detail -->
                    <div class="reputaiton">
                        <h1>Reputation</h1>
                        <?php $ratings = $userData->averageRating ?>
                        <h2>{{number_format($ratings,2)}} <span>/ 5</span></h2>

                        <div class="date-box">
                            <div class="buyer-ratings" data-rating="{{$ratings}}"></div>
                            ({{count($userData->ratings)}} Reviews)
                        </div>
                        @if(Auth::check())
                            <?php $getJobSuccess = getJobSuccess($userData->rating, $userData->id);?>
                            <div class="progress-wrapper">
                                @if(isset($getJobSuccess['status']) && $getJobSuccess['status'] == 1)
                                    {{$getJobSuccess['message']}}
                                @else
                                    <div class="text">{{$getJobSuccess}}% job success</div>
                                    <div class="bar-box">
                                        <div class="bar" style="width:{{$getJobSuccess}}%;"></div>
                                    </div>
                                @endif
                            </div>
                            <a class="btn btn-orange btn-block"
                               href="{{route('invite',[encodeId($userData->id,'favourite')])}}" data-toggle="modal"
                               data-target="#invitation">Invite to JOB</a>

                        @endif
                    </div>
                </div><!-- /.job-view-buyer-detail -->
            </div><!-- /.col-md-4 -->
            @else
                <div class="alert alert-danger " role="alert">
                    <strong>Error!</strong> You cannot view profile of this user. <a href="{{url('login')}}">Log In</a> to view profile.
                </div>
            @endif
        </div><!-- /.job-detail-view-body -->

    </div><!-- /.container -->
    </div><!-- /.job-detail -->

@endsection
@section('footer-scripts')
    <div class="modal fade" id="invitation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
    <style>
        .jq-ry-container {
            float: left;
        }
    </style>
@endsection
