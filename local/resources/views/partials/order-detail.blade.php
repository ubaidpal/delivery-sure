{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 08-Nov-16 12:48 PM
    * File Name    : 

--}}
<div class="job-header-detail">


    <div class="job-status">
        <div class="job-status-item">
            <div class="h4"><i class="fa fa-file-text-o" aria-hidden="true"></i> Estimated Delivery Fees: </div>
            <span>{{format_currency($order->estimate_delivery_fee)}}</span>
        </div><!-- /.job-status-item -->
        
        <div class="job-status-item">
            <div class="h4"><i class="fa fa-clock-o" aria-hidden="true"></i> Delivery Time: </div>
            <span>
                {{getTimeByTZ($order->deliver_date_time, 'h:i A | M-d-Y')}}
            </span>
        </div>
        <div class="job-status-item">
            <div class="h4"><i class="fa fa-usd" aria-hidden="true"></i> Estimated Item(s) Price: </div>
            <span>{{format_currency($order->item_value)}}</span>
        </div><!-- /.job-status-item -->
        @if($order->pick_up_location == 1)
            <div class="job-status-item">
                <div class="h4"><i class="fa fa-clock-o" aria-hidden="true"></i> Pickup Time: </div>
                <span>
                {{getTimeByTZ($order->pick_up_time, 'h:i A | M-d-Y')}}
            </span>
            </div><!-- /.job-status-item -->
        @endif
    </div><!-- /.job-status -->
</div>
<!-- /.job-header-detail -->
