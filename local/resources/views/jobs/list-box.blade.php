{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 29-Jul-16 6:44 PM
    * File Name    : 

--}}
@foreach($jobs as $job)
    <div class="job-item @if($job->owner->user_type ==config('constant_settings.USER_TYPES.RETAILER') ) retailer-job @else purchaser-job @endif">
        <div class="col-md-9">
            <span  class="btn btn-sm btn-yellow item-badge" style="cursor: default">
                @if(isset($job->category->name))
                    {{$job->category->name}}
                @endif
            </span>

            <div class="job-header-detail">
                <a class="pull-left mr10" href="{{route('order-detail',[Hashids::connection('orders')->encode($job->id)])}}">
                    <div class="h3">{{$job->title}} </div>
                    
                </a>

                   {{-- <a data-id="{{Hashids::connection('orders')->encode($job->id)}}" href="javascript:void(0);"
                       class="btn btn-gray save-job">

                    </a>--}}
				<span class="add-remove-fav mr10 pull-left">
                    @if(!empty($job->favourite))
                        <a href="javascript:void(0)" class="add-to-fav save-job"
                           data-id="{{Hashids::connection('orders')->encode($job->id)}}"
                           data-type="remove"><i class="fa fa-heart" aria-hidden="true"></i></a>
                    @else
                        <a href="javascript:void(0)" class="add-to-fav save-job"
                           data-id="{{Hashids::connection('orders')->encode($job->id)}}"
                           data-type="add"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                    @endif

                </span>
                <a class="pull-left" style="margin-top:-3px;"
                   href="{{route('share.job',[encodeId($job->id,'favourite')])}}" data-toggle="modal"
                   data-target="#shares"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
                <div class="clearfix"></div>
            </div>
             
            <!-- Job Body -->
            <div class="job-body">
                <p class="job-detail">
                    {{limit_char($job->order_description,150)}}
                    {{--<a href="javascript:void(0);" class="btn btn-link">more</a>--}}
                </p><!-- /.job-detail -->
            </div><!-- /.job-body -->
            <div class="delivery-time">
                <div class="h4"><span class="glyphicon glyphicon-time pull-left" style="margin-left:0;"></span> Delivery Time</div>
                <span>{{\Carbon\Carbon::parse($job->deliver_date_time)->format('h:i A | d-m-y')}}</span>
            </div><!-- /.job-status-item -->
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="job-status-item">
                    <span>{{format_currency($job->estimate_delivery_fee)}}</span>

                    <div class="h4">Delivery Fee</div>
                </div><!-- /.job-status-item -->

                <!-- Job Footer -->
                <div class="job-footer">
                    <a href="{{route('order-detail',[Hashids::connection('orders')->encode($job->id)])}}"
                       class="btn btn-gray">
                        @if(!empty($job->myBid))
                            Update Bid
                        @else
                            View detail
                        @endif
                    </a>
                    <!-- Button trigger modal
                    <a type="button" id="quick-view-{{$job->id}}" class="btn btn-gray" data-toggle="modal"
                       data-target="#quick-view-modal"
                       href="{{route('quick-view',[Hashids::connection('orders')->encode($job->id)])}}">Quick
                        view</a> -->
                </div><!-- /.job-footer -->
            </div>
        </div>
        <div class="col-md-12 p0">
        	<div class="buyer-detail d-board">

                    <div class="buyer-img">
                        <img src="{{getImage($job->owner->profile_photo_url, '61x61')}}" alt="image">
                    </div>
                    <div class="buyer-detail-wrapper">
                        <div class="mt10 pull-left">
                            <a href="{{route('profile',[encodeId($job->owner->id,'favourite')])}}" class="buyer-name">
                                @if(isset($job->owner->display_name))
                                    {{$job->owner->display_name}}
                                @endif
                            </a>
                        </div>

                        <?php
                        //$rate = $job->owner->averageRating;
                        $rate = $job->owner->rating;
                        $rate = ($rate > 0 ? $rate : 0);
                        ?>
                        <div class="buyer-ratings" data-rating="{{$rate}}"></div>
                        <div class="clearfix"></div>
                        <div class="buyer-address mt5 mr20 pull-left">
                        <span class="glyphicon glyphicon-map-marker"></span>
                        <span class="buyer-address">
                                        {{--@if(isset($job->owner->address))
                                            {{$job->owner->address}}
                                        @endif--}}
                            {{$job->delivery_location}}
                                    </span>
                    </div><!-- /.place-to-deliver-->
                    	<div class="member text mt5 pull-left"><span class="glyphicon glyphicon-user"></span> Member Since: {{dateFormat($job->owner->created_at)}}</div>
                    </div><!-- /.buyer-detail-wrapper -->

                    <div class="clearfix"></div>
                    
                </div><!-- /.buyer-detail -->
        </div>
        <div class="clearfix"></div>
    </div><!-- /.job-item -->
@endforeach
