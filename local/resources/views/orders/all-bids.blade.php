{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 16-Jun-16 3:23 PM
    * File Name    :

--}}
@extends('layouts.default')

<!-- Sidebar right menue -->

@section('content')
    @include('includes.sidebar-right-menu')
    <!-- Bidders-view -->
    <div class="bidders-view autoheight">
        <div class="container">
            @include('includes.alerts')
            <div class="bidders-view-header">
                <!-- Header Meta -->
                <div class="bidders-header-meta">
                    <a href="javascript:void(0);" class="btn btn-sm btn-gray">{{getCategoryName($order->category_id)}}</a>
                    {{-- <a href="{{route('order-detail',[Hashids::connection('orders')->encode($order->id)])}}"
                        class="btn btn-green pull-right">VIEW LISTING</a>--}}
                </div><!-- /.job-header-meta -->
                @include('partials.order-detail')

                <ul class="bidders-list-group list-group">
                    @if(count($bids)> 0)
                        <li class="list-group-item">
                            <div class="h2b">Bidders</div>
                        </li><!-- /.list-group-item -->

                        @foreach($bids as $bid)
                            <li class="list-group-item">
                                <div class="col-sm-3">
                                    <div class="buyer-detail">
                                        <div class="buyer-img">
                                            <img src="{{getImage($bid->bidder->profile_photo_url, '61x61')}}"
                                                 alt="image">
                                        </div>

                                        <div class="buyer-detail-wrapper">
                                            <div class="buyer-name">{{$bid->bidder->display_name}}</div>
                                            <?php
                                            $rate = $bid->bidder->averageRating;
                                            $rate = ($rate > 0 ? $rate : 0);
                                            ?>
                                            <div class="buyer-ratings" data-rating="{{$rate}}"></div>
                                            <div class="">({{getReviewCount($bid->bidder->id)}} Reviews)</div>
                                        </div><!-- /.buyer-detail-wrapper -->
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="my-bid-detail">
                                        <div class="h4">Delivery Fees:</div>
                                        <span>{{format_currency($bid->bid_amount)}}</span>
                                    </div>
                                    <div class="my-bid-detail">
                                        <div class="h4">Proposed Item Value:</div>
                                        <span>{{format_currency($bid->proposed_item_value)}}</span>
                                    </div>
                                    <div class="my-bid-detail">
                                        <div class="h4">Total:</div>
                                        <span>{{format_currency($bid->proposed_item_value +$bid->bid_amount )}}</span>
                                    </div>

                                    <div class="bidders-message">
                                        <div class="h3g">Message</div>

                                        <p class="txt-b">{!! nl2br($bid->description) !!}</p>

                                    </div><!-- /.bidders-message -->

                                    <!-- Button trigger modal -->
                                    @if($order->status == config('constant_settings.ORDER_STATUS.IN_PROCESS'))
                                        @if($bid->status != config('constant_settings.BID_STATUS.REJECTED_PURCHASER'))
                                            <a class="btn btn-green" data-toggle="modal" data-target="#bidPayment"
                                               href="{{route('get-bid-detail',[Hashids::connection('orders')->encode($bid->id)])}}">
                                                Confirm and Proceed
                                            </a>
                                            <a class="btn btn-gray"
                                               href="{{route('contact-bidder',[encodeId($bid->bidder_id,'message'), encodeId($order->id,'orders')])}}">
                                                Contact Bidder
                                            </a>
                                        @endif



                                    @elseif($bid->status == config('constant_settings.BID_STATUS.SELECTED'))
                                        <a class="btn btn-gray"
                                           href="{{route('contact-bidder',[encodeId($bid->bidder_id,'message'), encodeId($order->id,'orders')])}}">
                                            Contact Bidder
                                        </a>
                                    @endif



                                </div><!-- /.col-sm-9 -->
                                <div class="col-sm-5">

                                    @if($bid->status == config('constant_settings.BID_STATUS.REJECTED_PURCHASER'))
                                        <div class="label label-danger pull-right">Declined</div>
                                        <div class="clearfix"></div>
                                        <b>Declined Reason:</b><p>{{$bid->rejected_reason}}</p>
                                    @elseif($bid->status == config('constant_settings.BID_STATUS.SELECTED'))
                                        <div class="label label-success pull-right">Selected</div>
                                    @elseif($order->status == config('constant_settings.ORDER_STATUS.IN_PROCESS'))
                                        {!! Form::open(['route'=>['reject-bid']]) !!}
                                        {!! Form::hidden('bid_id', encodeId($bid->id,'orders')) !!}
                                        {!! Form::hidden('order_id', encodeId($bid->order_id,'orders')) !!}
                                        <div class="form-group">
                                            <label for="email">Declined Reason:</label>
                                            <textarea class="form-control" id="email" name="reason"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-red">Declined Bid</button>
                                        {!! Form::close() !!}
                                    @else
                                        {{--<div class="label label-default pull-right">No Action</div>--}}
                                    @endif

                                </div>
                            </li><!-- /.list-group-item -->
                        @endforeach
                    @else
                        <li class="list-group-item">
                            No Bid Found
                        </li>
                    @endif
                </ul><!-- /.list-group -->

            </div><!-- /.bidders-view-header -->
        </div><!-- /.container -->
    </div><!-- /.bidders-view -->

@endsection
@section('footer-scripts')
    @include('includes.modals.bid-payment')
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
        })
    </script>
@endsection
