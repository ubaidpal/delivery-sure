{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 16-Jun-16 12:14 PM
    * File Name    : 

--}}
<div class="col-md-4">
    <div class="job-view-buyer-detail">
        <!-- Buyer Detail -->
        <div class="buyer-detail mb0">
            <div class="col-sm-12 nopadding">
                @if($order->status != config('constant_settings.ORDER_STATUS.IN_PROCESS'))
                    @if($selectedBid && $selectedBid->bidder_id == $user->id)
                        <h2>Job is awarded to you</h2>
                    @else
                        <h2>Job closed</h2>
                    @endif
                @else
                    <h2>Proposal already submitted</h2>
                @endif
                <small>Your proposed terms</small>
            </div>
            <div class="clearfix"></div>
            <!-- /.buyer-img -->
            <div class="buyer-detail mb0">
                <div class="mt20">
                    <h3>Items(s) Cost:<span>{{format_currency($myBid->proposed_item_value)}}</span></h3>
                </div>
                <div class="clearfix"></div>
                <div class="mt10">
                    <h3>Delivery Fee: <span>{{format_currency($myBid->bid_amount)}}</span></h3>
                </div>
                <div class="bid-desc">
                    {!! $myBid->description !!}
                </div>
                <div class="clearfix"></div>

                @if($order->status == config('constant_settings.ORDER_STATUS.IN_PROCESS') && $myBid->status != config('constant_settings.BID_STATUS.CANCELED_DRIVER'))
                    <a href="{{route('cancel-bid',[encodeId($myBid->id,'orders')])}}" class="btn btn-orange mr10">
                        Cancel
                    </a>
                @elseif($myBid->status == config('constant_settings.BID_STATUS.CANCELED_DRIVER'))
                    <span class="btn btn-orange w-100">
                        Proposal Canceled
                    </span>
                @endif
                {{--{!! HTML::linkRoute('bid.detail-driver','View Detail',[Hashids::connection('orders')->encode($myBid->order_id)],['class'=>'btn btn-orange']) !!}--}}
                @if($order->status == config('constant_settings.ORDER_STATUS.IN_PROCESS') && $myBid->status != config('constant_settings.BID_STATUS.CANCELED_DRIVER'))
                <a class="btn btn-orange" href="#" data-toggle="modal" data-target="#update-bid">Update Bid</a>
                    @endif
            </div>
        </div><!-- /.buyer-detail -->


    </div><!-- /.job-view-buyer-detail -->
</div>



