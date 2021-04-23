{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 16-Jun-16 2:58 PM
    * File Name    : 

--}}
<div class="col-md-4">
    <div class="job-view-buyer-detail">

        <div class="buyer-detail mb0">
            <div class="buyer-img">
                <img alt="image" src="{{getImage($selectedBid->bidder->profile_photo_url,'61x61')}}">
                <?php
                $rate = $selectedBid->bidder->averageRating;
                $rate = ($rate > 0 ? $rate : 0);
                ?>

            </div><!-- /.buyer-img -->
            <a href="{{route('profile',[encodeId($selectedBid->bidder_id,'favourite')])}}">
                <div class="buyer-detail-wrapper pull-left mt10">
                    <div class="buyer-name">

                        <span> {{$selectedBid->bidder->display_name}}</span>
                        <div class="" id="ratings" data-rating="{{$rate}}"></div>
                    </div>
                </div>
            </a>

            <div class="clearfix"></div>
            <div class="buyer-detail mb0">
                <div class="mt20">
                    <h3>Delivery Fee <span>{{format_currency($selectedBid->bid_amount)}}</span></h3>
                </div>
                <div class="mt10">
                    <h3 class="mb20">Items Value <span>{{format_currency($selectedBid->proposed_item_value)}}</span></h3>
                    {!! HTML::linkRoute('all-bids','All Bids',[Hashids::connection('orders')->encode($order->id)], ['class'=>'btn btn-orange mr10']) !!}
                    {!! HTML::linkRoute('job-progress','View Process',[Hashids::connection('orders')->encode($order->id)], ['class'=>'btn btn-orange']) !!}
                </div>
            </div>
            <!-- /.buyer-detail-wrapper -->
        </div>
    </div>
    @if($order->status == config('constant_settings.ORDER_STATUS.IN_PROCESS') && $order->is_archive == 0 )
        <div class="clearfix"></div>
        <a class="btn btn-orange btn-block" href="{{route('invite',[encodeId($driver['id'],'favourite')])}}"
           data-toggle="modal"
           data-target="#invitation">SEND A JOB INVITATION</a>
    @endif
</div>


