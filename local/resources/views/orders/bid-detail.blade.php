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
                    <a href="{{route('order-detail',[Hashids::connection('orders')->encode($order->id)])}}"
                       class="btn btn-green pull-right">VIEW LISTING</a>
                </div><!-- /.job-header-meta -->

                <div class="job-header-detail">
                    <div class="h3">{{$order->title}}</div>

                    <div class="job-status">
                        {{--<div class="job-status-item">
                            <div class="h4">Status:</div>
                            <span>Urgent</span>
                        </div><!-- /.job-status-item -->--}}
                        <div class="job-status-item">
                            <div class="h4">Estimated Delivery Fees:</div>
                            <span>{{format_currency($order->estimate_delivery_fee)}}</span>
                        </div><!-- /.job-status-item -->
                        <div class="job-status-item">
                            <div class="h4">Estimated Delivery Time:</div>
                            <span>{{\Carbon\Carbon::parse($order->deliver_date_time)->format('h:i A | d-m-y')}}</span>
                        </div><!-- /.job-status-item -->
                    </div><!-- /.job-status -->
                </div><!-- /.job-header-detail -->

                <ul class="bidders-list-group list-group">
                    <li class="list-group-item">
                        <div class="h2b">Bidders</div>
                    </li><!-- /.list-group-item -->

                    <li class="list-group-item">
                        <div class="col-sm-3">
                            <div class="buyer-detail">
                                <div class="buyer-img">
                                    @role('delivery.man')
                                    <img src="{!! getImage($order->owner->profile_photo_url,'61x61') !!}"
                                         alt="image">
                                    @endrole
                                    @role('purchaser')
                                    <img src="{!! getImage($selectedBid->bidder->profile_photo_url,'61x61') !!}"
                                         alt="image">
                                    @endrole
                                    @role('retailer')
                                    <img src="{!! getImage($selectedBid->bidder->profile_photo_url,'61x61') !!}"
                                         alt="image">
                                    @endrole
                                </div>
                                <?php
                                $rate = $selectedBid->bidder->averageRating;
                                $rate = ($rate > 0 ? $rate : 0);
                                ?>
                                <div class="buyer-detail-wrapper">
                                    <div class="buyer-name">
                                        @role('delivery.man')
                                        {{$order->owner->display_name}}
                                        @endrole
                                        @role('purchaser')
                                        {{$selectedBid->bidder->display_name}}
                                        @endrole
                                        @role('retailer')
                                        {{$selectedBid->bidder->display_name}}
                                        @endrole

                                    </div>
                                    <div class="" id="ratting" data-rating="{{$ratting}}"></div>
                                    <div class="">
                                        @role('delivery.man')
                                        ({{getReviewCount($order->owner->id)}} Reviews)
                                        @endrole
                                        @role('purchaser')
                                        ({{getReviewCount($selectedBid->bidder->id)}} Reviews)
                                        @endrole
                                        @role('retailer')
                                        ({{getReviewCount($selectedBid->bidder->id)}} Reviews)
                                        @endrole

                                    </div>
                                    {{-- <div class="">(6 Reviews)</div>--}}
                                </div><!-- /.buyer-detail-wrapper -->
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="my-bid-detail">
                                <div class="h4">Delivery Fees:</div>
                                <span>{{format_currency($selectedBid->bid_amount)}}</span>
                            </div>
                            <div class="my-bid-detail">
                                <div class="h4">Proposed Item Value:</div>
                                <span>{{format_currency($selectedBid->proposed_item_value)}}</span>
                            </div>
                            <div class="my-bid-detail">
                                <div class="h4">Total:</div>
                                <span>{{format_currency($selectedBid->proposed_item_value +$selectedBid->bid_amount )}}</span>
                            </div>
                            <div class="bidders-message">
                                <div class="h3g">Message</div>

                                <p class="txt-b">{{$selectedBid->description}}</p>

                            </div><!-- /.bidders-message -->

                            <!-- Button trigger modal -->

                            @if(!$user->is('delivery.man'))
                                <a class="btn btn-gray"
                                   href="{{route('contact-bidder',[encodeId($selectedBid->bidder_id,'message'),encodeId($order->id,'orders')])}}">Contact
                                    Bidder</a>
                            @endif

                        </div><!-- /.col-sm-9 -->
                        <div class="col-sm-5">
                            @if($selectedBid->status == config('constant_settings.BID_STATUS.REJECTED_PURCHASER'))
                                <div class="form-group">
                                    <label for="email">Rejection Reason:</label>
                                    <p>
                                        {{$selectedBid->rejected_reason}}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </li><!-- /.list-group-item -->
                    @if($order->status == config('constant_settings.ORDER_STATUS.DELIVERED'))
                        <li class="list-group-item">
                            <div class="col-sm-10 col-sm-offset-1">
                                @if(!empty($feedback))
                                    <div class="feedback-seller">
                                        <div class="h3b">Feedback to Delivery Person</div>
                                        <div class="rating-item">
                                            <div class="feedback-rating" id="overAllRatting">

                                            </div>
                                            <div class="txt-b">Ratting</div>
                                        </div><!-- /.rating-item -->
                                        {{--<div class="rating-item">
                                            <div class="feedback-rating" id="feedback-rating">
                                            </div>
                                            <div class="txt-b">Feedback to Delivery Person</div>
                                        </div><!-- /.rating-item -->--}}
                                        <div class="h3b" style="margin-top: 15px">Feedback:</div>
                                        <div class="h3b">{{$feedback->feedback}}</div>
                                    </div>
                                @else
                                    <div class="feedback-seller">
                                        <div class="h3b">Feedback to Delivery Person</div>
                                        {{-- <div class="rating-item">
                                             <div class="feedback-rating" id="overAllRatting">

                                             </div>
                                             <div class="txt-b">Ratting</div>
                                         </div><!-- /.rating-item -->--}}
                                        <div class="rating-item">
                                            <div class="feedback-rating" id="feedback-rating">
                                            </div>
                                            <div class="txt-b">Feedback to Delivery Person</div>
                                        </div><!-- /.rating-item -->
                                    </div><!-- /.feedback-seller -->
                                    {!! Form::open(['route' => ['feedback']]) !!}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="txt-b">Share your experience with this delivery person to the DeliverySure
                                                community</p>

                                            <div class="form-group">
                                        <textarea class="form-control" rows="6" name="feedback"
                                                  id="feedback"></textarea>
                                            </div>

                                            <button type="submit" class="btn btn-green"
                                                    id="submit">Submit
                                            </button>
                                        </div><!-- /.col-sm-6 -->
                                    </div><!-- /.row -->
                                @endif
                                {!! Form::close() !!}

                            </div><!-- /.col-sm-10 -->
                        </li><!-- /.list-group-item -->
                    @endif
                </ul><!-- /.list-group -->

            </div><!-- /.bidders-view-header -->
        </div><!-- /.container -->
    </div><!-- /.bidders-view -->
    @if(!empty($feedback))
        <?php $feedback = $feedback->rating  ?>
    @else
        <?php $feedback = 0  ?>
    @endif
@endsection
@section('footer-scripts')
    @include('includes.modals.bid-payment')
    <script src="https://cdn.worldpay.com/v1/worldpay.js"></script>

    {!! HTML::script('local/public/assets/plugins/ratting/ratting.js') !!}
    {!! HTML::style('local/public/assets/plugins/ratting/ratting.css') !!}
    <script>
        $(function () {
            $("#ratting").rateYo({
                rating: $('#ratting').data('rating'),
                readOnly: true,
                spacing: '2px',
                height: '20px'
            });
            $("#feedback-rating").rateYo({
                rating: 0,
                fullStar: true,
                spacing: '2px',
                height: '20px'
            });

            $("#submit").click(function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });
                /* get rating */
                var rating = $("#feedback-rating").rateYo().rateYo("rating");
                var feedback = $('#feedback').val();
                $.ajax({
                    type: 'POST',
                    url: "{{route('feedback-delivery-person')}}",
                    data: {
                        ratting: rating,
                        feedback: feedback,
                        bid_id: "{{Hashids::connection('orders')->encode($selectedBid->id)}}"
                    },
                    success: function (response) {
                        if (response.status == 1) {
                            //$("#overAllRatting").rateYo("rating", response.ratting);
                            //$("#feedback-rating").rateYo("rating", 0);
                            $('#feedback').val('')
                        } else if (response == 2) {

                        }
                    }
                });

                //window.alert("Its " + rating + " Yo!");
            });
        });
    </script>

@endsection
