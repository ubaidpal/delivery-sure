@extends('layouts.default')

        <!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')

@section('content')

        <!-- Job In Progress - Feedback -->
<div class="bidders-view autoheight">
    <div class="container">
        <div class="bidders-view-header">
            <!-- Header Meta -->
            <div class="bidders-header-meta">
                <a href="javascript:void(0);" class="btn btn-sm btn-gray">{{getCategoryName($order->category_id)}}</a>
                <a href="{{route('my-jobs')}}" class="btn btn-green pull-right">VIEW LISTING</a>
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
                        <span>{{format_currency($selectedBid->bid_amount)}}</span>
                    </div><!-- /.job-status-item -->
                    <div class="job-status-item">
                        <div class="h4">Estimated Delivery Time:</div>
                        <span>{{getTimeByTZ($order->deliver_date_time,'h:i A M d, Y')}}</span>
                    </div><!-- /.job-status-item -->
                </div><!-- /.job-status -->
            </div><!-- /.job-header-detail -->

            <ul class="job-progress list-group">
                <li class="progress-pager list-group-item">
                    <div class="progress-pager-block">
                        <div class="progress-pager-item checklist "></div><!-- /.progress-pager-item -->
                        <span class="progress-pager-separator "></span><!-- /.progress-pager-separator -->
                        <div class="progress-pager-item depart"></div><!-- /.progress-pager-item -->
                        <span class="progress-pager-separator "></span><!-- /.progress-pager-separator -->
                        <div class="progress-pager-item delivered active"></div><!-- /.progress-pager-item -->
                    </div><!-- /.progress-pager -->
                    @if($user->id === $order->user_id)
                        <div class="order_pin"><b>Order Pin: {{$order->pin_number}}</b></div>
                    @endif
                </li><!-- /.list-group-item -->

                <li class="list-group-item">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="h2b pull-left">Delivered</div>
                    </div><!-- /.col-sm-10 -->
                </li><!-- /.list-group-item -->

                <li class="list-group-item">
                    <div class="col-sm-5 col-sm-offset-1">
                        @if(!empty($feedback))
                            <div class="feedback-seller">
                                <div class="h3b">
                                    @if($order->user_id == $user->id)
                                        Feedback to Delivery Person
                                    @else
                                        Feedback to Seller
                                    @endif
                                </div>
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
                                <div class="h3b">
                                    @if($order->user_id == $user->id)
                                        Feedback to Delivery Person
                                    @else
                                        Feedback to Seller
                                    @endif
                                </div>
                                {{--<div class="rating-item">
                                    <div class="feedback-rating" id="overAllRatting">

                                    </div>
                                    <div class="txt-b">Ratting</div>
                                </div><!-- /.rating-item -->--}}
                                <div class="rating-item">
                                    <div class="feedback-rating" id="feedback-rating">
                                    </div>
                                    <div class="txt-b">
                                        Feedback to Client
                                    </div>
                                </div><!-- /.rating-item -->
                            </div><!-- /.feedback-seller -->
                            @if($order->user_id != $user->id)
                                {!! Form::open(['route' => ['feedback'],'id'=>'feedback-form']) !!}
                                {!! Form::hidden('order_id',Hashids::connection('orders')->encode($order->id),['id'=>'ref-id']) !!}
                            @else
                                {!! Form::open(['route' => ['feedback-delivery-person'],'id'=>'feedback-form']) !!}
                                {!! Form::hidden('bidder_id',Hashids::connection('orders')->encode($order->selectedBid->id),['id'=>'ref-id']) !!}
                            @endif

                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="txt-b">Share your experience with this purchaser to the DeliverySure
                                        community</p>

                                    <div class="form-group">
                                        <textarea class="form-control" rows="6" name="feedback"
                                                  id="feedback"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-green pull-left"
                                            id="submit">Submit
                                    </button>
                                    <b class="text-danger mt10 pull-left col-sm-offset-1" id="feedback-error"></b>
                                </div><!-- /.col-sm-6 -->
                            </div><!-- /.row -->
                            {!! Form::close() !!}
                        @endif

                    </div>
                    <div class="col-sm-5 col-sm-offset-1" >
                        @if(!empty($myFeedback) && !empty($is_feedback_given))
                            <div class="feedback-seller">
                                <div class="h3b">
                                    @if($order->user_id == $user->id)
                                        Feedback given by Delivery Person
                                    @else
                                        Feedback given by Seller
                                    @endif
                                </div>
                                <div class="rating-item">
                                    <div class="feedback-rating" id="jobRating">

                                    </div>
                                    <div class="txt-b">Ratting</div>
                                </div><!-- /.rating-item -->
                                {{--<div class="rating-item">
                                    <div class="feedback-rating" id="feedback-rating">
                                    </div>
                                    <div class="txt-b">Feedback to Delivery Person</div>
                                </div><!-- /.rating-item -->--}}
                                <div class="h3b" style="margin-top: 15px">Feedback:</div>
                                <div class="h3b">{{$myFeedback->feedback}}</div>
                            </div>
                        @endif

                    </div><!-- /.col-sm-10 -->
                </li><!-- /.list-group-item -->


            </ul><!-- /.list-group -->

        </div><!-- /.bidders-view-header -->
    </div><!-- /.container -->
</div><!-- Job In Progress - Feedback -->
@if(!empty($feedback))
    <?php $feedback = $feedback->rating  ?>
@else
    <?php $feedback = 0  ?>
@endif
@if(!empty($myFeedback))
    <?php $myFeedback = $myFeedback->rating  ?>
@else
    <?php $myFeedback = 0  ?>
@endif
@endsection

@section('footer-scripts')


    {!! HTML::script('local/public/assets/plugins/ratting/ratting.js') !!}
    {!! HTML::style('local/public/assets/plugins/ratting/ratting.css') !!}
    <script>

        $(function () {
            $("#overAllRatting").rateYo({
                rating: "{{$feedback}}",
                readOnly: true,
                spacing: '2px',
                height: '20px'
            });
            $("#jobRating").rateYo({
                rating: "{{$myFeedback}}",
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
                if(rating == 0){
                    $('#feedback-error').text('Please select ratting').fadeIn('fast').delay(1000).fadeOut(800);
                    return false;
                }
                $.ajax({
                    type: 'POST',
                    url: $('#feedback-form').attr('action'),
                    data: {
                        ratting: rating,
                        feedback: feedback,
                        order_id: $('#ref-id').val(),
                        bid_id: $('#ref-id').val()
                    },
                    success: function (response) {
                        if(response.error == 1){
                            $('#feedback-error').text('Please select ratting').fadeIn('fast').delay(1000).fadeOut(800);
                            return false;
                        }
                        if (response.status == 1) {
                            $("#overAllRatting").rateYo("rating", response.ratting);
                            $("#feedback-rating").rateYo("rating", 0);
                            $('#feedback').val('');
                            window.location.reload();
                        } else if (response == 2) {

                        }
                    }
                });

                //window.alert("Its " + rating + " Yo!");
            });
        });
    </script>
@endsection
