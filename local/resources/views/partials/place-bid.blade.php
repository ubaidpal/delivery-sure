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
        <div class="buyer-detail">
            <div class="buyer-img">
                <img src="{{getImage($owner->profile_photo_url)}}" alt="image">
            </div><!-- /.buyer-img -->
            <div class="buyer-detail-wrapper">
                <a href="{{route('profile',[encodeId($owner->id,'favourite')])}}">
                    <div class="buyer-name">{{$owner->display_name}}</div>
                </a>


                <?php
                    if($owner->averageRating > 0){
                        $rate = $owner->averageRating;
                    }else{
                        $rate = 0;
                    }
                ?>
                <div  class="" data-rating="{{$rate}}" id="ratings"></div>
            </div><!-- /.buyer-detail-wrapper -->
        </div><!-- /.buyer-detail -->
        {!! Form::open(['route' => ['place-bid'],'data-toggle'=>"validator",'role'=>'form']) !!}
        {!! Form::hidden('order_id', Hashids::connection('orders')->encode($order->id)) !!}
        <div class="form-group">
            <label class="sr-only">Amount (in dollars)</label>

            <div class="input-group">
                <div class="input-group-addon">$</div>
                <input name="item_value" type="number" step="any" min="0" class="form-control" placeholder="Proposed items value" value="{{$order->item_value}}">
            </div>
        </div><!-- /.form-group -->
        <div class="form-group">
            <label class="sr-only">Amount (in dollars)</label>

            <div class="input-group">
                <div class="input-group-addon">$</div>
                <input name="delivery_fee" type="number" step="any" min="1" class="form-control" placeholder="Proposed delivery Fee" required value="{{$order->estimate_delivery_fee}}">
            </div>
        </div>
        <div class="form-group">
            <textarea class="form-control" placeholder="Message" required name="description">I will do it.</textarea>
        </div>


        <button type="submit" class="btn btn-orange btn-block">SUBMIT YOUR BID</button>
        {!! Form::close() !!}
    </div><!-- /.job-view-buyer-detail -->
</div>
