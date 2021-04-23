{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 16-Jun-16 2:58 PM
    * File Name    : 

--}}
<div class="col-md-4">
    <div class="job-view-buyer-detail">
        @if($totalBids > 0)
            <div class="buyer-detail">
                <h2 class="pull-left">
                    <span > ({{$totalBids}})</span>
                    Proposal Received &nbsp;
                </h2>
                @if($user->id == $order->user_id)
                    <small class="pull-left">
                        ({{Config::get('constant_settings.ORDER_STATUS_MSG.'.$order->status)}})
                    </small>
                @endif
            </div>
            <div class="buyer-detail pr">
                <h3>
                    Items(s) Cost Range: <span>{{format_currency($minItemValue) .' - '. format_currency($maxItemValue)}}</span>
                </h3>

            </div>
            <div class="buyer-detail pr">
                <h3>
                    Delivery Fee Range: <span>{{format_currency($minBid) .' - '. format_currency($maxBid)}}	</span>
                </h3>
            </div>
            <div class="clearfix"></div>
            {{-- {!! HTML::linkRoute('all-bids','View All',[Hashids::connection('orders')->encode($order->id)], ['class'=>'btn btn-orange']) !!} --}}
        @else
            No bid found!
        @endif
        {{-- @if(count($bids) > 0)
             @foreach($bids->slice(0,5) as $bid)
                 <div class="buyer-detail">
                     <div class="buyer-img">
                         <img alt="image" src="http://dev.demedat.com/local/public/assets/images/dummy-profile.jpg">
                     </div><!-- /.buyer-img -->
                     <div class="buyer-detail-wrapper">
                         <div class="buyer-name">{{$bid->bidder->display_name}}</div>
                         <div class="buyer-rating"></div>
                     </div><!-- /.buyer-detail-wrapper -->
                 </div>
             @endforeach
             {!! HTML::linkRoute('all-bids','View All',[Hashids::connection('orders')->encode($order->id)]) !!}
         @else
             No bid found!
         @endif--}}
    </div>
    <div class="clearfix"></div>
    <div class="bid-btn-wrapper">
        @if($totalBids > 0)
            {!! HTML::linkRoute('all-bids','View Bids',[Hashids::connection('orders')->encode($order->id)], ['class'=>'btn btn-orange pull-left']) !!}
        @endif
        @if($order->status == config('constant_settings.ORDER_STATUS.IN_PROCESS') && $order->is_archive == 0 )
            <a class="btn btn-orange pull-right" href="{{route('invite-job',[encodeId($order->id,'favourite')])}}"
               data-toggle="modal"
               data-target="#invitation">Invite to Job</a>
        @endif
    </div>
</div>

